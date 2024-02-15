<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require APPPATH . '/libraries/API_Controller.php';

class Ctl_page extends MY_Controller
{

    private $model;
    private $title;

    public function __construct()
    {
        parent::__construct();
        $modelname = 'mdl_page';
        $this->load->model(array('page/' . $modelname));

        $this->middleware(
            array(
                'access'    => [
                    // 'index'     => ['bill','quotation'],
                    // 'view'      => ['bill.view','bill.insert']
                ],
                // 'need'       => ['bill','quotation'],
                'except'    => [
                    // 'index'      => ['workorder','bill.view','bill'],
                    // 'view'      => [],
                ]
            )
        );

        // setting
        $this->model = $this->$modelname;
        $this->title = mb_ucfirst($this->lang->line('__menu_title'));
    }

    public function index()
    {
        // set page title
        /* $data['pagetitle'] = "ใบเสนอราคา";
        $data['breadcrumb'] = array('รายการจอง', 'ข้อมูลการจอง');
        $data['menuactive'] = site_url('bill/ctl_bill'); */

        $this->template->set_layout('lay_datatable');
        $this->template->title($this->title);
        /* $this->template->set_partial(
            'headlink',
            'partials/link/page',
            array(
                'data'  => array(
                    '<link href="' . base_url('') . 'asset/libs/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />',
                )
            )
        );
        $this->template->set_partial(
            'footerscript',
            'partials/script/page',
            array(
                'data'  => array(
                    '<script src="' . base_url('') . 'asset/js/pages/scrollbar.init.js"></script>',
                )
            )
        ); */
        $this->template->build('pages/index');
    }
    /**
     *
     * get data to datatable
     * non-severside (load all data before display)
     *
     * # whois() = my_sql_helper
     * # textShow() = my_text_helper
     * # workstatus() = my_html_helper
     * # status_offview() = my_html_helper
     * # toThaiDateTimeString() = my_date_helper
     * 
     * @return void
     */
    public function get_dataTable()
    {

        $request = $_REQUEST;

        $data = $this->model->get_dataShow();
        $count = $this->model->get_data_all();

        $data_result = [];

        if ($data) {
            foreach ($data as $row) {

                $user_active_id = $row->USER_STARTS ? $row->USER_STARTS : $row->USER_UPDATE;
                $user_active = whois($user_active_id);

                if ($row->DATE_UPDATE) {
                    $query_date = $row->DATE_UPDATE;
                    $user_active = $this->lang->line('_text_edit') . " " . $user_active;
                } else {
                    $query_date = $row->DATE_STARTS;
                }

                $dom_workstatus = workstatus($row->WORKSTATUS);
                $dom_status = status_offview($row->STATUS_OFFVIEW);

                $sub_data = [];

                $sub_data['ID'] = $row->ID;
                $sub_data['CODE'] = textShow($row->CODE);
                $sub_data['NAME'] = textLang($row->NAME, $row->NAME_US, false);

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
                    "display"   => toDateTimeString($query_date, 'datetimehm'),
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

    //  *
    //  * CRUD
    //  * read
    //  * 
    //  * get data for item id
    //  *
    public function get_data()
    {
        $request = $_REQUEST;
        $item_id = $request['id'];
        $data = $this->model->get_data($item_id);

        if ($data) {
            if (is_array($data)) {
                $data_foreach = [];
                foreach ($data as $key => $row) {
                    $data_foreach[$key] = $this->previewData($row);
                }

                $data = $data_foreach;
            } else {
                $data = $this->previewData($data);
            }
        }

        $result = $data;
        echo json_encode($result);
    }

    function previewData($datas)
    {
        $result = "";

        if ($datas) {
            $user_active_id = $datas->USER_STARTS ? $datas->USER_STARTS : $datas->USER_UPDATE;
            $user_active = whois($user_active_id);

            if ($datas->DATE_UPDATE) {
                $query_date = $datas->DATE_UPDATE;
                $user_active = $this->lang->line('_text_edit') . " " . $user_active;
            } else {
                $query_date = $datas->DATE_STARTS;
            }

            $datas->USER_ACTIVE_ID = $user_active_id;
            $datas->USER_ACTIVE = $user_active;
            $datas->DATE_ACTIVE = toDateTimeString($query_date, 'datetimehm');

            $result = $datas;
        }

        return $result;
    }

    //  *
    //  * CRUD
    //  * insert
    //  * 
    //  * insert data
    //  *
    public function insert_data()
    {
        # code...
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $request = $_REQUEST;

            $data = array(
                'name'        => textNull($request['name']) ? $request['name'] : null
            );

            $returns = $this->model->insert_data($data);
            echo json_encode($returns);
        }
    }

    //  *
    //  * CRUD
    //  * update
    //  * 
    //  * update data
    //  *
    public function update_data()
    {
        # code...
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $request = $_REQUEST;
            $item_id = textNull($request['item_id']) ? $request['item_id'] : null;
            $data = array(
                'name'        => textNull($request['name']) ? $request['name'] : null
            );

            $returns = $this->model->update_data($data, $item_id);
            echo json_encode($returns);
        }
    }


    //  *
    //  * CRUD
    //  * delete
    //  * 
    //  * delete data
    //  *
    public function delete_data()
    {
        # code...
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $returns = $this->model->delete_data();
            echo json_encode($returns);
        }
    }
}
