@extends('layouts.app')

@section('style')
    {{ Html::style('css/room.css') }}
@endsection

@section('script')
    <script type="text/javascript">
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    </script>
    {{ Html::script('js/room.js') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="panel-footer">
            <div class="input-group">
                <input id="btn-video-input" type="text" class="form-control input-sm" placeholder="Type your video here...">
                <span class="input-group-btn">
                    <button class="btn btn-warning btn-sm" id="btn-video">
                        Send
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div id="player"></div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span> Chat
                </div>
                <div class="panel-body" id="chat-div">
                    <ul class="chat">
                    </ul>
                </div>
                <div class="panel-footer">
                        <div class="input-group">
                            <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here...">
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm" id="btn-chat">
                                    Send
                                </button>
                            </span>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection