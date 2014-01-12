<?php
$this->extend('common_view');

$this->start('sidebar');
  echo $this->element('sidebar_user');
$this->end();
?>
<?php $this->start('css');?>
<style>
.text{
	margin-left: 0px;
}
</style>
<?php $this->end();?>

<h3>修改个人基本信息</h3>

<?php echo $this->Form->create('UserProfile'); ?>
<table>
	<tr><td><?php echo $this->Form->input('family_name', array('type' => 'text', 'label' => '姓')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('first_name', array('type' => 'text', 'label' => '名')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('age', array('label' => '年龄')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('gender', array('label' => '性别', 'options' => array('男', '女') , 'empty' => '请选择')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('birthday', array('label' => '生日', 'dateFormat' => 'DMY', 'minYear' => date('Y') - 80, 'maxYear' => date('Y') - 15,)); ?></td></tr>
	<tr><td><?php echo $this->Form->input('birthplace', array('type' => 'text', 'label' => '出生地')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('present_address', array('type' => 'text', 'label' => '现住址')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('nationality', array('type' => 'text', 'label' => '民族')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('religion', array('type' => 'text', 'label' => '宗教')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('marital_status', array('label' => '婚恋状态', 'options' => array('单身', '恋爱中', '已婚'), 'empty' => '请选择')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('health_condition', array('label' => '健康状况', 'options' => array('非常健康', '感觉良好', '小有不适', '非常糟糕'), 'empty' => '请选择')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('education', array('label' => '学历', 'options' => array('高中毕业', '学士', '硕士', '博士'), 'empty' => '请选择')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('profession', array('type' => 'text', 'label' => '职业')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('finacial_situation', array('label' => '经济境况', 'options' => array('富裕', '小康', '温饱', '拮据'), 'empty' => '请选择')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('phone_number', array('type' => 'tel', 'label' => '电话号码')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('qq_number', array('type' => 'text', 'label' => 'qq号')); ?></td></tr>
	<tr><td><?php echo $this->Form->input('hobby', array('type' => 'textarea', 'row' => 3, 'label' => '爱好')); ?></td></tr>

	<tr><td><?php echo $this->Form->end('保存修改'); ?></td></tr>
</table>