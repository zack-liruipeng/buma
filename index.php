<?php

if (!ini_get('date.timezone')) {
	date_default_timezone_set('America/Anguilla');
}
include_once dirname(__FILE__) . '/config.php';

?><!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Ruipeng">
        <meta name="description" content="The website for Assignment1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, , user-scalable=no">
        <title>BUMA</title>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/group11/buma/js/jquery-ui-1.10.4.custom.min.js"></script>
 	    <script type="text/javascript" src="/group11/buma/js/event.js"></script>
        <link href="/group11/buma/css/bootstrap.min.css" rel="stylesheet">
        <link href="/group11/buma/css/style.css" rel="stylesheet" type="text/css" media="screen" >
        <link href="/group11/buma/css/format.css" rel="stylesheet" type="text/css" media="all" />
        <script src="https://code.jquery.com/jquery.js"></script>
        <script src="/group11/buma/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header"><?php
                
                    // Test if the user is logged
                    if ($user_id)
                        echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                              </button>';

                    ?><a class="navbar-brand" href="/group11/buma/home"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;BUMA</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav"><?php
                        
                        // Test if the user is logged
                        if ($user_id)
                            echo '<li><p class="navbar-text"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Logged in as ' . utf8_encode(ucfirst($_SESSION['user_name'])) . '</p></li>
                                  <li><a href="/group11/buma/add_budget"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Add New Budget</a></li> <!--#Add-->
                                  <li><a href="/group11/buma/add_expense"><span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;Add New Expense</a></li> <!--#Add-->
                                  <li><a href="/group11/buma/wish_list"><span class="glyphicon glyphicon-gift"></span>&nbsp;&nbsp;Wish List</a></li> <!--#Wish-->
                                  <li><a href="/group11/buma/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;Logout</a></li> <!--#Logout-->';
                    ?></ul>
                </div>
            </div>
        </div>
        <div class="container"><?php
        
			// Show current page
			include dirname(__FILE__) . '/' . $file . '.php';
        
        ?></div>
    </body>
</html>
