
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
	width: 100%;
}
</style>
<?php $this->end();?>

<div class='main'>
	<div class='account'>
	
	<?php echo $this->Form->create('Document'); ?>
	<table>
		
		<tr>
			<td><?php echo $this->Form->input('first_name', array('label' => '姓', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('family_name', array('label' => '名', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('age', array('label' => '年龄', 'size' => '2')); ?></td>
			
			<td width="40%">
				<?php echo $this->Form->input('gender', array('label' => '性别', 'size' => '2')); ?>
				
			</td>
			
		</tr>
		<tr>
			<td><?php echo $this->Form->input('birthday', array('label' => '出生日期', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('phone_number', array('label' => '电话号码', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('profession', array('label' => '职业', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('nationality', array('label' => '民族', 'size' => '2'));
				?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('birthplace', array('label' => '出生地址', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('finacial_situation', array('label' => '经济状况', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('religion', array('label' => '宗教信仰', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('hobby', array('label' => '爱好', 'size' => '2')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('marital_status', array('label' => '婚姻状况', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('health_condition', array('label' => '健康状况', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('qq_number', array('label' => 'QQ号码', 'size' => '2')); ?></td>
			<td><?php echo $this->Form->input('education', array('label' => '学历', 'size' => '2')); ?></td>
		</tr>
	</table>
	<table>
		<tr>
			<td><?php echo $this->Form->input('present_address', array('label' => '现在住址', 'size' => '10')); ?></td>
		</tr>
		
		<tr align='right'>
			<td><?php echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->end(__('提交'));?></td>
		</tr>
	</table>
	
	
	
	</div>
</div>

