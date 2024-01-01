<?php namespace App\Libraries;

class Utility
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    
	public function sup_admin_menus()
	{
        return view('super_admin/side_menu');
    }
    
    public function sup_admin_left_side_menu()
	{
        return view('super_admin/left_side_menu');
    }
    
	public function admin_menus()
	{
        return view('firm_panel/side_menu');
    }
    
    public function left_side_menu()
	{
        return view('firm_panel/left_side_menu');
    }
    
    public function attendance_list()
	{
        return view('firm_panel/staff_administration/common_employee_attendance_list');
    }
    
    public function add_edit_attendance()
	{
        return view('firm_panel/staff_administration/common_add_edit_employee_attendance');
    }
}