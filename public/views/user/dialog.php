<h3>Chat with <?= ucfirst($companion->name)?></h3>
<div id="dialog" data-dialog-id="<?=$dialog_id?>" class="message_window">
<?php foreach ($messages as $message): ?>
    <?php include 'message.php'?>
<?php endforeach; ?>
</div>
<div class="col-lg-offset-4">
    <form action="/user/message/<?=$dialog_id?>" class="col-lg-7 send_message">
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control validate" data-rule="text" data-length = 1 required name="text" id="message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>
