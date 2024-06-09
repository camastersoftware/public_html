<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .lg_img{
        /*position: absolute !important;*/
        /*z-index: 9999999 !important;*/
        margin: 50px !important;
        width: 85% !important;
        height: 600px !important;
    }
    
    .ca_logo_img{
        margin: 50px !important;
        width: 70% !important;
        margin-top: 130px !important;
        margin-bottom: 0px !important;
    }
    
    .quotesSpan{
        color: #000 !important;
        font-size: 19px !important;
        font-style: italic !important;
    }
    
    .logoTitleSpan{
        color: #005495 !important;
        font-size: 25px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
    }
</style>

<div class="row">
    <div class="col col-sm-12 col-md-6  p-0 right-panel bg-white">
        <div class="text-center">
            <?php if(!empty($everydayLabArr)): ?>
                <?php 
                    $everydayLabImage = $everydayLabArr['everydayLabImage'];
                    $everydayLabQuotes = $everydayLabArr['everydayLabQuotes'];
                    $filePath = base_url(EVERYDAYLABPATH.$everydayLabArr['everydayLabImage']); 
                ?>
                <img src="<?= esc($filePath); ?>" class="img-fuild lg_img" <?php if(!empty($everydayLabQuotes)): ?>style="height: 500px !important;"<?php endif; ?>>
                <?php if(!empty($everydayLabQuotes)): ?>
                    <span class="quotesSpan">
                        <?= $everydayLabQuotes; ?>
                    </span>
                <?php endif; ?>
            <?php else: ?>
                <img src="<?= esc(base_url('assets/images/logo-ca.png')); ?>" class="img-fuild ca_logo_img" height="100%">
                <span class="logoTitleSpan">Compliance Management Solution</span>
            <?php endif; ?>
        </div>
    </div>
    <div class="col col-sm-12 col-md-6  p-0 left-panel">
        <main class="login-info">
            <div class="container">
                <div class="row justify-content-center justify-content-md-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center" style="padding-bottom: 5px;">
                                <img class="img-fluid" src="<?= esc(base_url('assets/images/logo-ca.png')); ?>" alt="" style="margin:0 auto; width:230px;">
                            </div>
                            <p class="text-center" style="color: #005495; font-size: 14px;font-weight: 600;text-transform: uppercase;">Compliance Management Solution</p>
                            <div class="card-body">
                                <h4 style="color:black;">Login</h4>
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-12 col-form-label text-md-left">License Number</label>
                                        <div class="col-md-12">
                                            <input id="username" type="text" class="form-control" name="companyKey" placeholder="Enter your License Number" value="<?php echo set_value('companyKey'); ?>" autofocus="">
                                            <?php if(!empty($companyKeyErr)): ?>
                                                <small class="help-block"><?php echo $companyKeyErr; ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-12 col-form-label text-md-left">Username</label>
                                        <div class="col-md-12">
                                            <input id="username" type="text" class="form-control" name="username" placeholder="Enter your username" value="<?php echo set_value('username'); ?>" autofocus="">
                                            <?php if(!empty($usernameErr)): ?>
                                                <small class="help-block"><?php echo $usernameErr; ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-md-12 col-form-label text-md-left">Password</label>
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter your password" value="<?php echo set_value('password'); ?>" >
                                            <?php if(!empty($passwordErr)): ?>
                                                <small class="help-block"><?php echo $passwordErr; ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-12 col-form-label text-md-left">Due Date Year</label>
                                        <div class="col-md-12">
                                            <select class="custom-select form-control" id="dueDateYear" name="dueDateYear">
                                                <option value="">Select Year</option>
                                                <?php for($d=$currentFinancialYear; $d>=2017; $d--): ?>
                                                    <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                    <option value="<?php echo $dueYr; ?>" <?php echo set_select('dueDateYear', $dueYr, $currFinYr==$dueYr ? TRUE:FALSE); ?> ><?php echo $dueYr; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <?php if(!empty($dueDateYearErr)): ?>
                                                <small class="help-block"><?php echo $dueDateYearErr; ?></small>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <?php if($errorMsg!=""): ?>
                                            <div class="col-md-12 m-2">
                                                <div class="alert alert-danger alert-dismissable">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <?php echo $errorMsg; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary" style="background:#005495; width:100%;">
                                                <i class="ion-log-in"></i> Login
                                            </button>
                                            <!-- <a href="register-ca-firm.php">
                                                <button type="button" class="btn btn-primary mt-10" style="background:#005495; width:100%;">
                                                    <i class="ion-log-in"></i> Register CA Firm
                                                </button>
                                            </a> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    $(document).ready(function() {
        // $('html, body, .justify-content-md-center').attr('style', '100%');
        setTimeout(function(){
            $('html, body, .justify-content-md-center').css('height', '100%');
            // $('html, body, .justify-content-md-center').attr('style', '100%');
        }, 10);
    });
</script>

<?= $this->endSection(); ?>

