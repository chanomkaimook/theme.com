<div class="row">
    <div class="form-group col-md-12">
        <label for="">สิทธิ์ <small>เลือกได้มากกว่า 1</small></label>
        <select name="role" id="role" class="form-control" data-toggle="select2" multiple="multiple" data-placeholder="ระบุสิทธิ์ได้มากกว่า 1">
            <?php
            foreach ($role as $row_role) :
                $aria = mb_ucfirst($row_role->NAME);
            ?>
                <option value="<?= $row_role->ID; ?>"><?= $aria; ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
</div>

<!-- <div class="form-group row d-none userfocus">
                        <div class="col-12">
                            <label for="">ดูแลเฉพาะ</label>
                            <select id="userfocus" name="userfocus" class="form-control select2-multiple" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
                                <?php
                                foreach ($operator as $row_operator) :
                                    $staffname = $row_operator->MEMBER_NAME . " " . $row_operator->MEMBER_LASTNAME;
                                ?>
                                    <option value="<?= $row_operator->STAFF_ID; ?>"><?= $staffname; ?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div> -->

<div class="row">
    <div class="form-group col-md-12">
        <label for="">ชื่อ</label>
        <input class="form-control" type="text" id="name" name="name" placeholder="ชื่อภาษาไทย" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <label for="">นามสกุล</label>
        <input class="form-control" type="text" id="lastname" name="lastname" placeholder="นามสกุลภาษาไทย" required>
    </div>
</div>

<div class="row">
    <div class="form-group col-md-12">
        <label for="">username</label>
        <input type="text" id="input_username" name="input_username" class="form-control" placeholder="ชื่อผู้ใช้" required>

    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label for="">รหัสผ่าน</label>
        <input type="text" id="input_password" name="input_password" class="form-control" placeholder="รหัสผ่าน" required>

    </div>
</div>