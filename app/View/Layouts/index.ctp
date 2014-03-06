<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>
  <title>
    <?php echo $title_for_layout; ?>
  </title>

  <?php
  echo $this->Html->css('error');
  echo $this->Html->css('style');
  echo $this->Html->css('basic-jquery-slider');
  echo $this->Html->script('jquery.min.js');
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');
  ?>
</head>

<body style="">
  <?php echo $this->fetch('bshare_side'); ?>
  <!-- header start -->
  <?php echo $this->element('header'); ?>
  <!-- header end -->
  <!-- warpper start -->
  <div id="wrapper" class='clearfix'>
    <!-- div id="content" -->

      <?php echo $this->Session->flash(); ?>
      <?php echo $this->Session->flash('Auth'); ?>
      <?php echo $this->fetch('content'); ?>
    <!-- /div -->
  </div>
  <!-- warpper end -->
  <?php echo $this->element('friendlylink'); ?>
  <?php echo $this->element('footer'); ?>
  

  <?php echo $this->element('sql_dump'); ?>
</body>
</html>