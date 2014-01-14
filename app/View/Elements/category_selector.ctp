<?php $this->start('script'); ?>
<script>
	function onSelectID(id, pid) {
		var cidElement = document.getElementById("current-id-input");
		cidElement.value = id;
		
		var pidElement = document.getElementById("parent-id-input");
		pidElement.value = pid;
		
		selectID(id);		
	}
</script>
<?php $this->end(); ?>

<div style="width:200px; float:left; margin:0 0px 20px 0">
	<ul>
		<li>
<?php $this->requestAction('/categories/printAllCategories'); ?><br>
		</li>
		<li>
			<form action="/categories/view" method="post">
			<ul>
			<li><input type="text" name="data[Category][name]" maxlength="10" /></li>
			<li><input type="hidden" id="parent-id-input" name="data[Category][parent_id]" /></li>
			<li><input type="hidden" id="current-id-input" name="data[id]" /></li>
			<li><select name="data[type]" id="WebcontentCategory" required="required">
				<option value="0">添加同级分类</option>
				<option value="1">添加子分类</option>
			</select>
			<input type="submit" value="提交"></li>
			</ul>
			</form>
		</li>
	</ul>

</div>