<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ctl_user extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('mdl_user');
        $this->load->model('mdl_roles');
        // $this->load->model('mdl_register');
        // $this->load->model('mdl_staff');
        $this->load->model('mdl_role_focus');

        $this->middleware();
    }

    public function index()
    {
        #
        # session
        /* $user_level = $this->session->userdata('role_level');

        $role = $this->db->where('level >=',$user_level)->get('roles');
        $data['role'] = $role->result();

        $optional['select'] = "
        employee.name as MEMBER_NAME,
        employee.lastname as MEMBER_LASTNAME,
        staff.id as STAFF_ID,
        ";

        $level = $this->db->get('level');
        $data['level'] = $level->result(); */

        // echo check_role('a');
        // echo "<pre>";
        // print_r($this->session->userdata());exit;

        $data['role'] = $this->mdl_roles->get_dataShow();
        $data['level'] = "";
        $this->template->set_layout('lay_datatable');
        $this->template->title('ผู้ใช้งาน');
        $this->template->build('users',$data);
    }

    public function fetch_data()
    {
        $this->load->helper('my_date');
        $data = $this->mdl_user->get_data_staff();

        $icon_head = '<i class="mdi mdi-star text-warning mdi-18px" title="verified user"></i>';

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

                $sub_data = [];
                $date_start = toDateTimeString($row->DATE_STARTS, 'datetime');
                $date_update = textNull($row->DATE_UPDATE) ? toDateTimeString($row->DATE_UPDATE, 'datetime') : null;

                $sub_data['ID'] = $row->ID;
                $sub_data['LEVEL'] = "";
                $sub_data['NAME'] = textLang($row->NAME,$row->NAME_US,false);
                $sub_data['LASTNAME'] = textLang($row->LASTNAME,$row->LASTNAME_US,false);
                $sub_data['USERNAME'] = $row->USERNAME;
                $sub_data['DATE_STARTS'] = array(
                    "display"   => $date_start,
                    "timestamp" => date('Y-m-d H:i:s', strtotime($row->DATE_STARTS))
                );

                $sub_data['DATE_ACTIVE'] = array(
                    "display"   => $date_update,
                    "timestamp" => date('Y-m-d H:i:s', strtotime($row->DATE_UPDATE))
                );

                $sub_data['USER_ACTIVE'] = array(
                    "display"   => $user_active,
                    "data"   => array(
                        'id'    => $user_active_id,
                    ),
                );

                $data_result[] = $sub_data;
            }
        }
        $result = array(
            'data' => $data_result
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
