<h1>修改案例</h1>
<center>
<table>
	<?php echo $this->Form->create('CaseArticle'); ?>
	<tr><td align="center"><?php echo $this->Form->input('title', array('label' => '案例标题')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('body', array('rows' => '3', 'cols' => '20', 'label' => '案例内容')); ?></td></tr>
	<tr align="center"><td><?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
	<?php echo $this->Form->end('保存修改'); ?></td></tr>	
</table>
</center>