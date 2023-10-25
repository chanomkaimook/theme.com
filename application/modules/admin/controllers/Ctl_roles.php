<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctl_roles extends MY_Controller
{
    private $model;
    private $title;

    public function __construct()
    {
        parent::__construct();
        $modelname = 'mdl_page';

        $this->load->model($modelname);
        $this->load->model('mdl_user');
        $this->load->model('mdl_register');
        $this->load->model('mdl_staff');
        $this->load->model('mdl_role_focus');

        $this->middleware();

        // set language
        $this->lang->load('roles', $this->langs);

        // setting
        $this->model = $this->$modelname;
        $this->title = $this->lang->line('menu_settingroles');
    }

    public function index()
    {
        $data['role'] = "";
        $data['level'] = "";
        $this->template->set_layout('lay_datatable');
        $this->template->title($this->title);
        $this->template->build('roles/index',$data);
    }

    public function get_dataTable()
    {
        $this->load->helper('my_date');

        $request = $_REQUEST;

        $data = $this->model->get_dataShow();
        $count = $this->model->get_data_all();

        $data_result = [];

        if ($data) {
            foreach ($data as $row) {

                $user_active_id = $row->USER_STARTS ? $row->USER_STARTS : $row->USER_UPDATE;

                if ($row->DATE_UPDATE) {
                    $query_date = $row->DATE_UPDATE;
                    $user_active = "(แก้) " . whois($row->USER_UPDATE);
                } else {
                    $query_date = $row->DATE_STARTS;
                    $user_active =  whois($row->USER_STARTS);
                }

                $dom_workstatus = workstatus($row->WORKSTATUS, 'status');
                $dom_status = status_offview($row->STATUS_OFFVIEW);

                $sub_data = [];

                $sub_data['ID'] = $row->ID;
                $sub_data['CODE'] = textShow($row->CODE);
                $sub_data['NAME'] = textShow($row->NAME);

                $sub_data['WORKSTATUS'] = array(
                    "display"   => $dom_workstatus,
                    "data"      =>  array(
                        'id'    => $row->WORKSTATUS,
                    ),
                );

                $sub_data['STATUS'] = array(
                    "display"   => $dom_status,
                    "data"   => array(
                        'id'    => $row->STATUS_OFFVIEW,
                    ),
                );

                $sub_data['USER_ACTIVE'] = array(
                    "display"   => $user_active,
                    "data"   => array(
                        'id'    => $user_active_id,
                    ),
                );

                $sub_data['DATE_ACTIVE'] = array(
                    "display"   => toThaiDateTimeString($query_date, 'datetime'),
                    "timestamp" => date('Y-m-d H:i:s', strtotime($query_date))
                );

                $data_result[] = $sub_data;
            }
        }

        $result = array(
            "recordsTotal"      =>     count($data),
            "recordsFiltered"   =>     $count,
            "data"              =>     $data_result
        );

        echo json_encode($result);
    }

    public function get_user()
    {
        $data = $this->mdl_user->get_data_staff();
        $data_role_focus = $this->mdl_role_focus->get_data();
        $result = array(
            'data' => $data,
            'data_role_focus' => $data_role_focus
        );
        echo json_encode($result);
    }

    public function update_user()
    {
        $data = $this->mdl_user->update_user();
        $result = array(
            'data' => $data
        );

        echo json_encode($result);
    }

    public function delete_user()
    {
        $data = $this->mdl_user->delete_user();
        $result = array(
            'data' => $data
        );

        echo json_encode($result);
    }
}
