<!DOCTYPE html>
<html lang="en">
    <head>
        <?= view('template/includes/site/css'); ?>
    </head>
    <body>
        <?= view('template/includes/site/navbar'); ?>

        <?= $this->renderSection('content'); ?>

        <?= view('template/includes/site/footer'); ?>
        <?= view('template/includes/site/scripts'); ?>

        <?= $this->renderSection('scripts'); ?>
    </body>
</html>