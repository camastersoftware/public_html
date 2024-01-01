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
    
    .fixed .main-header1 .navbar .app-menu {
        padding: 0 10px !important;
        text-align: center;
        padding: 0 10px !important;
        /*max-width: 30%;*/
        /*min-width: 12%;*/
        text-align: center;
    }
    
    @media (max-width: 1365px) {
        .fixed .main-header1 .navbar .app-menu {
            padding: 0 10px !important;
            text-align: center;
            padding: 0 10px !important;
            /*max-width: 30%;*/
            /*min-width: 11.5%;*/
            text-align: center;
        }
    }
    
    @media (min-width: 1600px) {
        .fixed .main-header1 .navbar .app-menu {
            padding: 0 0px !important;
            text-align: center;
            max-width: 25%;
            min-width: 11.7%;
            text-align: center;
        }
    }
    
    .p_clr{
       background-color: #005495 !important; 
    }
    
    .rounded_10{
        border-radius: 10px !important;
    }
</style>

<link rel="stylesheet" href="<?= esc(base_url('assets/css/marquee.css')); ?>">

<!-- Main content -->
<section class="content mt-35">
    
	<div class="row"> 
	    <?php if(!empty($birthdayArr) || !empty($holidayStr) || !empty($ancStr) || !empty($ancmntStr)): ?>
	    <div class="col-xl-12 col-lg-12 col-12">
			<div class="box">
				<div class="box-body" style="padding-bottom: 0px;">
					<div class="marqueeDiv">
					    <p>
					        <?php if(!empty($userBirthdayStr)): ?>
					            <b>Happy Birthday </b> (Staff) <b>:</b> <?php echo $userBirthdayStr; ?>
					        <?php endif; ?>
					        <?php if(!empty($userBirthdayStr) && !empty($clientBirthdayStr)): ?>
					        <b>|</b>
					        <?php endif; ?>
					        <?php if(!empty($clientBirthdayStr)): ?>
					            <b>Happy Birthday </b>(Client) <b>:</b> <?php echo $clientBirthdayStr; ?>
					        <?php endif; ?>
					        <?php if(!empty($birthdayArr) && !empty($holidayStr)): ?>
					        <b>|</b>
					        <?php endif; ?>
					        <?php if(!empty($holidayStr)): ?>
					            <b>Holiday : </b> Tommorow will be holiday on account of <?= $holidayStr; ?>
					        <?php endif; ?>
					        <?php if(!empty($birthdayArr) || !empty($holidayStr)): ?>
					        <b>|</b>
					        <?php endif; ?>
					        <?php if(!empty($ancStr)): ?>
					           <b>Announcements : </b> <?php echo $ancStr; ?>
					           <b>|</b>
					        <?php endif; ?>
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
            <?= view_cell('\App\Libraries\Utility::left_side_menu'); ?>
		</div> 
		<div class="col-xl-8 col-lg-8 col-12">
			<div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-12 tax_cldr mt-5">
    						<div class="row"> 
        						<div class="col-xl-12 col-lg-12 col-12 mt-5">
        							<h3 class="text-center text-bold m-0 bg-warning br-rds tx_cl_txt">Tax Calendar</h3>
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
            <?= view_cell('\App\Libraries\Utility::admin_menus'); ?>
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
        
        $('.fc-header-toolbar .fc-right, .fc-header-toolbar .fc-left').on('click', function(){
            
            var monthYr = $('.fc-header-toolbar .fc-center h2').text();
            
            var mthArr = monthYr.split(' ');
            
            var mthName = mthArr[0]; 
            
            var mthNo = getMonthFromString(mthName);
                
            // var monthNo = pad(mthNo);
            var monthNo = mthNo;
            
            var baseUrl = "<?php echo base_url(); ?>";
            
            var tax_cldr_link = baseUrl+"/tax_calendar?monthNo="+monthNo;
            
            $('.tax_cldr_link').attr('href', tax_cldr_link);
            
            console.log(monthNo);
        });
        
        $('.fc-button').on('click', function(){
            
            updateCalender();
            
        });
        
        $('body').on('click', '.dateBackgroundClr', function(){
            
            // $('.center-modal').modal('show');

            var due_date=$(this).data('date');

            var base_url = "<?php echo base_url(); ?>";

            window.location.href=base_url+"/getDateActs?date="+due_date;
            
        });

        updateCalender();

    });
    
    function updateCalender()
    {
        // var dateArr = ['2021-05-28', '2021-05-24', '2021-05-13', '2021-05-03'];
        var dateArr = <?php echo json_encode($dueDateArrCol); ?>;
            
        console.log(dateArr);
            
        // console.log(dateArr);
        
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
        
        // $('.fc-widget-content, .fc-day-top').removeClass('fc-today');
    }
    
    function getMonthFromString(mon){
        return new Date(Date.parse(mon +" 1, 2012")).getMonth()+1
    }
    
    function pad(n) {
        return (n < 10) ? ("0" + n) : n;
    }

</script>

<?= $this->endSection(); ?>