<?php


require_once 'Http/Auth/Login.php';
require_once 'Http/Auth/Register.php';
require_once 'Http/Auth/Active.php';
require_once 'Http/Auth/Logout.php';
require_once 'Http/Auth/Forgot.php';
require_once 'Http/Auth/AdminLogin.php';

uri('login', 'Auth\Login', 'login');
uri('check-login', 'Auth\Login', 'checkLogin', 'POST');



uri('admin-login', 'Auth\AdminLogin', 'adminLogin');
uri('admin-check-login', 'Auth\AdminLogin', 'adminCheckLogin', 'POST');


// login
uri('logout', 'Auth\Logout', 'logout');




// register 
uri('register', 'Auth\Auth', 'register');

// register store
uri('register/store', 'Auth\Register', 'registerStore', 'POST');
uri('active/{verify_token}', 'Auth\Active', 'active');



// forget password
// uri('forgot', 'Auth\Forgot', 'forgot');
uri('forgot-request', 'Auth\Forgot', 'forgotRequest', 'POST');
uri('reset-password-form/{forgot_token}', 'Auth\Forgot', 'resetPasswordView');
uri('reset-password-store/{forgot_token}', 'Auth\Forgot', 'resetPassword', 'POST');

