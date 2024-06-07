<?php
function check_for_show_menu(string $permitname = null, array $array_default)
{
    $result = false;

    // check admin
    if (check_admin()) {
        return true;
    }

    if (array_search($permitname, $array_default) !== FALSE) {
        $result = true;
    }

    return $result;
}
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title"></li>

                <li>
                    <a href="javascript: void(0);">
                        <i class="fe-airplay"></i>
                        <span><?= mb_ucfirst($this->lang->line('__menu_menu')) ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= site_url('dashboard/ctl_dashboard') ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_dashboard')) ?>"><?= mb_ucfirst($this->lang->line('__menu_dashboard')) ?></a></li>
                    </ul>
                </li>

                <?php
                $array_menu_main = [];
                $array_menu_sub = [];
                $menu_main_array['main_menu'] = array(
                    "uploader",
                    "dailyeatcows"
                );
                $menu_main_array['sub_menu'] = array(
                    "dailymilkingcows.view",
                    "sickcows.view",
                    "sickcowsdetail.view",
                    "foodless.view",
                    "dailyeatcows.view",
                    "maintenancecar.view",
                    "condensedfood.view",
                    "roughfood.view",
                    "medicalsupplies.view",
                    "electricity.view",
                    "cornfield.view"
                );

                $array_menu_main = (array) check_permit_groupmenu($menu_main_array['main_menu']);
                $array_menu_sub = (array) check_permit_groupmenu($menu_main_array['sub_menu']);

                /* echo "<pre>";
                    print_r($array_menu_main);
                    echo "</pre>";
                    echo "<pre>";
                    print_r($array_menu_sub);
                    echo "</pre>"; */
                // echo array_search('uploaders', $array_menu_main);
                // die;
                ?>

                <?php
                $css_upload = "d-none";
                if (check_for_show_menu('uploader', $array_menu_main)) {
                    $css_upload = "";
                }
                ?>
                <li class="<?= $css_upload; ?>">
                    <a href="javascript: void(0);">
                        <i class="fe-file-text"></i>
                        <span>นำเข้าข้อมูล</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <?php
                        $_menu_item_import_1 = "นำเข้าไฟล์ Excel";
                        ?>
                        <li class=""><a href="<?= site_url('excelupload/ctl_excel'); ?>" data-show="<?= $_menu_item_import_1; ?>"><?= $_menu_item_import_1; ?></a></li>
                    </ul>
                </li>

                <!-- <li class="<?= $css_blank; ?>">
                        <a href="javascript: void(0);">
                            <i class="fe-file-text"></i>
                            <span>หน้าระบบ</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <?php
                            /* $_menu_page[] = array("page", "หน้าเริ่มต้น");

                            for ($i = 0; $i < 1; $i++) {
                                $css_page[$i] = "d-none";
                                if (check_for_show_menu($_menu_page[$i][0], $array_menu_main)) {
                                    $css_page[$i] = "";
                                }

                                if (check_for_show_menu($_menu_page[$i][0], $array_menu_sub)) {
                                    $css_page[$i] = "";
                                }

                            } */
                            ?>
                            <li class="<?= $css_page[0]; ?>"><a href="<?= site_url('list/ctl_' . $_menu_page[0][0]); ?>" data-show="<?= $_menu_page[0][0]; ?>"><?= $_menu_page[0][1]; ?></a></li>
                        </ul>
                    </li> -->

                <!-- Profile -->
                <li>
                    <a href="#">
                        <i class="fas fa-user"></i>
                        <span><?= mb_ucfirst($this->lang->line('__menu_profile')) ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li><a href="<?= site_url('profile/ctl_page/') ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_profile')) ?>"><?= mb_ucfirst($this->lang->line('__menu_profile')) ?></a></li>
                    </ul>
                </li>

                <?php
                $css_admin = "d-none";
                if (check_for_show_menu("none", $array_menu_main)) {
                    $css_admin = "";
                }
                ?>
                <!-- Admin -->
                <li class="<?= $css_admin; ?>">
                    <a href="#">
                        <i class="fas fa-tools"></i>
                        <span><?= mb_ucfirst($this->lang->line('__menu_admin')) ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level text-capitalize" aria-expanded="false">
                        <li><a href="<?= site_url('admin/ctl_register') ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_register')) ?>"><?= mb_ucfirst($this->lang->line('__menu_register')) ?></a></li>
                        <li><a href="<?= site_url('admin/ctl_user') ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_users')) ?>"><?= mb_ucfirst($this->lang->line('__menu_users')) ?></a></li>
                        <li><a href="<?= site_url('admin/ctl_roles') ?>" data-show="setting roles"><?= mb_ucfirst($this->lang->line('__menu_settingroles')) ?></a></li>
                        <li><a href="<?= site_url('staff/ctl_page') ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_employee')) ?>"><?= mb_ucfirst($this->lang->line('__menu_employee')) ?></a></li>
                        <li><a href="<?= site_url('page/ctl_page') ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_blank')) ?>"><?= mb_ucfirst($this->lang->line('__menu_blank')) ?></a></li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
<script>
    document.getElementById('side-menu').getElementsByClassName('menu-title')[0].innerHTML = menuTitle
</script>