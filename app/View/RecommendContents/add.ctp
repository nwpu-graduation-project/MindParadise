<?php 
$this->extend('/PersonalCenter/common_view');

$this->start('sidebar');
	echo $this->element("sidebar_admin");
$this->end();
$this->start('script');
?>
<script>
document.onreadystatechange=function() { 
	if(document.readyState == 'complete'){ 

		document.getElementById("RecommendContentPicture").onchange=function(){
		  var x = document.getElementById("RecommendContentPicture");
		  if(!x || !x.value) return;
		  var patn = /\.jpg$|\.jpeg$|\.gif$|\.png$/i;
		  if(patn.test(x.value)){
		    var y = document.getElementById("imghead");
		    if(y){
		      previewImage(x);
		    }else{
		      var img=document.createElement('img');
		      img.setAttribute('width','120');
		      img.setAttribute('height','90');
		      img.setAttribute('id','imghead');
		      document.getElementById('preview').appendChild(img);
		      previewImage(x);
		    }
		  }else{
		    alert("您选择的似乎不是图像文件。");
		  }
		};
	} 
}; 


function previewImage(file)  
{  
  var MAXWIDTH  = 100;  
  var MAXHEIGHT = 100;  
  var div = document.getElementById('preview');  
  if (file.files && file.files[0])  
  {  
    div.innerHTML = '<img id=imghead>';  
    var img = document.getElementById('imghead');  
    img.onload = function(){  
      var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);  
      img.width = rect.width;  
      img.height = rect.height;  
      img.style.marginLeft = rect.left+'px';  
      img.style.marginTop = rect.top+'px';  
    }  
    var reader = new FileReader();  
    reader.onload = function(evt){img.src = evt.target.result;}  
    reader.readAsDataURL(file.files[0]);  
  }  
  else  
  {  
    var sFilter='filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';  
    file.select();  
    var src = document.selection.createRange().text;  
    div.innerHTML = '<img id=imghead>';  
    var img = document.getElementById('imghead');  
    img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;  
    var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);  
    status =('rect:'+rect.top+','+rect.left+','+rect.width+','+rect.height);  
    div.innerHTML = "<div id=divhead style='width:"+rect.width+"px;height:"+rect.height+"px;margin-top:"+rect.top+"px;margin-left:"+rect.left+"px;"+sFilter+src+"\"'></div>";  
  }  
}  
function clacImgZoomParam( maxWidth, maxHeight, width, height ){  
    var param = {top:0, left:0, width:width, height:height};  
    if( width>maxWidth || height>maxHeight )  
    {  
        rateWidth = width / maxWidth;  
        rateHeight = height / maxHeight;  
          
        if( rateWidth > rateHeight )  
        {  
            param.width =  maxWidth;  
            param.height = Math.round(height / rateWidth);  
        }else  
        {  
            param.width = Math.round(width / rateHeight);  
            param.height = maxHeight;  
        }  
    }  
      
    param.left = Math.round((maxWidth - param.width) / 2);  
    param.top = Math.round((maxHeight - param.height) / 2);  
    return param;  
} 
</script>
<?php $this->end('script'); ?>
<h3>添加推荐</h3>
<?php
echo $this->Form->create('RecommendContent', array('type' => 'file'));
echo $this->Form->input('RecommendContent.title', array('label' => '推荐标题'));
echo $this->Form->input('RecommendContent.abstract', array('rows' => '3', 'label' => '推荐简述'));
echo $this->Form->input('RecommendContent.url', array('label' => '链接地址'));
echo $this->Form->file('RecommendContent.picture', array('label' => '图片描述'));
echo $this->Form->end('保存');
?>
<div id='preview'>
</div>

