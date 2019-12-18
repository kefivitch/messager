<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swipe - The Simplest Chat Platform</title>
    <meta name="description" content="#">
    <link rel="stylesheet" href="{{ asset('\css\grayshift.min.css') }}">
    <link rel="stylesheet" href="{{ asset('\css\swipe.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
            <style type="text/css">/**
         * @license
         * Copyright Akveo. All Rights Reserved.
         * Licensed under the MIT License. See License.txt in the project root for license information.
         */
        .eva-animation {
        animation-duration: 1s;
        animation-fill-mode: both; }

        .eva-infinite {
        animation-iteration-count: infinite; }

        .eva-icon-shake {
        animation-name: eva-shake; }

        .eva-icon-zoom {
        animation-name: eva-zoomIn; }

        .eva-icon-pulse {
        animation-name: eva-pulse; }

        .eva-icon-flip {
        animation-name: eva-flipInY; }

        .eva-hover {
        display: inline-block; }

        .eva-hover:hover .eva-icon-hover-shake, .eva-parent-hover:hover .eva-icon-hover-shake {
        animation-name: eva-shake; }

        .eva-hover:hover .eva-icon-hover-zoom, .eva-parent-hover:hover .eva-icon-hover-zoom {
        animation-name: eva-zoomIn; }

        .eva-hover:hover .eva-icon-hover-pulse, .eva-parent-hover:hover .eva-icon-hover-pulse {
        animation-name: eva-pulse; }

        .eva-hover:hover .eva-icon-hover-flip, .eva-parent-hover:hover .eva-icon-hover-flip {
        animation-name: eva-flipInY; }

        @keyframes eva-flipInY {
        from {
            transform: perspective(400px) rotate3d(0, 1, 0, 90deg);
            animation-timing-function: ease-in;
            opacity: 0; }
        40% {
            transform: perspective(400px) rotate3d(0, 1, 0, -20deg);
            animation-timing-function: ease-in; }
        60% {
            transform: perspective(400px) rotate3d(0, 1, 0, 10deg);
            opacity: 1; }
        80% {
            transform: perspective(400px) rotate3d(0, 1, 0, -5deg); }
        to {
            transform: perspective(400px); } }

        @keyframes eva-shake {
        from,
        to {
            transform: translate3d(0, 0, 0); }
        10%,
        30%,
        50%,
        70%,
        90% {
            transform: translate3d(-3px, 0, 0); }
        20%,
        40%,
        60%,
        80% {
            transform: translate3d(3px, 0, 0); } }

        @keyframes eva-pulse {
        from {
            transform: scale3d(1, 1, 1); }
        50% {
            transform: scale3d(1.2, 1.2, 1.2); }
        to {
            transform: scale3d(1, 1, 1); } }

        @keyframes eva-zoomIn {
        from {
            opacity: 1;
            transform: scale3d(0.5, 0.5, 0.5); }
        50% {
            opacity: 1; } }
        </style>
</head>

<body onload="updateConversation();" >
    <div class="d-flex flex-column flex-lg-row">
        @include('components.navbar')
        <div class="sidebar sidebar-expand-lg order-1 order-lg-0">
            <div class="container py-5 px-lg-5">
                <form>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <i data-eva="search"></i>
                        </div>
                        <input class="form-control form-control-lg" type="search" placeholder="Search"
                            aria-label="Search">
                    </div>
                </form>
                <div class="row">
                    <style>
                        .alert {
                            margin-top: 10px;
                            padding: 20px;
                            width : 100%;
                        }    
                        .alert-success {
                            color: #468847;
                            background-color: #dff0d8;
                            border-color: #d6e9c6;
                        }

                        .alert-error {
                            color: #b94a48;
                            background-color: #f2dede;
                            border-color: #eed3d7;
                        }
                    </style>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-error" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="tab-content">
                    <input type="hidden" value="" id="selectedChannel">
                    <div class="tab-pane fade show active" id="channels" role="tabpanel">
                         <ul class="nav nav-tabs nav-justified nav-sm mt-3" role="tablist" aria-orientation="horizontal">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#direct" role="tab"
                                    aria-controls="direct" aria-selected="true">Direct</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#groups" role="tab" aria-controls="groups"
                                    aria-selected="false">Groups</a>
                            </li>
                        </ul>
                        <div class="d-flex align-items-center mt-5">
                            <h3 class="mr-3">Channels</h3>
                            
                            <button class="btn btn-sm btn-circle btn-neutral" data-toggle="modal" data-target="#compose"
                                type="button">
                                <i data-eva="edit-2" data-eva-width="20" data-eva-height="20"></i>
                            </button>
                        </div>
                        <hr class="mb-0">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="direct" role="tabpanel">

                            </div>
                            <div class="tab-pane fade" id="groups" role="tabpanel">
                                @include('components.groups')
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="friends" role="tabpanel">
                        <h3 class="my-5">Friends</h3>
                        <hr class="mb-0">
                        @include('components.friends')
                    </div>
                    <div class="tab-pane fade" id="notifications" role="tabpanel">
                        <h3 class="my-5">Notifications</h3>
                        <hr class="mb-0">
                        @include('components.notifications')
                    </div>
                    <div class="tab-pane fade" id="settings" role="tabpanel">
                        <h3 class="my-5">Settings</h3>
                        <hr class="mb-0">
                        <div id="accordionOne">
                            @include('components.parameters.account')
                            @include('components.parameters.privacy')
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @include('components.modal')
        <main class="flex-lg-grow-1">
            <div class="chat chat-offcanvas open">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <div class="container px-lg-5">
                            @include('components.chat.header')
                            @include('components.chat.body')
                            @include('components.chat.footer')
                        </div>
                        
                    </div>
                    @include('components.chat.sidebar')
                </div>
            </div>
        </main>
    </div>
    <script>
        var user_id = {{ Auth::user()->id }};
        conversation_id = null ;
    </script>
    <script src="{{ asset('js\jquery-3.4.1.slim.min.js') }}"></script>
    
    <script src="{{ asset('js\bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js\eva.min.js') }}"></script>
    <script src="{{ asset('js\offcanvas.min.js') }}"></script>
    <script src="{{ asset('js\axios.min.js') }}"></script>
    <script src="{{ asset('js\conversation.js') }}"></script>
    <script src="{{ asset('js\messages.js') }}"></script>
    
<script>
function sendMsg() {
        message = document.getElementById('message-input').value;
        document.getElementById('message-input').value = "";
        //console.log(message.value);
        axios.post('http://messager.test/api/send/' + user_id+'/'+conversation_id,{data:{message:message}})
                .then(resp => {
                    //console.log(resp.data);
                });
        //message = "";
    }
</script>
    <script>
        eva.replace()
    </script>
    <script>
        // Enable pusher logging - don't include this in production
        //Pusher.logToConsole = true;

        var pusher = new Pusher('b3090ece02c41b33bc54', {
            cluster: 'eu',
            forceTLS: true
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            var direct = document.getElementById('direct');
            updateConversation();
            var conv_id = document.getElementById('selectedChannel').value;
            reloadMsg(conv_id);
            //console.log("conv :"+conv_id);
        });

    </script>
</body>

</html>
