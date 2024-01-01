<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= esc(base_url('assets/images/logo-ca.png')); ?>">

    <title>
        <?php if($uri1!="superadmin"): ?>
            CA Master - Admin Panel
        <?php else: ?>
            CA Master - Super Admin Panel
        <?php endif; ?>
    </title>

    <?= view($cssPath); ?>
    
    <?php
        if($lndryThemeCookie=="enabled")
            $tempTheme="dark-skin";
        else
            $tempTheme="light-skin";
    ?>

</head>
<body class="hold-transition <?php echo $tempTheme; ?> theme-primary fixed sidebar-collapse">

    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="padding-top: 10px !important;">
            <div class="container-full">

                <?= $this->renderSection('content'); ?>

                <?= view($footerPath); ?>

            </div>
        </div>
        <!-- /.content-wrapper -->

        <!--<footer class="main-footer">-->
            <!--<div class="pull-right d-none d-sm-inline-block">-->
            <!--    <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">-->
            <!--        <li class="nav-item">-->
            <!--            <a class="nav-link" href="javascript:void(0)">FAQ</a>-->
            <!--        </li>-->
            <!--        <li class="nav-item">-->
            <!--            <a class="nav-link" href="#">Purchase Now</a>-->
            <!--        </li>-->
            <!--    </ul>-->
            <!--</div>-->
            <!--&copy; <?php //echo date('Y'); ?> <a href="https://dynamicvishva.in/">Dynamic Vishva</a>. All Rights Reserved.-->
        <!--</footer>-->

    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">

        $(document).ready(function(){

            <?php if(!empty($flashSuccessMsg)): ?>
                swal("", "<?php echo $flashSuccessMsg; ?>", "success");
            <?php endif; ?>

            <?php if(!empty($flashWarningMsg)): ?>
                swal('Warning', "<?php echo $flashWarningMsg; ?>", 'warning');
            <?php endif; ?>

            <?php if(!empty($flashErrorMsg)): ?>
                swal("Error!", "<?php echo $flashErrorMsg; ?>", "error");
            <?php endif; ?>

            $('.self_refresh').on('click', function(){
                location.reload();
            });

            $('.get_back').on('click', function(){
                window.history.back();
            });
            
            setInterval(function(){ 
                $('.step').hide();
            }, 500);
        });

    </script>

    <?= view($scriptPath); ?>

    </body>
</html>
