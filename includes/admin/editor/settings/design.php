<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh


?>
<div class="totalpoll-tab-content settings-tab-content settings-design" data-tp-tab-content="design">

	<?php do_action( 'totalpoll/actions/admin/editor/settings/design/before', $design, $this->poll ); ?>

	<div class="settings-item">

		<div class="settings-field">
			<label>
				<input type="checkbox" name="totalpoll[settings][design][template][default]">
				<?php _e( 'Set current settings as defaults', TP_TD ); ?>
			</label>
		</div>
		<?php do_action( 'totalpoll/actions/admin/editor/settings/design/set-as-defaults', $design, $this->poll ); ?>

		<div class="settings-field">
			<label>
				<input type="checkbox" name="totalpoll[settings][design][template][reset]" data-tp-templates>
				<?php _e( 'Reset settings to defaults', TP_TD ); ?>
			</label>
		</div>

		<?php do_action( 'totalpoll/actions/admin/editor/settings/design/reset-to-defaults', $design, $this->poll ); ?>
	</div>

	<div class="settings-item">
		<div class="containables-container" data-tp-container>
			<ul class="containables" data-tp-containables>
				<?php
				$template = TotalPoll::module( 'template', $design['template']['name'], $this->poll );
				if ( $template === false ):
					$template = TotalPoll::module( 'template', 'default', $this->poll );
				endif;

				$sections = $template->settings();
				foreach ( $sections as $section => $section_content ):

					?>
					<li class="containable" data-tp-containable>

						<div class="containable-handle" data-tp-containable-handle>
							<?php echo $section_content['label']; ?>
						</div>

						<div class="containable-content with-tabs">
							<?php
							$first_tab = key( $section_content['tabs'] );
							$hide_tabs = count( $section_content['tabs'] ) === 1 && empty( $section_content['tabs'][ $first_tab ]['label'] );
							?>

							<div class="totalpoll-tabs-container">
								<?php if ( ! $hide_tabs ): ?>
									<div class="totalpoll-tabs" data-tp-tabs>
										<?php
										foreach ( $section_content['tabs'] as $tab => $tab_content ):
											?>
											<a href="#" class="<?php echo $tab === $first_tab ? 'active' : ''; ?>" data-tp-tab="design-<?php echo $tab; ?>"><?php echo $tab_content['label']; ?></a>
											<?php
										endforeach;
										?>
									</div>
								<?php endif; ?>
								<div class="totalpoll-tabs-content" data-tp-tabs-content>
									<?php foreach ( $section_content['tabs'] as $tab => $tab_content ): ?>
										<div class="totalpoll-tab-content <?php echo $tab === $first_tab ? 'active' : ''; ?>" data-tp-tab-content="design-<?php echo $tab; ?>">

											<?php foreach ( $tab_content['fields'] as $field_slug => $field_content ): ?>

												<div class="settings-item">

													<div class="settings-field">

														<?php

														if ( isset( $field_content['label'] ) && is_string( $field_content['label'] ) ):
															$field_content['label'] = array(
																'content'    => $field_content['label'],
																'attributes' => array(
																	'class' => 'settings-field-label',
																),
															);
														endif;

														if ( isset( $design['preset'][ $section ]['tabs'][ $tab ]['fields'][ $field_slug ] ) ):
															$field_content = TotalPoll::instance( 'helpers' )->parse_args( $design['preset'][ $section ]['tabs'][ $tab ]['fields'][ $field_slug ], $field_content );
														endif;

														$field = TotalPoll::instance(
															'field',
															array(
																TotalPoll::instance( 'helpers' )->parse_args(
																	array(
																		'type'       => $field_content['type'] === 'color' ? 'text' : $field_content['type'],
																		'field_name' => "totalpoll[settings][design][preset][{$section}][tabs][{$tab}][fields][{$field_slug}][value]",
																		'name'       => $field_slug,
																		'class'      => array( 'widefat', "{$field_content['type']}-field" ),
																		'attributes' => array(
																			"data-tp-field-{$field_content['type']}" => true,
																		),
																	),
																	$field_content
																),
															)
														);

														echo $field->render();
														?>

													</div>

												</div>

											<?php endforeach; ?>

										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>

					</li>
					<?php
				endforeach;
				?>
			</ul>
		</div>

	</div>

	<div class="settings-item">
		<div class="settings-field">
			<label>
				<input type="checkbox" name="totalpoll[settings][design][one_click][enabled]" value="1" <?php checked( empty( $design['one_click']['enabled'] ), false ); ?>>
				<?php _e( 'Enable one-click vote', TP_TD ); ?>
			</label>
		</div>

		<?php do_action( 'totalpoll/actions/admin/editor/settings/design/one_click', $design, $this->poll ); ?>
	</div>

	<?php do_action( 'totalpoll/actions/admin/editor/settings/design/after', $design, $this->poll ); ?>

</div>