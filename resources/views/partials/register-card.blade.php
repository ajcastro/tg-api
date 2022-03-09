<div class="card login-card card-main">
    <div class="card-body">
        <div class="mb-3 text-center text-uppercase">
            <h5>
                Register
            </h5>
        </div>
        <div class="mb-3">
            <label for="username-form-control" class="form-label">Username</label>
            <input type="text" class="form-control form-control-sm" id="username-form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="email-form-control" class="form-label">Email</label>
            <input type="email" class="form-control form-control-sm" id="email-form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="password-form-control" class="form-label">Password</label>
            <input type="password" class="form-control form-control-sm" id="password-form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="confirm-password-form-control" class="form-label">Confirm Password</label>
            <input type="password" class="form-control form-control-sm" id="confirm-password-form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="phone-number-form-control" class="form-label">Phone Number</label>
            <input type="text" class="form-control form-control-sm" id="phone-number-form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="bank-form-control" class="form-label">Bank</label>
            <select type="text" class="form-control form-control-sm" id="bank-form-control" placeholder="">
                <option selected>- Select Bank -</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="account-number-form-control" class="form-label">Account Number</label>
            <input type="text" class="form-control form-control-sm" id="account-number-form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="account-name-form-control" class="form-label">Account Name</label>
            <input type="text" class="form-control form-control-sm" id="account-name-form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="referral-code-form-control" class="form-label">Referral Code</label>
            <input type="text" class="form-control form-control-sm" id="referral-code-form-control" placeholder="">
        </div>
        <div class="mb-4 form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                I am 18 years old and have agreed to the terms and conditions.
            </label>
        </div>
        <div class="mb-2">
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="{{url('/')}}" class="btn btn-link float-end">Back to Login</a>
        </div>
    </div>
</div>


