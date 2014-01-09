<?php
$this->start('css');
echo '<link rel="stylesheet" type="text/css" href="/ueditor_mini/themes/default/css/umeditor.min.css">';
?>
<style type="text/css">
	/* .edui-container {
		border: none;
		box-shadow: none;
	}*/

        #directionContainer ul{
            margin:0px;
            padding: 0px 0px 0px 20px;
        }
        .main{
            width:1024px;
        }
        .left{
            width:250px;
            height: 50px;
            float:left;
            margin-right:4px;
        }
        .right{
            width:730px;
            float:left;
        }
        #directionWrapper{
            padding:15px 7px;
            width:234px;
            border:1px solid #CCC;
        }
        .directionTitle{
            font-weight: bold;
            font-size: 14px;
            padding-bottom:3px;
            border-bottom: 1px dashed #ccc;
        }
        .sectionItem{
            height:20px;
            padding: 4px;
        }
        .sectionItem span{
            *zoom:1;
            display:inline-block;
        }
        .itemTitle{
            _float:left;
        }
        .selectIcon,.deleteIcon,.moveUp,.moveDown{
            float:right;
            color:red;
            font-size:0px;
            line-height: 20px;
            height:20px;
            text-align: center;
            cursor: pointer;
        }
        .selectIcon,.moveUp,.moveDown{
            width:14px;
            font-size:10px;
        }
        .selectIcon:hover,.moveUp:hover,.moveDown:hover{
            text-decoration: underline;
        }
        .deleteIcon{
            width:20px;
            margin-left:3px;
            background: url(../themes/default/images/icons-all.gif) 0 -89px;
        }
        .fixTop{
            position: fixed;
            top: -1px;
        }
    </style>
<?php
$this->end();

$this->start('script');
echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>';
echo '<script src="/ueditor_mini/umeditor.config.js"></script>';
echo '<script src="/ueditor_mini/umeditor.min.js"></script>';
$this->end();
?>

<div class="main">
    <h1>目录大纲demo</h1>
    <div class="left">
        <div id="directionWrapper">
            <div class="directionTitle">目录：</div>
            <div id="directionContainer"></div>
        </div>
    </div>
    <div class="right">
        <script id="editor" type="text/plain" style="width:730px;height:500px;">
<p style="text-indent: 2em;"><strong>UMditor</strong>是由百度WEB前端研发部开发的所见即所得的开源富文本编辑器，具有轻量、可定制、用户体验优秀等特点。开源基于BSD协议，所有源代码在协议允许范围内可自由修改和使用。百度UMditor的推出，可以帮助不少网站开者在开发富文本编辑器所遇到的难题，节约开发者因开发富文本编辑器所需要的大量时间，有效降低了企业的开发成本。</p><h2>特点 </h2><p>UMditor在设计上采用了经典的分层架构设计理念，尽量做到功能层次之间的轻度耦合。具体来讲，整个系统分为了核心层、命令插件层和UI层这样三个低耦合的层次。</p><h2 index="3"> 应用领域 </h2> <h3 index="3_1"> 百度产品线 </h3><p>百度百科、百度空间、百度经验、百度旅游、百度知道、百度贴吧、百度新知</p><h3 index="3_2"> 其他公司产品 </h3><p>麦库记事、网易lofter</p><h2 index="4"> 更新记录 </h2> <h3 index="4_3"> 1.2.6.1版本 </h3> <h4> 新增功能 </h4> <ul class=" list-paddingleft-2" style="list-style-type: disc;"> <li> <p>查找替换支持正则表达式</p></li><li><p>增加类似word中的快捷菜单，默认关闭</p></li><li><p>针对默认过滤回转换div为p标签，提供了配置开关allowDivTransToP,默认为true</p></li><li><p>工具栏支持指定位置折行，&#39;|&#39;表示分割符,&#39;||&#39;表示折行</p></li> </ul> <h4> 优化修复 </h4> <ul class=" list-paddingleft-2" style="list-style-type: disc;"> <li> <p>修复了ie67下初始化宽高给定百分比</p></li><li><p>修复了在ie下删除分割线后光标定位的问题</p></li><li><p>提供了手动加载语言文件，避免ie下有时会因语言文件加载失败导致编辑器加载失败,提示&quot;not import language file&quot;的错误</p></li><li><p>优化了编辑器初始化时获得contentWindow可能不存在的情况</p></li><li><p>优化了编辑器加载自定义样式的问题，默认initialStyle传入的css样式优先级最高，其次是指定的外部css文件</p></li><li><p>表格操作功能升级，优化了对表格的拖拉及双击操作，并且支持IE6+浏览器</p></li><li><p>修复编辑器在禁用状态下仍然可以拖动表格边框的bug</p></li><li><p>修复了分割线不能删除的问题</p></li><li><p>修复了初始化内容过多时，编辑器不自动长高，要点击编辑器才会长高的问题</p></li><li><p>优化了添加字符边框的展示效果，避免出现重叠的问题</p></li><li><p>修复下拉菜单超出屏幕的bug</p></li><li><p>修复table属性初始化时table布局错误的bug</p></li><li><p>优化了选择工具栏上下拉菜单类型的操作命令时，选区会有闪动的问题</p></li><li><p>优化了关于swfupload的一个xss漏洞</p></li><li><p>优化了对于ie9,10的支持</p></li> </ul> <h3 index="4_5"> 1.2.5版本 </h3> <h4> 新增功能 </h4> <ul class=" list-paddingleft-2" style="list-style-type: disc;"> <li><p>table整体重构</p></li><li><p> table支持插入表头和标题</p></li><li><p> table支持拷贝</p></li><li><p> table支持任意调整宽高</p></li><li><p> ...</p></li> </ul> <h3 index="4_6"> 1.2.4版本 </h3> <h4> 新增功能 </h4> <ul class=" list-paddingleft-2" style="list-style-type: disc;"> <li><p>官网新增API文档</p></li><li><p> CSS按照UI结构进行了模块化拆分</p></li><li><p> 新增皮肤切换功能，并提供一套新皮肤（可通过配置项theme来设置）</p></li><li><p> ...</p></li> </ul> <h2 index="5"> 正式版 </h2> <h3 index="5_11"> 新增功能 </h3> <ul class=" list-paddingleft-2" style="list-style-type: disc;"> <li> <p>新增了编辑器路径的设置，可以不用手动设置路径，自动识别相关路径，解决路径设置繁琐的问题</p></li><li><p>重写了过滤粘贴机制，采用黑白名单，可以书写符合自己需求的过滤规则，可以完全定义标签的属性，甚至是style上的某个属性及其数值</p></li><li><p>数据同步改为失去焦点就执行，可以不再使用sync方法手动同步数据</p></li><li><p>改使用closure的压缩工具</p></li><li><p>表格支持排序和隔行显示</p></li><li><p>优化了undo/redo操作</p></li><li><p>优化了ui界面</p></li><li><p>添加了字体边框</p></li> </ul> <h3 index="5_12"> 优化修复 </h3> <ul class=" list-paddingleft-2" style="list-style-type: disc;"> <li> <p>优化了拖拽机制，处理浮动图片拖拽不能跟指定的某行对齐</p></li><li><p>优化了backspace/del键的操作</p></li><li><p>重写了插入代码功能，插入代码编写支持tab和回车键</p></li><li><p>列表粘贴优化，模仿word的列表粘贴</p></li><li><p>修复jsp后台8080端口,截屏插件返回错误的问题</p></li><li><p>修复firefox下编辑状态切换的问题</p></li><li><p>修复查找替换报错</p></li><li><p>修复表格新增行后宽度丢失问题</p></li><li><p>修复表格底纹和表格排序多语言配置遗漏</p></li><li><p>解决右键，粘贴，对话框内容报错</p></li><li><p>修复设置单元格颜色问题</p></li><li><p>优化大字号下的显示问题</p></li><li><p>解决IE下表格粘贴失效问题</p></li><li><p>修复选中内容设置成代码，出现多余字符的问题</p></li><li><p>修复从word粘贴内容到编辑器，过滤失效的问题</p></li><li><p>修复光标闭合，多次点击字符边框按钮，会出现多余的字符“font”的问题</p></li><li><p>修复字符边框效果错误的问题</p></li> <li><p>以及其他的一些问题.</p></li> </ul><p><br/></p>
        </script>
    </div>
</div>

<script type="text/javascript">
    //实例化编辑器
    var ue = UM.getEditor('editor');

        var dirmap = {}, dir = ue.execCommand('getsections');
	alert('geee');	
		traversal(dir);
        
        function traversal(section) {
            var $list, $item, $itemContent, child, childList;
            if(section.children.length) {
                $list = $('<ul>');
                for(var i = 0; i< section.children.length; i++) {
                    child = section.children[i];
                    //设置目录节点内容标签
                    var title = getSubStr(child['title'], 18);
                    $itemContent = $('<div class="sectionItem"></div>').html($('<span class="itemTitle">' + title + '</span>'));
                    $itemContent.attr('data-address', child['startAddress'].join(','));
                    $itemContent.append($('<span class="deleteIcon">删</span>' +
                            '<span class="selectIcon">选</span>' +
                            '<span class="moveUp">↑</span>' +
                            '<span class="moveDown">↓</span>'));
                    dirmap[child['startAddress'].join(',')] = child;
                    //设置目录节点容器标签
                    $item = $('<li>');
                    $item.append($itemContent);
                    //继续遍历子节点
                    if($item.children.length) {
                        childList = traversal(child);
                        childList && $item.append(childList);
                    }
                    $list.append($item);
                }
            }
            return $list;
        }


    function getSubStr(s,l){
        var i=0,len=0;
        for(i;i<s.length;i++){
            if(s.charAt(i).match(/[^\x00-\xff]/g)!=null){
                len+=2;
            }else{
                len++;
            }
            if(len>l){ break; }
        }return s.substr(0,i);
    };
</script>