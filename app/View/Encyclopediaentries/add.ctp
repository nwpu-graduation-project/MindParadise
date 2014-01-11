<?php
$this->start('css');
echo $this->Html->css('treeview');
?>
<link rel="stylesheet" type="text/css" href="/ueditor/themes/default/css/ueditor.min.css">
<style type="text/css">
	.edui-container {
		border: none;
		box-shadow: none;
	}
	.fixTop{
		position: fixed;
    	top: -1px;
	}
</style>
<?php
$this->end();

$this->start('script');
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
	function traversal(section, level) {
		var $list, $item, $itemContent, child, childList;
		if (section.children.length) {
			if (level == 0) {
				// $list = $('<ul class="anyClass skinClear harmonica">');
				$list = $('<ul class="anyClass skinPlank">');
			} else {
				$list = $('<ul style="display: block;">');
			}
		
			for (var i = 0; i < section.children.length; i++) {
				child = section.children[i];
				//设置目录节点内容标签
				var title = getSubStr(child['title'], 18);
				if(level == 0) {
					$itemContent = $('<a class="harFull" style="cursor:pointer; width: 185px">' + title + '</a>');
				} else {
					$itemContent = $('<a class="harFull" style="cursor:pointer">' + title + '</a>');
				}
				$itemContent.attr('data-address', child['startAddress'].join(','));
				//设置目录节点容器标签
				$item = $('<li>');
				$item.append($itemContent);
				//继续遍历子节点
				if ($item.children.length) {
					var next = level + 1;
					childList = traversal(child, next);
					childList && $item.append(childList);
				}
				$list.append($item);
			}
		}
		return $list;
	}

	function getSubStr(s, l) {
		var i = 0, len = 0;
		for (i; i < s.length; i++) {
			if (s.charAt(i).match(/[^\x00-\xff]/g) != null) {
				len += 2;
			} else {
				len++;
			}
			if (len > l) {
				break;
			}
		}
		return s.substr(0, i);
	}
	
	function genIndex () {
		var divNode = document.getElementById("pageEditor")
		var headings = ["h1", "h2", "h3", "h4", "h5", "h6"];
		for(index=0;index<headings.length;index++) {
			
			var headingNodes = UE.dom.domUtils.getElementsByTagName(divNode, headings[index]);
			alert(headingNodes.length);
			for(i=0; i<headingNodes.length; i++) {
				headingNodes[i].id = 'heading_'+ headings[index]+'_'+i;
				alert(headingNodes[i].id);
			}
		}
	}
	
	function selectID(id) {
		var element = document.getElementById("selectedCategoryId");
		element.value = id;
		
		var nameInput = document.getElementById("categoryName");
		nameInput.value = document.getElementById("category_"+id).textContent;
	}
	
	function onSubmit() {
		// set plain text for searching
		var element = document.getElementById("plainText");
		element.value = ue.getContentTxt();
		
		// set page index
		var dir = ue.execCommand('getsections');
		$('#directionContainer').html(traversal(dir, 0) || null);
		var directionContainer = document.getElementById("directionContainer");
		var pageIndex = document.getElementById("pageIndex");
		pageIndex.value = directionContainer.innerHTML;
		
		return true;
	}
	
	function hehe() {
	}
</script>
<?php
echo $this->Html->script('treeview');
$this->end();
?>

<div id="main" style="float: none">
	
	<div id="left" style="float: left">
	<?php echo $this->element('category_selector'); ?>
	</div>
	<div id="directionContainer" style="display: none"></div>
	
	<form action="/encyclopediaentries/add" id="entryAddForm" method="post"
		accept-charset="utf-8" onsubmit="return onSubmit()">
	

	<div id="editorContainer" name="editorContainerDiv" style="width: 70%;float: left">
		<!-- entry name -->
		<input type="text" name="data[EncyclopediaEntry][entry]" maxlength="10" placeholder="词条名" style="font-size: 36px"/>
		
		<!-- category id and name -->
		<label for="categoryName">分类</label>
		<input type="text" id="categoryName" disabled="disabled" style="font-size: 24px"/>
		<input type="hidden" id="selectedCategoryId" name="data[EncyclopediaEntry][category_id]" />
		
		<!-- index -->
		<input type="hidden" id="pageIndex" name="data[pageIndex]" />
		
		<!-- editor and plain text-->
		<div>
		<script type="text/plain" id="pageEditor" name="data[entryPage]" style="width:100%; height:900px;">
<p></p><h1>hehe</h1><p>afdsaffsdfsadfdaafdsaffafdafdsfdsafsdaf<br/></p><h2>afsdddddddddd</h2><p>dafdsafdsafdsaf<br/></p><h2>ffdafffffdsafdsafsafdsafd</h2><p>dafdfdsafdsafdsfdasfdsfdsf<br/></p><h3>fdsafdafdaf</h3><p></p>
		</script>
		</div>
		<input type="hidden" id="plainText" name="data[plainText]" />
		
		<script type="text/javascript">
			var ue = UE.getEditor('pageEditor');
		</script>

		<input type="button" onclick="hehe()" value="hehe">
		<input type="submit" value="提交">
	</div>
	
	</form>

</div>
