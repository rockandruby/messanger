<?php
require_once 'mixins/AuthMixin.php';

class AuthController extends ApplicationController{
    use \Controllers\Mixins\Auth;
}
