<div class="card login-card card-main">
    <div class="card-body">
        <div class="mb-3 text-center text-uppercase">
            <h5>
                Login
            </h5>
        </div>
        <div class="mb-3">
            <label for="username-form-control" class="form-label">Username</label>
            <input type="email" class="form-control" id="username-form-control" placeholder="">
        </div>
        <div class="mb-3">
            <label for="password-form-control" class="form-label">Password</label>
            <input type="email" class="form-control" id="password-form-control" placeholder="">
        </div>
        <div class="mb-2">
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="{{url('/register')}}" class="btn btn-link float-end">Register</a>
        </div>
    </div>
</div>
