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
                            <span> หน้าหลัก </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?= site_url('dashboard/ctl_dashboard') ?>" data-show="Dashboard">Dashboard</a></li>
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

                    <!-- Profile -->
                    <li class="<?= check_permit_menu('profile') ?>">
                        <a href="#">
                            <i class="fas fa-user"></i>
                            <span>ข้อมูลส่วนตัว</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="<?= site_url('profile/ctl_profile/') ?>" data-show="ข้อมูลผู้ใช้">ข้อมูลผู้ใช้</a></li>
                        </ul>
                    </li>

                    <!-- Admin -->
                    <li class="<?= check_permit_menu('admin') ?>">
                        <a href="#">
                            <i class="fas fa-tools"></i>
                            <span><?= $this->lang->line('__menu_admin') ?></span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level text-capitalize" aria-expanded="false">
                            <li><a href="<?= site_url('admin/ctl_register') ?>" data-show="ลงทะเบียน">ลงทะเบียน</a></li>
                            <li><a href="<?= site_url('admin/ctl_user') ?>" data-show="ผู้ใช้งาน">ผู้ใช้งาน</a></li>
                            <li><a href="<?= site_url('admin/ctl_roles') ?>" data-show="setting roles"><?= $this->lang->line('__menu_settingroles') ?></a></li>
                            <li><a href="<?= site_url('staff/ctl_page') ?>" data-show="พนักงาน">พนักงาน</a></li>
                            <li><a href="<?= site_url('page/ctl_page') ?>" data-show="blank"><?= $this->lang->line('__menu_blank') ?></a></li>
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