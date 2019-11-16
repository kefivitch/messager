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
                            <form>
                                <label for="subject">Subject</label>
                                <input class="form-control form-control-lg mb-5" id="subject" type="text"
                                    placeholder="What's the subject?">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="3"
                                    placeholder="Hmm, are you friendly?"></textarea>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="members" role="tabpanel">
                            <form>
                                <div class="input-group mb-5">
                                    <div class="input-group-prepend">
                                        <i data-eva="funnel-outline"></i>
                                    </div>
                                    <input class="form-control form-control-lg" type="search" placeholder="Search"
                                        aria-label="Search">
                                </div>
                            </form>
                            <h3>Members</h3>
                            <hr class="mb-0">
                            <div class="d-flex py-5 border-bottom">
                                <span
                                    class="avatar avatar-sm status status-online mr-3 bg-primary rounded-circle">jd</span>
                                <div class="mr-auto">
                                    <h6 class="mb-2 lh-100">John Doe</h6>
                                    <p class="lh-100">Manhattan</p>
                                </div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="d-flex py-5 border-bottom">
                                <span
                                    class="avatar avatar-sm status status-offline mr-3 bg-success rounded-circle">jd</span>
                                <div class="mr-auto">
                                    <h6 class="mb-2 lh-100">John Doe</h6>
                                    <p class="lh-100">Manhattan</p>
                                </div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="d-flex py-5 border-bottom">
                                <span
                                    class="avatar avatar-sm status status-offline mr-3 bg-info rounded-circle">jd</span>
                                <div class="mr-auto">
                                    <h6 class="mb-2 lh-100">John Doe</h6>
                                    <p class="lh-100">Manhattan</p>
                                </div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="d-flex py-5 border-bottom">
                                <span
                                    class="avatar avatar-sm status status-offline mr-3 bg-warning rounded-circle">jd</span>
                                <div class="mr-auto">
                                    <h6 class="mb-2 lh-100">John Doe</h6>
                                    <p class="lh-100">Manhattan</p>
                                </div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="d-flex py-5 border-bottom">
                                <span
                                    class="avatar avatar-sm status status-offline mr-3 bg-danger rounded-circle">jd</span>
                                <div class="mr-auto">
                                    <h6 class="mb-2 lh-100">John Doe</h6>
                                    <p class="lh-100">Manhattan</p>
                                </div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="d-flex py-5 border-bottom">
                                <span
                                    class="avatar avatar-sm status status-offline mr-3 bg-primary rounded-circle">jd</span>
                                <div class="mr-auto">
                                    <h6 class="mb-2 lh-100">John Doe</h6>
                                    <p class="lh-100">Manhattan</p>
                                </div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="d-flex py-5 border-bottom">
                                <span
                                    class="avatar avatar-sm status status-offline mr-3 bg-success rounded-circle">jd</span>
                                <div class="mr-auto">
                                    <h6 class="mb-2 lh-100">John Doe</h6>
                                    <p class="lh-100">Manhattan</p>
                                </div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                            <div class="d-flex py-5 border-bottom">
                                <span
                                    class="avatar avatar-sm status status-offline mr-3 bg-info rounded-circle">jd</span>
                                <div class="mr-auto">
                                    <h6 class="mb-2 lh-100">John Doe</h6>
                                    <p class="lh-100">Manhattan</p>
                                </div>
                                <div class="form-check align-self-center ml-3">
                                    <input class="form-check-input" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-block btn-lg btn-primary" type="submit">Compose</button>
            </div>
        </div>
    </div>
</div>
