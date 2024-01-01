<?php namespace App\Controllers\Remote;
use \App\Controllers\BaseController;

class Sync extends BaseController
{
    public function __construct()
    {
        $this->Mcommon = new \App\Models\Mcommon();
        $this->Mcity = new \App\Models\Mcity();
    }

    public function getCities()
    {
        $stateId=$this->request->getPost('stateId');
        $set_val_city=$this->request->getPost('set_val_city');

        $cityList = $this->Mcity->where('cities.fk_state_id', $stateId)
                    ->orderBy('cities.cityName', 'ASC')
                    ->where('cities.status', '1')
                    ->findAll();

        $data['cityList']=$cityList;
        $data['set_val_city']=$set_val_city;

        return view('remote/sync/getCities', $data);
    }
}

?>
