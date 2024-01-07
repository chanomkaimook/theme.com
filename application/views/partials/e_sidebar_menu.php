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
                        $menu_path_quotation = array(
                            "main_menu" => array("quotation","bill","workorder"),
                            "sub_menu"  => array(
                                "quotation.view",
                                // "bill.view",
                                "bill.insert",
                                "workorder.view"
                            )
                        );

                    ?>
                    <!-- <li class="<?= check_permit_groupmenu($menu_path_quotation) ?>">
                        <a href="javascript: void(0);">
                            <i class="fe-file-text"></i>
                            <span> เอกสาร </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li class="<?= check_permit_menu($menu_path_quotation['sub_menu'][0]) ?>"><a href="<?= site_url('bill/ctl_quotation'); ?>" data-show="quotations">ใบเสนอราคา</a></li>
                            <li class="<?= check_permit_menu($menu_path_quotation['sub_menu'][1]) ?>"><a href="<?= site_url('bill/ctl_bill'); ?>" data-show="document bills">ใบขอรับบริการ</a></li>
                            <li class="<?= check_permit_menu($menu_path_quotation['sub_menu'][2]) ?>"><a href="<?= site_url('bill/ctl_workorder'); ?>" data-show="work orders">Work Order</a></li>
                        </ul>
                    </li> -->

                    <li class="">
                        <a href="javascript: void(0);">
                            <i class="fe-file-text"></i>
                            <span><?= mb_ucfirst($this->lang->line('__menu_lab')) ?></span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li class=""><a href="<?= site_url('lab/ctl_page'); ?>" data-show="Lab">Lab</a></li>
                            <li class=""><a href="<?= site_url('sublab/ctl_page'); ?>" data-show="Sublab">Sublab</a></li>
                        </ul>
                    </li>

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

                    <!-- Admin -->
                    <li class="<?= check_permit_menu('admin') ?>">
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