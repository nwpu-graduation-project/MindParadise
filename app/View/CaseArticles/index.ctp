   
   <?php $this->start('css'); ?>
    <link rel="stylesheet" href="/css/cases_reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/cases_style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/grid.css" type="text/css" media="screen">   
    <link rel="stylesheet" href="/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="/css/search_case.css" type="text/css" media="screen">
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
                        <br>
                        <form class="search" action="/search/" method="post" style="width:70%;">
                        <table>
                        <tr>
                            <td>
                                <input class="searchTerm" name="data[keyword]" placeholder="输入关键词，按回车搜索" size='30'/>
                            </td>
                            <td>
                                <input type="submit" value="搜索" style='width:200%'/>
                            </td>
                            <td>
                                <input type="hidden" value="3" name='type'/>
                            </td>
                        </tr>
                        </table>
                        </form>
                        <h4><br>最新案例</h4>
                        <?php foreach ($caseArticles as $caseArticle) : ?>
                        <div class="p3">
                            <time class="tdate-2" datetime="2011-08-10"><?php $date = $caseArticle['CaseArticle']['created']; 
                                $formatDate = substr($date, 0,10);
                                echo $formatDate; ?></time>
                            <h4 class="p0"><?php echo $caseArticle['CaseArticle']['title']; ?></h4>
                            <p class="p2"><?php echo $caseArticle['CaseArticle']['source']; ?></p>
                            <div class="wrapper1">
                                <figure class="img-indent">
                                    <?php $string = $caseArticle['CaseArticle']['photo'];
                                     echo "<img src='/img/cases_photos/$string' alt='photo' width='350Pixel' height='235Pixel'/>"; ?>
                                </figure>
                                <div class="extra-wrap">
                                    <p class="margin-bot"><font color='green'>导读:&nbsp;</font><?php echo $caseArticle['CaseArticle']['abstract']; ?></p>
                                    <div class="wrapper1" style="margin-bottom:30%">
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
     