<?php

include_once dirname(__FILE__) . '/config.php';

?><script type="text/javascript">
	function InputCheck(RegForm) {
		// This fuction will check the information of the user registered for
		// It is the most normal register requirement 
		if (document.getElementById("agreement").checked==false)
		{	alert("Please accept the user agreement");
			return (false);
		}
	}
</script>
<!--This is the new sign up box -->

<div class="widget-body">
    <h2 class="form-signin-heading"> New User Registration</h2>
    <h4>Enter your details to begin:</h4>
    <form id="register_form" role="form">
         <fieldset>
            <input type="email" class="form-control" 	id="email"		name="email" 	placeholder="Email"  autofocus/>
            <!--<input type="text" class="form-control"  	id="user_id"		name="user_id"	placeholder="Your account name(at least 6 digits)"/>-->
            <input type="text" class="form-control"  	id="username" 	name="username" placeholder="Name"/>
            <input type="password" class="form-control" id="password" 	name="password"	placeholder="Password(at least 6 digits)"/>
            <input type="password" class="form-control" id="repass" 	name="repass"	placeholder="Repeat password"/>
            
        <label class="checkbox checkbox-control">
            <input type="checkbox" id="agreement">I accept the <a href="BUMA User Agreement.pdf">User Agreement</a>
        </label>			
            <button type="reset" onclick="reset()" class="btn btn-lg btn-block">Reset</button>
            <button id="register_form_buttom" class="btn btn-lg btn-primary btn-block btn-success">Register</button>				
        </fieldset>			
        <a href="login">Back to login</a>
        <div class="alert my_alert"></div>
    </form>
</div>