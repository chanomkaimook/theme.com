<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="section-tool d-flex gap-2">
            <!-- Button trigger modal  -->
            <button type="button" id="register" class="btn btn-primary" data-id="" data-toggle="modal" data-target="#btn_register_user_modal">เพิ่ม user</button>
        </div>

        <div class="">
            <div class="card-box table-responsive">
                <table id="datatable" class="table table-hover m-0 table-actions-bar dt-responsive dataTable no-footer dtr-inline" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>username</th>
                            <th>ชื่อ</th>
                            <th>นามสกุล</th>
                            <th>วันที่สมัคร</th>
                            <th>วันอัพเดต</th>
                            <th class="hidden-sm"><?= mb_ucfirst($this->lang->line('_action')) ?></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- end row -->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->

<!-- Modal -->
<?php require_once('component/modal.php'); ?>


<script>
    //  =========================
    //  =========================
    //  Setting
    //  =========================
    //  =========================

    //  *
    //  * Dom
    //  * setting variable
    //  *
    const d = document
    const datatable_name = '#datatable'

    //  *
    //  * Button
    //  * setting variable
    //  *
    const btn_view = ".btn-view"
    const btn_add = '.btn-add'
    const btn_edit = '.btn-edit'
    const btn_del = '.btn-del'
    const btn_submit = 'button[type=submit]'
    const btn_print = '.btn-print'

    //  *
    //  * Form
    //  * setting variable
    //  *
    const form_name = '#frm'
    const form_hidden_id = '[name=frm_hidden_id]'

    //  *
    //  * Modal
    //  * setting variable
    //  *
    const modal_roles = '#modal_roles'
    const modal = '.modal'
    const modal_body = '.modal .modal-body'
    const modal_body_view = '.modal .modal-body-view'
    const modal_body_form = '.modal .modal-body-form'

    //  =========================
    //  =========================
    //  End Setting
    //  =========================
    //  =========================

    $(document).ready(function() {
        let frm = $(form_name)
        let method = $(form_name+' input#method')


        //  =========================
        //  =========================
        //  Event
        //  =========================
        //  =========================

        //  *
        //  * Form
        //  * click button submit
        //  * 
        //  * call function submit data on form
        //  * #async_insert_data() = script_crud.php
        //  * #async_update_data() = script_crud.php
        //  *
        $(d).on('submit', form_name, function(e) {
            e.preventDefault()
            let f = $(modal_body_form)
            let item_id = $(modal).find(form_hidden_id).val()

            let data = $(form_name).serializeArray()

            let func

            if (item_id) {
                func = async_update_data(item_id, data)
            } else {
                func = async_insert_data(data)

            }

            func
                .then((resp) => {
                    if (resp.error == 1) {
                        swalalert('error', resp.txt, {
                            auto: false
                        })
                    } else {
                        Swal.fire({
                            type: 'success',
                            title: 'สำเร็จ',
                            text: resp.txt,
                            timer: swal_autoClose,
                        }).then((result) => {

                            modalHide()

                            dataReload()

                        })
                    }
                });


            return false
        })






        //
        // button add
        $(document).on('click', '#register', function() {

            method.val('insert')
            frm.find('#btn_register').text('ลงทะเบียน')
        })

        //
        // button edit
        $(document).on('click', btn_edit, function() {

            let url_get_user = new URL('admin/ctl_user/get_user?id=' + $(this).attr('data-id'), domain);
            fetch(url_get_user)
                .then(res => res.json())
                .then((resp) => {

                    if (resp.permit) {
                        resp.data.permit = resp.permit
                    }

                    if (resp.data_role_focus) {
                        resp.data.role_focus = resp.data_role_focus
                    }

                    modal_input_data(resp.data)

                    method.val('edit')
                    frm.find('#btn_register').text('บันทึก')

                    $("#hidden_id").val($(this).attr('data-id'))
                });
        })

        //
        // reset form
        $('#btn_register_user_modal').on('hidden.bs.modal', function(e) {
            // do something...
            frm.trigger('reset')

            $(this).find(".userfocus").addClass('d-none')
            $('[data-toggle=select2]').val(null).trigger('change')

            $(this).find("#input_username").removeAttr('disabled')
            $(this).find("#input_password").removeAttr('disabled')
        })


        function register() {
            var dataArray = $("#dataform").serializeArray(),
                len = dataArray.length,
                dataObj = {};


            let url = new URL('register/ctl_register/insert_data_staff', domain);

            let data = new FormData();
            for (i = 0; i < len; i++) {

                data.append(dataArray[i].name, dataArray[i].value);
            }

            data.append('group_role', $('#role[data-toggle=select2]').val())

            fetch(url, {
                    method: 'POST',
                    body: data
                })
                .then(res => res.json())
                .then((resp) => {

                    if (resp.error == 1) {
                        Swal.fire('ผิดพลาด', resp.txt, 'warning')
                    } else {

                        Swal.fire({
                            title: 'สำเร็จ',
                            html: 'รหัสพร้อมใช้งาน',
                            timer: 2000,
                            timerProgressBar: true,
                        }).then((result) => {
                            update_verify(resp.data.ID, resp.data.USERNAME)
                            window.location.reload();
                        })
                    }

                });

        }

        function update_verify(id = null, username = null) {

            if (id) {
                let data_vf = new FormData()
                data_vf.append('id', id)
                data_vf.append('username', username)

                let url_verify = new URL('admin/ctl_register/update_verify', domain);
                fetch(url_verify, {
                        method: 'POST',
                        body: data_vf,
                    })
                    .then(res => res.json())
                    .then((resp) => {

                    });

            }

        }

        function modal_input_data(data = []) {

            let modal_name = $("#btn_register_user_modal")

            /**
             * for role foucs
             */
            if (data.role_focus.length) {
                let a = ''
                a = data.role_focus.map((item, index) => {
                    // console.log(item,index)
                    return item.STAFF_CHILD
                })
                $('.userfocus').removeClass('d-none')
                $('[data-toggle=select2]').val(a).trigger('change')
            }

            let p = data.permit.roles_id_list
            if (p) {
                r = new Array();
                r.push(1)
                r.push(2)
                console.log(r)
                // $('#role').select2().val([1,2]).trigger('change.select2');
                // $('#role').val([1,2]);
                // $('#role').trigger('change.select2');

                $('#role').select2('val',[2,3]).trigger('change.select2');
                // $('#role').select2().val([1,2]).trigger('change.select2');


                // $('#role option[value=1]').attr('selected', 'selected')

                // $('#role').val([1, 2])
                // $('#role[data-toggle=select2]').val(data.permit.roles_id_list).trigger('change')
            }
            // $('#role[data-toggle=select2]').val(p).trigger("change.select2");
            /* $('#role').trigger({
                type: 'select2:select',
                params: {
                    data: {id:1,id:2}
                }
            }); */

            modal_name.find("#role").val(data.ROLES_ID)
            modal_name.find("#name").val(data.NAME)
            modal_name.find("#lastname").val(data.LASTNAME)
            modal_name.find("#input_username").val(data.USERNAME).attr('disabled', 'disabled')
            modal_name.find("#input_password").attr('disabled', 'disabled')

        }

        function update_userdata() {

            let data_hidden_id = $("#hidden_id").val();

            let url_update_user = new URL('admin/ctl_user/update_user', domain)

            var data = new FormData()
            data.append('id', data_hidden_id)
            data.append('role', $("#role").val())
            data.append('name', $("#name").val())
            data.append('lastname', $("#lastname").val())
            data.append('userfocus', $('[data-toggle=select2]').val())

            let option = {
                method: 'POST',
                body: data,
            }

            fetch(url_update_user, option)
                .then(res => res.json())
                .then((resp) => {

                    $(datatable_name).DataTable().ajax.reload();

                    $('#btn_register_user_modal').modal('hide')

                })
        }


        $(document).on('click', '.btn_delete_user', function() {
            $("#hidden_id").val($(this).attr('data-id'))
            let hidden_id = $("#hidden_id").val();

            let table_tr = $('.btn_edit_user[data-id=' + hidden_id + ']').parents('tr');
            let user_name = table_tr.children('td').eq(1).text() + ' ' + table_tr.children('td').eq(2).text()

            Swal.fire({
                title: 'ยืนยันการลบ',
                text: "คุณต้องการลบข้อมูลนี้ " + user_name,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#64c5b1',
                cancelButtonColor: '#f96a74',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.value) {
                    confirm_delete(hidden_id)
                }
            })
        })

        function confirm_delete(id = null) {

            if (id) {
                let url_delete_user = new URL('admin/ctl_user/delete_user', domain);

                var delete_data = new FormData();
                delete_data.append('id', id);
                fetch(url_delete_user, {
                        method: 'POST',
                        body: delete_data
                    })
                    .then(res => res.json())
                    .then((resp) => {
                        if (resp.data.error == 0) {
                            $(datatable_name).DataTable().ajax.reload(null, false);

                            Swal.fire(
                                'สำเร็จ',
                                resp.data.text,
                                'success'
                            )
                        } else {
                            Swal.fire(
                                'ผิดพลาด',
                                resp.data.text,
                                'warning'
                            )
                        }

                        //window.location.reload()
                    });
            }

        }


    })
</script>
<?php include('script.php') ?>
<?php include('script_crud.php') ?>
<?php include('script_datatable.php') ?>