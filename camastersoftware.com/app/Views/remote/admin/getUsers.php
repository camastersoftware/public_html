<h4>Staff Details</h4>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">Sr No</th>
                        <th scope="col">Staff Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j=1; ?>
                    <?php if(!empty($getUserList)): ?>
                        <?php foreach($getUserList AS $e_row): ?>
                        <tr>
                            <th scope="row"><?php echo $j; ?></th>
                            <td><?php echo $e_row['userTitle'].". ".$e_row['userFullName']; ?></td>
                        </tr>
                        <?php $j++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <hr>
        <button type="button" class="waves-effect waves-light btn btn-submit add_client">Create User/Staff</button>
        <button type="button" class="waves-effect waves-light btn btn-dark go_back">Back</button>
    </div>
</div>

<script type="text/javascript">
            
    $(document).ready(function(){

        $('.go_back').on('click', function(){
            $('.add_staff_section').show();
            $('.get_staff_section').hide();
            $('.client_list_tbl').show();
            $('.add_user_top').show();
            $('.back_page').hide();
        });

        $('.add_client').on('click', function(){
            $('.add_user_top').hide();
            $('.add_staff_section').hide();
            $('.client_list_tbl').hide();
            $('.get_staff_section').hide();
            $('.staff_form').show();
        }); 

    });

</script>