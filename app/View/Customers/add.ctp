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
<center><h2>新增客户个人资料</h2></center><br>
<div class='main'>
	<div class='account'>
	<?php echo $this->Form->create('Customer'); ?>
	<table border='1' cellspacing='0'>
		<tr>
			<td width="25%"><?php echo $this->Form->input('first_name', array('label' => '姓氏:', 'size' => '6')); ?></td>
			<td width="25%"><?php echo $this->Form->input('family_name', array('label' => '名字:', 'size' => '6')); ?></td>
			<td width="25%"><?php echo $this->Form->input('age', array('label' => '年龄:', 'size' => '5')); ?></td>
			
			<td width="30%">
				<?php echo $this->Form->input('gender', array('label' => '性别:', 'type' => 'select', 'options' => array(
					'男' => '男',
					'女' => '女',

				))); ?>
				
			</td>
			
		</tr>
		<tr>
			<td><?php echo $this->Form->input('birthday', array('label' => '出生日期:', 'size' => '4')); ?></td>
			<td><?php echo $this->Form->input('phone_number', array('label' => '电话号码:', 'size' => '5')); ?></td>
			<td><?php echo $this->Form->input('profession', array('label' => '职业:', 'size' => '7')); ?></td>
			<td><?php echo $this->Form->input('nationality', array('label' => '民族:', 'size' => '7'));
				?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('birthplace', array('label' => '出生地址:', 'size' => '4')); ?></td>
			<td><?php echo $this->Form->input('finacial_situation', array('label' => '经济状况:', 'type' => 'select', 'options' => array(
					'极度贫穷' => '极度贫穷',
					'贫穷' => '贫穷',
					'温饱' => '温饱',
					'小康' => '小康',
					'富有' => '富有',
					'极度富有' => '极度富有'

			))); ?></td>
			<td><?php echo $this->Form->input('religion', array('label' => '宗教信仰:', 'type' => 'select', 'options' => array(
					'佛教' => '佛教',
					'伊斯兰教' => '伊斯兰教',
					'基督教' => '基督教'

			))); ?></td>
			<td><?php echo $this->Form->input('hobby', array('label' => '爱好:', 'size' => '7')); ?></td>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('marital_status', array('label' => '婚姻状况:', 'type' => 'select', 'options' => array(
					'单身' => '单身',
					'热恋' => '热恋',
					'已婚' => '已婚',
					'离婚' => '离婚'

				))); ?></td>
			<td><?php echo $this->Form->input('health_condition', array('label' => '健康状况:', 'type' => 'select', 'options' => array(
					'健康' => '健康',
					'亚健康' => '亚健康',
					'疾病' => '疾病'

				))); ?></td>
			<td><?php echo $this->Form->input('qq_number', array('label' => 'QQ号码:', 'size' => '5')); ?></td>
			<td><?php echo $this->Form->input('education', array('label' => '学历:', 'type' => 'select', 'options' => array(
					'初中' => '初中',
					'高中' => '高中',
					'大专' => '大专',
					'本科' => '本科',
					'研究生' => '研究生',
					'博士' => '博士'

			))); ?></td>
		</tr>
	
		<tr>
			<td width="60%" colSpan='4'><?php echo $this->Form->input('present_address', array('label' => '现在住址:', 'size' => '61')); ?></td><td width="40%"></td>
		</tr>
	</table>
	<center><?php echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->end(__('提交'));?></center>
	
	
	</div>
</div>
