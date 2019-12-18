<nav class="navside navside-expand-lg sticky-top order-2 order-lg-0">
    <div class="container">
        <a class="d-none d-lg-inline" rel="home" href="#">
            <i class="eva-xl" data-eva="github" data-eva-animation="pulse"></i>
        </a>
        <ul class="nav navside-nav" role="tablist" aria-orientation="vertical">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#channels" role="tab" aria-controls="channels"
                    aria-selected="true">
                    <i class="eva-md" data-eva="message-square" data-eva-animation="pulse"></i>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#friends" role="tab" aria-controls="friends"
                    aria-selected="false">
                    <i class="eva-md" data-eva="people" data-eva-animation="pulse"></i>
                </a>
            </li> --}}
            <li class="nav-item flex-lg-grow-1">
                <a class="nav-link" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications"
                    aria-selected="false">
                    <!--<i class="eva-md" data-eva="bell" data-eva-animation="pulse"></i>-->
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-controls="settings"
                    aria-selected="false">
                    <i class="eva-md" data-eva="settings" data-eva-animation="pulse"></i>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link" href="/logout">
                    <i class="eva-md" data-eva="log-out-outline" data-eva-animation="pulse"></i>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block">
                @php
                                $words = explode(" ", Auth::user()->name);
                                $acronym = "";
                                foreach ($words as $w) {
                                    $acronym .= $w[0];
                                }
                            @endphp
                <span class="avatar avatar-md status status-online h5 bg-primary rounded-circle">{{ $acronym }}</span>
            </li>
        </ul>
    </div>
</nav>
