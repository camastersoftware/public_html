<option value="">Select</option>
<?php if(!empty($resultArr)): ?>
	<?php foreach($resultArr AS $e_row): ?>
		<?php $rowId=$e_row['non_regular_due_date_for_id']; ?>
		<?php $rowName=$e_row['non_regular_due_date_for_name']; ?>
		<option value="<?php echo $rowId; ?>" <?php if($set_value==$rowId): ?>selected<?php endif; ?> ><?php echo $rowName; ?></option>
	<?php endforeach; ?>
<?php endif; ?>