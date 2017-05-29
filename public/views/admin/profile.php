<form method="post" action="/admin/profile" class="col-lg-4">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control validate" id="name" data-rule="text" placeholder="Name" value="<?= $admin->name?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control validate" id="email" placeholder="Email" data-rule="email" value="<?= $admin->email?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="New password">
    </div>
    <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password confirm">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

