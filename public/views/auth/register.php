<form method="post" action="/auth/register" class="col-lg-4">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control validate" id="name" data-rule="text" placeholder="Name" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control validate" id="email" placeholder="Email" data-rule="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control validate" id="password" data-rule="password_confirm" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password confirm" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/auth/login">Sign in</a>
</form>
