<div class="row">

    <div class="col-md-4">
        <div class="member-card text-center">
            <div class="member-thumb mb-2 mx-auto">
                <?php
                if ($this->session->userdata('user_img')) {
                ?>
                    <div id="profileImage" class="mx-auto">

                    </div>
                <?php
                } else {
                ?>
                    <div id="profileImage" data-profileImage="1" class="rounded-circle bordered mx-auto"></div>
                <?php
                }
                ?>
            </div>
            <div class="form-group">
                <h4 class="mb-1">
                    <span class="name_th"></span>
                    <span class="lastname_th"></span>
                </h4>
                <p class="text-muted">ฝ่าย <span class="section">section</span> <span> | </span> <span class="position text-pink"> position </span></p>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="row">
            <div class="form-group col-md-6">
                <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_name_th')) ?></label>
                <p class="card-text name_th"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_lastname_th')) ?></label>
                <p class="card-text lastname_th"></p>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_name_us')) ?></label>
                <p class="card-text name_us"></p>
            </div>
            <div class="form-group col-md-6">
                <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_lastname_us')) ?></label>
                <p class="card-text lastname_us"></p>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('form_user_username')) ?></label>
                <p class="card-text username"></p>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('form_roles_label_rolechild')) ?></label>
                <div class="card-text d-flex user_roles gap-1">
                    <!-- <div class="btn btn-light rounded-pill px-2">บัญชี</div> -->
                </div>
            </div>
        </div>


        <div class="row">
            <div class="form-group col-md-12">
                <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('form_roles_label_permit')) ?></label>

                <!-- <div data-plugin="jstree">
            <ul>
                <li data-jstree='{"opened":true}'>Plugins
                    <ul>
                        <li data-jstree='{"selected":true,"type":"file"}' data-id="5">Plugin one</li>
                        <li data-jstree='{"type":"file"}' data-id="2">Plugin two</li>
                    </ul>
                </li>
            </ul>
        </div> -->

                <div class="jstree-grid-container">
                </div>

            </div>
        </div>
    </div>

</div>