<?php
require_once 'Http/Controllers/profile/Profile.php';

//  profile routes
uri('profile', 'App\Profile', 'profile');
uri('edit-password-profile/{id}', 'App\Profile', 'changePasswordStore', 'POST');





