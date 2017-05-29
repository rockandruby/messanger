<h3>Dialogs</h3>
<?php foreach ($dialogs as $dialog):?>
    <div class="row">
        <div class="col-lg-2">
            <a href="/user/dialog/<?=$dialog['id']?>"><?= $dialog['name']?></a>
        </div>
        <div class="col-lg-1">
             <strong><?= $counter[$dialog['id']] ?? null ?></strong>
        </div>
    </div>
<?php endforeach; ?>