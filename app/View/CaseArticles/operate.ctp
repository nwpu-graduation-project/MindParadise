<h1>案例管理</h1>
<h1>
    <?php
    echo $this->Html->link('新增案例', array('controller' => 'caseArticles', 'action' => 'add'));
    ?>
</h1>
<br>
<table>
    <tr>
        <th>案例ID</th>
        <th>标题</th>
        <th>访问次数</th>
        <th>创建时间</th>
        <th>修改时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($caseArticles as $caseArticle): ?>
    <tr>
        <td><?php echo $caseArticle['CaseArticle']['id']; ?></td>
        <td><?php echo $this->Html->link($caseArticle['CaseArticle']['title'],
                array('controller' => 'caseArticles', 'action' => 'view', $caseArticle['CaseArticle']['id'])); ?>
        </td>
        <td><?php echo $caseArticle['CaseArticle']['count']; ?></td>
        <td><?php echo $caseArticle['CaseArticle']['created']; ?></td>
        <td><?php echo $caseArticle['CaseArticle']['modified']; ?></td>
        <td>
        <?php
        echo $this->Html->link('修改', array('action' => 'edit', $caseArticle['CaseArticle']['id']));
        echo '&nbsp&nbsp&nbsp&nbsp';
        echo $this->Form->postLink('删除',
            array('action' => 'delete', $caseArticle['CaseArticle']['id']), array('confirm' => '你确定要删除吗?'));
        echo '&nbsp&nbsp&nbsp&nbsp';
        echo $this->Form->postLink('查看',
            array('action' => 'view', $caseArticle['CaseArticle']['id']));
        ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($caseArticle);?>
    
</table>

