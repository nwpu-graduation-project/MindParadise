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


<h1>评论我的</h1>
<div id='comment-list'>
<?php
foreach($commentsOnSelfContents as $comment):
?>	
  <div class='comment-warpper'>
    <div class='comment-title'>
		<span class='name'><?php echo $comment['Commentor']['username']; ?></span>
		<span>评论了</span>
		<span>
		  <?php
		    echo $this->Html->link($comment['Webcontent']['title'], '/webcontents/view/'.$comment['Webcontent']['id']);
		  ?>
		</span>
    </div>

    <div class='comment-content'>
    <?php
    	echo $this->Html->link($comment['Comment']['content'], '/webcontents/view/'.$comment['Webcontent']['id'].'#'.$comment['Webcontent']['id'].'_'.$comment['Comment']['id']);
    ?>
    </div>
  </div>
<?php
endforeach
?>
</div>


<ul class="paginate_nav">
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
