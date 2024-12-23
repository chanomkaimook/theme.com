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
function check_for_collaspe_menu(string $urlname = null, string $urlcurrent = null)
{
    $result = false;
    if ($urlname && $urlcurrent) {

        // check "/" for urlname
        $explode_url = explode('/', $urlname);
        if (count($explode_url) < 3) {
            $urlname = $urlname . "/index";
        }

        // check "/" for urlcurrent
        $explode_url_current = explode('/', $urlcurrent);
        if (count($explode_url_current) < 3) {
            $urlcurrent = $urlcurrent . "/index";
        }

        if ($urlname === $urlcurrent) {
            // echo $urlname."==".$urlcurrent;
            $result = true;
        }
    }

    return $result;
}

$current_url_string = uri_string();
$site_url = site_url();
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title"></li>

                <?php
                // 
                // settings menu
                $array_menu_sub = [];
                $menu_main_array['sub_menu'] = array(
                    "page.view",
                );

                $array_menu_sub = (array) check_permit_groupmenu($menu_main_array['sub_menu']);

                /*
                    echo "<pre>";
                    print_r($array_menu_sub);
                    echo "</pre>";
                    die; */
                ?>

                <?php
                $css_dashboard_li = "";
                $css_dashboard_ul_collapse = "mm-collapse";
                $_menu_dashboard[] = array(mb_ucfirst($this->lang->line('__menu_dashboard')), "dashboard/ctl_dashboard");

                for ($i = 0; $i < count($_menu_dashboard); $i++) {
                    $css_dashboard[$i] = "";
                    if (check_for_collaspe_menu($_menu_dashboard[$i][1], $current_url_string)) {
                        $css_dashboard_ul_collapse = "";
                    }
                }

                ?>
                <li class="<?= $css_dashboard_li; ?>">
                    <a href="javascript: void(0);">
                        <i class="fe-airplay"></i>
                        <span><?= mb_ucfirst($this->lang->line('__menu_menu')) ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level <?= $css_dashboard_ul_collapse; ?>" aria-expanded="false">
                        <li class="<?= $css_dashboard[0]; ?>">
                            <a href="<?= $site_url . $_menu_dashboard[0][1] ?>" data-show="<?= $_menu_dashboard[0][0] ?>">
                                <span><?= $_menu_dashboard[0][0] ?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php
                /* $css_page_li = "d-none";
                    $css_page_ul_collapse = "mm-collapse";
                    $_menu_page[] = array("pages.permit","หน้าเริ่มต้น", "list/ctl_page");

                    for ($i = 0; $i < 1; $i++) {
                        $css_page[$i] = "d-none";
                        if (check_for_show_menu($_menu_page[$i][0], $array_menu_sub)) {
                            $css_page_li = "";
                            $css_page[$i] = "";
                        }

                        if (check_for_collaspe_menu($_menu_page[$i][0], $current_url_string)) {
                            $css_page_ul_collapse = "";
                        }
                    } */
                ?>
                <!-- <li class="<?= $css_page_li; ?>">
                        <a href="javascript: void(0);">
                            <i class="fe-file-text"></i>
                            <span>หน้าระบบ</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level <?= $css_page_ul_collapse; ?>" aria-expanded="false">
                            <li class="<?= $css_page[0]; ?>"><a href="<?= $site_url . $_menu_page[0][1]; ?>" data-show="<?= $_menu_page[0][0]; ?>"><?= $_menu_page[0][0]; ?></a></li>
                        </ul>
                    </li> -->

                <!-- Profile -->
                <?php
                $css_profile_ul_collapse = "mm-collapse";
                $_menu_profile[] = array(mb_ucfirst($this->lang->line('__menu_profile')), 'profile/ctl_page');
                if (check_for_collaspe_menu('profile/ctl_page', $current_url_string)) {
                    $css_profile_ul_collapse = "";
                }
                ?>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fas fa-user"></i>
                        <span><?= mb_ucfirst($this->lang->line('__menu_profile')) ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level <?= $css_profile_ul_collapse; ?>" aria-expanded="false">
                        <li>
                            <a href="<?= $site_url . $_menu_profile[0][1] ?>" data-show="<?= $_menu_profile[0][0] ?>">
                                <span><?= $_menu_profile[0][0] ?></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php
                $css_admin_li = "d-none";
                $css_admin_ul_collapse = "mm-collapse";
                $_menu_admin[] = array(mb_ucfirst($this->lang->line('__menu_register')), "admin/ctl_register");
                $_menu_admin[] = array(mb_ucfirst($this->lang->line('__menu_users')), "admin/ctl_user");
                $_menu_admin[] = array(mb_ucfirst($this->lang->line('__menu_settingroles')), "admin/ctl_roles");
                $_menu_admin[] = array(mb_ucfirst($this->lang->line('__menu_employee')), "staff/ctl_page");
                $_menu_admin[] = array(mb_ucfirst($this->lang->line('__menu_blank')), "page/ctl_page");
                $_menu_admin[] = array(mb_ucfirst($this->lang->line('__menu_blank')), "page/ctl_page/pagestab");

                if (check_for_show_menu("admin", $array_menu_sub)) {
                    $css_admin_li = "";
                }
                for ($i = 0; $i < count($_menu_admin); $i++) {
                    if (check_for_collaspe_menu($_menu_admin[$i][1], $current_url_string)) {
                        $css_admin_ul_collapse = "";
                    }
                }
                ?>
                <!-- Admin -->
                <li class="<?= $css_admin_li; ?>">
                    <a href="javascript: void(0);">
                        <i class="fas fa-tools"></i>
                        <span><?= mb_ucfirst($this->lang->line('__menu_admin')) ?></span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level <?= $css_admin_ul_collapse; ?> text-capitalize" aria-expanded="false">
                        <li><a href="<?= $site_url . $_menu_admin[0][1] ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_register')) ?>"><span><?= mb_ucfirst($this->lang->line('__menu_register')) ?></span></a></li>
                        <li><a href="<?= $site_url . $_menu_admin[1][1] ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_users')) ?>"><span><?= mb_ucfirst($this->lang->line('__menu_users')) ?></span></a></li>
                        <li><a href="<?= $site_url . $_menu_admin[2][1] ?>" data-show="setting roles"><span><?= mb_ucfirst($this->lang->line('__menu_settingroles')) ?></span></a></li>
                        <li><a href="<?= $site_url . $_menu_admin[3][1] ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_employee')) ?>"><span><?= mb_ucfirst($this->lang->line('__menu_employee')) ?></span></a></li>
                        <li><a href="<?= $site_url . $_menu_admin[4][1] ?>" data-show="<?= mb_ucfirst($this->lang->line('__menu_blank')) ?>"><span><?= mb_ucfirst($this->lang->line('__menu_blank')) ?></span></a></li>
                        <li><a href="<?= $site_url . $_menu_admin[5][1] ?>" data-show="หน้าตั้งต้น Tab">หน้าตั้งต้น Tab</a></li>
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