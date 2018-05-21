<?php
if ( defined( 'ABSPATH' ) === false ) :
	exit;
endif; // Shhh
?>
<?php do_action( 'totalpoll/actions/admin/editor/includes/question/before' ); ?>
<?php include 'question.php'; ?>
<?php do_action( 'totalpoll/actions/admin/editor/includes/choices/before' ); ?>
<?php include 'choices.php'; ?>
<?php do_action( 'totalpoll/actions/admin/editor/includes/thank-you-message/before' ); ?>
<?php include 'thank-you-message.php'; ?>
<?php do_action( 'totalpoll/actions/admin/editor/includes/poll-placement/before' ); ?>
<?php include 'poll-placement.php'; ?>
<?php do_action( 'totalpoll/actions/admin/editor/includes/visual-transition/before' ); ?>
<?php include 'visual-transition.php'; ?>
<?php do_action( 'totalpoll/actions/admin/editor/includes/results/before' ); ?>
<?php include 'results.php'; ?>
<?php do_action( 'totalpoll/actions/admin/editor/includes/settings/before' ); ?>
<?php include 'settings.php'; ?>
<?php do_action( 'totalpoll/actions/admin/editor/includes/browser/before' ); ?>
<?php include 'browse.php'; ?>
