<div id="header">
  <div id="top_header">
    <div class="center_frame">
      <div class="top">
        <div class="top_header_action"> 
          <?php if(!$currentUser): ?>
              <a href="login" class="login">登录</a>    
              <a href="register" class="register">注册</a>
          <?php else: ?>
            <a class="logout" href="/logout">注销</a>
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
    <div class="bg_111">
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
      </div>
    </div>
  </div>
</div>