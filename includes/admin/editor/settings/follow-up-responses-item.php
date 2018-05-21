<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<tr>
	<td scope="col" class="manage-column column-question active">
		<?php echo $item['question'] ?>
	</td>

	<td scope="col" class="manage-column column-time active">
		<?php echo date( 'Y-m-d H:i e', $item['time'] ); ?>
	</td>

	<td scope="col" class="manage-column column-answer active">
		<?php echo isset($item['answer']) ? $item['answer'] : "" ?>
	</td>

	<td scope="col" class="manage-column column-country active">
		<?php echo isset($item['country']) ? $item['country'] : "" ?>
	</td>

	<td scope="col" class="manage-column column-region">
		<?php echo isset($item['region']) ? $item['region'] : "" ?>
	</td>

	<td scope="col" class="manage-column column-city">
		<?php echo isset($item['city']) ? $item['city'] : "" ?>
	</td>

	<?php do_action( 'totalpoll/actions/admin/editor/follow-up-responses/table-body-cells', $item, $this->poll ); ?>
		
	</td>
</tr>