<?php
session_start();
include 'redir.php';

echo <<<_STYLE

<html><head>
	<meta charset="utf-8">
	<title>logout</title>
	<style type="text/css">
		body{
        background-color: #34495e;
        text-align: center;
		height: 100vh;
		width: 100%;
		font-size: 18px;
      }

      h1{
			font-family: 'impact', sans-serif;
			font-size: 4em;
			font-weight: bold;
			text-align: center;
			color: white;
		}
		h2{
			font-family: 'optima',sans-serif;
			font-size: 22px;
			font-weight: bold;
			text-align: center;
			color: white;

		}
		p{
			font-family: 'optima', sans-serif;
			font-size: 30px;
			line-height: 60px;
			text-align: center;
			color: white;
		}
		
	</style>
</head>
<body>
<h1>COMPLIB</h1>
<h2>Student Exam Number: [ B163919 ]</h2>
_STYLE;


$fn = $_SESSION['forname'];
echo <<<_MAIN1
    <p>Goodby $fn. You have now exited the databse.<br>
    You can clike <a href="complib.php" style="color:#fbc531">here</a> to return to the login page.
	</p>
	</body>
	</html>
_MAIN1;
?>