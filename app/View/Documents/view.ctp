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

<center><h2>咨询诊断记录</h2></center><br>
<div class='main'>
	<div class='account'>
	
	<table width="100%" align='center' border='1' cellspacing='0'>
		<tr>
			<td width="50%" colSpan='2' align='left' cellpadding='5'>第<?php echo h($document['Document']['detail_order']); ?>次咨询</td>
			
			<td width="50%" colSpan='2'align='right' cellpadding='5'>是否公开:<?php echo h($document['Document']['f_public']); ?></td>
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
			<td colSpan='4' rowSpan='1'>现在住址:<?php echo h($customer['Customer']['present_address']); ?></td>
		</tr>
		<tr>
			<td colSpan='4' rowSpan='1'>标题:<?php echo h($document['Document']['title']); ?></td>
		</tr>
		<tr>
			<td colSpan='4'><textarea rows='2' cols='66'>摘要:<?php echo h($document['Document']['abstract']); ?></textarea></td>
		</tr>
		<tr>
			<td colSpan='4'><textarea rows='4' cols='66'>主诉:<?php echo h($document['Document']['chief_compliant']);?></textarea></td>
		</tr>
		<tr>
			<td colSpan='4'><textarea rows='4' cols='66'>诊断:<?php echo h($document['Document']['diagnosis']); ?></textarea></td>
		</tr>
		<tr>
			<td width="50%" colSpan='2' align='left' cellpadding='5'>咨询师姓名: <?php echo h($expert['Expert']['realname']); ?></td>
			
			<td width="50%" colSpan='2'align='right' cellpadding='5'>创建日期: <?php echo h($document['Document']['created']); ?></td>
		</tr>
	</table>
	
	
	
	</div>
</div>





