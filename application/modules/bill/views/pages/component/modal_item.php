<div id="modal_view" class="modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <style>
        @media print {

            .modal-header button,
            .modal-footer {
                display: none;
            }

            body {
                font-size: large;
            }

            body p {
                font-size: 24px;
            }
        }
    </style>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mt-0 modal_text_header"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="printDiv('modal_view')">ปริ้น</button>
            </div>
            <!-- Form -->
            <form class="form-horizontal" id="frm">
                <input type="hidden" name="frm_hidden_id">

                <div class="modal-body">
                    <div class="modal-body-content" style="height:70vh">
                        <div class="color-scroll" style="max-height:70vh">
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">ปิด</button>
                    <button type="button" class="btn-edit btn btn-warning waves-effect waves-light px-4">แก้ไข</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light px-4">บันทึก</button>
                </div>
            </form>
            <!-- End Form -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->