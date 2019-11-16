<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swipe - The Simplest Chat Platform</title>
    <meta name="description" content="#">
    <link rel="stylesheet" href="{{ asset('\css\grayshift.min.css') }}">
    <link rel="stylesheet" href="{{ asset('\css\swipe.min.css') }}">
</head>

<body>
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
                                @include('components.conversations')
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
    
    <script src="{{ asset('js\jquery-3.4.1.slim.min.js') }}"></script>
    <script src="{{ asset('js\bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js\eva.min.js') }}">
    </script>
    <script src="{{ asset('js\offcanvas.min.js') }}"></script>
    <script src="{{ asset('js\axios.min.js') }}"></script>
    <script>
    </script>
    <script>
        eva.replace()
    </script>
    <script >
        var user_id={{ Auth::user()->id }} ;
        var direct=$('#direct');
        axios.post('/api/conversations/'+user_id).then(resp => {
            //console.log();
            conversations = resp.data;
            //console.log(conversations["163"]);
            for (var key in conversations) {
                //console.log("key " + key );
                var name = conversations[key].participants[0].name;
                var initials = name.match(/\b\w/g) || [];
                initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();
                str = '<div class="channel ';
                if(conversations[key].conversation.last_message){
                    
                    if(conversations[key].conversation.last_message.is_seen == 0){
                        str+= 'active';
                        
                    }
                }
                str+= '"><span class="avatar avatar-sm status status-online mr-3 bg-primary rounded-circle">'+initials+'</span>';
                str+= '<div class="flex-grow-1"><div class="d-flex align-items-center mb-3"><h6 class="mr-auto">'
                str+= conversations[key].participants[0].name;
                str+= '</h6><p class="ml-3">';
                str+= conversations[key].conversation.diff;
                str+= '</p></div><p class="text">';
                if(conversations[key].conversation.last_message) {
                    str+= conversations[key].conversation.last_message.body;
                }
                else {
                    str+= 'Exemple of sent message.'
                }
                str+= '</p></div>'
                str+= '<input type="hidden" value="';
                str+= key+'" id="conv_id"></div>';
                direct.prepend(str);
                
            }
            console.log(conversations["163"].conversation.last_message.body);
        });
    </script>
</body>

</html>
