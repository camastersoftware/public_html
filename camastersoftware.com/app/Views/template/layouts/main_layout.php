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
            <?php if(!empty($pageTitle)): ?>
                <?php echo $pageTitle; ?>
            <?php else: ?>
                CA Master - Admin Panel
            <?php endif; ?>
        <?php else: ?>
            CA Master - Super Admin Panel
        <?php endif; ?>
    </title>

    <?= view($cssPath); ?>
    
    <?= $this->renderSection('headerJavacript'); ?>
    
    <?php
        if($lndryThemeCookie=="enabled")
            $tempTheme="dark-skin";
        else
            $tempTheme="light-skin";
    ?>
    
    <script>
        var base_url = "<?= base_url(); ?>/";
    </script>

</head>
<body class="hold-transition <?php echo $tempTheme; ?> theme-primary fixed sidebar-collapse">
    
    <div class="overlay"></div>
    <div class="spanner">
        <img src="<?= esc(base_url('assets/images/logo-ca.png')); ?>" width="150">
        <div class="loader"></div>
        <p>Loading... Please wait for a moment.</p>
    </div>

    <div class="wrapper">

        <?= view($navPath); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">

                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <!--<h3 class="page-title">-->
                                <?php
                                    // if(isset($pageTitle))
                                    //     echo $pageTitle;
                                    // else
                                    //     echo "N/A";
                                ?>
                            <!--</h3>-->
                            <div class="d-inline-block align-items-center">
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo base_url(); ?>">
                                                <i class="mdi mdi-home-outline"></i>
                                            </a>
                                        </li>
                                        <?php if(!empty($navArr)): ?>
                                            <?php foreach($navArr AS $e_nav): ?>
                                                <li class="breadcrumb-item <?php if($e_nav['active']==true): ?>active<?php endif; ?>" aria-current="page">
                                                    <?php 
                                                        if($e_nav['active']==false)
                                                            $navLink=$e_nav['link'];
                                                        else
                                                            $navLink="javascript:void(0);";
                                                    ?>
                                                    <a href="<?php echo $navLink; ?>">
                                                        <?php echo $e_nav['title']; ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ol>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>

                <?= $this->renderSection('content'); ?>

                <?= view($footerPath); ?>
                
                <?= view('template/includes/modal'); ?>

            </div>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
                <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">Version - v2024.10.02</a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="#">Purchase Now</a>-->
                    <!--</li>-->
                </ul>
            </div>
            &copy; <a href="<?= base_url(); ?>" target="_blank">CAMaster Software Private Limited</a>. All Rights Reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">

        $(document).ready(function(){

            <?php if(!empty($flashBasicMsg)): ?>
                swal("<?php echo $flashBasicMsg; ?>");
            <?php endif; ?>

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
            
            setInterval(function(){ 
                $('.step').hide();
            }, 500);
        });

    </script>

    <?= view($scriptPath); ?>
    
    <?= $this->renderSection('javacript'); ?>

    </body>
</html>
