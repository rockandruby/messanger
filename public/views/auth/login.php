<form method="post" action="/auth/login" class="col-lg-4">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control validate" id="email" data-rule="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/auth/register">Sign up</a>
</form>
