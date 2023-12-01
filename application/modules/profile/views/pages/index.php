<div class="content">
    <input type="hidden" id="hidden_task_id">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="section-tool d-flex flex-column flex-md-row justify-content-between">

        </div>
        <div class="">
            <div class="card-box">

                <!-- Modal -->
                <?php require_once(FCPATH.'/application/modules/admin/views/users/form/view.php'); ?>

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


        async_get_data(2)
        .then((resp)=>{
            console.log(resp)
        })

        
    })

    //  *
    //  * CRUD
    //  * read
    //  * 
    //  * get data
    //  *
    async function async_get_data(id = null) {
        let url = new URL(path('admin/ctl_user/get_user'), domain)
        if (id) {
            url.searchParams.append('id', id)
        }

        let response = await fetch(url)
        let result = await response.json()

        return result
    }
</script>