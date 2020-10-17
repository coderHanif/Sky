<?php
$ajaxNonce = wp_create_nonce("YrmNonce");

$pagenum = isset( $_GET['yrm-pagenum'] ) ? absint( $_GET['yrm-pagenum'] ) : 1;
global $wpdb;

$orderStatus = true;
$arrowVisibility = ' yrm-visibility-hidden';
$rotateClass = '';
$orderSql = 'desc';
$orderBySql = 'Order by id';
if (!empty($_GET['order'])) {
	$orderSql = $_GET['order'];
	$arrowVisibility = '';
	if ( $_GET['order'] == 'asc') {
		$orderStatus = false;
		$rotateClass = 'yrm-rotate-180';
	}
}

if (!empty($_GET['orderby'])) {
	$orderBySql = 'ORDER BY '.$_GET['orderby'];
}

$limit = YRM_NUMBER_PAGES; // number of rows in page
$offset = ($pagenum - 1) * $limit;
$total = $wpdb->get_var("SELECT COUNT(`id`) FROM {$wpdb->prefix}".YRM_FIND_TABLE);
$numOfPages = ceil($total/$limit);
$results = ReadMoreData::getAllSearchSaved($offset, $limit, $orderBySql, $orderSql);

?>
<div class="ycf-bootstrap-wrapper">
	<div class="wrap">
		<h2 class="add-new-buttons"><?php _e('Find & Replace', YRM_LANG); ?><a href="<?php echo admin_url();?>admin.php?page=<?php echo YRM_FIND_PAGE;?>&yrmFindPage=create" class="add-new-h2"><?php echo _e('Add New', YRM_LANG); ?></a></h2>
	</div>
	<div class="expm-wrapper">
		<?php if(YRM_PKG == YRM_FREE_PKG): ?>
			<div class="main-view-upgrade main-upgreade-wrapper">
				<a href="<?php echo YRM_PRO_URL; ?>" target="_blank">
					<button class="yrm-upgrade-button-red">
						<b class="h2">Upgrade</b><br><span class="h5">to PRO version</span>
					</button>
				</a>
			</div>
		<?php endif;?>
		<table class="table table-bordered expm-table">
			<tr>
				<td class="manage-column column-id sortable"><span>Id <span class="yrm-sorting-indicator <?php echo $rotateClass.$arrowVisibility; ?>" data-orderby="id" data-order="<?php echo $orderStatus; ?>"></span></span></td>
				<td><?php _e('Title', YRM_LANG)?></td>
				<td><?php _e('Enabled', YRM_LANG)?></td>
				<td><?php _e('Options', YRM_LANG)?></td>
			</tr>

			<?php if(empty($results)) { ?>
				<tr>
					<td colspan="4"><?php _e('No Data', YRM_LANG)?></td>
				</tr>
			<?php }
			else {
				foreach ($results as $result) { ?>
					<?php
					$id = (int)$result['id'];
					$title = esc_attr($result['expm-title']);
					if (empty($title)) {
						$title = __('(no title)');
					}
					$type = esc_attr($result['type']);

					?>
					<tr>
						<td><?php echo $id; ?></td>
						<td><a href="<?php echo admin_url()."admin.php?page=button&yrm_type=".$type."&readMoreId=".$id.""?>"><?php echo $title; ?></a></td>
						<td>
							<?php $isChecked = ($result['enable'] ? 'checked': ''); ?>
							<div class="yrm-switch-wrapper">
								<label class="yrm-switch">
									<input type="checkbox" name="yrm-status-switch" data-id="<?php echo $id; ?>" class="yrm-find-replace-status-switch" <?php echo $isChecked;?>>
									<span class="yrm-slider yrm-round"></span>
								</label>
							</div>
						</td>
						<td>
							<a class="yrm-crud yrm-edit glyphicon glyphicon-edit" href="<?php echo admin_url()."admin.php?page=".YRM_FIND_PAGE."&farId=".$id."&yrmFindPage=create"?>"></a>
							<a class="yrm-crud yrm-type-delete-link glyphicon glyphicon-remove" data-type="far" data-id="<?php echo $id;?>" href="<?php echo admin_url()."admin-post.php?action=yrm_typeDelete&readMoreId=".$id.""?>"></a>
						</td>
					</tr>
				<?php } ?>

			<?php } ?>
			<tr>
				<td>Id</td>
				<td><?php _e('Title', YRM_LANG)?></td>
				<td><?php _e('Enabled', YRM_LANG)?></td>
				<td><?php _e('Options', YRM_LANG)?></td>
			</tr>
		</table>
		<?php
		$page_links = paginate_links( array(
			'base' => add_query_arg( 'yrm-pagenum', '%#%' ),
			'format' => '',
			'prev_text' => __( '&laquo;', 'text-domain' ),
			'next_text' => __( '&raquo;', 'text-domain' ),
			'total' => $numOfPages,
			'current' => $pagenum
		) );

		if ( $page_links ) {
			echo '<div class="yrm-tablenav"><div class="yrm-tablenav-pages">' . $page_links . '</div></div>';
		}
		?>
	</div>
</div>