<div class="row">
    <div class="form-group col-md-12 text-center">
        <div class="position-relative">
            <input type="file" class="form-control-file border d-none" id="imgFile">
            <div class="tool-btn position-absolute mx-auto w-100">
                <button type="button" class="btn btn-sm btn-changeprofile" style="opacity:0.75">เปลี่ยนรูป</button>
            </div>

            <?php
            if ($this->session->userdata('user_img')) {
            ?>
                <div id="profileImage" class="mx-auto profile-edit-toggle">

                </div>
            <?php
            }
            ?>
            <div id="image_temp" data-profileImage="1" class="rounded-circle bordered mx-auto"></div>

        </div>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <span class="required"><i class="mdi mdi-svg"></i></span>
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_name_th')) ?></label>
        <input type="text" class="form-control" name="name_th" placeholder="ระบุ" value="" required>
    </div>
    <div class="form-group col-md-6">
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_lastname_th')) ?></label>
        <input type="text" class="form-control" name="lastname_th" placeholder="ระบุ" value="">
    </div>
    <div class="form-group col-md-6">
        <span class="required"><i class="mdi mdi-svg"></i></span>
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_name_us')) ?></label>
        <input type="text" class="form-control" name="name_us" placeholder="ระบุ" value="" required>
    </div>
    <div class="form-group col-md-6">
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_lastname_us')) ?></label>
        <input type="text" class="form-control" name="lastname_us" placeholder="ระบุ" value="">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <span class="required"><i class="mdi mdi-svg"></i></span>
        <label class="text-capitalize">ฝ่าย</label>
        <select id="section" name="section" class="form-control" data-toggle="select2" required>
            <option value="" disabled selected>ระบุ</option>
            <?php
            if ($sections) :
                foreach ($sections as $row) :
            ?>
                    <option value="<?= $row->ID; ?>"><?= $row->NAME; ?></option>
            <?php
                endforeach;
            endif;
            ?>
        </select>
    </div>
    <div class="form-group col-md-6">
        <span class="required"><i class="mdi mdi-svg"></i></span>
        <label class="text-capitalize">ตำแหน่ง</label>
        <input type="text" class="form-control" name="position" placeholder="ระบุ" value="" required>
    </div>
</div>

<script>
    $(document).on('click', '.btn-changeprofile', function() {
        $('#imgFile').trigger('click')
        // $('#imgFile').triggerHandler('select')
    })
</script>