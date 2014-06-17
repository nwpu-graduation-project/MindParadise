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

<h1>文章管理</h1>
<h1>
    <?php
    echo $this->Html->link('新增文章', array('controller' => 'caseArticles', 'action' => 'add'));
    ?>
</h1>
<br>
<table>
    <tr>
        <th>文章ID</th>
        <th>标题</th>
        <th>访问次数</th>
        <th>创建时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($caseArticles as $caseArticle): ?>
    <tr>
        <td><?php echo $caseArticle['CaseArticle']['id']; ?></td>
        <td><?php echo $this->Html->link($caseArticle['CaseArticle']['title'],
                array('controller' => 'caseArticles', 'action' => 'view', $caseArticle['CaseArticle']['id'])); ?>
        </td>
        <td><?php echo $caseArticle['CaseArticle']['count']; ?></td>
        <td><?php $date=$caseArticle['CaseArticle']['created'];
            $formatDate = substr($date, 0,10);
            echo $formatDate; ?></td>
        <td>
        <?php
        echo $this->Html->link('修改', array('action' => 'edit', $caseArticle['CaseArticle']['id']));
        echo '&nbsp&nbsp&nbsp&nbsp';
        echo $this->Form->postLink('删除',
            array('action' => 'delete', $caseArticle['CaseArticle']['id']), array('confirm' => '你确定要删除吗?'));
        echo '&nbsp&nbsp&nbsp&nbsp';
        echo $this->Form->postLink('查看',
            array('action' => 'view', $caseArticle['CaseArticle']['id']));
        echo '&nbsp&nbsp&nbsp&nbsp';
        echo $this->Form->postLink('删除评论',
            array('action' => 'deleteComment', $caseArticle['CaseArticle']['id']), array('confirm' => '你确定要删除该文章下的评论吗?'));
        echo '&nbsp&nbsp&nbsp&nbsp';
        ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($caseArticle);?>
    
</table>
<div id="page_navigation">
    <div class="center_frame">
        <ul class="blog_page_nav">
<?php
echo $this->Paginator->prev(
  __('上', true),
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
        'currentTag' => 'a')
    );
?>

<?php
echo $this->Paginator->next(
  __('下', true),
  array(
    'tag' => 'li',
    'class' => 'page_next',
  )
);
?>
        </ul>
    </div>
</div>
