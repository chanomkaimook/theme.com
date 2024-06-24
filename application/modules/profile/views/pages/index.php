<style>
    #image_temp {
        font-size: 2.5rem;
        line-height: 9rem;
        /* margin: 20px 0; */
    }

    #profileImage {
        font-size: 35px;
        line-height: 150px;
        margin: 20px 0;
    }

    #profileImage,
    #image_temp {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #CCC;
        color: #fff;
        text-align: center;
    }
</style>
<div class="content">
    <input type="hidden" id="hidden_task_id">
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="begin_loader">


            <div class="profile" style="display:none">
                <div class="section-tool d-flex flex-column flex-md-row justify-content-between">

                    <div class="mb-1 mb-md-0">
                        <div class="d-flex gap-2">
                            <div class="tool-btn">
                                <button type="button" class="btn-profile btn">แก้ไขข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-box profile" style="display:none">

                <?php require_once('form/view.php'); ?>
                <!-- Modal -->

            </div>
        </div>

        <!-- end row -->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->

<!-- Modal -->
<?php require_once('component/modal_item.php') ?>
<!-- End Modal -->

<script>
    let user_id = document.getElementById('hidden_user_id').value

    $(document).ready(function() {
        // input user_id value to form_hidden_id because 
        // code work on variable form_hidden_id
        $(modal).find(form_hidden_id).val(user_id)
        getstarted()


        //  *
        //  * CRUD
        //  * click button edit
        //  * 
        //  * call function open form for edit data
        //  *
        $(d).on('click', 'button.btn-profile', function(e) {
            e.preventDefault()

            edit_data(user_id)
        })

    })

    function getstarted() {
        async_get_data(user_id)
            .then((resp) => {
                modalActive(resp, 'view')
            })
            .then(() => {
                loading_clear('.profile')

                // set up to dev
                // edit_data(user_id)
            })
    }
    /* function edit_profile() {

        $(modal_view_name).modal()

        async_get_data(user_id)
            .then((resp) => {
                modalActive(resp, 'edit')
            })
    } */
</script>
<?php include('script.php') ?>
<?php include('script_crud.php') ?>