<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

    <style>
        .table-responsive table thead tr{
            background: #005495 !important;
            color: #fff !important;
        }
        
        .table-responsive table tbody tr{
            background: #96c7f242 !important;
        }
        
        .table-responsive tr th{
            border: 1px solid #fff !important;
        }
        
        .table-responsive tr td{
            border: 1px solid #015aacab !important;
        }
        
        table.dataTable {
            border-collapse: collapse !important;
            font-size: 16px !important;
        }
        
        .table > tbody > tr > td, .table > tbody > tr > th {
            padding: 0px 14px !important;
        }
        
        .btnPrimClr {
            margin-top: 5px !important;
            height: 30px !important;
            margin-bottom: 5px !important;
        }
        
        .table-responsive {
            overflow-x: hidden !important;
        }
        
        table.dataTable{
            margin-top: 0px !important;
        }
        
        .dt-buttons{
            display: block !important;
        }
    </style>

    <!-- Main content -->
    <section class="content mt-35">
        <div class="row">

            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border flexbox">
                        <h4 class="box-title font-weight-bold">
                            <?php
                                if(isset($pageTitle))
                                    echo $pageTitle;
                                else
                                    echo "N/A";
                            ?>
                        </h4>
                        <div class="text-right flex-grow">
                            <a href="<?= base_url('home'); ?>">
    					        <button class="btn btn-sm btn-dark" >Back</button>
    				        </a>
    					</div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <div class="col-md-3">Menu & Submenus</div>
                                        <div class="col-md-9">
                                            <div class="form-group row">
                                                <?php if(!empty($staffTypesArr)): ?>
                                                    <?php foreach($staffTypesArr AS $k_staff=>$e_staff): ?>
                                                    <div class="col-md-2 text-center"><?= $e_staff['staff_type_name']; ?></div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if(!empty($menuNameArr)): ?>
                                            <?php foreach($menuNameArr AS $e_menu): ?>
                                            <div class="col-md-3">
                                                <label class="font-weight-bold"><?= $e_menu['menuName']; ?></label>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group row">
                                                    <?php if(!empty($staffTypesArr)): ?>
                                                        <?php foreach($staffTypesArr AS $k_staff=>$e_staff): ?>
                                                            <?php
                                                                $menuPref=0;
                                                                if(isset($menuAccessArray[$e_staff['staff_type_id']][$e_menu['menuId']]['accessPref']))
                                                                {
                                                                    if($menuAccessArray[$e_staff['staff_type_id']][$e_menu['menuId']]['accessPref']==1)
                                                                        $menuPref=1;
                                                                    else
                                                                        $menuPref=0;
                                                                }
                                                                else
                                                                {
                                                                    $menuPref=0;
                                                                }
                                                            ?>
                                                            <div class="col-md-2 text-center">
                                                                <input type="checkbox" name='menuPref[]' id="menuPref<?= $e_menu['menuId'].$e_staff['staff_type_id']; ?>" class="filled-in" value="<?php echo $e_menu['menuId']; ?>" <?php if($menuPref==1): ?>checked<?php endif; ?> />
                                                                <label for="menuPref<?= $e_menu['menuId'].$e_staff['staff_type_id']; ?>" ></label>	
                                                                <input type="hidden" name='menuStaffId[]' value="<?= $e_staff['staff_type_id']; ?>" />
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if(!empty($subMenuNameArr)): ?>
                                                <?php foreach($subMenuNameArr AS $e_submenu): ?>
                                                    <?php if($e_submenu['fkMenuId']==$e_menu['menuId']): ?>
                                                        <div class="col-md-3">
                                                            <?= $e_submenu['subMenuName']; ?>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group row">
                                                                <?php if(!empty($staffTypesArr)): ?>
                                                                    <?php foreach($staffTypesArr AS $k_staff=>$e_staff): ?>
                                                                    <?php
                                                                        $menuPref=0;
                                                                        if(isset($submenuAccessArray[$e_staff['staff_type_id']][$e_menu['menuId']][$e_submenu['subMenuId']]['accessPref']))
                                                                        {
                                                                            if($submenuAccessArray[$e_staff['staff_type_id']][$e_menu['menuId']][$e_submenu['subMenuId']]['accessPref']==1)
                                                                                $menuPref=1;
                                                                            else
                                                                                $menuPref=0;
                                                                        }
                                                                        else
                                                                        {
                                                                            $menuPref=0;
                                                                        }
                                                                    ?>
                                                                    <div class="col-md-2 text-center">
                                                                        <input type="checkbox" name='submenuPref[]' id="submenuPref<?= $e_submenu['subMenuId'].$e_staff['staff_type_id']; ?>" class="filled-in" value="<?php echo $e_submenu['subMenuId']; ?>" <?php if($menuPref==1): ?>checked<?php endif; ?> />
                                                                        <label for="submenuPref<?= $e_submenu['subMenuId'].$e_staff['staff_type_id']; ?>" ></label>	
                                                                        <input type="hidden" name='menuId[]' value="<?= $e_menu['menuId']; ?>" />
                                                                        <input type="hidden" name='submenuStaffId[]' value="<?= $e_staff['staff_type_id']; ?>" />
                                                                    </div>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->



<?= $this->endSection(); ?>