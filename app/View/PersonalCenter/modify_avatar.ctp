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

<?php $this->start('css'); ?>
<style type="text/css">
.container { ; margin:0px auto; }
.section { background-color:#fff; padding:20px;}
.row{ width:661px; overflow:hidden; margin-top:20px;line-height:30px;padding-left:94px;}
.row span.label{float:left;position:relative;line-height:30px;margin-left:-94px;width:84px;text-align:right; color:#5b5b5b;}
.btn_submit {background:url(/upload/images/submit.gif) no-repeat;width:70px;height:29px;border:0;}
</style>
<?php $this->end(); ?>


<div class="container">
	<h3>上传头像</h3>
	<div class="section">
		<div class="row" id="avatar_msg" style="font-weight:700;color:#f00;display:none;">上传成功！</div>
		<div class="row">
			<label><span class="label">当前头像：</span></label>
			<img id="avatar" src=<?php echo $avatar ?> />
		</div>
		<div class="row">
			<label><span class="label">上传图片：</span></label>
			<input type="text" id="avatarUpload" value="" />
			<input type="hidden" id="img" name="img" />
			<input type="hidden" id="x" name="x" />
			<input type="hidden" id="y" name="y" />
			<input type="hidden" id="w" name="w" />
			<input type="hidden" id="h" name="h" />
			<div id="upload_controller" style="padding-top:-10px;display: none;">
				<a href="javascript:$('#avatarUpload').uploadify('upload','*')">开始上传</a> |
				<a href="javascript:$('#avatarUpload').uploadify('cancel', '*')">取消上传</a>
			</div>
		</div>
		<div class="row imgchoose" style="display:none;">编辑头像：<br /><img src="" id="target" /></div>
		<div class="row imgchoose" style="display:none;">
			头像预览：<br />
			<div style="width:200px;height:200px;margin:10px 10px 10px 0;overflow:hidden; float:left;"><img class="preview" id="preview3" src="" /></div>
			<div style="width:130px;height:130px;margin:80px 0 10px;overflow:hidden; float:left;"><img class="preview" id="preview2" src="" /></div>
			<div style="width:112px;height:112px;margin:98px 0 10px 10px;overflow:hidden; float:left;"><img class="preview" id="preview" src="" /></div>
		</div>
		<div class="row">
			<input type="button" class="btn_submit" value="" id="avatar_submit" style="display:none;" />
		</div>
	</div>
</div>


<script src="/upload/js/jquery.js"></script>
<link href="/upload/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/upload/uploadify/jquery.uploadify-3.1.js"></script>
<script type="text/javascript" src="/upload/jcrop/jquery.Jcrop.min.js"></script>
<link rel="stylesheet" href="/upload/jcrop/jquery.Jcrop.css" type="text/css" />
<script type="text/javascript">
$(function() {

	var jcrop_api, boundx, boundy;

	//首页轮播图1
	$("#avatarUpload").uploadify({
		'auto'				: false,
		'multi'				: false,
		'queueSizeLimit' 	: 1,
		'buttonText'		: '请选择图片',
		'height'			: 20,
		'width'				: 120,
		'removeCompleted'	: true,
		'removeTimeout'		: 0,
		'swf'				: '/upload/uploadify/uploadify.swf',
		'uploader'			: <?php echo "'/personalCenter/modifyAvatar/".$user_id."/upload'" ?>,
		'fileTypeExts'		: '*.gif; *.jpg; *.jpeg; *.png;',
		'fileSizeLimit'		: '1024KB',
		'onUploadSuccess' : function(file, data, response) {
			
			if(jcrop_api !== undefined)
				jcrop_api.destroy();
			var msg = $.parseJSON(data);
			if( msg.result_code == 1 ){
				$("#img").val( msg.result_des );
				$("#target").attr("src",msg.result_des);
				$(".preview").attr("src",msg.result_des);
				$('#target').Jcrop({
					minSize: [50,50],
					setSelect: [0,0,200,200],
					onChange: updatePreview,
					onSelect: updatePreview,
					onSelect: updateCoords,
					aspectRatio: 1
				},
				function(){
					// Use the API to get the real image size
					var bounds = this.getBounds();
					boundx = bounds[0];
					boundy = bounds[1];
					// Store the API in the jcrop_api variable
					jcrop_api = this;
				});

				$(".imgchoose").show(1000);
				$("#avatar_submit").show(1000);
				
			} else {
				alert('上传失败');
			}
		},
		'onClearQueue' : function(queueItemCount) {
            //alert( $('#img1') );
            //$("#upload_controller").hide();
        },
		'onCancel' : function(file) {
            //alert('The file ' + file.name + ' was cancelled.');
            $("#upload_controller").hide();
        },
        'onSelect' : function(file)
        {
        	$("#upload_controller").show();
        },
        'onQueueComplete' : function(queueData) {
            //alert(queueData.uploadsSuccessful + ' 个文件上传成功.');
            $("#upload_controller").hide();
        }
    });
    
    //头像裁剪
	
	function updateCoords(c)
	{
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
	};
	function checkCoords()
	{
		if (parseInt($('#w').val())) return true;
		alert('请选择图片上合适的区域');
		return false;
	};
	function updatePreview(c){
		if (parseInt(c.w) > 0){
			var rx = 112 / c.w;
			var ry = 112 / c.h;
			$('#preview').css({
				width: Math.round(rx * boundx) + 'px',
            	height: Math.round(ry * boundy) + 'px',
            	marginLeft: '-' + Math.round(rx * c.x) + 'px',
            	marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		}
		{
			var rx = 130 / c.w;
			var ry = 130 / c.h;
			$('#preview2').css({
            	width: Math.round(rx * boundx) + 'px',
            	height: Math.round(ry * boundy) + 'px',
            	marginLeft: '-' + Math.round(rx * c.x) + 'px',
            	marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		}
		{
			var rx = 200 / c.w;
			var ry = 200 / c.h;
			$('#preview3').css({
				width: Math.round(rx * boundx) + 'px',
				height: Math.round(ry * boundy) + 'px',
				marginLeft: '-' + Math.round(rx * c.x) + 'px',
				marginTop: '-' + Math.round(ry * c.y) + 'px'
			});
		}
	};
	
	$("#avatar_submit").click(function(){
		var img = $("#img").val();
		var x = $("#x").val();
		var y = $("#y").val();
		var w = $("#w").val();
		var h = $("#h").val();
		if( checkCoords() ){
			$.ajax({
				type: "POST",
				url: <?php echo "'/personalCenter/modifyAvatar/".$user_id."/cut'" ?>,
				data: {"img":img,"x":x,"y":y,"w":w,"h":h},
				dataType: "json",
				success: function(msg){
					if( msg.result_code == 1 ){
						$('html,body').animate({scrollTop:$('#avatar').offset().top-150},1000,'swing',function(){
							$('#avatar_msg').show();
							$('#avatar').attr('src',msg.result_des.small);
						});
					} else {
						alert("重试一次！或者换张图片试试");
					}
				}
			});
		}
	});
});
</script>


