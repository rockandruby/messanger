<div align="right">
    <a href="/admin/newuser" class="btn btn-success">New user</a>
</div>
<table class="table">
    <thead>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Active</th>
        <th>Actions</th>
    </thead>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= \Core\Helper::isActive($user['active']) ?></td>
            <td>
                <a href="/admin/user/<?=$user['id']?>" title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                <a href="/admin/deleteuser/<?=$user['id']?>" title="Remove"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>