@extends('layouts.app')

@section('style')
@endsection

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Join a room</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="room-url" class="col-md-4 control-label">Room url</label>

                                    <div class="col-md-6">
                                        <input id="room-url" type="text" class="form-control" name="room-url" value="{{ old('room-url') }}" autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Join
                                        </button>
                                        or leave this field empty to create new
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
    </div>



@endsection
