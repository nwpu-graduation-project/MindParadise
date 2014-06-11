<?php 
$this->extend('/PersonalCenter/common_view');

$this->start('sidebar');
	echo $this->element("sidebar_admin");
$this->end();

$this->start('script');
?>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
 <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
 <script>
  $(function() {
    $( "#sortable" ).sortable({ opacity: 0.6, cursor: 'move', update: function() {
		var order = $(this).sortable("serialize") + '&action=update';
    $.ajax({
      type: 'POST',
      url: '/recommendContents/updateOrder',
      data: order,
      async: true,
      error: function(){alert('Error loading PHP document');},
      success: function(result){alert(result);}
    });
	}});
    //$( "#sortable" ).disableSelection();
  });
 </script>
<?php  
$this->end();

$this->start('css');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<style>
  #sortable { list-style-type: none; margin: 0; padding: 0; width: 80%; }
  #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
  #sortable li span { position: absolute; margin-left: -1.3em; }
  #sortable li a {float: right; margin-left: 10px;}
  #sortable li a.title
  {
    float: left;
    margin-left: 20px;
    width: 60%;
    overflow: hidden;
    display: block;
  }
</style>
<?php 
$this->end();
?>



<h3>推荐管理</h3>


<ul id="sortable">
<?php foreach($recommendEntries as $entry): ?>
  <li id="arrayorder_<?php echo $entry['RecommendContent']['id'] ?>" class="ui-state-default">
  <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
  <?php 
  echo $this->Html->link(
    $entry['RecommendContent']['title'],
    $entry['RecommendContent']['url'],
    array('class' => 'title')
  );

  echo $this->Form->postLink(
    '删除',
    array('action' => 'delete', $entry['RecommendContent']['id']),
    array('confirm' => 'Are you sure?')
  );
	echo $this->Html->link(
		'编辑',
		array('action' => 'edit', $entry['RecommendContent']['id'])
	);
	?>
  </li>
<?php endforeach ?>

  
</ul>
