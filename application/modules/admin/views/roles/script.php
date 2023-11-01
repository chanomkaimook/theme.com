<script>
    $(d).ready(function() {

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


            // set variable checkbox
            // permit
            let a = $('.jstree-grid-container li[aria-level=2][aria-selected=true]')
            $.each(a, function(index, item) {
                // data.append('a',$(item).attr('data-id'))
                data.push({
                    'name': 'permit_id[]',
                    'value': $(item).attr('data-id')
                })
            })
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

        //  *
        //  * CRUD
        //  * click button view
        //  * 
        //  * call function view data
        //  *
        $(d).on('click', btn_view, function(e) {
            e.preventDefault()

            let id = $(this).attr('data-id')
            view_data(id)

            $(form_name).find(form_hidden_id).val(id)
            $(form_name).find(btn_edit).attr('data-id', id)
        })

        //  *
        //  * CRUD
        //  * click button edit
        //  * 
        //  * call function open form for edit data
        //  *
        /* $(d).on('click', btn_edit, function(e) {
            e.preventDefault()

            let id = $(this).attr('data-id')
            edit_data(id)

            $(form_name).find(form_hidden_id).val(id)
        }) */

        //  *
        //  * CRUD
        //  * click button add
        //  * 
        //  * call function open form for add data
        //  *
        $(d).on('click', btn_add, function(e) {
            e.preventDefault()
            add_data()

            // $(form_name).find(form_hidden_id).val('')
        })

        //  *
        //  * Modal
        //  * Modal Hide
        //  * 
        //  * call reset form when modal hide
        //  *
        $(modal).on('hidden.bs.modal', function(e) {
            e.preventDefault()

            resetForm()
        })

        //  *
        //  * Modal
        //  * Modal Show
        //  * 
        //  * add DOM loading when modal to show
        //  *
        $(modal).on('show.bs.modal', function() {
            modalLoading()
        })
    })
    //  =========================
    //  =========================
    //  End Event
    //  =========================
    //  =========================

    //  =========================
    //  =========================
    //  Function
    //  Todo adjust code default here
    //  =========================
    //  =========================

    //  *
    //  * Modal
    //  * view
    //  * 
    //  * display data
    //  * @data = array[key=>[column=>value]]
    //  *
    function modalActive(data = [], action = 'view') {
        if (action != 'add' && data.NAME) {
            let header = data.NAME
            $(modal).find('.modal_text_header').html(header)
        }

        switch (action) {
            case 'view':
                $(modal_body_view)
                    .find('.roles_name_th').text(data.NAME).end()
                    .find('.roles_name_us').text(data.NAME_US).end()
                    .find('.roles_descrip_th').text(data.DESCRIPTION).end()
                    .find('.roles_descrip_us').text(data.DESCRIPTION_US).end()

                break
            case 'edit':
                $(modal_body_form)
                    .find('[name=label_1]').val(data[0].WORKSTATUS).end()

                break
            default:
                break
        }

        $(modal_roles).modal()

        modalLayout(action)
    }

    //  *
    //  * Modal
    //  * layout
    //  * 
    //  * layout DOM for show on modal
    //  *
    function modalLayout(action = null) {
        let form_btn_edit = $(modal).find(btn_edit)
        let form_btn_submit = $(modal).find(btn_submit)
        let form_btn_print = $(modal).find(btn_print)

        if (action == 'view') {
            $(modal_body_view).removeClass('d-none')
            $(modal_body_form).addClass('d-none')

            form_btn_edit.show()
            form_btn_submit.hide()
            form_btn_print.show()
        } else {
            $(modal_body_view).addClass('d-none')
            $(modal_body_form).removeClass('d-none')

            form_btn_edit.hide()
            form_btn_submit.show()
            form_btn_print.hide()
        }
    }

    //  =========================
    //  =========================
    //  End Function
    //  =========================
    //  =========================

    //  =========================
    //  =========================
    //  Base Function
    //  =========================
    //  =========================

    //  *
    //  * Form
    //  * view
    //  * 
    //  * get data
    //  * #async_get_data() = script_crud.php
    //  *
    function view_data(item_id = 0) {
        // item_id = 0
        async_get_data(item_id)
            .then((resp) => {
                modalActive(resp, 'view')
            })
            .then(() => {
                modalLoading_clear()
            })
    }

    //  *
    //  * DataTable
    //  * reload
    //  * 
    //  @param bool $reload = reload datatable
    //  * refresh data on datatable
    //  *
    function dataReload(reload=true) {
        modalHide()

        if(reload == false){
            $(datatable_name).DataTable().ajax.reload(false)
        }else{
            $(datatable_name).DataTable().ajax.reload()
        }
    }

    //  *
    //  * Form
    //  * add
    //  * 
    //  * open form add data

    //  *
    function add_data() {
        modalActive([], 'add')
        modalLoading_clear()
    }

    //  *
    //  * Form
    //  * reset
    //  * 
    //  * reset data all form
    //  *
    function resetForm() {
        let form = document.querySelectorAll("form")

        form.forEach((item, key) => {
            document.getElementsByTagName('form')[key].reset();
        })

        $('[data-plugin=jstree_checkbox]').jstree("deselect_all");

        $('.modal').find('.slimScrollDiv').slimScroll();
    }

    //  *
    //  * Modal
    //  * hiding modal
    //  *
    function modalHide() {
        $(modal).modal('hide')
    }

    //  *
    //  * Modal
    //  * data loading on modal
    //  *
    function modalLoading() {
        if ($(modal_body).length) {
            $(modal_body).find('div').hide()
            $(modal_body).append(loading)
        }
    }

    //  *
    //  * Modal
    //  * clear data loading on modal
    //  *
    function modalLoading_clear() {
        if ($(modal_body).length) {
            $(modal_body).find('.loading').remove()
            $(modal_body).find('div').show()
        }
    }

    //  =========================
    //  =========================
    //  End Base Function
    //  =========================
    //  =========================
</script>

<script>
    $(document).ready(function() {
        $("#basicTree").jstree({
            core: {
                themes: {
                    responsive: !1
                }
            },
            types: {
                default: {
                    icon: "mdi mdi-folder-star"
                },
                file: {
                    icon: "mdi mdi-file"
                }
            },
            plugins: ["types"]
        }), $("#checkTree").jstree({
            core: {
                themes: {
                    responsive: !1
                }
            },
            types: {
                default: {
                    icon: "fa fa-folder"
                },
                file: {
                    icon: "fa fa-file"
                }
            },
            plugins: ["types", "checkbox"]
        }), $("#dragTree").jstree({
            core: {
                check_callback: !0,
                themes: {
                    responsive: !1
                }
            },
            types: {
                default: {
                    icon: "fa fa-folder"
                },
                file: {
                    icon: "fa fa-file"
                }
            },
            plugins: ["types", "dnd"]
        }), $("#ajaxTree").jstree({
            core: {
                check_callback: !0,
                themes: {
                    responsive: !1
                },
                data: {
                    url: function(e) {
                        return "#" === e.id ? "assets/data/ajax_roots.json" : "assets/data/ajax_children.json"
                    },
                    data: function(e) {
                        return {
                            id: e.id
                        }
                    }
                }
            },
            types: {
                default: {
                    icon: "fa fa-folder"
                },
                file: {
                    icon: "fa fa-file"
                }
            },
            plugins: ["contextmenu", "dnd", "search", "state", "types", "wholerow"]
        })
    });
</script>