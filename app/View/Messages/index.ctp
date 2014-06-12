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
<div id='message-list'>
<?php
foreach($messages as $message):
  $str = null;
  switch($message['Message']['type'])
  {
    case 1: $str = '回复了你';break;
    case 2: $str = '发表了评论';break;
    case 3: $str = '向您咨询';break;
    case 4: $str = '答复了你';break;
    default:
  }
?>
<?php if($message['Message']['f_read'] == 1): ?>
  <div class='message-warpper'>
<?php else: ?>
  <div class='message-warpper unread-mark'>
<?php endif ?>
    <div class='message-title'>
    <span class='name'><?php echo $message['Message']['trigger_username']; ?></span>
    <span>'在'</span>
    <span>
      <?php
        echo $this->Html->link($message['Message']['link_title'], '/messages/view/'.$message['Message']['id']);
        echo $str;
      ?>
    </span>
    </div>
    <div class='message-content'>
    <?php
    	echo $message['Message']['abstract'];
    ?>
    </div>
  </div>
<?php
endforeach
?>
</div>


<ul class='paginate_nav'>
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
</ul>
