<?php
// dashboard
require_once 'dashboard.php';

// send mail
require_once 'send-mail/send-mail.php';

// Auth
require_once 'auth/auth.php';

// profile
require_once 'profile/profile.php';

// employees
require_once 'employees/employees.php';

// employees
require_once 'sections/sections.php';

// expenses categories
require_once 'expenses-categories/expenses-categories.php';

// expenses
require_once 'expenses/expenses.php';

// positions
require_once 'positions/positions.php';

// number-drugs
require_once 'number-drugs/number-drugs.php';

// settings
require_once 'settings/settings.php';

// user agent
require_once 'user-agent.php';

// cron job
require_once 'cron-job/cron_job.php';

// users
require_once 'users/users.php';

// drugs
require_once 'drugs/drugs.php';

// units
require_once 'units/units.php';

// patients
require_once 'patients/patients.php';

// prints
require_once 'prints/prints.php';

// intake-times
require_once 'intake-times/intake-times.php';

// dosage
require_once 'dosage/dosage.php';

// intake-instructions
require_once 'intake-instructions/intake-instructions.php';

// prescriptions
require_once 'prescriptions/prescriptions.php';

// categories-drugs
require_once 'drug-categories/drug-categories.php';

function uri($reservedUrl, $class, $method, $requestMethod = 'GET')
{
        //current url array
        $currentUrl = explode('?', currentUrl())[0];
        $currentUrl = str_replace(CURRENT_DOMAIN, '', $currentUrl);
        $currentUrl = trim($currentUrl, '/');
        $currentUrlArray = explode('/', $currentUrl);
        $currentUrlArray = array_filter($currentUrlArray);

        //reserved Url array
        $reservedUrl = trim($reservedUrl, '/');
        $reservedUrlArray = explode('/', $reservedUrl);
        $reservedUrlArray = array_filter($reservedUrlArray);

        if (sizeof($currentUrlArray) != sizeof($reservedUrlArray) || methodField() != $requestMethod) {
                return false;
        }

        $parameters = [];
        for ($key = 0; $key < sizeof($currentUrlArray); $key++) {
                if ($reservedUrlArray[$key][0] == "{" && $reservedUrlArray[$key][strlen($reservedUrlArray[$key]) - 1] == "}") {
                        array_push($parameters, $currentUrlArray[$key]);
                } elseif ($currentUrlArray[$key] !== $reservedUrlArray[$key]) {
                        return false;
                }
        }

        if (methodField() == 'POST') {
                $request = isset($_FILES) ? array_merge($_POST, $_FILES) : $_POST;
                $parameters = array_merge([$request], $parameters);
        }

        $object = new $class;
        call_user_func_array(array($object, $method), $parameters);
        exit();
}
