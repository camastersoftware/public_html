<?= $this->extend($layoutPath); ?>

<?= $this->section('content'); ?>

<style>
    .box_body_bg {
        padding: 1.1rem 1.1rem;
        flex: 1 1 auto;
        /*border-radius: 10px;*/
        border: 1px solid #015aacab !important;
        background: #96c7f242 !important;
        /*margin-top: 20px !important;*/
        border-top-left-radius: 0px !important;
        border-top-right-radius: 0px !important;
    }
</style>

<section class="content mt-35">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border flexbox">
                    <h4 class="box-title font-weight-bold">
                        <?php echo $pageTitle; ?>
                    </h4>
                    <div class="text-right flex-grow">
                        <a href="<?php echo $backUrl; ?>">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark">Back</button>
                        </a>
                    </div>
                </div>
                <div class="box-body box_body_bg"> 
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Personal Documents</h5>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-md-4">Client Profile Photo:</label>
                                <div class="col-lg-8 col-md-8 mt-5">
                                    <?php if(!empty($clientData['clientProfileImg'])): ?>
                                        <a href="<?php echo $documentsPath."/".$clientData['clientProfileImg']; ?>" class="btn btn-sm btn-warning" target="_blank">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-4 col-md-4">Document File:</label>
                                <div class="col-lg-8 col-md-8 mt-5">
                                    <?php if(!empty($clientData['clientRegDocumentFile'])): ?>
                                        <a href="<?php echo $documentsPath."/".$clientData['clientRegDocumentFile']; ?>" class="btn btn-sm btn-warning" target="_blank">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-20">
                            <h5>Registration Documents</h5>
                            <hr>
                            <div class="form-group row mt-20">
                                <?php if(!empty($documentList)): ?>
                                    <?php foreach($documentList AS $e_doc): ?>
                                        <?php $cli_doc_id=$e_doc['client_document_id']; ?>
                                        <?php
                                            $client_document_file="";
                                            if(isset($clientDocDataArr[$cli_doc_id]['client_document_file']))
                                                $client_document_file=$clientDocDataArr[$cli_doc_id]['client_document_file'];
                                        ?>
                                        <div class="col-md-4">
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-8 col-md-8"><?php echo $e_doc['client_document_name']; ?>:</label>
                                                <div class="col-lg-4 col-md-4 mt-5">
                                                    <?php if(!empty($client_document_file)): ?>
                                                        <a href="<?php echo $documentsPath."/".$client_document_file; ?>" class="btn btn-sm btn-warning" target="_blank">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>