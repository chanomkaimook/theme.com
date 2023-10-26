<div class="row">
    <div class="form-group col-md-12">
        <span class="required"><i class="mdi mdi-svg"></i></span>
        <label class="text-capitalize">ดูแลเฉพาะ</label>
        <select id="permit" name="permit" class="form-control select2-multiple" 
        data-toggle="select2" multiple="multiple" data-placeholder="Choose ..." required>
            <?php
            foreach ($q_permit as $r_permit) :

                $array_group = array_
                $name = $r_permit->NAME;
            ?>
            <optgroup label="Alaskan/Hawaiian Time Zone">
                <option value="<?= $r_permit->ID; ?>"><?= $name; ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label class="text-capitalize">label</label>
        <input type="text" class="form-control" name="label_4" placeholder="ระบุ">
    </div>
    <div class="form-group col-md-6">
        <label class="text-capitalize">label</label>
        <input type="text" class="form-control" name="label_5" placeholder="ระบุ">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <span class="required"><i class="mdi mdi-svg"></i></span>
        <label class="text-capitalize">label</label>
        <textarea class="form-control" rows="2" name="label_6" required></textarea>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <label class="text-capitalize">label</label>
        <textarea class="form-control" rows="2" name="label_7"></textarea>
    </div>
</div>