<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .sec_heading{
        background:#F99D27;
        padding:7px 0;
        text-align:center;
        font-size:16px;
        font-weight: bold;
    }

    .card_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 0px !important;
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
    }
    
    .form_bg_format{
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        border-radius: 10px !important;
        border: 1px solid #8c8c8cab !important;
        background: #fdfeff !important;
    }
</style>

<section class="content">
    <div class="row">
        <div class="col-12">
            <!-- Step wizard -->
            <div class="box box-default mt-40">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold"><?= $pageTitle; ?></h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo base_url('superadmin/due_dates'); ?>" >
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body card_bg_format">
                    <form action="<?php echo base_url('superadmin/update_extend_due_date'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="offset-md-1 offset-lg-1 col-md-10 col-lg-10">
                                <div class="form-group row form_bg_format">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 mt-3">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="sec_heading">
                                                            <h4 class="text-white font-weight-bold m-0">Basic Due Date Details</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Act:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                            if(!empty($dueDatesArr['act_name']))
                                                                                echo $dueDatesArr['act_name']; 
                                                                            else
                                                                                echo "N/A";
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Due Date For:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                            if(!empty($dueDatesArr['due_date_for_name']))
                                                                                echo $dueDatesArr['due_date_for_name']; 
                                                                            else
                                                                                echo "N/A";
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-2">
                                                                        <label class="font-weight-bold">Tax Payer:</label>
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <?php
                                                                            if($dueDatesArr['is_all_tax_payer']=="1")
                                                                            {
                                                                                echo "All Assessees";
                                                                            }
                                                                            else
                                                                            {
                                                                                if(!empty($dueDatesArr['tax_payers']))
                                                                                    echo $dueDatesArr['tax_payers']; 
                                                                                else
                                                                                    echo "N/A";
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Under Section:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                            if(!empty($dueDatesArr['under_section_name']))
                                                                                echo $dueDatesArr['under_section_name']; 
                                                                            else
                                                                                echo "N/A";
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Audit Applicable:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php 
                                                                            if($dueDatesArr['audit_app']==1)
                                                                                echo "Yes"; 
                                                                            else
                                                                                echo "No";
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php if($dueDatesArr['audit_app']==1): ?>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Audit:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                            if(!empty($dueDatesArr['audit_name']))
                                                                                echo $dueDatesArr['audit_name']; 
                                                                            else
                                                                                echo "N/A";
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Applicable Form:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php
                                                                            if(!empty($dueDatesArr['applicable_form_name']))
                                                                                echo $dueDatesArr['applicable_form_name']; 
                                                                            else
                                                                                echo "N/A";
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Periodicity:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php echo $dueDatesArr['periodicity_name']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Period:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php 
                                                                            if($dueDatesArr['periodicity']==1)
                                                                            {
                                                                                if(check_valid_date($dueDatesArr["daily_date"]))
                                                                                    echo date("d-M-Y", strtotime($dueDatesArr['daily_date'])); 
                                                                                else
                                                                                    echo "N/A"; 
                                                                            }
                                                                            else if($dueDatesArr['periodicity']==2)
                                                                            {
                                                                                echo date("M", strtotime("2021-".$dueDatesArr["period_month"]."-01"))."-".$dueDatesArr["period_year"];
                                                                            }
                                                                            elseif($dueDatesArr['periodicity']>=3)
                                                                            {
                                                                                echo date("M", strtotime("2021-".$dueDatesArr["f_period_month"]."-01"))."-".$dueDatesArr["f_period_year"]." - ".date("M", strtotime("2021-".$dueDatesArr["t_period_month"]."-01"))."-".$dueDatesArr["t_period_year"];
                                                                            }
                                                                            else
                                                                            {
                                                                                echo "N/A";
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Financial Year:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php echo $dueDatesArr['finYear']; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Due Date:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <?php echo date("d-M-Y", strtotime($dueDatesArr['due_date'])); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="sec_heading">
                                                            <h4 class="text-white font-weight-bold m-0">Extended Dates</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <?php $e=1; ?>
                                                            <?php if(!empty($extDateArr)): ?>
                                                                <?php foreach($extDateArr AS $e_ext): ?>
                                                                <?php
                                                                    $ext_due_date_master_id=$e_ext['ext_due_date_master_id'];
                                                                    $ext_doc_file=$e_ext['ext_doc_file'];
                                                                ?>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4">
                                                                            <label class="font-weight-bold"><?= $e; ?>. Due Date:</label>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <?php echo date("d-M-Y", strtotime($e_ext['extended_date'])); ?>
                                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#editExtDateModal<?= $ext_due_date_master_id; ?>">
                                                                                <button class="btn btn-warning btn-sm" data-toggle="tooltip" data-original-title="Edit Extended Date"><i class="fa fa-pencil"></i></button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group row">
                                                                        <div class="col-md-4">
                                                                            <label class="font-weight-bold">Document:</label>
                                                                        </div>
                                                                        <div class="col-md-8">
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
                                                                </div>
                                                                <?php $e++; ?>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <div class="col-md-12 text-center">
                                                                <label>No records found</label>
                                                            </div>
                                                        <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="mt-0">
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <div class="sec_heading">
                                                            <h4 class="text-white font-weight-bold m-0">Extend Due Date</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Extend Due Date:</label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="date" name="ext_due_date" id="ext_due_date" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <label class="font-weight-bold">Document : <br><small class="text-danger">(Only pdf is accepted)</small></label>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <input type="file" name="ext_doc_file" id="ext_doc_file">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12 mt-30 text-center">
                                                        <input type="hidden" name="due_date_id" value="<?php echo $due_date_id; ?>">
                                                        <button type="submit" name="submit" class="waves-effect waves-light btn btn-submit">Submit</button>
                                                        <a href="<?php echo base_url('superadmin/due_dates'); ?>" >
                                                            <button type="button" class="btn btn-dark">Back</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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