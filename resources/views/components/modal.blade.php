<div class="modal fade" id="compose" tabindex="-1" role="dialog" aria-labelledby="composeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="composeLabel">Compose</h4>
                <button class="btn btn-sm btn-circle btn-neutral align-self-start" data-dismiss="modal" type="button"
                    aria-label="Close">
                    <i data-eva="close" aria-hidden="true"></i>
                </button>
            </div>
            <div class="modal-body p-0">
                <ul class="nav nav-tabs nav-justified p-3 px-sm-5 rounded-0" role="tablist"
                    aria-orientation="horizontal">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#details" role="tab" aria-controls="details"
                            aria-selected="true">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#members" role="tab" aria-controls="members"
                            aria-selected="false">Members</a>
                    </li>
                </ul>
                <div class="px-3 py-5 px-sm-5">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="details" role="tabpanel">
                            <form method="POST" action={{ route('createConv') }}>
                                @csrf
                                @method('POST')
                                <label for="subject">Subject</label>
                                <input class="form-control form-control-lg mb-5" id="subject" name="subject" type="text"
                                    placeholder="What's the subject?">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" id="message" rows="3"
                                    placeholder="Hmm, are you friendly?"></textarea>
                            
                        </div>
                        <div class="tab-pane fade" id="members" role="tabpanel">
                            
                                <div class="input-group mb-5">
                                    <div class="input-group-prepend">
                                        <i data-eva="funnel-outline"></i>
                                    </div>
                                    <input class="form-control form-control-lg" type="search" placeholder="Search"
                                        aria-label="Search">
                                </div>
                            
                            <h3>Members</h3>
                            <hr class="mb-0">
                            @foreach (App\User::all() as $user)
                            @php
                                $words = explode(" ", $user->name);
                                $acronym = "";
                                foreach ($words as $w) {
                                    $acronym .= $w[0];
                                }
                            @endphp

                                <div class="d-flex py-5 border-bottom">
                                    <span
                                        class="avatar avatar-sm status status-online mr-3 bg-primary rounded-circle">{{ $acronym }}</span>
                                    <div class="mr-auto">
                                        <h6 class="mb-2 lh-100">{{ $user->name }}</h6>
                                        <p class="lh-100">{{ $user->email }}</p>
                                    </div>
                                    <div class="form-check align-self-center ml-3">
                                        <input class="form-check-input" value="{{ $user->id }}" name="users[]" type="checkbox">
                                    </div>
                                </div>
                            @endforeach
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input vlaue="Compose" class="btn btn-block btn-lg btn-primary" type="submit">
            </div>
            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
            </form>
        </div>
    </div>
</div>
