    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vendors_css.css?v='.date('YmdHis')); ?>">

    <!-- Style-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css?v='.date('YmdHis')); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/skin_color.css?v='.date('YmdHis')); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/project.css?v='.date('YmdHis')); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/loader.css?v='.date('YmdHis')); ?>">
    
    <?php if(in_array('tooltip', $cssArr)): ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/custom-tooltip.css?v='.date('YmdHis')); ?>">
    <?php endif; ?>
    
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="<?php echo base_url('assets/js/vendors.min.js'); ?>"></script>
    
    <!--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dynamic-marquee@2"></script>-->
    <!--<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
    <!--<script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>-->
    <!--<script type='text/javascript' src='https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js'></script>-->
    <!--<script type='text/javascript' src='<?//= esc(base_url('assets/jQueryMarquee/jquery.marquee.min.js')); ?>'></script>-->
    <!--<script src="<?//= esc(base_url('assets/Pause-master/jquery.pause.js')); ?>"></script>-->
    <!--<script src="<?//= esc(base_url('assets/jquery.easing-master/jquery.easing.min.js')); ?>"></script>-->
    
    <!--<script type='text/javascript' src='//cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js'></script>-->
    
    <?php if($uri1!="superadmin" || $sessUserLoginName!=""): ?>
    
        <style>
            .fixed .main-header1 .navbar .app-menu {
                /*border-right: 1px solid #fff !important;*/
                padding: 0 10px !important;
                text-align: center !important;
            }
        </style>
    
    <?php elseif($uri1=="superadmin" && $sessUserLoginName==""): ?>
        <!-- .... -->
    <?php endif; ?>
        
    <script language=Javascript>
       
       function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       
       function isPercent(evt)
       {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            
            if (charCode != 46 && charCode > 31  && (charCode < 48 || charCode > 57))
                return false;
                
            // if(parseInt(evt.target.value) > 100)
            //     return false;
             
            return true;
       }
    </script>