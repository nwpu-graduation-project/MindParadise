<div id="friendly">
  <a href="#" class="more">更多</a>
    <span class="item">友情链接：</span>
    <div class="flist">
    <?php
        foreach($blogrolls as $blogroll)
        {   
            $url = $blogroll['Blogroll']['url'];
            $title = $blogroll['Blogroll']['title'];
            echo '<a href='.$url.' title='.$title.' target="_blank">'.$title.'</a>';
        }
    ?>
        <a href="http://www.xinli001.com/site/" title="心理圈" target="_blank">心理圈</a>
        
        <a href="http://xl.39.net/" title="39心理" target="_blank">39心理</a>
        
        <a href="http://www.psy525.cn/" title="525心理网" target="_blank">525心理网</a>
        
        <a href="http://www.86kx.com/" title="白领网" target="_blank">白领网</a>
        
        <a href="http://www.39yst.com/" title="三九养生堂" target="_blank">三九养生堂</a>
        
        <a href="http://zyk.99.com.cn/" title="中医" target="_blank">中医</a>
        
        <a href="http://baike.onlylady.com/" title="女性百科" target="_blank">女性百科</a>
        
    </div>
</div>