<html>
<body>
<center>
<h1>案例列表</h1>
    <?php foreach ($caseArticles as $caseArticle): ?>
    <table width="50%">
    <tr>
        <td width="40%" align="left"><?php echo $this->Html->link($caseArticle['CaseArticle']['title'],
                array('controller' => 'caseArticles', 'action' => 'view', $caseArticle['CaseArticle']['id'])); ?>
        </td>
        <td></td>
        <td width="40%" align="right"><?php echo $caseArticle['CaseArticle']['created']; ?></td>
    </tr>
    <tr><hr width="50%"></tr>
    </table>
    <?php endforeach; ?>
    <?php unset($caseArticle);?>
    <hr width="50%">
</center>
</body>
</html>
