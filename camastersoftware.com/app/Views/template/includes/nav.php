<header class="main-header">
    <div class="d-flex align-items-center logo-box justify-content-between">
        <!-- <a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block mx-10 push-btn" data-toggle="push-menu" role="button">
            <i class="ti-menu"></i>
        </a> -->
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
            <div class="logo-lg pl-20" style="font-size: 13px;margin-left: -15px;">
                <div class="image">
                    <img src="<?php echo base_url('assets/images/logo-ca.png'); ?>" class="avatar avatar-lg project-img" alt="User Image">
                </div>
            </div>
        </a>
    </div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top pl-10 navNew">
        <?php if ($uri1 != "superadmin" || $sessUserLoginName != "") : ?>
            <div class="heading_name text-center">
                <div class="app-menu">
                    <span class="centerClass">
                        <h3 class="text-cenetr text-bold mb-0"><?php echo $sessCaFirmName; ?></h3>
                        <h5 class="text-cenetr font-weight-bold">CHARTERED ACCOUNTANTS</h5>
                    </span>
                    <ul class="header-megamenu nav">
                        <li class="btn-group nav-item d-md-none">
                            <a href="#" class="waves-effect waves-light nav-link rounded push-btn" data-toggle="push-menu" role="button">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <li class="btn-group d-lg-inline-flex d-none">
                        <div class="app-menu animateHeader" data-id="in">
                            <div class="front animateInHeader">
                                <div class="search-bx mx-5">
                                    <p class="mb-0 font-weight-bold">
                                        <?php echo date('l, dS M Y'); ?>
                                    </p>
                                    <div id="MyClockDisplay" class="clock text-center" onload="showTime()"></div>
                                </div>
                            </div>
                            <div class="back animateOutHeader text-center" style="width: 250px;">
                                <div class="search-bx mx-5">
                                    <p class="mb-0 font-weight-bold">
                                        <span>Login By :</span>
                                        <span class="fu_count loginNameSpan"><?php echo $sessUserLoginName; ?></span>
                                    </p>
                                    <p class="mb-0 font-weight-bold" style="font-size: 12px !important;">
                                        <span>Due Date Year :</span>
                                        <span class="fu_count loginNameSpan"><?php echo $sessDueDateYear; ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        <?php elseif ($uri1 == "superadmin" && $sessUserLoginName == "") : ?>
            <div class="heading_name text-center">
                <div class="app-menu">
                    <span class="centerClass">
                        <h3 class="text-cenetr text-bold mb-0">CAMASTER SOFTWARE PRIVATE LIMITED</h3>
                        <h6 class="text-cenetr font-weight-bold">PROFESSIONAL PRACTICE MANAGEMENT</h6>
                    </span>
                    <ul class="header-megamenu nav">
                        <li class="btn-group nav-item d-md-none">
                            <a href="#" class="waves-effect waves-light nav-link rounded push-btn" data-toggle="push-menu" role="button">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="navbar-custom-menu r-side">
                <ul class="nav navbar-nav">
                    <li class="btn-group d-lg-inline-flex d-none rounded_10 p_clr external-event1" style="padding-top:0px !important;">
                        <div class="app-menu animateHeader" data-id="in">
                            <div class="front animateInHeader">
                                <div class="search-bx mx-5">
                                    <p class="mb-0 font-weight-bold text-white">
                                        <span>Firms :</span>
                                        <span class="fu_count">
                                            <?php
                                            // if(!empty($totalFirmArr['totalFirms']))
                                            //     echo str_replace(".00", "", money_format('%!i', $totalFirmArr['totalFirms']));
                                            // else
                                            //     echo "0";

                                            if (!empty($totalFirmArr['totalFirms'])) {
                                                echo str_replace(".00", "", number_format($totalFirmArr['totalFirms'], 2));
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </span>
                                    </p>
                                    <p class="mb-0 font-weight-bold text-white">
                                        <span>Users :</span>
                                        <span class="fu_count">
                                            <?php
                                            // if(!empty($totalFirmArr['totalUsers']))
                                            //     echo str_replace(".00", "", money_format('%!i', $totalFirmArr['totalUsers']));
                                            // else
                                            //     echo "0";

                                            if (!empty($totalFirmArr['totalUsers'])) {
                                                echo str_replace(".00", "", number_format($totalFirmArr['totalUsers'], 2));
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="back animateOutHeader text-center" style="width: 200px;">
                                <div class="search-bx mx-5">
                                    <p class="mb-0 font-weight-bold text-white">
                                        <span>Rating :</span>
                                        <span class="fu_count"><?php echo $feedbackAvgVal; ?></span>
                                    </p>
                                    <p class="mb-0 font-weight-bold text-white" style="font-size: 12px !important;">
                                        <span>Due Date Year :</span>
                                        <span class="fu_count"><?php echo $sessDueDateYear; ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <!--
            <ul class="nav navbar-nav">
                <li class="btn-group d-lg-inline-flex d-none rounded_10 p_clr external-event1" style="padding-top:0px !important;">
                    <div class="app-menu">
                        <div class="search-bx mx-5">
                            <p class="mb-0 font-weight-bold text-white">
                                <span>Firms :</span> 
                                <span class="fu_count">
                                    <?php
                                    // if(!empty($totalFirmArr['totalFirms']))
                                    //     echo str_replace(".00", "", money_format('%!i', $totalFirmArr['totalFirms']));
                                    // else
                                    //     echo "0";
                                    ?>
                                </span>
                            </p>
                            <p class="mb-0 font-weight-bold text-white">
                                <span>Users :</span> 
                                <span class="fu_count">
                                    <?php
                                    // if(!empty($totalFirmArr['totalUsers']))
                                    //     echo str_replace(".00", "", money_format('%!i', $totalFirmArr['totalUsers']));
                                    // else
                                    //     echo "0";
                                    ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </li>            
            </ul>
            -->
            </div>
        <?php endif; ?>
    </nav>
</header>

<header class="main-header main-header1">
    <?php if ($uri1 != "superadmin" || $sessUserLoginName != "") : ?>
        <nav class="navbar navbar-static-top pl-10">
            <ul class="nav navbar-nav">
                <li class="btn-group d-lg-inline-flex d-none">
                    <div class="app-menu <?php if ($uri2 == "home") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar"><a href="<?php echo base_url('home'); ?>" class="text-white">&nbsp;Dashboard</a></p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "clients" || $uri1 == "users" || $uri1 == "groups") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="dropdown-toggle nav_bar" data-toggle="dropdown">
                                    Create&nbsp;Masters
                                </a>
                                <div class="dropdown-menu drop_fileds">
                                    <a class="dropdown-item" href="<?php echo base_url('clients'); ?>">Create Client</a>
                                    <a class="dropdown-item" href="<?php echo base_url('groups'); ?>">Create Group</a>
                                    <a class="dropdown-item" href="<?php echo base_url('users'); ?>">Create User (Employee)</a>
                                    <!-- <a class="dropdown-item" href="<?php //echo base_url('non-regular-due-date-for-list'); ?>">Create Non-Regular Due Date For</a> -->
                                    <!-- <a class="dropdown-item" href="<?php //echo base_url('non-regular-due-dates'); ?>">Create Non-Regular Due Dates</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "my_works") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?php echo base_url('my_works'); ?>" class="text-white not_in_use">
                                    &nbsp;My&nbsp;Work
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="javascript:void(0);" class="text-white not_in_use">
                                    &nbsp;Time&nbsp;Sheet
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "todolist") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?php echo base_url('todolist'); ?>" class="text-white">
                                    &nbsp;To Do List
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "reminder") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?php echo base_url('reminder'); ?>" class="text-white">
                                    &nbsp;Reminders
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "inc_tax_mis_menu" || $uri1 == "tds-tcs-mis-report" || $uri1 == "gst-mis-report" || $uri1 == "pt-reg-mis-report" || $uri1 == "llp-mis-menu" || $uri1 == "combined-mis-report") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="dropdown-toggle nav_bar" data-toggle="dropdown">
                                    &nbsp;MIS&nbsp;Report
                                </a>
                                <div class="dropdown-menu drop_fileds">
                                    <a class="dropdown-item" href="<?php echo base_url('inc_tax_mis_menu'); ?>">&nbsp;Income&nbsp;Tax</a>
                                    <a class="dropdown-item" href="<?php echo base_url('tds-tcs-mis-report'); ?>">&nbsp;TDS-TCS</a>
                                    <a class="dropdown-item" href="<?php echo base_url('gst-mis-report'); ?>">&nbsp;GST</a>
                                    <a class="dropdown-item" href="<?php echo base_url('pt-reg-mis-report'); ?>">&nbsp;Profession&nbsp;Tax</a>
                                    <a class="dropdown-item" href="<?php echo base_url('llp-mis-menu'); ?>">&nbsp;LLP</a>
                                    <a class="dropdown-item" href="<?php echo base_url('combined-mis-report'); ?>">&nbsp;Combined&nbsp;Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "contactList") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?php echo base_url('contactList'); ?>" class="text-white">
                                    &nbsp;Contacts
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "referencer") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?php echo base_url('referencer'); ?>" class="text-white">
                                    &nbsp;Referencer
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri1 == "myDetails" || $uri1 == "caMasterDetails" || $uri1 == "error_reports" || $uri1 == "feedback_report") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5" style="margin-left:15px;">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="dropdown-toggle nav_bar" data-toggle="dropdown">
                                    &nbsp;My Account
                                </a>
                                <div class="dropdown-menu drop_fileds">
                                    <a class="dropdown-item switchDueDateYearBtn" href="javascript:void(0);">Switch Due Date Year</a>
                                    <a class="dropdown-item" href="<?= base_url('myDetails'); ?>">My Company Profile</a>
                                    <a class="dropdown-item not_in_use" href="javascript:void(0);">My Subscription</a>
                                    <a class="dropdown-item" href="<?= base_url('caMasterDetails'); ?>">CA-Master Details</a>
                                    <a class="dropdown-item" href="<?= base_url('manageSettings'); ?>">Manage Settings</a>
                                    <a class="dropdown-item" href="<?php echo base_url('error_reports'); ?>">Query Manager</a>
                                    <a class="dropdown-item" href="<?php echo base_url('feedback_report'); ?>">Feedback Report</a>
                                    <a class="dropdown-item not_in_use" href="javascript:void(0);">User Manual</a>
                                    <a class="dropdown-item" href="<?php echo base_url('chat/0'); ?>">Chat</a>
                                    <a class="dropdown-item logout_opt" href="<?php echo base_url('logout'); ?>">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-menu">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?= base_url('chat/0') ?>" class="text-white">
                                    <?php if (!empty($tot_Msg_Count)) : ?>
                                        <?php if ($tot_Msg_Count > 0) : ?>
                                            <i class=" bell-icon"><?= $tot_Msg_Count ?></i>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <i class="fa fa-comments icon-default nav_chat_menu_icon"></i>
                                </a>
                            </p>
                        </div>
                    </div>

                </li>
            </ul>
        </nav>
    <?php elseif ($uri1 == "superadmin" && $sessUserLoginName == "") : ?>
        <style>
            .nav_bar {
                /*font-size: 13px !important;*/
                font-size: 14px !important;
                color: #fff;
                font-weight: 600;
                padding: 10px 0px;
            }
        </style>
        <nav class="navbar navbar-static-top pl-10">
            <ul class="nav navbar-nav">
                <li class="btn-group d-lg-inline-flex d-none">
                    <div class="app-menu">
                        <div class="search-bx mx-5">
                            <p class="nav_bar"><a href="<?php echo base_url('superadmin/home'); ?>" class="text-white">&nbsp;Dashboard</a></p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri2 == "firmList" || $uri2 == "staff_types" || $uri2 == "menus" || $uri2 == "announcements") : ?>active<?php endif; ?>">
                        <div class="search-bx">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="dropdown-toggle nav_bar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    &nbsp;Masters
                                </a>
                                <div class="dropdown-menu drop_fileds">
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/firmList'); ?>">Create Firm (Licensee)</a>
                                    <a class="dropdown-item hide" href="<?php echo base_url('superadmin/profession_types'); ?>">Profession Types</a>
                                    <a class="dropdown-item hide" href="<?php echo base_url('superadmin/payment_options'); ?>">Payment Options</a>
                                    <a class="dropdown-item hide" href="<?php echo base_url('superadmin/states'); ?>">States</a>
                                    <a class="dropdown-item hide" href="<?php echo base_url('superadmin/cities'); ?>">Cities</a>
                                    <a class="dropdown-item hide" href="<?php echo base_url('superadmin/group_categories'); ?>">Client Group Categories</a>
                                    <a class="dropdown-item hide" href="<?php echo base_url('superadmin/salutation'); ?>">Salutation List</a>
                                    <a class="dropdown-item hide" href="<?php echo base_url('superadmin/documents'); ?>">Document List</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/staff_types'); ?>">Create Staff Type</a>
                                    <a class="dropdown-item hide" href="<?php echo base_url('superadmin/periodicity'); ?>">Periodicity</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/menus'); ?>">Create Menu</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/announcements'); ?>">Create Announcement</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/everyday_lab'); ?>">Create Everyday Lab</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri2 == "due_dates" || $uri2 == "org_types" || $uri2 == "acts" || $uri2 == "staff_types") : ?>active<?php endif; ?>">
                        <div class="search-bx">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="dropdown-toggle nav_bar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    &nbsp;Tax&nbsp;Calendar
                                </a>
                                <div class="dropdown-menu drop_fileds">
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/due_dates'); ?>">Create Due Date</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/org_types'); ?>">Create Organisation Types</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/acts'); ?>">Create Act</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/due-date-types'); ?>">Create Due Date Type</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/extended-due-dates'); ?>">Extended Due Dates</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri2 == "dataBank") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?php echo base_url('superadmin/dataBank'); ?>" class="text-white">
                                    &nbsp;Data Bank
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri2 == "demo_requests") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <!--&nbsp;Commission-->
                                <a href="<?php echo base_url('superadmin/demo_requests'); ?>" class="text-white">
                                    &nbsp;Demo Requests
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri2 == "subscribers") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?php echo base_url('superadmin/subscribers'); ?>" class="text-white">
                                    &nbsp;Licensee
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                &nbsp;License&nbsp;Fee
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri2 == "referncer") : ?>active<?php endif; ?>">
                        <div class="search-bx mx-5">
                            <p class="nav_bar verticalLine">
                                <a href="<?php echo base_url('superadmin/referncer'); ?>" class="text-white">
                                    &nbsp;Referencer
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="app-menu <?php if ($uri2 == "myAccountDetails" || $uri2 == "error_reports" || $uri2 == "feedbackReport") : ?>active<?php endif; ?>">
                        <div class="search-bx">
                            <div class="btn-group">
                                <a href="javascript:void(0);" class="dropdown-toggle nav_bar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    &nbsp;My&nbsp;Account
                                </a>
                                <div class="dropdown-menu drop_fileds">
                                    <a class="dropdown-item switchDueDateYearSuperAdminBtn" href="javascript:void(0);">Switch Due Date Year</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/myAccountDetails'); ?>">CA-Master Details</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/error_reports'); ?>">Query Manager</a>
                                    <a class="dropdown-item" href="<?php echo base_url('superadmin/feedbackReport'); ?>">Feedback Report</a>
                                    <a class="dropdown-item logout_opt" href="<?php echo base_url('superadmin/logout'); ?>">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</header>