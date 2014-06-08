<?php
$this->extend('/PersonalCenter/common_view');
$this->start('sidebar');
switch($currentUser['User']['role'])
{
	//case 1:
	case 2: echo $this->element("sidebar_user");break;
	case 3: echo $this->element("sidebar_consultant");break;
	case 4: echo $this->element("sidebar_admin");break;
	default://error
}
$this->end();
?>

<?php $this->start('css');?>
<style>
.text{
	margin-left: 0px;
	width:120%;
}
</style>
<?php $this->end();?>

<center><h2>修改咨询记录</h2></center><br>
<center>
<div class='main'>
	<div class='account'>
		<?php echo $this->Form->create('Document'); ?>
		<table align='center' border='1' cellspacing='0'>
		<tr>
			<td>是否公开:<?php 
				$options = array('是' => '是', '否' => '否');
				$string = $this->request->data['Document']['f_public'];
				
				$attributes = array('legend' => false, 'value' => $string);

				echo $this->Form->radio('f_public', $options, $attributes); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('title', array('label' => '标题:', 'size' => '47')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('abstract', array('label' => '摘要:', 'rows' => '3', 'cols' => '46')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('chief_compliant', array('label' => '主诉:', 'rows' => '3', 'cols' => '46')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('diagnosis', array('label' => '诊断:', 'rows' => '3', 'cols' => '46')); ?></td>
		</tr>
	</table>
	<center><?php echo $this->Form->input('id', array('type' => 'hidden'));
			echo $this->Form->end(__('保存修改'));?></center>
	</div>
</div>
</center>