<div class="row">
    <div class="form-group col-md-12">
        <span class="required"><i class="mdi mdi-svg"></i></span>
        <label class="text-capitalize"><?= mb_ucfirst($this->lang->line('form_roles_roles_name')) ?></label>
        <input type="text" class="form-control" name="roles_name" placeholder="<?= mb_ucfirst($this->lang->line('form_roles_roles_name_placeholder')) ?>" value="" required>
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
            echo html_roles_jstree($permit);
            ?>
        </div>

    </div>
</div>
<!-- 
    jstree-anchor jstree-clicked : jstree-icon jstree-checkbox
    jstree-anchor : jstree-icon jstree-checkbox jstree-undetermined
    
    jstree-anchor jstree-clicked : jstree-icon jstree-checkbox
    jstree-anchor : jstree-icon jstree-checkbox
 -->