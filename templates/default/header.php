<?php
if (defined('ABSPATH') === false) :
	exit;
endif; // Shhh
?>

<? if ($this->current != 'results'): ?>
    <form method="post" novalidate class="totalpoll-view-<?php echo $this->current; ?>" itemscope itemtype="http://schema.org/Question">
<? endif; ?>

<?php echo implode('', $this->hidden_fields()); ?>