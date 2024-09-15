
<div class="box no-border pt-10">
    <div class="box-header with-border text-center side_head_bdr_rds mx-10">
        <h4 class="box-title text-center font-weight-bold">Management</h4>
    </div>
    <div class="box-body p-0 text-center px-5 side_menu_box_mr">
        <div id="external-events text-center">
            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php if($uri1=="all_in_one_menus"): ?>active<?php endif; ?>" data-class="bg-primary" data-href="<?= base_url('all_in_one_menus'); ?>" >
                <a class="text-white not_in_use" href="javascript:void(0);"><span>All-In-One</span></a>
            </div>

            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 mrgbtm-10" data-class="bg-primary" data-href="javascript:void(0);" >
                <a class="text-white not_in_use" href="javascript:void(0);"><span>Favourites</span></a>
            </div>

            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php if($uri1=="tax_calendar_menu"): ?>active<?php endif; ?>" data-class="bg-primary" data-href="<?php echo base_url('tax_calendar_menu'); ?>" >
                <a class="text-white" href="javascript:void(0);"><span>Tax Calendar</span></a>
            </div>
            <!--
            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php //if($uri1=="master_data"): ?>active<?php// endif; ?>" data-class="bg-primary" data-href="<?php //echo base_url('master_data'); ?>" >
                <a class="text-white" href="javascript:void(0);"><span>Master Lists</span></a>
            </div>
            -->
            <?php
                $misReportsArr = array(
                    "mis-report-menu",
                    "inc_tax_mis_menu",
                    "tds-tcs-mis-report",
                    "gst-mis-report",
                    "pt-reg-mis-report",
                    "llp-mis-menu",
                    "combined-mis-report",
                    "get_client_report"
                );
            ?>
            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php if(in_array($uri1, $misReportsArr)): ?>active<?php endif; ?>" data-class="bg-primary" data-href="<?php echo base_url('mis-report-menu'); ?>" >
                <a class="text-white not_in_use" href="javascript:void(0);"><span>MIS Report</span></a>
            </div>
            
            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php if($uri1=="office-administration"): ?>active<?php endif; ?>" data-class="bg-primary" data-href="<?php echo base_url('office-administration'); ?>" >
                <a class="text-white not_in_use" href="javascript:void(0);"><span>Office Mgmt</span></a>
            </div>
            
            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php if($uri1=="client-administration"): ?>active<?php endif; ?>" data-class="bg-primary" data-href="<?php echo base_url('client-administration'); ?>" >
                <a class="text-white not_in_use" href="javascript:void(0);"><span>Client Mgmt</span></a>
            </div>
            
            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php if($uri1=="staff-administration"): ?>active<?php endif; ?>" data-class="bg-primary" data-href="<?php echo base_url('staff-administration'); ?>" >
                <a class="text-white not_in_use" href="javascript:void(0);"><span>Staff Mgmt</span></a>
            </div>
            
            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php if($uri1=="accountFinance"): ?>active<?php endif; ?>" data-class="bg-primary" data-href="<?php echo base_url('accountFinance'); ?>" >
                <a class="text-white not_in_use" href="javascript:void(0);"><span>Billing & Receipts</span></a>
            </div>
        </div>
    </div>
</div>