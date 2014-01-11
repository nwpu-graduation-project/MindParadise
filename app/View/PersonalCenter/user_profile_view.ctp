<?php
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_user');
$this->end();

?>
<?php var_dump($profile)?>