<div class="panel panel-default">
	<div class="panel-heading"><?php _e('Rules', YRM_LANG);?></div>
	<div class="panel-body">
		<div class="row row-static-margin-bottom">
			<div class="col-xs-5">
				<label class="control-label" for="yrm-find-name"><?php _e('Find', YRM_LANG);?>:</label>
			</div>
			<div class="col-xs-4">
				<input type="text" class="form-control" placeholder="<?php _e('Find', YRM_LANG);?>" name="yrm-find-name" id="yrm-find-name" value="<?php echo esc_attr($typeObj->getOptionValue('yrm-find-name')); ?>">
			</div>
		</div>
		<div class="row row-static-margin-bottom">
			<div class="col-xs-5">
				<label class="control-label" for="yrm-replace-name"><?php _e('Replace With', YRM_LANG);?>:</label>
			</div>
			<div class="col-xs-4">
				<input type="text" class="form-control" placeholder="<?php _e('Replace With', YRM_LANG);?>" name="yrm-replace-name" id="yrm-replace-name" value="<?php echo esc_attr($typeObj->getOptionValue('yrm-replace-name')); ?>">
			</div>
		</div>
	</div>
</div>