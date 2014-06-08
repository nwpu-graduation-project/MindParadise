   
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
                        <form class="search" action="/search/check" method="post" style="width:70%;">
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
                        <?php
                        $replace = array();
                        foreach ($keywordsArray as $key => $value) {
                            $replace[] = base64_encode('<font color="red"><b id="key_word_'.$key.'">').' '.$value.' PC9iPjwvZm9udD4=';
                        }

                        function decode($text) {
                                $wordsArray = explode(" ", $text);
                                $decoded = "";
                                foreach ($wordsArray as $key => $value) {
                                    $decoded = $decoded.base64_decode($value);
                                }
                                return $decoded;
                        }

                        function previewText($text) {
                            $prev = explode("。", $text);
                            $counter = 0;
                            foreach ($prev as $key => $value) {
                                if (stripos($value, '<b id="key_word_')) {
                                    echo $value;
                                    $counter++;
                                    if($counter == 3) {
                                        break;
                                    }
                                    echo '...';
                                }
                            }
                        }

                        foreach ($result as $key => $value) {
                            echo '<div>';
                            switch ($value['search_indices']['type']) {
                                case '1':
                                    echo '<div><h2>心理知识--<a href="/webcontents/view/'.$value['search_indices']['content_id'].'" style="float: none">';
                                    $webcontent = $this->requestAction(
                                            '/webcontents/getWebcontentInfoById/'.$value['search_indices']['content_id']);
                                    echo $webcontent['Webcontent']['title'];
                                    echo '</a></h2>'.$webcontent['Webcontent']['created'].'</div>';
                                    break;
                                case '2':
                                    echo '<div><h2>心理百科--<a href="/encyclopediaentries/view/'.$value['search_indices']['content_id'].'" style="float: none">';
                                    $entry = $this->requestAction(
                                            '/encyclopediaentries/getEntryInfoById/'.$value['search_indices']['content_id']);
                                    echo $entry['EncyclopediaEntry']['entry'];
                                    echo '</a></h2>'.$entry['EncyclopediaEntry']['created'].'</div>';
                                    break;
                                case '3':
                                    echo '<div><h2>案例文章--<a href="/caseArticles/view/'.$value['search_indices']['content_id'].'" style="float: none">';
                                    $caseArticle = $this->requestAction(
                                            '/caseArticles/getCaseArticleById/'.$value['search_indices']['content_id']);
                                    echo $caseArticle['CaseArticle']['title'];
                                    echo '</a></h2>'.$caseArticle['CaseArticle']['created'].'</div>';
                                    break;
                                default:
                                    
                                    break;
                            }
                            echo '<div><p>';
                            echo previewText(decode( str_replace ($keywordsArray, $replace, $value['search_indices']['content']) ));
                            echo '</p></div><br>';
                            echo '</div>';
                        }

                        //返回高亮结果
                        // echo highlight($result['0']['search_indices']['content'], $keywordsArray);
                        function highlight($str, $key_arr) {
                            
                            $param_temp = array();
                            echo preg_match_all('/' . join('|', $key_arr) . '/i', $str, $matches);
                            // var_dump($matches);
                            
                            foreach ($matches[0] as $value) {
                                $param_temp[$value] = "<font color=red><b>" . $value . "</b></font>";
                            }

                            $str2 = strtr($str, $param_temp);
                            return $str2;
                        }

                        // var_dump($result);
                        ?>
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
     