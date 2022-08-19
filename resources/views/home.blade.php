@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            {{ __('Dashboard') }}
                        </div>

                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle position-relative" href="#" role="button"
                                id="show-notifications" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bell"></i>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{-- @if (auth()->user() && isset($notifications))
                                        {{ $notifications->count() }}
                                    @endif --}}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-notification" aria-labelledby="dropdownMenuLink">

                                {{-- @if (auth()->user() && isset($notifications))
                                    @foreach ($notifications as $notification)
                                        <li><a class="dropdown-item" href="#">{{ $notification->data['name'] }} send
                                                you a notification</a></li>
                                    @endforeach
                                @endif --}}

                            </ul>
                        </div>

                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
                <div class="mt-5">
                    @if (isset($images))
                        @foreach ($images as $image)
                            <img src="data:image/svg;base64,{{ $image->image_base64 }}" width="75px" height="75px"
                                style="margin-left: 5px; border-radius: 50%" alt="">
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        // function allNotifications(){
        //     $.ajax({
        //         url: "/home",
        //         type: "GET",
        //         dataType: "json",
        //         success: function(data) {
        //             var data = "";
        //             $.each(data, function(key, value){

        //                 data = data + "<li>"
        //                 data = data + "<a class='dropdown-item' href='#'>" + value.type + "</a>"
        //                 data = data + "</li>"

        //             })
        //             $('.dropdown-menu-notification').html(data);
        //         }
        //     });
        // }
        // allNotifications();
    </script>
@endsection
