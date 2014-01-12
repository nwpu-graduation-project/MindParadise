   
   <?php $this->start('css'); ?>
    <link rel="stylesheet" href="/css/cases_reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/cases_style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/grid.css" type="text/css" media="screen">   
    <link rel="stylesheet" href="/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/style.css" type="text/css" media="screen">
   <?php $this->end(); ?>
   
   <?php $this->start('script'); ?>
    <script src="/js/cases_jquery-1.6.2.min.js" type="text/javascript"></script>
    <script src="/js/cufon-yui.js" type="text/javascript"></script>
    <script src="/js/cufon-replace.js" type="text/javascript"></script>
    <script src="/js/Open_Sans_400.font.js" type="text/javascript"></script>
    <script src="/js/Open_Sans_italic_400.font.js" type="text/javascript"></script> 
    <script src="/js/FF-cash.js" type="text/javascript"></script>       
    <?php $this->end(); ?>

    <section id="content">
                <div class="main1">
                    <div class="container_12">
                    <div class="wrapper">
                    <article class="grid_8 suffix_1 spacer-4">
                        <h4><br>最新案例</h4>
                        <?php foreach ($caseArticles as $caseArticle) : ?>
                        <div class="p3">
                            <time class="tdate-2" datetime="2011-08-10"><?php echo $caseArticle['CaseArticle']['created']; ?></time>
                            <h4 class="p0"><?php echo $caseArticle['CaseArticle']['title']; ?></h4>
                            <p class="p2"><?php echo $caseArticle['CaseArticle']['source']; ?></p>
                            <div class="wrapper1">
                                <figure class="img-indent">
                                    <?php $string = $caseArticle['CaseArticle']['photo'];
                                     echo "<img src='/img/cases_photos/$string' alt='photo' width='350Pixel' height='235Pixel'/>"; ?>
                                </figure>
                                <div class="extra-wrap">
                                    <p class="margin-bot"><?php echo $caseArticle['CaseArticle']['abstract']; ?></p>
                                    <div class="wrapper1">
                                        <?php $id = $caseArticle['CaseArticle']['id'];
                                        echo "<a class='button2 fleft' href='/caseArticles/view/$id'>More</a>";
                                        ?>
                                        <a class="link-2 fright" href="#"><?php echo $caseArticle['CaseArticle']['comment_number']; ?>条评论</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php unset($caseArticle); ?>  
                    </article>
                    <article class="grid_3">
                        <h4 class="indent-bot"><br>时间排序</h4>
                        <h6 class="p0">2014</h6>
                        <dl class="news indent-bot">
                            <dt><a href="#">12月</a></dt><br>
                            <dd><a href="#">11月</a></dd><br>
                            <dd><a href="#">10月</a></dd><br>
                            <dd><a href="#">9月</a></dd><br>
                            <dd><a href="#">8月</a></dd><br>
                            <dd><a href="#">7月</a></dd><br>
                            <dd><a href="#">6月</a></dd><br>
                        </dl>
                        <h6 class="p0"><a class="color-2" href="#">2013</a></h6><br>
                        <h6 class="p0"><a class="color-2" href="#">2012</a></h6><br>
                        <h6 class="p0"><a class="color-2" href="#">2011</a></h6><br>
                        <h6 class="p0"><a class="color-2" href="#">2010</a></h6><br>
                    </article>
                </div>
            </div>
        </div>
    </section>

<div id="page_navigation">
    <div class="center_frame">
        <ul class="blog_page_nav">
<?php
echo $this->Paginator->prev(
  __('上', true),
  array(
    'tag' => 'li',
    'class' => 'page_prev',
  )
);
?>
            
<?php
echo $this->Paginator->numbers(array(
        'separator' => NULL,
        'tag' => 'li',
        'class' => 'page_number',
        'currentClass' => 'current',
        'currentTag' => 'a')
    );
?>

<?php
echo $this->Paginator->next(
  __('下', true),
  array(
    'tag' => 'li',
    'class' => 'page_next',
  )
);
?>
        </ul>
    </div>
</div>
     