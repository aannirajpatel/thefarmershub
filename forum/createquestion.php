<?php

require("../includes/auth.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        body, html {
  height: 100%;
}
.bg {
  /* The image used */
  background-image: linear-gradient(to right bottom, #051937, #004d7a, #008793, #00bf72, #a8eb12);

  /* Full height */
  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
   </style>
  <title>Create question</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body class="bg">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="#">The Farmer's Hub</a>
  
  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link active" href="#">Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Articles</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../forum/forum.php">Forums</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Statistics</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Logout</a>
    </li>
  </ul>
</nav>
<br><br>
<div class="container">
<table width="400" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form id="form1" name="form1" method="post" action="addq.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" bgcolor="#E6E6E6"><strong>Ask a Question</strong> </td>
</tr>
<tr>
<td width="14%"><strong>Question</strong></td>
<td width="2%">:</td>
<td width="84%"><input name="question" type="text" id="question" size="100" /></td>
</tr>
<!--<tr>
<td valign="top"><strong>Detail</strong></td>
<td valign="top">:</td>
<td><textarea name="detail" cols="50" rows="3" id="detail"></textarea></td>
</tr>
<tr>
<td><strong>Name</strong></td>
<td>:</td>
<td><input name="name" type="text" id="name" size="50" /></td>
</tr>
<tr>
<td><strong>Email</strong></td>
<td>:</td>
<td><input name="email" type="text" id="email" size="50" /></td>
</tr>
<tr>-->
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit" />  <!--<input type="reset" name="Submit2" value="Reset" />--></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

</div>
</div>
</body>
</html>