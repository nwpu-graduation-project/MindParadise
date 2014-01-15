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

<h2>案例显示</h2><br>
<div class='main'>
	<div class='account'>
	
	<table align='center'>
		<tr>
			<td width="25%">第<?php echo h($document['Document']['detail_order']); ?>次咨询</td>
			<td width="25%"></td>
			<td width="25%"></td>
			<td width="50%">是否公开:<?php echo h($document['Document']['f_public']); ?></td>
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
	</table>
	<table>
		<tr>
			<td>现在住址:<?php echo h($customer['Customer']['present_address']); ?></td>
		</tr>
		<tr>
			<td>标题:<?php echo h($document['Document']['title']); ?></td>
		</tr>
		<tr>
			<td>摘要:<?php echo h($document['Document']['abstract']); ?></td>
		</tr>
		<tr>
			<td>主诉:<?php echo h($document['Document']['chief_compliant']); ?></td>
		</tr>
		<tr>
			<td>诊断:<?php echo h($document['Document']['diagnosis']); ?></td>
		</tr>
	</table>
	
	
	
	</div>
</div>





