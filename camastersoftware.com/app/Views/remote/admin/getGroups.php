<h4>Client Group Details</h4>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col">Sr No</th>
                        <th scope="col">Client Group</th>
                        <th scope="col">Group Number</th>
                        <th scope="col">Cost Center</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $j=1; ?>
                    <?php if(!empty($groupList)): ?>
                        <?php foreach($groupList AS $e_grp): ?>
                            <tr class="client_group_id_<?php echo $e_grp['client_group_id']; ?>" >
                                <th scope="row"><?php echo $j; ?></th>
                                <td>
                                    <input type="text" class="form-control client_group" name="client_group" value="<?php echo $e_grp['client_group']; ?>" />
                                </td>
                                <td>
                                    <input type="text" class="form-control client_group_number" name="client_group_number" value="<?php echo $e_grp['client_group_number']; ?>">
                                </td>
                                <td>
                                    <select class="custom-select form-control client_group_cost" name="client_group_cost">
                                        <option value="">Select Cost Center</option>
                                        <?php if(!empty($userList)): ?>
                                            <?php foreach($userList AS $e_user): ?>
                                            <option value="<?php echo $e_user['userId']; ?>" <?php if($e_user['userId']==$e_grp['client_group_cost']): ?>selected<?php endif; ?> ><?php echo $e_user['userFullName']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                                <td>
                                    <select class="custom-select form-control client_group_category" name="client_group_category">
                                        <option value="">Select Category</option>
                                        <?php if(!empty($groupCatList)): ?>
                                            <?php foreach($groupCatList AS $e_g_cat): ?>
                                            <option value="<?php echo $e_g_cat['group_category_id']; ?>" <?php if($e_g_cat['group_category_id']==$e_grp['client_group_category']): ?>selected<?php endif; ?>><?php echo $e_g_cat['group_category_name']; ?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="hidden" name="client_group_id" value="<?php echo $e_grp['client_group_id']; ?>">
                                    <button type="button" class="waves-effect waves-light btn btn-sm btn-submit save_client_group_btn" data-toggle="tooltip" data-original-title="Edit" data-rowId="<?php echo $e_grp['client_group_id']; ?>">
                                        <i class="fa fa-pencil"></i>&nbsp;Save
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger del_client_group" data-toggle="tooltip" data-original-title="Delete" data-rowId="<?php echo $e_grp['client_group_id']; ?>">
                                        <i class="fa fa-trash"></i>&nbsp;Delete
                                    </button>
                                </td>
                            </tr>
                            <?php $j++; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6"><center>No records found</center></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 text-right">
        <hr>
        <button type="button" class="waves-effect waves-light btn btn-submit add_client">Create New Group</button>
        <button type="button" class="waves-effect waves-light btn btn-dark go_back">Back</button>
    </div>
</div>

<script>
    $(document).ready(function(){

        $('.go_back').on('click', function(){
            $('.add_group_section').show();
            $('.get_group_section').hide();
            $('.client_list_tbl').show();
            $('.add_client_group_btn').show();
        });

        $('.add_client').on('click', function(){
            $('.get_group_section').hide();
            $('.group_form').show();
        });

    });
</script>