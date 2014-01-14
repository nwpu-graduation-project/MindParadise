<?php 
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_admin');
$this->end();

?>

<h3><?php echo h($blogroll['Blogroll']['title']); ?></h3>
<div><?php echo $blogroll['Blogroll']['url']; ?></div>
