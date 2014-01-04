<?php
$this->start('css');
echo $this->Html->css('treeview');
$this->end();

$this->start('script');
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
echo $this->Html->script('treeview');
$this->end();
?>

<div style="width:200px; float:left; margin:0 0px 20px 0">
	<ul>
		<li>
<?php $this->requestAction('/categories/printAllCategories'); ?><br>
		</li>
		<li>
			<form action="/categories/view" method="post">
			<ul>
			<li><input type="text" name="data[name]" maxlength="10"/></li>
			<li><input type="hidden" name="data[parent_id]" /></li>
			<li><select name="data[type]" id="WebcontentCategory" required="required">
				<option value="1">添加同级分类</option>
				<option value="2">添加子分类</option>
			</select>
			<input type="submit" value="提交"></li>
			</ul>
			</form>
		</li>
	</ul>

</div>
<hr>