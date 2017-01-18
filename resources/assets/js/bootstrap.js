
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
require('vue-resource');

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo"


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'c39fe439002d5f3b8990',
    cluster: 'eu',
    encrypted: true
});

var url = window.location.pathname;
var id = url.substring(url.lastIndexOf('/') + 1);

//listening for chat message and creates html for it
window.Echo.private('chat-room.' + id)
    .listen('ChatMessageReceived', (e) => {
    	var htmlText = '<li class="left clearfix"><div class="chat-body clearfix"><div class="header"><strong class="primary-font user-name"></strong> </div><p class="user-message"></p></div></li>';
        if ($(".left clearfix").length){
        	$(htmlText).insertAfter($(".left clearfix").first());
            // $("#chat-div ul li:last").append(htmlText);
        } else {
            $("#chat-div ul").append(htmlText);
            // $(htmlText).insertAfter($(".chat"));         
        }
        $(".user-name").last().text(e.user.name+":");
        $(".user-message").last().text(e.chatMessage.message);
        $("#chat-div").animate({ scrollTop: $(document).height() }, "slow")
    });

//adding new video
window.Echo.private('script-room.' + id)
    .listen('NewVideoAdded', (e) => { 
        if ($("#player").length){
            var video_id = e.videoMessage.split('v=')[1];
            var ampersandPosition = video_id.indexOf('&');
            if(ampersandPosition != -1) {
              video_id = video_id.substring(0, ampersandPosition);
            }
            var htmlText = '<iframe id="player" width="760" height="415" src="https://www.youtube.com/embed/'+ video_id +'?autoplay=1"  frameborder="0" allowfullscreen"></iframe>';
            $("#player").replaceWith($(htmlText));
        }
    });

//adding current video for new user in the room
window.Echo.private('currentVideo-room.' + id)
    .listen('CurrentVideo', (e) => { 
        if ($("#player").length){
            var video_id = e.url.split('v=')[1];
            var ytime = '&start='+ e.diff;    
            var ampersandPosition = video_id.indexOf('&');
            if(ampersandPosition != -1) {
              video_id = video_id.substring(0, ampersandPosition);
            }
            var htmlText = '<iframe id="player" width="760" height="415" src="https://www.youtube.com/embed/'+ video_id +'?autoplay=1'+ ytime +'"  frameborder="0" allowfullscreen"></iframe>';
            $("#player").replaceWith($(htmlText));
        }
    });