<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <ul class="nav nav-tabs tabs-bordered">
                        <li class="nav-item">
                            <a href="#table" data-toggle="tab" aria-expanded="false" class="nav-link ">
                                <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                <span class="d-none d-sm-block text-capitalize"><?= mb_ucfirst($this->lang->line('table')) ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#overview" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                <span class="d-none d-sm-block"><?= mb_ucfirst($this->lang->line('overview')) ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#setting" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                                <span class="d-none d-sm-block"><?= mb_ucfirst($this->lang->line('setting')) ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#log" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                                <span class="d-none d-sm-block"><?= mb_ucfirst($this->lang->line('log')) ?></span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane " id="table">
                            <?php
                            require('datatable.php');
                            ?>
                        </div>
                        <div class="tab-pane" id="overview">
                            <?php
                            require('all.php');
                            ?>
                        </div>
                        <div class="tab-pane active" id="setting">
                            <?php
                            require('setting.php');
                            ?>
                        </div>
                        <div class="tab-pane" id="log">
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- end container-fluid -->

</div> <!-- end content -->
<script>
    let data_1_ready = 0,
        data_2_ready = 0;

    $('body .content:first').append(loading)
    $('body .container-fluid').css('display', 'none')

    checkReady()

    function checkReady() {
        if (data_1_ready) {
            $('body .container-fluid').fadeIn()
            $('body .loading').remove()
        }
    }

    $(function() {

        // 
        // function to process data
        // loading data
        readyData()

        async function readyData() {
            let result1 = await new Promise((resolve, reject) => {
                resolve(getData())
            })
            let result2 = await new Promise((resolve, reject) => {
                resolve(data_1_ready = 1)
            });

            checkReady()
        }

        function getData() {
            let datatable = $('#datatable')

            let last_columntable = datatable.find('th').length - 1
            let last_defaultSort = last_columntable - 1

            //
            // get data to data table
            //
            // # domain = form e_navbar.php
            // # url_moduleControl = form e_navbar.php
            // # dataTableHeight() = form e_navbar.php
            // # dataFillterFunc() = form e_navbar.php
            // # datatable_dom     = form e_navbar.php
            // # datatable_button  = form e_navbar.php
            //
            let urlname = new URL(path(url_moduleControl + '/get_dataTable'), domain);

            let table = datatable.DataTable({
                scrollY: dataTableHeight(),
                scrollCollapse: false,
                autoWidth: false,
                // searchDelay: datatable_searchdelay_time,
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                ajax: {
                    url: urlname,
                    type: 'get',
                    dataType: 'json',
                    data: dataFillterFunc()
                },
                order: [],
                columnDefs: [{
                        responsivePriority: 1,
                        targets: 0
                    },

                    {
                        responsivePriority: 2,
                        targets: last_columntable
                    },
                    {
                        "targets": [2, 3, 4],
                        "className": "truncate"
                    },
                ],
                columns: [{
                        "data": "CODE",
                        "width": "60px",
                        "render": function(data, type, row, meta) {
                            let code = data
                            if (!code) {
                                code = ""
                            }
                            return "<b>#" + code + "</b>"
                        }
                    },
                    {
                        "data": "NAME",
                        "width": "",
                        "createdCell": function(td, cellData, rowData, row, col) {
                            $(td).css('min-width', '150px')
                        },
                        "render": function(data, type, row, meta) {

                            let task = `${data}`
                            if (row.CODE) {
                                task += `<a href=# data-target="#modal_ticket" class="text-info" data-toggle="modal" data-code="${row.CODE}">#${row.CODE}</a> `
                            }

                            return task
                        }
                    },
                    {
                        "data": "WORKSTATUS.display",
                    },
                    {
                        "data": "STATUS.display",
                    },
                    {
                        "data": {
                            _: 'USER_ACTIVE.display', // default show
                        }
                    },
                    {
                        "data": {
                            _: 'DATE_ACTIVE.display', // default show
                            sort: 'DATE_ACTIVE.timestamp'
                        }
                    },
                    {
                        "data": "ID",
                        "render": function(data, type, row, meta) {
                            let btn_view = `<a data-id="${data}" class="btn-view dropdown-item" href="#" data-code="${row.CODE}" ><i class="mdi mdi-magnify mr-2 text-info font-18 vertical-middle"></i>รายละเอียด</a>`
                            let btn_edit = `<a data-id="${data}" class="btn-edit dropdown-item" href="#"><i class="mdi mdi-wrench mr-2 text-warning font-18 vertical-middle"></i>แก้ไข</a>`
                            let btn_del = `<a data-id="${data}" class="btn-del dropdown-item" href="#" ><i class="mdi mdi-delete mr-2 text-danger font-18 vertical-middle"></i>ลบรายการ</a>`

                            if (row.STATUS.data.id == 1) {
                                btn_edit = ''
                            }

                            let table_action = `
                                <div class="btn-group dropdown">
                                    <a href="javascript: void(0);" class="table-action-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        ${btn_view}
                                        ${btn_edit}
                                        ${btn_del}
                                    </div>
                                </div>
                            `
                            return table_action
                        },
                        "width": "60px",
                        "orderable": false
                    }
                ],

                dom: datatable_dom,
                buttons: datatable_button,
            })
        }

        /*  function getData_2() {
             let url = new URL(path(url_moduleControl + '/get_user'), domain)
             fetch(url)
                 .then(res => res.json())
                 .then(resp => {
                     data_2_ready = 1

                     checkReady()

                     console.log('data_2')
                 })
         } */

    })
</script>