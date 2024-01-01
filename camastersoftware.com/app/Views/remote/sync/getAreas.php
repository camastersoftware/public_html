<option value="">Select Area</option>
<?php if(!empty($areaList)): ?>
	<?php foreach($areaList AS $e_area): ?>
		<?php $areaId=$e_area['areaId']; ?>
		<?php $areaName=$e_area['officeName']; ?>
		<?php $areaPincode=$e_area['pincode']; ?>
		<option value="<?php echo $areaId; ?>" data-pin="<?php echo $areaPincode; ?>" <?php if($set_val_area==$areaId): ?>selected<?php endif; ?>><?php echo $areaName; ?></option>
	<?php endforeach; ?>
<?php endif; ?>