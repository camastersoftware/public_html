<!--
<div class="box no-border no-shadow mb-6">
    <div class="box-body p-0 text-center">
        <div id="external-events text-center">

            <div class="external-event1 margin-event pt-5 pb-5 rounded_10 p_clr mr_my_work" data-class="bg-primary" >
                <a class="text-white" href="<?//= base_url('admin/myWork'); ?>"><span>My Work</span></a>
            </div>

        </div>
    </div>
</div>
-->
<div class="box no-border no-shadow">
    <div class="box-header with-border text-center">
        <h4 class="box-title text-center font-weight-bold">Reports</h4>
    </div>
    <div class="box-body p-0 text-center">
        <!-- the events -->
        <div id="external-events text-center">
            
            <!--<div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink" data-class="bg-primary" data-href="<?php echo base_url('admin/myWork'); ?>" >-->
            <!--    <a class="text-white" href="javascript:void(0);"><span>My Work</span></a>-->
            <!--</div>-->

            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 my_work_menu mt-20 openLink mrgbtm-10 <?php if($uri2=="master_data"): ?>active<?php endif; ?>" data-class="bg-primary" data-href="<?php echo base_url('admin/master_data'); ?>" >
                <a class="text-white" href="javascript:void(0);"><span>Masters &</span><br><span>Tax Calendar</span></a>
            </div>

            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 openLink mrgbtm-10 <?php if($uri2=="compliance" || $uri2=="inc_tax_section" || $uri2=="inc_tax_payments" || $uri2=="oth_act_menus" || $uri2=="inc_menus" || $uri2=="appeals"): ?>active<?php endif; ?>" data-class="bg-warning" data-href="<?php echo base_url('admin/compliance'); ?>" >
                <a class="text-white" href="javascript:void(0);">Compliance Management</a>
            </div>

            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 openLink mrgbtm-10 <?php if($uri2=="accountFinance"): ?>active<?php endif; ?>" data-class="bg-info" data-href="<?php echo base_url('admin/accountFinance'); ?>" >
                <a class="text-white not_in_use" href="javascript:void(0);"><span>Accounts &</span><br><span>Finance</span></a>
            </div>

            <div class="external-event1 margin-event pt-5 pb-5 p_clr rounded_10 openLink mrgbtm-10 <?php if($uri2=="administrationMgmnt"): ?>active<?php endif; ?>" data-class="bg-success" data-href="<?php echo base_url('admin/administrationMgmnt'); ?>" >
                <a class="text-white" href="javascript:void(0);">Administration & Management</a>
            </div>

        </div>
    </div>
</div>