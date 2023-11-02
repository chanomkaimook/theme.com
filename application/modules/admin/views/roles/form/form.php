<div class="row">
    <div class="form-group col-md-6">
        <span class="required"><i class="mdi mdi-svg"></i></span>
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('form_roles_roles_name_th')) ?></label>
        <input type="text" class="form-control" name="roles_name_th" placeholder="<?= mb_ucfirst($this->lang->line('form_roles_roles_name_placeholder')) ?>" value="" required>
    </div>
    <div class="form-group col-md-6">
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('form_roles_roles_name_us')) ?></label>
        <input type="text" class="form-control" name="roles_name_us" placeholder="<?= mb_ucfirst($this->lang->line('form_roles_roles_name_placeholder')) ?>" value="">
    </div>
</div>

<div class="row">
    <div class="form-group col-md-6">
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_form_descrip_th')) ?></label>
        <textarea class="form-control" name="roles_descrip_th"></textarea>
    </div>
    <div class="form-group col-md-6">
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('_form_descrip_us')) ?></label>
        <textarea class="form-control" name="roles_descrip_us"></textarea>
    </div>
</div>

<style>
    .jstree-grid-container {
        display: grid;
        grid-template-columns: auto;
    }

    @media (min-width: 427px) {
        .jstree-grid-container {
            grid-template-columns: auto auto;
            grid-gap: 10px;
        }
    }

    @media (min-width: 992px) {
        .jstree-grid-container {
            grid-template-columns: auto auto auto;
            grid-gap: 10px;
        }
    }
</style>
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
            <?php
            echo html_roles_jstree($permit,'jstree_checkbox');
            ?>
        </div>

    </div>
</div>
<!-- 
    // selected
    li[aria-level=2][aria-selected=true]
    
    aria-level=1 : jstree-undetermined
 -->