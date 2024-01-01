<!DOCTYPE html>
<html lang="en" style="height:100%;">
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

        <link rel="stylesheet" type="text/css" href="<?= esc(base_url('assets/css/login.css')); ?>">

        <style type="text/css">
            .action
            {
                padding: 4px; border-radius: 4px; color: white; font-size: 12px;
                cursor:pointer;
            }
            .action1
            {
                color: white; font-size: 12px;
            }
        </style>

    </head>
    <body class="bg-dark">
        <div id="app">
            <div class="container-fluid">

                <?= $this->renderSection('content'); ?>

            </div>
        </div>

        <?= view($scriptPath); ?>

    </body>
</html>

<script>
    $(document).ready(function() {
        $('html, body, .justify-content-md-center').attr('style', '');
        setInterval(function(){
            // $('html, body, .justify-content-md-center').css('height', '100% !important');
            $('html, body, .justify-content-md-center').attr('style', '');
        }, 10);
    });
</script>
