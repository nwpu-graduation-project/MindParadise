<div id="header">
  <div id="top_header">
    <div class="center_frame">
      <div class="top">
        <div class="top_header_action"> 
          <?php if(!$currentUser): ?>
            <a href="/login" class="login">登录</a>    
            <a href="/register" class="register">注册</a>
          <?php else: ?>
            <a class="logout" href="/logout">注销</a>
            <a class="username" href="/personalCenter/"><?php echo $currentUser['User']['username']; ?></a>
            <div id="notifications">
              <!-- indicator start -->
              <div id="indicator">
                <span>notifications</span>
                <?php if($currentUser['User']['messages_unread'] != 0): ?>
                  <a class="count important" href="/messages/index">
                    <?php echo $currentUser['User']['messages_unread'];?>
                  </a>
                <?php else: ?>
                  <a class="count" href="/messages/index">0</a>
                <?php endif; ?>
              </div>
              <!-- indicator end -->
              <?php if($unreadMessages): ?>
                <!-- flash-message start -->
                <div class="flash-message">

                  <?php foreach($unreadMessages as $num => $message): ?>
                    <div class="noti-message">
                      <?php 
                      echo $message['Message']['type'];
                      echo $message['Message']['abstract']; 
                      ?>
                      <br>
                      <a href="#">详细</a>
                    </div>
                  <?php endforeach; ?>

                  <div class="form">
                    <a class="btn" href="/messages/index">查看所有</a>
                  </div>
                </div>
                <!-- flash-message end -->
              <?php endif;?>
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
        <div class="logo"> <a href="/index"><img src="/img/logo.png" alt=""></a> </div>
        <ul id="navigation">
          <li><a href="/users/index"><span>首页</span></a></li>
          <li><a href="/Experts/index"><span>专家团队</span></a></li>
          <li><a href="/CaseArticles/index"><span>案例分析</span></a>
            <!--
            <ul>
              <li> <a href="#" class="life">Life with P84</a> <span class="nav_line"></span></li>
              <li> <a href="#" class="life_1">Always full power</a> <span class="nav_line"></span></li>
              <li> <a href="#" class="life_2">Media access</a> <span class="nav_line"></span></li>
              <li> <a href="#" class="life_3">Infinite creativity</a> <span class="nav_line"></span></li>
              <li> <a href="#" class="life_4">How to install P84</a> </li>
            </ul>
          -->
          </li>
          <li><a href="/webcontents/"><span>心理知识</span></a></li>
          <li><a href="/encyclopediaentries/"><span>心理百科</span></a></li>
          <li><a href="#"><span>留言咨询</span></a></li>
          <li><a href="#"><span>在线咨询</span></a></li>

        </ul>
        <!--Logo And Navigation End Here--> 
      </div>
    </div>
  </div>
</div>