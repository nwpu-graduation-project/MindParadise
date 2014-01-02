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


<h1>消息列表</h1>

<?php
foreach($messages as $message)
{
	echo $message['Message']['type'];
	echo $message['Message']['abstract'];
	echo $message['Message']['link_route'];
}
?>


<?php
echo $this->Paginator->prev(
  '上一页',
  array(
  	// 'escape' => FALSE,
  	'tag' => 'li',
  	'class' => 'page_prev',
  ),
  '上一页',
  array(
  	'tag' => 'li',
  	'class' => 'page_prev',
  )
);
?>
			
<?php
echo $this->Paginator->numbers(array(
		'separator' => NULL,
		'tag' => 'li',
		'class' => 'page_number',
		'currentClass' => 'current',
		'currentTag' => 'a'
		)
	);
?>

<?php
echo $this->Paginator->next(
  '下一页',
  array(
  	// 'escape' => FALSE,
  	'tag' => 'li',
  	'class' => 'page_next',
  ),
  '下一页',
  array(
  	'tag' => 'li',
  	'class' => 'page_next',
  )
);
?>
