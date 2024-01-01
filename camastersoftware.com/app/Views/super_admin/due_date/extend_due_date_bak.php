<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default mt-40">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">Extend Due Date</h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('superadmin/due_dates'); ?>" >
                            <button type="button" class="btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="<?php echo base_url('superadmin/update_extend_due_date'); ?>" method="post" enctype="multipart/form-data" >
                        <section>
                            <div class="form-group row" id="due_act_div">
                                <label class="col-md-3 font-weight-bold" for="due_act">Act:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['act_name']))
                                            echo $dueDatesArr['act_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="due_state_div">
                                <label class="col-md-3 font-weight-bold" for="due_state">State:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['stateName']))
                                            echo $dueDatesArr['stateName']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="due_date_for_div">
                                <label class="col-md-3 font-weight-bold" for="due_date_for">Due Date For:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['due_date_for_name']))
                                            echo $dueDatesArr['due_date_for_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="tax_payer_div">
                                <label class="col-md-3 font-weight-bold" for="tax_payer">Tax Payer:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['tax_payers']))
                                            echo $dueDatesArr['tax_payers']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="under_section_div">
                                <label class="col-md-3" for="under_section">Under Section:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['under_section_name']))
                                            echo $dueDatesArr['under_section_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="audit_app_div">
                                <label class="col-md-3" for="audit_app">Audit Applicable:</label>
                                <label class="col-md-4">
                                    <?php 
                                        if($dueDatesArr['audit_app']==1)
                                            echo "Yes"; 
                                        else
                                            echo "No";
                                    ?>
                                </label>
                            </div>  
                            <?php if($dueDatesArr['audit_app']==1): ?>
                            <div class="form-group row" id="audit_div">
                                <label class="col-md-3" for="audit">Audit:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['audit_name']))
                                            echo $dueDatesArr['audit_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>
                            <?php endif; ?>  
                            <div class="form-group row" id="applicable_form_div">
                                <label class="col-md-3" for="applicable_form">Applicable Form:</label>
                                <label class="col-md-4">
                                    <?php
                                        if(!empty($dueDatesArr['applicable_form_name']))
                                            echo $dueDatesArr['applicable_form_name']; 
                                        else
                                            echo "N/A";
                                    ?>
                                </label>
                            </div>  
                            <div class="form-group row" id="periodicity_div">
                                <label class="col-md-3" for="periodicity">Periodicity:</label>
                                <label class="col-md-4"><?php echo $dueDatesArr['periodicity_name']; ?></label>
                            </div>  
                            <div class="form-group row" id="period_div">
                                <label class="col-md-3" for="period_label">Period:</label>
                                <label class="col-md-4">
                                    <?php 
                                        if($dueDatesArr['periodicity']==1)
                                        {
                                            if(!empty($dueDatesArr['daily_date']) && $dueDatesArr['daily_date']!="0000-00-00" && $dueDatesArr['daily_date']!="1970-01-01")
                                                echo date("d-M-Y", strtotime($dueDatesArr['daily_date'])); 
                                            else
                                                echo "N/A"; 
                                        }
                                        else if($dueDatesArr['periodicity']==2)
                                        {
                                            echo date("M", strtotime($dueDatesArr["period_month"]))."-".date("Y", strtotime($dueDatesArr["period_year"]));
                                        }
                                        elseif($dueDatesArr['periodicity']>=3)
                                        {
                                            echo "From: ".date("M", strtotime($dueDatesArr["f_period_month"]))."-".date("Y", strtotime($dueDatesArr["f_period_year"])).", To: ".date("M", strtotime($dueDatesArr["t_period_month"]))."-".date("Y", strtotime($dueDatesArr["t_period_year"]));
                                        }
                                        else
                                        {
                                            echo "N/A";
                                        }
                                    ?>
                                </label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3">Financial Year:</label>
                                <label class="col-md-4"><?php echo $dueDatesArr['finYear']; ?></label>
                            </div>   
                            <div class="form-group row">
                                <label class="col-md-3">Due Date:</label>
                                <label class="col-md-4"><?php echo date("d-M-Y", strtotime($dueDatesArr['due_date'])); ?></label>
                            </div> 
                            <?php $e=1; ?>
                            <?php if(!empty($extDateArr)): ?>
                                <?php foreach($extDateArr AS $e_ext): ?>
                                    <?php
                                        $ext_due_date_master_id=$e_ext['ext_due_date_master_id'];
                                        $ext_doc_file=$e_ext['ext_doc_file'];
                                    ?>
                                    <div class="form-group row">
                                        <label class="col-md-3">Due Date <?php echo $e; ?>:</label>
                                        <label class="col-md-4">
                                            <?php echo date("d-M-Y", strtotime($e_ext['extended_date'])); ?>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#editExtDateModal<?= $ext_due_date_master_id; ?>">
                                                <button class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit Extended Date"><i class="fa fa-pencil"></i></button>
                                            </a>
                                        </label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3">Document for Due Date <?php echo $e; ?>:</label>
                                        <div class="col-md-2">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#editDocExtDateModal<?= $ext_due_date_master_id; ?>">
                                                <button class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit Doucument of Extended Date"><i class="fa fa-pencil"></i></button>
                                            </a>
                                            &nbsp;
                                            <?php if(!empty($ext_doc_file)): ?>
                                                <?php $uploadFilePath = base_url("uploads/admin/due_date/".$ext_doc_file); ?>
                                                <a href="<?= $uploadFilePath; ?>" target="_blank">
                                                    <button type="button" class="waves-effect waves-light btn btn-submit btn-sm" data-toggle="tooltip" data-original-title="View">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                                &nbsp;
                                                <a href="javascript:void(0);" class="deleteUploadedFile">
                                                    <button type="button" class="waves-effect waves-light btn btn-danger btn-sm" data-toggle="tooltip" data-original-title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php $e++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="form-group row">
                                <label class="col-md-3">New Extended Due Date:</label>
                                <div class="col-md-4">
                                    <input type="date" name="ext_due_date" id="ext_due_date" required>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-md-3">Document : <small class="text-danger">(Only pdf is accepted)</small></label>
                                <div class="col-md-4">
                                    <input type="file" name="ext_doc_file" id="ext_doc_file">
                                </div>
                            </div>   
                            <!--<div class="form-group row">-->
                            <!--    <label class="col-md-3">Notes:</label>-->
                            <!--    <div class="col-md-4">-->
                            <!--        <textarea name="due_notes" id="due_notes" class="form-control" rows="4" placeholder="Enter Notes"></textarea>-->
                            <!--    </div>-->
                            <!--</div>   -->
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group text-right">
                                        <input type="hidden" name="due_date_id" value="<?php echo $due_date_id; ?>">
                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                        <a href="<?php echo base_url('superadmin/due_dates'); ?>" >
                                            <button type="button" class="btn btn-dark">Back</button>
                                        </a>
                                    </div>
                                </div>
                            </div>  
                        </section>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<?php if(!empty($extDateArr)): ?>
    <?php foreach($extDateArr AS $e_ext): ?>
    
        <?php
            $ext_due_date_master_id=$e_ext['ext_due_date_master_id'];
            $ext_doc_file=$e_ext['ext_doc_file'];
        ?>
        
        <!-- Modal -->
        <div id="editExtDateModal<?= $ext_due_date_master_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('superadmin/edit_extend_due_date'); ?>" method="post" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Extended Due Date</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Extended Due Date<small class="text-danger">*</small></label>
                                        <input type="date" name="edit_ext_due_date" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Document : <small class="text-danger">*</small><small class="text-danger">(Only pdf is accepted)</small></label>
                                        <input type="file" name="edit_ext_doc_file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                            <input type="hidden" name="due_date_id" id="due_date_id" value="<?php echo $due_date_id; ?>">
                            <input type="hidden" name="ext_due_date_master_id" id="ext_due_date_master_id" value="<?php echo $ext_due_date_master_id; ?>">
                            <input type="hidden" name="old_ext_doc_file" value="<?php echo $ext_doc_file; ?>">
                            <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        
        <!-- Modal -->
        <div id="editDocExtDateModal<?= $ext_due_date_master_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <form action="<?php echo base_url('superadmin/edit-doc-extend-due-date'); ?>" method="post" enctype="multipart/form-data" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Edit Document of Extended Due Date</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <label>Document : <small class="text-danger">*</small><small class="text-danger">(Only pdf is accepted)</small></label>
                                        <input type="file" name="edit_ext_doc_file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="width: 100%;">
                            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                            <input type="hidden" name="due_date_id" id="due_date_id" value="<?php echo $due_date_id; ?>">
                            <input type="hidden" name="ext_due_date_master_id" id="ext_due_date_master_id" value="<?php echo $ext_due_date_master_id; ?>">
                            <input type="hidden" name="old_ext_doc_file" value="<?php echo $ext_doc_file; ?>">
                            <button type="submit" name="submit" class="btn btn-success text-left">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    
    <?php endforeach; ?>
<?php endif; ?>

<script type="text/javascript">

	$(document).ready(function(){
	    
	    $('body').on('click', '.deleteUploadedFile', function(){
            
            var base_url = "<?php echo base_url(); ?>";
            var ext_due_date_master_id = $('#ext_due_date_master_id').val();
            
            swal({
                title: "Are you sure?",
                text: "Do you really want to delete this uploaded file ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if (isConfirm) {

                    $.ajax({
                        url : base_url+'/superadmin/delete-ext-due-date-doc-file',
                        type : 'POST',
                        data : {
                            'ext_due_date_master_id':ext_due_date_master_id
                        },
                        dataType: 'html',
                        success : function(response) {
                            
                            window.location.reload();

                        },
                        error : function(request, error)
                        {
                            alert("Request: "+JSON.stringify(request));
                        }
                    });

                } else {
                    swal("Cancelled", "You cancelled :)", "error");
                }
            });
            
        });
		
	});
	
</script>

<?= $this->endSection(); ?>