<h4>Client Details</h4>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">Sr No</th>
                        <th scope="col">Client Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j=1; ?>
                    <?php if(!empty($getClientList)): ?>
                        <?php foreach($getClientList AS $e_clnt): ?>
                            <tr>
                                <th scope="row"><?php echo $j; ?></th>
                                <td>
                                    <?php 
                                        if($e_clnt['orgType']==9)
                                            echo $e_clnt['clientTitle'].". ".$e_clnt['clientName'];
                                        else
                                            echo $e_clnt['clientBussOrganisation']; 
                                    ?>
                                </td>
                            </tr>
                            <?php $j++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2"><center>No records found</center></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <hr>
        <button type="button" class="waves-effect waves-light btn btn-submit add_client">Create New Client</button>
        <button type="button" class="waves-effect waves-light btn btn-dark go_back">Back</button>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('.go_back').on('click', function(){
            $('.add_client_section').show();
            $('.get_client_section').hide();
            $('.client_list_tbl').show();
        });

        $('.add_client').on('click', function(){
            $('.get_client_section').hide();
            $('.client_form').show();
            $('.back_page').show();
        });

    });
</script>