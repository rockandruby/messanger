<form method="post" action="/admin/newuser" class="col-lg-4">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control validate" data-rule="text" id="name" placeholder="Name" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control validate" data-rule="email" id="email" placeholder="Email" required>
    </div>
    <div class="form-group">
        <input type="checkbox" name="active" id="active">
        <label for="active">Active</label>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control validate" id="password" data-rule="password_confirm" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password confirm" required>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
