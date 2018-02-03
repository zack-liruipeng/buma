<div id="login" id="loginForm" class="visible widget-box no-border">
	<form class="form-signin" role="form"  id="login_form">
        <h2 class="form-signin-heading">Welcome to BUMA</h2>
        <input name="email" type="text" class="username form-control" placeholder="Email address" required autofocus value="<?php
		echo $_COOKIE['email']; ?>">
        <input name="password" type="password" class="password form-control" placeholder="Password" required value="<?php
		echo $_COOKIE['password']; ?>">
        <label class="checkbox checkbox-control"><input name="remember_me" type="checkbox" value="remember-me" <?php echo (isset($_COOKIE['email']) && isset($_COOKIE['password']) ? "checked='checked'" : ""); ?>> Remember me</label>
    
	    <a href="forgot"><button type="button" class="btn btn-link forgot-control">Forgot Password</button></a>
   
	    <button class="btn btn-lg btn-primary btn-block" id="btn_login_form" type="submit">Log in</button>
    
	    <a href="register"><button class="btn btn-default btm-new-account" type="button">Create New Account</button></a>
    
	    <div id="login_form" class="alert"></div>
	</form>	
</div>
