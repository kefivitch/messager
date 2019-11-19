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

                            @include('components.parameters.appearance')
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
                        <button class="btn btn-circle btn-neutral sidebar-toggler" data-toggle="sidebar-offcanvas">
                            <i class="ml-n3" data-eva="chevron-left"></i>
                        </button>
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
