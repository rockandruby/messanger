<?php

use Core\Helper;

class UserController extends FrontController
{
    function profile(){
        $user = $this->currentUser();
        if(!empty($_POST)){
            $error = Helper::checkPasswordEquality($user, $_POST['old_password'], $_POST['password'], $_POST['password_confirmation']);
            header('Location: /user/profile');
            if($error) exit;
            User::update($user->id, $this->formParams());
            Helper::notice('User updated!');
        }else{
            $this->view('user/profile', ['user' => $user]);
        }
    }

    public function dialogs(){
        $dialogs = Dialog::userDialogs($this->currentUser()->id);
        $new_messages = Message::countNewMessages($this->currentUser()->id);
        $counter = Helper::messageCounter($new_messages);
        $this->view('user/dialogs',['dialogs' => $dialogs, 'new_messages' => $new_messages, 'counter' => $counter]);
    }

    public function newDialog($params){
        $current_user = $this->currentUser();
        $user = User::find($params[0]);
        if(!$user || $user->id == $current_user->id || !$user->active){
            Helper::alert('Can\'t create dialog with user!');
            header('Location: /user/dialogs');
            exit;
        }
        $result = Dialog::findUserDialog($current_user->id, $user->id);
        $dialog_id = $result ? $result['id'] : Dialog::create(['current_user_id' => $current_user->id, 'user_id' => $user->id]);
        $messages = Message::getDialogMessages($dialog_id, $current_user->id);
        $this->view('user/dialog', ['messages' => $messages, 'dialog_id' => $dialog_id, 'companion' => $user]);
    }

    public function dialog($params){
        $dialog = Dialog::find($params[0]);
        $user = $this->currentUser();
        if($dialog->current_user_id != $user->id && $dialog->user_id != $user->id){
            Helper::alert('Can\'t watch alien dialog!');
            header('Location: /user/dialogs');
            exit;
        }
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $messages = Message::getNewMessages($dialog->id, $user->id);
                if(!empty($messages)){
                    $ids = [];
                    foreach ($messages as $message){
                        $ids[] = $message['id'];
                        include Helper::viewPath(). 'user/message.php';
                    }
                    Message::markAsRead($ids);
                }
        }else{
            $messages = Message::getDialogMessages($dialog->id, $user->id);
            $companion = $user->id != $dialog->current_user_id ? User::find($dialog->current_user_id) : User::find($dialog->user_id);
            $this->view('user/dialog', ['messages' => $messages, 'dialog_id' => $dialog->id, 'companion' => $companion]);
        }

    }

    public function message($params){
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $dialog = Dialog::find($params[0]);
            $user = $this->currentUser();
            if($dialog->current_user_id != $user->id && $dialog->user_id != $user->id) exit;
            $safe_params = $this->safeParams(['text' => $_POST['text']]);
            $message_id = Message::create(array_merge($safe_params,[
                'user_id' => $this->currentUser()->id,
                'dialog_id' => $dialog->id
            ]));

            $message = Message::find($message_id);
            $message = [ 'name' => $user->name, 'text' => $message->text, 'created_at' => $message->created_at ];
            include Helper::viewPath(). 'user/message.php';
        }
    }

}
