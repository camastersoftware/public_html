<option value="">Select City</option>
<?php if(!empty($cityList)): ?>
	<?php foreach($cityList AS $e_city): ?>
		<?php $cityId=$e_city['cityId']; ?>
		<?php $cityName=$e_city['cityName']; ?>
		<option value="<?php echo $cityId; ?>" <?php if($set_val_city==$cityId): ?>selected<?php endif; ?>><?php echo $cityName; ?></option>
	<?php endforeach; ?>
<?php endif; ?>