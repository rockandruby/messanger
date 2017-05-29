<form method="post" action="/adminauth/login" class="col-lg-4">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control validate" data-rule="email" id="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="/adminauth/register">Sign up</a>
</form>
