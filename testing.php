<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="en-US" lang="en-US">

<html>
<head>
<link rel="stylesheet" href="styles/styles.css" type="text/css">
<title>Helpdesk Portal</title>
<link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
<?php
$username = "Holly";
echo $username;
?>
<div id="blackBar">
<div id="barText">
<ul id="adminMenu">
<li>Help</li>
<li>Sign Out</li>
<li>Hi <?php echo $username; ?></li>
</ul>
</div>
</div>

<header>
<div id="logo"><img style="height:85%; width:85%;" src="images/NumaticLogo.png" alt="Numatic Logo"></div>
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
<h2> New Ticket </h2>
<form action="welcome.php" method="post">
Customer: <input type="text" name="customer"><br>
Telephone Number: <input type="text" name="tel"><br>
Priority: <input type="text" name="email"><br>
Problem Profile: <input type="text" name="email"><br>
Description: <input type="text" name="email"><br>

<input type="submit">
</form>

<p>This is a paragraph.</p>
<?php
 echo "holly"; 
?>

</content>

</section>
</body>
</html>