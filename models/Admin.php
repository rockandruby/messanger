<?php
require_once 'mixins/UserMixin.php';

class Admin extends Base
{
    protected static $table = 'admins';

    use \Models\Mixins\UserMixin;

}