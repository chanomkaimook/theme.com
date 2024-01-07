<script>
    function getData() {
        let datatable = $('#datatable')

        let last_columntable = datatable.find('th').length - 1
        let last_defaultSort = last_columntable - 3
        let column_last_array = t()

        function t() {
            let r = []
            for (var i = last_defaultSort; i <= last_columntable; i++) {
                r.push(i)
            }
            return r
        }
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
        // # if open server side should be set paramiter
        // data for set column name from table
        // e.g.
        /* data: dataFillterFunc([{
            name: 'column',
            value: {
                0: 'code',
                1: 'name',
                2: 'workstatus',
                3: 'status_offview',
                4: 'user_active', // find staff to do
                5: 'date_active' // find date time to do
            }
        }, ]) */
        let urlname = new URL(path(url_moduleControl + '/get_dataTable'), domain);

        let table = datatable.DataTable({
            // processing: true,
            serverSide: true,
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
                data: dataFillterFunc([{
                    name: 'column',
                    value: {
                        0: 'code',
                        1: 'name',
                        2: 'workstatus',
                        3: 'status_offview',
                        4: 'user_active', // find staff to do
                        5: 'date_active' // find date time to do
                    }
                }, ])
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
                    "targets": [0, 1],
                    "className": "truncate"
                },
                {
                    "targets": column_last_array,
                    "width": "80px"
                },
            ],
            columns: [{
                    "data": "CODE",
                    "width": "60px",
                    "render": function(data, type, row, meta) {
                        let code = data
                        // let url_doc_bill = new URL(path(url_moduleControl+'/document'),domain)
                        // url_doc_bill.searchParams.append('code',code)

                        code = `<div class="w-100 text-info" data-id="${row.ID}" role="button">
                        ${data}
                        </div>`

                        if (!code) {
                            code = ""
                        }
                        return "<b>" + code + "</b>"
                    }
                },
                {
                    "data": "NAME",
                    "width": "",
                    "createdCell": function(td, cellData, rowData, row, col) {
                        $(td).css('min-width', '150px')
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
                        let btn_view = `<a data-id="${data}" class="btn-view text-capitalize dropdown-item" href="#" data-code="${row.CODE}" ><i class="mdi mdi-magnify mr-2 text-info font-18 vertical-middle"></i>${table_column_view[setlang]}</a>`
                        let btn_edit = `<a data-id="${data}" class="btn-edit text-capitalize dropdown-item" href="#"><i class="mdi mdi-wrench mr-2 text-warning font-18 vertical-middle"></i>${table_column_edit[setlang]}</a>`
                        let btn_del = `<a data-id="${data}" class="btn-del text-capitalize dropdown-item" href="#" ><i class="mdi mdi-delete mr-2 text-danger font-18 vertical-middle"></i>${table_column_del[setlang]}</a>`

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

        // table.buttons(0, 0).remove();
        // table.button().add(0,'print');
    }
</script>