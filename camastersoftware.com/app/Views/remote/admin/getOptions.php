<?php if($option_type==6): ?>
    <option value="0">No Condition</option>
<?php else: ?>
    <option value="">Select</option>
<?php endif; ?>

<?php if(!empty($resultArr)): ?>
	<?php foreach($resultArr AS $e_city): ?>
		<?php $cityId=$e_city['act_option_map_id']; ?>
		<?php $cityName=$e_city['act_option_name']; ?>
		<option value="<?php echo $cityId; ?>" <?php if($set_value==$cityId): ?>selected<?php endif; ?> ><?php echo $cityName; ?></option>
	<?php endforeach; ?>
<?php endif; ?>