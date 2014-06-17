<div class='verify'>
	<h2>Recover Password</h2>
	 
	<?php if (isset($success)): ?>
	    <div class="message">
	    验证成功，新的密码已经发送到你的邮箱。</div>
	    <p>新生成的密码已经发送到你的邮箱，请登录之后在个人中心页面修改密码页面及时修改自己的密码。</p>
	<?php else: ?>
	    <div class="warning">无效的验证地址。这个页面已经过期或者地址没有被正确的拷贝。</div>
	    <p>确保自己拷贝了完整的验证链接地址。如果你确定拷贝无误仍无法验证成功，请联系我们。</p>
	<?php endif; ?>
</div>
