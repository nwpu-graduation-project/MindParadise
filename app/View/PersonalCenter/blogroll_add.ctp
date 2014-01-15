<?php 
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_admin');
$this->end(); 

?>

<h3>添加链接</h3>
<?php
echo $this->Form->create('Blogroll');
echo $this->Form->input('title');
echo $this->Form->input('url', array('rows' => '3'));
echo $this->Form->end('保存');
?>
