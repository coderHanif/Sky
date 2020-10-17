<?php
$id = 0;
if (!empty($_GET['farId'])) {
    $id = $_GET['farId'];
}
?>
<div class="ycf-bootstrap-wrapper">
    <div class="expm-wrapper">
    <form method="POST" action="<?php echo admin_url();?>admin-post.php?action=yrm_fr_save_data">
		<?php
		if(function_exists('wp_nonce_field')) {
			wp_nonce_field('read_more_save');
		}
		$reportButton = '';
		if(YRM_PKG == YRM_FREE_PKG) {
			$proClassWrapper = 'yrm-pro-option';
			$reportButton = '<a href="'.YRM_SUPPORT_URL.'" target="_blank"><button type="button" id="yrm-report-problem-button" class="yrm-button-red pull-right">
					<i class="glyphicon glyphicon-alert"></i>
					
					Report issue</button></a>';
		}
		?>
        <div class="titles-wrapper">
            <h2 class="expander-page-title">Change settings <?php echo $reportButton; ?></h2>
            <div class="button-wrapper">
                <p class="submit">
                    <?php if(YRM_PKG == YRM_FREE_PKG): ?>
                        <input type="button" class="yrm-upgrade-button-red" value="Upgrade to PRO version" onclick="window.open('<?php echo YRM_PRO_URL; ?>');">
                    <?php endif;?>
                    <input type="submit" class="button-primary yrm-button-primary" value="<?php echo 'Save Changes'; ?>">
                </p>
            </div>
        </div>
        <div class="clear"></div>
        <div class="row form-group">
            <div class="col-xs-12">
                <input type="text" name="yrm-find-title" class="form-control input-md" placeholder="Title" value="<?php echo esc_attr($typeObj->getOptionValue('title')); ?>">
            </div>
        </div>
        <input type="hidden" name="yrm-type" value="far">
        <input type="hidden" name="yrm-id" value="<?php echo esc_attr($id); ?>">
        <?php require_once(dirname(__FILE__).'/rules.php'); ?>
    </form>
    </div>
</div>