$(document).ready(function(){

    var url = window.location.pathname;
    var id = url.substring(url.lastIndexOf('/') + 1);

    //sendig message from chat
    $("#btn-input").on('keyup', function(e){
        if(e.keyCode == 13){
          $.post("./chatMessage", {
              message: $("#btn-input").val()
          })
          $("#btn-input").val('');
        }
    });

    //sendig message from chat
    $("#btn-chat").click(function(){
        $.post("./chatMessage", {
            message: $("#btn-input").val()
        })
        $("#btn-input").val('');
    });

    //sendig new video's url
    $("#btn-video-input").on('keyup', function(e){
        if(e.keyCode == 13){
          $.post("./videoMessage", {
              message: $("#btn-video-input").val(),
              roomid: id
          })
          $("#btn-video-input").val('');
        }
    });

    //sendig new video's url
    $("#btn-video").click(function(){
        $.post("./videoMessage", {
            message: $("#btn-video-input").val(),
            roomid: id
        })
        $("#btn-video-input").val('');
    });

    //getting current video in this room
    window.setTimeout(function(){
      $.post("./getCurrentVideo", {
            roomid: id
      })
    }, 800);

});





//old version...

 // // 2. This code loads the IFrame Player API code asynchronously.
 //      var tag = document.createElement('script');

 //      tag.src = "https://www.youtube.com/iframe_api";
 //      var firstScriptTag = document.getElementsByTagName('script')[0];
 //      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

 //      // 3. This function creates an <iframe> (and YouTube player)
 //      //    after the API code downloads.
 //      var player;
 //      function onYouTubeIframeAPIReady() {
 //        player = new YT.Player('player', {
 //          height: '360',
 //          width: '640',
 //          videoId: 'M7lc1UVf-VE',
 //          events: {
 //            'onReady': onPlayerReady,
 //            'onStateChange': onPlayerStateChange
 //          }
 //        });
 //      }

 //      // 4. The API will call this function when the video player is ready.
 //      function onPlayerReady(event) {
 //        event.target.playVideo();
 //      }

 //      // 5. The API calls this function when the player's state changes.
 //      //    The function indicates that when playing a video (state=1),
 //      //    the player should play for six seconds and then stop.
 //      var done = false;
 //      function onPlayerStateChange(event) {
 //        if (event.data == YT.PlayerState.PLAYING && !done) {
 //          setTimeout(stopVideo, 6000);
 //          done = true;
 //        }
 //      }
 //      function stopVideo() {
 //        player.stopVideo();
 //      }