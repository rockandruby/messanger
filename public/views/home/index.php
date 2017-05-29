<h1>Users</h1>
<?php foreach ($users as $user): ?>
    <div class="row users_list">
        <div class="col-lg-4"><?= $user['name'] ?></div>
        <?php if($this->isAuthed()):?>
        <div class="col-lg-2"><a href="/user/newdialog/<?= $user['id']?>" class="btn btn-primary">Chat him</a></div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
