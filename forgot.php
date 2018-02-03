<?php

include_once dirname(__FILE__) . '/config.php';

?>
<div class="widget-body">
	<h2 class="form-signin-heading">Retrieve Password</h2>
	<form id="forgot_form" role="form"action="forgot_post.html">
		<fieldset>
			<input type="email" class="form-control" id="email" name="email" placeholder="Please enter your email"  autofocus/>			 
		</fieldset>
		<br />
		<button id="forgot_form_buttom" class="btn btn-lg btn-primary btn-block btn-success">Send to me!</button>		
		<label>
		<a href="login">Back to login</a>
        </label>
		<div class="alert my_alert"></div>
    </form>
</div>