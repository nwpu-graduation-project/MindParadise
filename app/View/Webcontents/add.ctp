<div id="artical_editor" class="center_frame" style="width: 1100px">

<?php
$this->start('css');
echo '<link rel="stylesheet" type="text/css" href="/ueditor/themes/default/css/ueditor.min.css">';
$this->end();

$this->start('script');
echo '<script src="/js/jquery.min.ueditor.js"></script>';
echo '<script src="/ueditor/ueditor.config.js"></script>';
echo '<script src="/ueditor/ueditor.all.js"></script>';
?>
<script type="text/javascript">
	function append() {
		var newNode = document.createElement("li");
		newNode.setAttribute("onclick", "remove(this)");

		var input = document.getElementById("add_tag");
		var str = input.value;
		newNode.innerHTML = "<a><span>" + str + "</span></a>";

		var oldNode = document.getElementById("plpular_tags_icon");
		oldNode.appendChild(newNode);

		// var tag_names = document.getElementById("hidden_tag_names");
		// tag_names.value += (input.value + " ");
		input.value = "";
	}

	function remove(obj) {
		obj.parentNode.removeChild(obj)
	}
	
	function onSubmit() {
		
		// set plain text
		var element = document.getElementById("hidden_plain_text");
		element.value = um.getContentTxt();
		
		// set seleted tag names
		var ulTag = document.getElementById("plpular_tags_icon");
		var liTags = ulTag.childNodes;
		var i=0;
		var str = "";
		for(i=0;i<liTags.length;i++) {
			str += liTags[i].textContent;
			if(i< (liTags.length -1) ) {
				str += "`";
			}
		}
		var hidden_tag_names = document.getElementById("hidden_tag_names");
		hidden_tag_names.value = str;
		return true;
	}
</script>
<?php
$this->end();

echo $this->Form->create('Webcontent', array('onsubmit' => 'onSubmit()'));
echo $this->Form->input('title',array('label' => '标题', 'div' => array('class' => 'input_1')));
echo $this->Form->input('abstract',array('label' => '导读','placeholder'=>'导读','rows' => '3'));
echo $this->Form->label('Webcontent.category','分类','required');
echo $this->Form->select('category', $categories);
?>

<div>
	<label for="tagSelector" class="required">标签</label>
	<input type="text" id="add_tag"  maxlength="7" size="10"/>
	<input type="button" onclick="append()" value="+" />
	<ul id="plpular_tags_icon" style="width: 100%"></ul>
    <input id="hidden_tag_names" name="data[selectedTagNames]" type="hidden" />
    <input id="hidden_plain_text" name="data[plainText]" type="hidden" />
</div>
<div id="editorContainer" name="editorContainerDiv">
	<label for="contentEditor" class="required">正文</label>
	<script type="text/plain" id="contentEditor" name="data[webcontentPage]" style="width:100%; height:300px;">
	</script>
</div>
<script type="text/javascript">var um = UE.getEditor("contentEditor");</script>

<?php
echo $this->Form->end('提交');
?>

</div>