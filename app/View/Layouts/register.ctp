<!DOCTYPE html>
<!-- saved from url=(0049)file:///home/tahong/Documents/header/header.html# -->
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

    //echo $this->Html->script('jquery.min.js');
  echo $this->fetch('meta');
  echo $this->fetch('css');
  echo $this->fetch('script');
  ?>
</head>

<body style="">
  <!-- header start -->
  <div id="header">
    <div id="top_header">
      <div class="center_frame">
        <div class="top">
          <div class="top_header_action"> 

            <?php if(!$currentUser): ?>   
              <a href="login" class="login">登录</a> 
              <a href="register" class="register">注册</a> 
            <?php else: ?>
              <a class="logout" href="/logout">退出</a>
              <a class="username" href="#"><?php echo $currentUser['User']['username']; ?></a>
              <div id="notifications">
                <!-- indicator start -->
                <div id="indicator">
                  <span>notifications</span>
                  <a class="count important" href="#">7</a>
                </div>
                <!-- indicator end -->
                <!-- flash-message start -->
                <div class="flash-message">
                  <div class="noti-message">
                    Things have been happening
                    <a href="#">here's proof</a>
                  </div>
                  <div class="noti-message">
                    This is a warning — be warned!
                  </div>
                  <div class="form">
                    <a class="btn" href="#">view all notifications</a>
                  </div>
                </div>
                <!-- flash-message end -->
              </div>
            <?php endif; ?>   
          </div>
          <form name="search" method="post" action="">
            <div class="search">
              <input type="text" placeholder="Search">
              <a href="default.htm"></a>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Top Header End Here-->
    <div id="logo_nav">
      <div class="bg">
        <div class="center_frame"> 
          <!--Logo And Navigation Start Here-->
          <div class="logo"> <a href="index.html"><img src="/img/logo.png" alt=""></a> </div>
          <ul id="navigation">
            <li><a href="index"><span>首页</span></a></li>
            <li><a href="#"><span>专家团队</span></a></li>
            <li><a href="#"><span>案例分析</span></a>
              <ul>
                <li> <a href="#" class="life">Life with P84</a> <span class="nav_line"></span></li>
                <li> <a href="#" class="life_1">Always full power</a> <span class="nav_line"></span></li>
                <li> <a href="#" class="life_2">Media access</a> <span class="nav_line"></span></li>
                <li> <a href="#" class="life_3">Infinite creativity</a> <span class="nav_line"></span></li>
                <li> <a href="#" class="life_4">How to install P84</a> </li>
              </ul>
            </li>
            <li><a href="#"><span>心理百科</span></a></li>
            <li><a href="#"><span>心理知识</span></a></li>
            <li><a href="#"><span>留言咨询</span></a></li>
            <li><a href="#"><span>在线咨询</span></a></li>
          </ul>
          <!--Logo And Navigation End Here--> 
          <!--CHANGE ONLY THIS PART HERE--> 

      <!--Project Top Start Here 
      <div id="register_details">
          <form action="/users/register" method="post" accept-charset="utf-8">
            <h6>Register</h6>
            <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
            <input type="text" maxlength="30" name="data[User][username]"  placeholder="username" class="input_1" required="required">
            <input type="password" name="data[User][password_confirm]"  placeholder="password" class="input_2" required="required">
            <input type="password" name="data[User][password]"  placeholder="password confirm" class="input_3" required="required">
            <input type="email" maxlength="100" name="data[User][email]" placeholder="Email" class="input_4" required="required">
            <input type="submit" name="submit" value="" class="register_img">
          </form>
      </div>
      Project Top Start Here --> 
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->Session->flash('Auth'); ?>
      <?php echo $this->fetch('content'); ?>
      <!--CHANGE ONLY UPERE PART IN INNER PAGES--> 
      
    </div>
  </div>
</div>
</div>
<!-- header end -->
<!-- warpper start -->
<div class="wrapper">
  <div id="content">  
  </div>
</div>
<!-- warpper end -->

<div id="footer">
  <div id="footer1">
    <div id="fbox1">
      <h2>Browse</h2>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="">Project 84</a>
          <ul class="fsub-menu">
            <li><a href="project.html">Life with P84</a></li>
            <li><a href="#">Always full power</a></li>
            <li><a href="#">Media access</a></li>
            <li><a href="#">Infinite creativity4</a></li>
            <li><a href="#">How to install P84</a></li>
          </ul>
        </li>
        <li><a href="services.html">Services</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
      <ul>
        <li><a href="#">Frequently Asked Questions</a>
          <ul class="fsub-menu">
            <li><a href="#">Top 10 Questions</a></li>
            <li><a href="#">Is it safe?</a></li>
            <li><a href="#">What's the procedure like?</a></li>
            <li><a href="#">How much does it cost?</a></li>
            <li><a href="#">What if I die?</a></li>
          </ul>
        </li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Sitemap</a> </li>
        <li><a href="#">Job Opportunities</a></li>
        <li><a href="#">Advertisement</a></li>
      </ul>
    </div>
    <div id="fbox2">
      <h2>Connect with us</h2>
      <div class="share"> <a href="http://www.cssmoban.com" class="facebook">&nbsp;</a> <a href="http://www.cssmoban.com" class="twitter">&nbsp;</a> <a href="#" class="skype">&nbsp;</a> <a href="#" class="in">&nbsp;</a> <a href="#" class="email">&nbsp;</a>  </div>
      <form name="signup" method="post" action="">
        <div class="newsletter">
          <h2>Join our newsletter</h2>
          <input name="" type="text" value="Enter you Emails">
          <input name="" type="submit">
          <a href="#">Click here to unsubscribe</a> </div>
        </form>
      </div>
      <div id="fbox3"> <img src="images/footer-pic.png" width="92" height="214" alt=""> <span>PowerHouse Corporation<br>
        1534 Hi Street, Santa Felicia, CA 90563</span> </div>
      </div>
      <div id="copyrights">
        <div>© Copyright 2012 PowerHouse Corporation, All Rights Reserved Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></div>
      </div>
    </div>

    <?php echo $this->element('sql_dump'); ?>
  </body>
  </html>