<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="en-US" lang="en-US">

<html>
<head>
<link rel="stylesheet" href="styles/styles_logIn.css" type="text/css">
<title>Helpdesk Portal</title>
<link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
<?php
$username = "Holly";

?>
<div id="blackBar">
<div id="barText">
<ul id="adminMenu">
<li>Help</li>
<li>Sign Out</li>
<li>Hi, <?php echo $username; ?></li>
</ul>
</div>
</div>

<header>
<div id="logo"><img style="height:85%; width:85%;" src="images/NumaticLogo.png" alt="Numatic Logo" draggable="false"></div>
<h1>Helpdesk Portal</h1>
<div id="menubar">
<ul id="menu">
<li>Home</li>
<li>Tickets</li>
<li>Reports</li>
</ul>
</div>
</header>

<section>
<content>
<h2> Log In</h2>
<div id="form">
<form action="welcome.php" method="post">
<label>Username: </label><input type="text" name="username"><br>
<label>Password: </label> <input type="password" name="password"><br><br>
<input type="submit">
</form>
</div>
<div id="homecare"><img style="height:80%; width:80%;" src="images/homecare_group.png" alt="Home Care Range" draggable="false"></div>



</content>

</section>
</body>
</html>