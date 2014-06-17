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
       
    </div>
</div>