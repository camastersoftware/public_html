<div class="table-responsive">
    <table class="table mb-0">
        <thead>
            <tr>
                <th scope="col">Sr No</th>
                <th scope="col">Address Line 1</th>
                <th scope="col">Address Line 2</th>
                <th scope="col">Pincode</th>
                <th scope="col">Landmark</th>
            </tr>
        </thead>
        <tbody>
            <?php $j=1; ?>
            <?php if(!empty($addressArr)): ?>
                <?php foreach($addressArr AS $e_addr): ?>
                    <tr>
                        <th scope="row"><?php echo $j; ?></th>
                        <td><?php echo $e_addr['addressLine1']; ?></td>
                        <td><?php echo $e_addr['addressLine2']; ?></td>
                        <td><?php echo $e_addr['pincode']; ?></td>
                        <td><?php echo $e_addr['landmark']; ?></td>
                    </tr>
                <?php $j++; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5"><center>No records<center></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>