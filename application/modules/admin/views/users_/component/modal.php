<div id="btn_register_user_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <!-- Form -->
            <form class="form-horizontal was-validated" autocomplete="off" id="frm" action="" >
                <input type="hidden" id="method" name="method" value="">
                <input type="hidden" id="hidden_id" name="hidden_id" value="1"> <!-- set 1 for default value check -->

                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <div class="">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal"><?= mb_ucfirst($this->lang->line('_form_btn_close')) ?></button>
                        <button type="button" class="btn-edit btn btn-warning waves-effect waves-light px-4"><?= mb_ucfirst($this->lang->line('_form_btn_edit')) ?></button>
                        <button type="submit" class="btn btn-success waves-effect waves-light px-4"><?= mb_ucfirst($this->lang->line('_form_btn_submit')) ?></button>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="modal-body-content" style="height:100%">
                        <!-- <div class="color-scroll" style="max-height:70vh"> -->
                        <!-- HTML -->
                        <div class="modal-body-view">
                            <?php include __DIR__ . '../../form/view.php' ?>
                        </div>
                        <!-- End HTML -->

                        <!-- Form -->
                        <div class="modal-body-form">
                            <?php include __DIR__ . '../../form/form.php' ?>
                        </div>
                        <!-- End Form -->
                        <!-- </div> -->
                    </div>






                </div>
            </form>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('[data-toggle=select2]').select2()

        $(document).on('change', '#role', function() {
            if ($(this).val() == 8) {
                $('.userfocus').removeClass('d-none')
            } else {
                $('.userfocus').addClass('d-none')
            }
        })
    })
</script>