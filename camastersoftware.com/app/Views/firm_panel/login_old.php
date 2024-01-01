<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col col-sm-12 col-md-12  p-0 left-panel">
        <main class="py-4 login-info">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header text-center">
                                <img class="img-fluid" src="<?= esc(base_url('assets/images/logo-ca.png')); ?>" alt="" style="margin:0 auto; width:230px;">
                            </div>
                            <div class="card-body">
                                <h4 style="color:black;">Login</h4>
                                <form action="" method="post">
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-12 col-form-label text-md-left">Company Key</label>
                                        <div class="col-md-12">
                                            <input id="username" type="text" class="form-control" name="companyKey" placeholder="Enter your company key" value="<?php echo set_value('companyKey'); ?>" autofocus="">
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
                                                <?php for($d=2021; $d>=2011; $d--): ?>
                                                    <?php $dueYr=$d."-".(substr($d+1, 2)); ?>
                                                    <option value="<?php echo $dueYr; ?>" <?php echo set_select('dueDateYear', $dueYr); ?> ><?php echo $dueYr; ?></option>
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

<?= $this->endSection(); ?>

