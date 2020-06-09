<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
    <title>CompLib Login page</title>
    <link rel="stylesheet" href="css/login.css">
   <style>
      body{
        background-image: url('images/login.png');
        background-repeat: repeat; 
      }
    </style>
</head>

<body>
  <div class="title">
  <h1>Welcome to CompLib </h1>
  <h2>Student Exam Number: B163919</h2>
  </div>

  <form class="box" action="indexp.php" method="post">
  	<h1>Login</h1>
	<input type="forename" name="fn" placeholder="Forename" pattern="[A-Za-z ]{1,32}" rquired>
  	<input type="surname" name="sn" placeholder="Surname" pattern="[A-Za-z ]{1,32}" required>
  	<input type="submit" value="Login">
  </form>


  <?php
  require_once 'login.php';
  $db_server = mysql_connect( $db_hostname, $db_username, $db_password );
  if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
  mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );
  $query = "select * from Manufacturers";
  $result = mysql_query( $query );
  if ( !$result )die( "unable to process query: " . mysql_error() );
  $rows = mysql_num_rows( $result );
  $mask = 0;
  mysql_close( $db_server );
  for ( $j = 0; $j < $rows; ++$j ) {
  	$mask = ( 2 * $mask ) + 1;
  }
	$_SESSION[ 'supmask' ] = $mask;
?>
	

</body>
</html>

