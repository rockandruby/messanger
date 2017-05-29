<form method="post" action="/admin/user/<?= $user->id?>" class="col-lg-4">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control validate" id="name" data-rule="text" placeholder="Name" value="<?= $user->name?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control validate" data-rule="email" id="email" placeholder="Email" value="<?= $user->email?>" required>
    </div>
    <div class="form-group">
        <input type="checkbox" name="active" id="active" <?= $user->active ? 'checked' : '' ?> >
        <label for="active">Active</label>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="new_password" placeholder="Password">
    </div>
    <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password confirm">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
