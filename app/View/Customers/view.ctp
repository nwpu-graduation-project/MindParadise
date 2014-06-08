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

<center><h2>咨询诊断书</h2></center><br>
<div class='main'>
	<div class='account'>
	
	<?php echo $this->Form->create(null, array('url' => array('controller' => 'documents',
		'action' => 'add'))); ?>
	<table align='center' border='1' cellspacing='0'>
		<tr>
			<td width="50%" colSpan='2'>第<?php $count = h($customer['Customer']['case_count']); echo $count+1;
				echo $this->Form->input('detail_order', array('type' => 'hidden', 'default' => $count+1));
				$case_id = h($customer['Customer']['id']);
				echo $this->Form->input('Document.case_id', array('type' => 'hidden', 'default' => $case_id));
			 ?>次咨询</td>
			<td width="50%" colSpan='2'>是否公开:<?php 
				$options = array('是' => '是', '否' => '否');
				$attributes = array('legend' => false, 'value' => '否');

				echo $this->Form->radio('Document.f_public', $options, $attributes); ?></td>
		</tr>
		<tr>
			<td>姓氏:<?php echo h($customer['Customer']['first_name']); ?></td>
			<td>名字:<?php echo h($customer['Customer']['family_name']); ?></td>
			<td>年龄:<?php echo h($customer['Customer']['age']); ?></td>
			
			<td>性别:<?php echo h($customer['Customer']['gender']); ?></td>
			
		</tr>
		<tr>
			<td>出生日期:<?php echo h($customer['Customer']['birthday']); ?></td>
			<td>电话号码:<?php echo h($customer['Customer']['phone_number']); ?></td>
			<td>职业:<?php echo h($customer['Customer']['profession']); ?></td>
			<td>民族:<?php echo h($customer['Customer']['nationality']); ?></td>
		</tr>
		<tr>
			<td>出生地:<?php echo h($customer['Customer']['birthplace']); ?></td>
			<td>经济状况:<?php echo h($customer['Customer']['finacial_situation']); ?></td>
			<td>宗教信仰:<?php echo h($customer['Customer']['religion']); ?></td>
			<td>爱好:<?php echo h($customer['Customer']['hobby']); ?></td>
		</tr>
		<tr>
			<td>婚姻状况:<?php echo h($customer['Customer']['marital_status']); ?></td>
			<td>健康状况:<?php echo h($customer['Customer']['health_condition']); ?></td>
			<td>QQ号码:<?php echo h($customer['Customer']['qq_number']); ?></td>
			<td>学历:<?php echo h($customer['Customer']['education']); ?></td>
		</tr>
		<tr>
			<td colSpan='4'>现在住址:<?php echo h($customer['Customer']['present_address']); ?></td>
		</tr>
		<tr>
			<td colSpan='4'><?php echo $this->Form->input('Document.title', array('label' => '标题:', 'size' => '66')); ?></td>
		</tr>
		<tr>
			<td valign='center' colSpan='4'><?php echo $this->Form->input('Document.abstract', array('label' => '摘要:', 'type' => 'textarea', 'rows' => '3', 'cols' => '66')); ?></td>
		</tr>
		<tr>
			<td colSpan='4'><?php echo $this->Form->input('Document.chief_compliant', array('label' => '主诉:', 'type' => 'textarea', 'rows' => '3', 'cols' => '66')); ?></td>
		</tr>
		<tr>
			<td colSpan='4'><?php echo $this->Form->input('Document.diagnosis', array('label' => '诊断:', 'type' => 'textarea', 'rows' => '3', 'cols' => '66')); ?></td>
		</tr>
	</table>
	<center><?php echo $this->Form->input('id', array('type' => 'hidden'));
			echo $this->Form->end(__('创建'));?></center>
	
	
	</div>
</div>





