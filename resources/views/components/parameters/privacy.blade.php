<div class="accordion-item">
    <div class="accordion-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" role="button"
        aria-expanded="false" aria-controls="collapseTwo">
        <div class="mr-auto">
            <h6 class="mb-1 lh-150">Privacy & Safety</h6>
            <p>Configure your preferences.</p>
        </div>
        <i data-eva="arrow-ios-forward"></i>
        <i data-eva="arrow-ios-downward"></i>
    </div>
    <div class="collapse" id="collapseTwo" data-parent="#accordionOne" aria-labelledby="headingTwo">
        <div class="accordion-body">
            <form action="{{ route('updatePassword') }}" method="POST">
                @csrf
                @method('post')
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <label for="currentPassword">Current Password</label>
                <input name="curPassword" class="form-control form-control-lg mb-5" id="currentPassword" type="password"
                    placeholder="Current Password">
                <label for="newPassword">New Password</label>
                <input name="password" class="form-control form-control-lg mb-5" id="newPassword" type="password"
                    placeholder="New Password">
                <label for="repeatPassword">Repeat Password</label>
                <input name="password_confirmation" class="form-control form-control-lg mb-5" id="repeatPassword" type="password"
                    placeholder="Repeat Password">
                <input class="btn btn-block btn-lg btn-primary" type="submit" value="Apply changes">
            </form>
        </div>
    </div>
</div>
