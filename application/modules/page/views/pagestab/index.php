<div class="content">
    <input type="hidden" id="hidden_task_id">
    <!-- Start Content-->
    <div class="container-fluid">
        <style>
            .truncate {
                max-width: 200px;
            }
        </style>
        <div class="">
            <div class="card-box">
                <ul class="nav nav-tabs tabs-bordered">
                    <li class="nav-item">
                        <a href="#table" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                            <span class="d-none d-sm-block text-capitalize"><?= mb_ucfirst($this->lang->line('_table')) ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#overview" data-toggle="tab" aria-expanded="true" class="nav-link">
                            <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                            <span class="d-none d-sm-block"><?= mb_ucfirst($this->lang->line('_overview')) ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#setting" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <span class="d-block d-sm-none"><i class="mdi mdi-email-outline"></i></span>
                            <span class="d-none d-sm-block"><?= mb_ucfirst($this->lang->line('_setting')) ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#log" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <span class="d-block d-sm-none"><i class="mdi mdi-settings"></i></span>
                            <span class="d-none d-sm-block"><?= mb_ucfirst($this->lang->line('_log')) ?></span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="table">
                        <?php
                        require('datatable.php');
                        ?>
                    </div>
                    <div class="tab-pane" id="overview">
                        <?php
                        require('all.php');
                        ?>
                    </div>
                    <div class="tab-pane" id="setting">
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

        <!-- end row -->

    </div> <!-- end container-fluid -->

</div> <!-- end content -->

<!-- Modal -->
<?php require_once('component/modal_item.php') ?>
<!-- End Modal -->

<script>
    $(document).ready(function() {
        getData()

        const inputInt = d.querySelectorAll('input.int_only')
        inputInt.forEach(function(item, index) {
            item.addEventListener("keyup", function() {
                this.value = this.value.replace(/[^0-9.]/g, '');
            })
        })

        /* //	format number and float (.00) return string!! 
        function formatMoney(number, decPlaces, decSep, thouSep) {
            decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
                decSep = typeof decSep === "undefined" ? "." : decSep;
            thouSep = typeof thouSep === "undefined" ? "," : thouSep;
            var sign = number < 0 ? "-" : "";
            var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
            var j = (j = i.length) > 3 ? j % 3 : 0;

            return sign +
                (j ? i.substr(0, j) + thouSep : "") +
                i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
                (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
        } */
    })
</script>
<?php include('script.php') ?>
<?php include('script_crud.php') ?>
<?php include('script_datatable.php') ?>
<?php //require_once('application/views/partials/e_script_print.php'); 
?>