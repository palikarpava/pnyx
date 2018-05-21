<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<div class="totalpoll-tab-content" data-tp-tab-content="follow-up-responses" data-tp-paginate>
	<?php
	$items       = TotalPoll::instance( 'meta-pageable' )->paginate( 'follow-up-responses', $this->poll->id());
	$items_count = TotalPoll::instance( 'meta-pageable' )->count( 'follow-up-responses', $this->poll->id() );
	?>
	<input type="hidden" data-tp-paginate-count value="<?php echo $items_count; ?>">
	<input type="hidden" data-tp-paginate-action value="pnyx_browse_follow_up_responses">

	<table class="wp-list-table widefat fixed striped users">
		<thead>
		<tr>
			<th scope="col" class="manage-column column-time active" width="160"><?php _e( 'Time', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-question active" width="160"><?php _e( 'Question', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-answer active"><?php _e( 'Answer', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-country active" width="100"><?php _e( 'Country', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-region" width="100"><?php _e( 'Region', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-city" width="100"><?php _e( 'City', TP_TD ); ?></th>
			<?php do_action( 'totalpoll/actions/admin/editor/follow-up-responses/table-header-cells', $this->poll ); ?>
		</tr>
		</thead>

		<tbody data-tp-paginate-body>

		<?php

		if ( empty( $items ) === true ):
			?>
			<tr style="background: white;">
				<td><?php _e( 'There are no responses.', TP_TD ); ?></td>
			</tr>
			<?php
		else:
			foreach ( $items as $item ):
				include 'follow-up-responses-item.php';
			endforeach;
		endif;
		?>
		</tbody>

		<tfoot>
		<tr>
			<th scope="col" class="manage-column column-time active" width="160"><?php _e( 'Time', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-question active" width="160"><?php _e( 'Question', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-answer active"><?php _e( 'Answer', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-country active" width="100"><?php _e( 'Country', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-region" width="100"><?php _e( 'Region', TP_TD ); ?></th>
			<th scope="col" class="manage-column column-city" width="100"><?php _e( 'City', TP_TD ); ?></th>
			<?php do_action( 'totalpoll/actions/admin/editor/follow-up-responses/table-header-cells', $this->poll ); ?>
		</tr>
		</tfoot>

	</table>

	<div class="totalpoll-toolbar clearfix">
		<div class="alignleft">
			<button class="button" data-tp-paginate-button data-tp-paginate-first disabled value="1"><?php _e( 'First', TP_TD ); ?></button>
			&nbsp;
			<button class="button button-primary" data-tp-paginate-button data-tp-paginate-previous disabled value="1"><?php _e( 'Previous', TP_TD ); ?></button>
		</div>
		<div class="alignright">
			<button class="button button-primary" data-tp-paginate-button data-tp-paginate-next <?php disabled( $items_count < 10, true ); ?> value="2"><?php _e( 'Next', TP_TD ); ?></button>
			&nbsp;
			<button class="button" data-tp-paginate-button data-tp-paginate-last <?php disabled( $items_count < 10, true ); ?> value="<?php echo ceil( $items_count / 10 ); ?>"><?php _e( 'Last', TP_TD ); ?></button>
		</div>
	</div>

	<div class="totalpoll-toolbar clearfix with-major-actions">
		<div class="alignleft">
			<?php printf( _n( 'One response', '%s responses', $items_count, TP_TD ), number_format( $items_count ) ); ?>
		</div>
		<div class="alignright">
			<?php _e( 'Download', TP_TD ); ?>
			&nbsp;&nbsp;
			<button class="button button-primary" type="submit" name="totalpoll[download][follow-up-responses]" value="csv" formtarget="_blank"><?php _e( 'CSV', TP_TD ); ?></button>
			&nbsp;
			<button class="button button-primary" type="submit" name="totalpoll[download][follow-up-responses]" value="html" formtarget="_blank"><?php _e( 'HTML', TP_TD ); ?></button>
			&nbsp;&nbsp;
			<?php _e( 'or', TP_TD ); ?>
			&nbsp;&nbsp;
			<button class="button" name="totalpoll[reset][follow-up-responses]" value="1"><?php _e( 'Reset', TP_TD ); ?></button>
		</div>
	</div>

</div>