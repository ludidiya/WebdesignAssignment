<?php
session_start();
?>

<?php
$_SESSION[ 'forname' ] = $_POST[ 'fn' ];
$_SESSION[ 'surname' ] = $_POST[ 'sn' ];
$smask = $_SESSION[ 'supmask' ];
include "navigation.html";
require_once 'login.php';
include 'redir.php';
?>

<div id="write" class="container">
<h2>Hello <?php echo $_SESSION[ 'forname' ] ?>!</h2><br>
<p>Welcome to Compound library. You have successfully logged in! </p><br>
<p>Now, please click<a href="Home.php" class="contentInd">here</a>to start.</p>


<br><br><br>
</dir>
</body>
</html>

