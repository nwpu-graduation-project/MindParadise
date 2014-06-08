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


<h1>我评论的</h1>
<div id='comment-list'>
<?php
foreach($commentsOnOthers as $comment):
?>	
  <div class='comment-warpper'>
    <div class='comment-title'>

		<span class='name'><?php echo $comment['Commentor']['username']; ?></span>

		<?php if(!$comment['Comment']['parent_comment_id']): ?>
			<span>评论了</span>
			<span>
			  <?php
			    echo $this->Html->link($comment['Webcontent']['title'], '/webcontents/view/'.$comment['Webcontent']['id']);
			  ?>
			</span>
		<?php else:?>
			<span>回复了</span>
			<span>
			<?php 
        $commentedUsername = $usernameIndex['id'.$comment['ParentComment']['commentor_id']];
        echo $commentedUsername.':'; 
      ?>
			</span>
		<?php endif ?>

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

