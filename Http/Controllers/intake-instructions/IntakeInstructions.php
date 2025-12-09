<?php

namespace App;

class IntakeInstructions extends App
{
    //  intake-instructions page
    public function intakeInstructions()
    {
        $this->middleware(true, true, 'general', true);
        $intakeInstructions = $this->db->select('SELECT * FROM intake_instructions')->fetchAll();
        require_once(BASE_PATH . '/resources/views/app/intake-instructions/intake-instructions.php');
    }

    // store dosage
    public function intakeInstructionsStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['intake_instructions'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }
        $intakeInstructions = $this->db->select('SELECT intake_instructions FROM intake_instructions WHERE `intake_instructions` = ?', [$request['intake_instructions']])->fetch();

        if (!empty($intakeInstructions['intake_instructions'])) {
            $this->flashMessage('error', _repeat);
        } else {
            $this->db->insert('intake_instructions', array_keys($request), $request);
            $this->flashMessage('success', _success);
        }
    }

    // dosage page
    public function editIntakeInstructions($id)
    {
        $this->middleware(true, true, 'general');

        $intakeInstructions = $this->db->select('SELECT * FROM intake_instructions WHERE `id` = ?', [$id])->fetch();
        if ($intakeInstructions != null) {
            require_once(BASE_PATH . '/resources/views/app/intake-instructions/edit-intake-instructions.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // edit intake_instructions store
    public function editIntakeInstructionsStore($request, $id)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        // check empty form
        if ($request['intake_instructions'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $intake_instructions = $this->db->select('SELECT * FROM intake_instructions WHERE `intake_instructions` = ?', [$request['intake_instructions']])->fetch();

        if ($intake_instructions) {
            if ($intake_instructions['id'] != $id) {
                $this->flashMessage('error', 'این طریقه مصرف قبلا ثبت شده است.');
                return;
            }
        }

        $this->db->update('intake_instructions', $id, array_keys($request), $request);
        $this->flashMessageTo('success', _success, url('intake-instructions'));
    }

    // dosage Details detiles page
    public function dosageDetails($id)
    {
        $this->middleware(true, true, 'general');
        $dosage = $this->db->select('SELECT * FROM dosage WHERE `id` = ?', [$id])->fetch();
        if ($dosage != null) {
            require_once(BASE_PATH . '/resources/views/app/dosage/dosage-details.php');
            exit();
        } else {
            require_once(BASE_PATH . '/404.php');
            exit();
        }
    }

    // change status dosage
    public function changeStatusDosage($id)
    {
        $this->middleware(true, true, 'general');

        $dosage = $this->db->select('SELECT id, `status` FROM dosage WHERE id = ?', [$id])->fetch();
        if (!$dosage) {
            require_once(BASE_PATH . '/404.php');
            exit();
        }

        $newStatus = ($dosage['status'] == 1) ? 2 : 1;

        $this->db->update('dosage', $id, ['status'], [$newStatus]);
        $this->send_json_response(true, _success, $newStatus);
    }
}
