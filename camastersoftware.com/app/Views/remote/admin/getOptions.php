<?php if($option_type==6): ?>
    <option value="0">No Condition</option>
<?php else: ?>
    <option value="">Select</option>
<?php endif; ?>

<?php if(!empty($resultArr)): ?>
	<?php foreach($resultArr AS $e_row): ?>
		<?php $rowId=$e_row['act_option_map_id']; ?>
		<?php $rowName=$e_row['act_option_name']; ?>
		<option value="<?php echo $rowId; ?>" <?php if($set_value==$rowId): ?>selected<?php endif; ?> ><?php echo $rowName; ?></option>
	<?php endforeach; ?>
<?php endif; ?>