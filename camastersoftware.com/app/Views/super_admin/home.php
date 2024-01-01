<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .fc-toolbar{
        padding: 0px !important;
    }

    .box-body{
        padding-top: 0px !important;
    }

    .mt{
        margin-top: 80px !important;
    }
    
    .p_clr{
       background-color: #005495 !important; 
    }
    
    .rounded_10{
        border-radius: 10px !important;
    }    
    
    .head_yl_clr{
        background-color: #f99d27 !important;
    }
</style>

<link rel="stylesheet" href="<?= esc(base_url('assets/css/marquee.css')); ?>">

<!-- Main content -->
<section class="content mt-35">
	<div class="row"> 
	    <?php if(!empty($ancmntStr)): ?>
	    <div class="col-xl-12 col-lg-12 col-12">
			<div class="box">
				<div class="box-body" style="padding-bottom: 0px;">
					<div class="marqueeDiv">
					    <p>
					        <?php if(!empty($ancmntStr)): ?>
					           <b>CAMaster : </b> <?php echo $ancmntStr; ?>
					        <?php endif; ?>
					    </p>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="col-xl-2 col-lg-2 col-12">
            <?= view_cell('\App\Libraries\Utility::sup_admin_left_side_menu'); ?>
		</div> 
		<div class="col-xl-8 col-lg-8 col-12">
			<div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-12 tax_cldr mt-5">
    						<div class="row"> 
        						<div class="col-xl-12 col-lg-12 col-12 mt-5">
        							<h3 class="text-center text-bold m-0 bg-warning br-rds tx_cl_txt head_yl_clr" style="background-color: #f99d27 !important">Tax Calendar</h3>
        						</div>
        					</div>
        				</div>
						<div class="col-xl-12 col-lg-12 col-12 tax_cldr mt-5">
							<hr class="mt-0 mb-0">
							<div id="calendar" class="cldr_div"></div>
						</div>
					</div>
				</div>
			</div> 
		</div>
		<div class="col-xl-2 col-lg-2 col-12"> 
		    <?= view_cell('\App\Libraries\Utility::sup_admin_menus'); ?>
		</div> 
	</div>
</section>
<!-- /.content -->

    <!-- Modal -->
    <div class="modal center-modal fade" id="modal-center" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Acts Details</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Your content comes here</p>
                </div>
                <div class="modal-footer modal-footer-uniform text-right">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
	</div>
    <!-- /.modal -->

<script type="text/javascript">
            
    $(document).ready(function(){
        
        $('.fc-button').on('click', function(){
            
            updateCalender();
            
        });
        
        $('body').on('click', '.dateBackgroundClr', function(){
            
            // $('.center-modal').modal('show');

            var due_date=$(this).data('date');

            var base_url = "<?php echo base_url(); ?>";

            window.location.href=base_url+"/superadmin/getDateActs?date="+due_date;
            
        });

        updateCalender();

    });
    
    function updateCalender()
    {
        // var dateArr = ['2021-05-28', '2021-05-24', '2021-05-13', '2021-05-03'];
        var dateArr = <?php echo json_encode($dueDateArrCol); ?>;
            
        console.log(dateArr);
        
        $('.fc-row td.fc-day').each(function(index, value){
            
            $(dateArr).each(function(index1, value1){
                
                if($(value).data('date')==value1)
                {
                    $(value).addClass('dateBackgroundClr');
                }
                
            });
        });
        
        $('.fc-row td.fc-day-top').each(function(index, value){
            
            $(dateArr).each(function(index1, value1){
                
                if($(value).data('date')==value1)
                {
                    $(value).addClass('dateBackgroundClr');
                }
                
            });
        });
    }

</script>

<?= $this->endSection(); ?>