<div class="accordion-item">
    <div class="accordion-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" role="button"
        aria-expanded="false" aria-controls="collapseOne">
        <div class="mr-auto">
            <h6 class="mb-1 lh-150">My Account</h6>
            <p>Configure your preferences.</p>
        </div>
        <i data-eva="arrow-ios-forward"></i>
        <i data-eva="arrow-ios-downward"></i>
    </div>
    <div class="collapse" id="collapseOne" data-parent="#accordionOne" aria-labelledby="headingOne">
        <div class="accordion-body">
            <form method="POST" action="{{ route('updateUser') }}">
                @csrf
                @method('POST')
                <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                <label for="name">Name</label>
                <input class="form-control form-control-lg mb-5" name="name" value="{{ Auth::user()->name }}" id="name" type="text" placeholder="Name">
                <label for="email">Email</label>
                <input class="form-control form-control-lg mb-5" name="email" value="{{ Auth::user()->email }}" id="email" type="email" placeholder="Email Address">
                {{-- <label for="address">Address</label>
                <input class="form-control form-control-lg mb-5" id="address" type="text" placeholder="Address">
                <label for="biography">Biography</label>
                <textarea class="form-control mb-5" id="biography" rows="3"
                    placeholder="Tell us a little about yourself"></textarea> --}}
                <input type="submit" class="btn btn-block btn-lg btn-primary" value="Apply changes">
            </form>
        </div>
    </div>
</div>
