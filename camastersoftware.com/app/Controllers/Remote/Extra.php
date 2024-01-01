<?php namespace App\Controllers\Remote;
use \App\Controllers\BaseController;

class Extra extends BaseController
{
    public function __construct()
    {
        $this->Mact_option = new \App\Models\Mact_option();
    }

    public function getOptions()
    {
        $due_act=$this->request->getPost('due_act');
        $option_type=$this->request->getPost('option_type');
        $set_value=$this->request->getPost('set_value');
        
        $this->data['option_type']=$option_type;
        $this->data['set_value']=$set_value;

        $resultArr=$this->Mact_option->where('act_option_map_tbl.fk_act_id', $due_act)
            ->where('act_option_map_tbl.option_type', $option_type)
            ->where('act_option_map_tbl.status', 1)
            ->orderBy('act_option_map_tbl.act_option_name', 'ASC')
            ->findAll();

        $this->data['resultArr']=$resultArr;

        return view('remote/admin/getOptions', $this->data);
    }

}

?>