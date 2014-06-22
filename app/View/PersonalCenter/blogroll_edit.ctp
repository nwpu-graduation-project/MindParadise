<?php 
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_admin');
$this->end(); 

?>

<h3>编辑链接</h3>
<?php
echo $this->Form->create('Blogroll');
echo $this->Form->input('title', array('label' => '站点名称'));
echo $this->Form->input('url', array('rows' => '3', 'label' => '链接地址'));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('保存');
?>
