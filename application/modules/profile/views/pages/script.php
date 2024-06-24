<script>
    /**
     * 
     * Function and event
     * function require script_crud.php
     * setting variable on below this page
     * 
     */
    /**
     * 
     * adjust code begin to zone Function
     * and zone Event on jquery script
     * adjust base code begin to zone Function
     * 
     */
    //  *
    //  * Dom
    //  * setting variable
    //  *
    const d = document
    const datatable_name = '#datatable'

    //  *
    //  * Form
    //  * setting variable
    //  *
    const form_name = '#frm'
    const form_hidden_id = '[name=frm_hidden_id]'
    const form_button_btn_view = '.btn-view'
    const form_button_btn_edit = '.btn-edit'
    const form_button_btn_add = '.btn-add'
    const form_button_btn_submit = 'button[type=submit]'
    const form_button_btn_del = '.btn-del'

    //  *
    //  * Modal
    //  * setting variable
    //  *
    let modal = '.modal'
    let modal_body = '.modal .modal-body'
    let modal_view_name = '#modal_view'
    let modal_body_view = '.modal .modal-body-view'
    let modal_body_form = '.modal .modal-body-form'


    $(document).ready(function() {
        // create select2 for section 
        $('[data-toggle=select2]').select2()

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

            if (f.find('[type=file]').length && f.find('[type=file]')[0].files.length) {
                let countImage = f.find('[type=file]')[0].files.length
                for (var i = 0; i < countImage; i++) {
                    data.push({
                        name: 'image[]',
                        value: f.find('[type=file]')[0].files[i]
                    })
                }
            }

            let func

            if (item_id) {
                func = async_update_data(item_id, data)
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
        $(d).on('click', form_button_btn_view, function(e) {
            e.preventDefault()

            let id = $(this).attr('data-id')
            view_data(id)

            $(form_name).find(form_hidden_id).val(id)
            $(form_name).find(form_button_btn_edit).attr('data-id', id)
        })

        //  *
        //  * CRUD
        //  * click button edit
        //  * 
        //  * call function open form for edit data
        //  *
        $(d).on('click', form_button_btn_edit, function(e) {
            e.preventDefault()

            let id = $(this).attr('data-id')
            edit_data(id)

            $(form_name).find(form_hidden_id).val(id)
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
        //  =========================
        //  =========================
        //  End Event
        //  =========================
        //  =========================


    })

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
        if (data) {
            if (action != 'add' && data.NAME) {
                let header = data.NAME
                $(modal).find('.modal_text_header').html(header)
            }

            switch (action) {
                case 'view':

                    if (data.SECTION) {
                        $('.form-group').find('.section').text(data.SECTION).end()
                    }
                    if (data.POSITION) {
                        $('.form-group').find('.position').text(data.POSITION).end()
                    }

                    if (data.IMG) {

                        let base_img_profile = $('[name=base_img_profile]').val()
                        let creatImagePreviews = creatImagePreview(base_img_profile + "/360/" + data.IMG)
                        $('.member-card').find('#profileImage').html(creatImagePreviews).end()
                        $(modal).find('#profileImage').html(creatImagePreviews).end()

                        // element from index.php
                        $('#image_temp').addClass('d-none')
                        $('.profile-edit-toggle').removeClass('d-none')

                    } else {
                        //  show icon profile   
                        showIconProfile(data.NAME_US, data.LASTNAME_US)
                    }

                    $('.form-group')
                        .find('.name_th').text(data.NAME).end()
                        .find('.name_us').text(data.NAME_US).end()
                        .find('.lastname_th').text(data.LASTNAME).end()
                        .find('.lastname_us').text(data.LASTNAME_US).end()
                        .find('.username').text(data.USERNAME).end()
                        .find('.jstree-grid-container').html(data.PERMIT_HTML).end()


                    create_roles()

                    async function create_roles() {
                        let data_array_html = ""
                        await new Promise((resolve, reject) => {
                            resolve(
                                data.ROLES.map(function(item) {
                                    data_array_html += create_html_roles(textCapitalize(item.ROLES_CODE))
                                })
                            )
                        })
                        await new Promise((resolve, reject) => {
                            $('.form-group').find('.user_role').html(data_array_html)
                        })
                    }

                    break
                case 'edit':
                    $(modal_body_form)
                        .find('[name=name_th]').val(data.NAME).end()
                        .find('[name=lastname_th]').val(data.LASTNAME).end()
                        .find('[name=name_us]').val(data.NAME_US).end()
                        .find('[name=lastname_us]').val(data.LASTNAME_US).end()
                        .find('[name=position]').val(data.POSITION).end()

                    if (data.SECTION) {
                        let select_id = $('#section option:contains(' + data.SECTION + ')').val()
                        $('#section').val(select_id).triggerHandler('change')
                    }

                    break
                default:
                    break
            }

            modalLayout(action)
        }

    }

    function create_html_roles(text = null) {
        let html = ""

        if (text) {
            html += `<div class="btn btn-primary">${text}</div>`
        }

        return html
    }

    //  *
    //  * Modal
    //  * layout
    //  * 
    //  * layout DOM for show on modal
    //  *
    function modalLayout(action = null) {
        let btn_edit = $(modal).find(form_button_btn_edit)
        let btn_submit = $(modal).find(form_button_btn_submit)

        if (action == 'view') {
            $(modal_body_view).removeClass('d-none')
            $(modal_body_form).addClass('d-none')
        } else {
            $(modal_body_view).addClass('d-none')
            $(modal_body_form).removeClass('d-none')
        }
    }

    // *
    // * Image profile
    // *
    //
    // event select image to preview
    if ($('#imgFile').length) {
        imgFile.onchange = (evt) => {
            let countImage = imgFile.files.length
            if (countImage >= 1) {

                // hide dom file image
                imgFile.classList.add("d-none");

                let html_image = ""
                html_image = creatImagePreview(URL.createObjectURL(imgFile.files[0]))
                image_temp.innerHTML = html_image

                // element from index.php
                $('#image_temp').removeClass('d-none')
                $('.profile-edit-toggle').addClass('d-none')
            } else {
                image_temp.innerHTML = ""
            }
        }
    }

    //
    // create preview image
    function creatImagePreview(image = "") {
        let html_image = ""
        if (image) {
            html_image += `<div style="background:url('${image}') no-repeat;
            background-size: cover;background-position: center;" class="rounded-circle h-100" ></div>`
        }

        return html_image
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
    //  * read
    //  * 
    //  * open form view data
    //  * #async_get_data() = script_crud.php
    //  *
    function get_data(item_id = 0) {
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
    //  * Form
    //  * edit
    //  * 
    //  * open form edit data
    //  * #async_get_data() = script_crud.php
    //  *
    function edit_data(item_id = 0) {

        $(modal_view_name).modal()

        // item_id = 0
        async_get_data(item_id)
            .then((resp) => {
                modalActive(resp, 'edit')
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
    function dataReload(reload = true) {
        modalHide()

        // from index.php
        getstarted()
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

        $('[data-toggle=select2]').val(null).trigger('change')

        // read modal image profile lastime
        let profile_lastime = $('#profileImage').html()
        $('#image_temp').html(profile_lastime)
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