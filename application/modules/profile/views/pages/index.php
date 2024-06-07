<style>
    #profileImage {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: #CCC;
        font-size: 35px;
        color: #fff;
        text-align: center;
        line-height: 150px;
        margin: 20px 0;
    }
</style>
<div class="content">
    <input type="hidden" id="hidden_task_id">
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="begin_loader">
            <div class="card-box profile" style="display:none">

                <!-- Modal -->
                <?php require_once('form/view.php'); ?>

            </div>
        </div>

        <!-- end row -->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->

<!-- Script -->
<?php require_once('application/views/partials/e_script_print.php'); ?>
<!-- End Script -->

<script>
    $(document).ready(function() {

        let user_id = document.getElementById('hidden_user_id').value

        async_get_data(user_id)
            .then((resp) => {
                modalActive(resp, 'view')
            })
            .then(() => {
                loading_clear('.profile')
            })
    })
</script>
<?php include('script.php') ?>
<?php include('script_crud.php') ?>