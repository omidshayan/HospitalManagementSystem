<?php

namespace App;

class IntakeTime extends App
{
    //  intakeTimes page
    public function intakeTimes()
    {
        dd('ok');
        $this->middleware(true, true, 'general', true);
        $numberDrugs = $this->db->select('SELECT * FROM number_of_drugs')->fetch();
        require_once(BASE_PATH . '/resources/views/app/number-drugs/number-drugs.php');
    }

    // store number drug
    public function numberDrugsStore($request)
    {
        $this->middleware(true, true, 'general', true, $request, true);

        if ($request['number'] == '') {
            $this->flashMessage('error', _emptyInputs);
        }

        $numberDrugs = $this->db->select('SELECT id FROM number_of_drugs')->fetch();

        if (!empty($numberDrugs)) {
            $this->db->update('number_of_drugs', $numberDrugs['id'], ['number'], [$request['number']]);
            $this->flashMessage('success', _success);
        } else {
            require_once(BASE_PATH . '/404.php');
        }
    }
}
