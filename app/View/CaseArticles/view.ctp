<html>
<body>
案例信息
<center>
<table>
	<tr><td align="center"><h1><?php echo h($caseArticle['CaseArticle']['title']); ?></h1></td></tr>
	<tr><td align="center">发布时间:<?php echo h($caseArticle['CaseArticle']['created']); ?>&nbsp;&nbsp;阅读:(<?php echo h($caseArticle['CaseArticle']['count']); ?>)次</td></tr>
	<tr><td align="center"><?php $string = $caseArticle['CaseArticle']['photo']; echo "<img src='/img/uploads/$string' width='100' height='70' alt='photo' />"; ?></td></tr>
	<tr><td><?php echo h($caseArticle['CaseArticle']['body']); ?></td></tr>
</table>
</center>
</body>
</html>