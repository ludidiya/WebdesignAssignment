<?php
session_start();
?>

<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
?>

<div id="write" class="container">
<h2>Property search result</h2><hr>

<?php
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());     
$query = "select * from Manufacturers";
$result = mysql_query($query);
if(!$result) die("unable to process query: " . mysql_error());
$rows = mysql_num_rows($result);
$manarray = array();
for($j = 0 ; $j < $rows ; ++$j)
  {
    $row = mysql_fetch_row($result);
    $manarray[$j] = $row[1];
  }



if (($_POST['tgval'] != "") && ($_POST['cval']!="")) {
    $mychoice=get_post('tgval');
    $myvalue=get_post('cval');
    $compsel = "select * from Compounds where ";
    if($mychoice == "mw") {
      $compsel = $compsel."( mw > ".($myvalue - 1.0)." and  mw < ".($myvalue + 1.0).")";
    }
    if($mychoice == "TPSA") {
      $compsel = $compsel."( TPSA > ".($myvalue - 0.1)." and  TPSA < ".($myvalue + 0.1).")";
    }
    if($mychoice == "XLogP") {
      $compsel = $compsel."( XLogP > ".($myvalue - 0.1)." and  XLogP < ".($myvalue + 0.1).")";
    }
 
    //    echo $compsel;
    echo "\n";
    $result = mysql_query($compsel);
    if(!$result) die("unable to process query: " . mysql_error());
    $rows = mysql_num_rows($result);



 if($rows > 1000) {
      echo "<p>It has <b>", $rows, "</b> results. The fist 1000 compounds are displayed.</p>";
      echo '<p>Return to<a class="contentInd" href="Property_select.php">Property Search page.</a>[Click]</p>';
      echo<<<TABLE_
<table id='myTable' align="center">
<thead>
  <tr>
  	<th>CID</th>
    <th>catName</th>
    <th>Manu</th>
    <th>nAtm</th>
    <th>nCar</th>
    <th>nNit</th>
    <th>nOxy</th>
    <th>nSul</th>
    <th>nCycl</th>
    <th>nHDon</th>
    <th>nHAcc</th>
    <th>nRotBon</th>
    <th>MW</th>
    <th>TPSA</th>
    <th>XLogP</th>
    <th>Display</th>
  </tr>
  </thead>
  <tbody>
TABLE_;
      for($j = 0 ; $j < 1000 ; ++$j)
  {
    echo "<tr>";
    $row = mysql_fetch_row($result);
    echo '<td>' . $row[ 0 ] . '</td>';
	echo '<td>' . $row[ 11 ] . '</td>';
	echo '<td>' . $manarray[$row[10] - 1] . '</td>';
	echo '<td>' . $row[ 1 ] . '</td>';
	echo '<td>' . $row[ 2 ] . '</td>';
	echo '<td>' . $row[ 3 ] . '</td>';
	echo '<td>' . $row[ 4 ] . '</td>';
	echo '<td>' . $row[ 5 ] . '</td>';
	echo '<td>' . $row[ 6 ] . '</td>';
	echo '<td>' . $row[ 7 ] . '</td>';
	echo '<td>' . $row[ 8 ] . '</td>';
	echo '<td>' . $row[ 9 ] . '</td>';
	echo '<td>' . $row[ 12 ] . '</td>';
	echo '<td>' . $row[ 13 ] . '</td>';
	echo '<td>' . $row[ 14 ] . '</td>';
	echo '<td><a style="color:blue" href="http://mscidwd.bch.ed.ac.uk/s1986520/test_1/dispaly.php?cid=' . $row[ 0 ] . '">Link</a></td>';
	echo '</tr>';
  }
echo "</tbody>";
echo "</table>";
echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

      
    } else  {
    echo "<p>It has <b>", $rows, "</b> results.</p>";
      echo '<p>Return to<a class="contentInd" href="Property_select.php">Property Search page.</a>[Click]</p>';
      echo<<<TABLESET_
<table id='myTable' align="center">
<thead>
  <tr>
    <th>CID</th>
    <th>catName</th>
    <th>Manu</th>
    <th>nAtm</th>
    <th>nCar</th>
    <th>nNit</th>
    <th>nOxy</th>
    <th>nSul</th>
    <th>nCycl</th>
    <th>nHDon</th>
    <th>nHAcc</th>
    <th>nRotBon</th>
    <th>MW</th>
    <th>TPSA</th>
    <th>XLogP</th>
    <th>Display</th>
  </tr>
  </thead>
  <tbody>
TABLESET_;
      for($j = 0 ; $j < $rows ; ++$j)
  {
    echo "<tr>";
    $row = mysql_fetch_row($result);
    echo '<td>' . $row[ 0 ] . '</td>';
	echo '<td>' . $row[ 11 ] . '</td>';
	echo '<td>' . $manarray[$row[10] - 1] . '</td>';
	echo '<td>' . $row[ 1 ] . '</td>';
	echo '<td>' . $row[ 2 ] . '</td>';
	echo '<td>' . $row[ 3 ] . '</td>';
	echo '<td>' . $row[ 4 ] . '</td>';
	echo '<td>' . $row[ 5 ] . '</td>';
	echo '<td>' . $row[ 6 ] . '</td>';
	echo '<td>' . $row[ 7 ] . '</td>';
	echo '<td>' . $row[ 8 ] . '</td>';
	echo '<td>' . $row[ 9 ] . '</td>';
	echo '<td>' . $row[ 12 ] . '</td>';
	echo '<td>' . $row[ 13 ] . '</td>';
	echo '<td>' . $row[ 14 ] . '</td>';
	echo '<td><a style="color:blue"  href="http://mscidwd.bch.ed.ac.uk/s1986520/test_1/dispaly.php?cid=' . $row[ 0 ] . '">Link</a></td>';
	echo '</tr>';
  }
echo "</tbody>";
echo "</table>";
echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    }
  } else {
     echo '<p><b>No query is given! </b>Return to<a class="contentInd" href="Property_select.php">Property Search page.</a>[Click]</p>';
  }

echo <<<_TAIL1
</body>
</html>
_TAIL1;
function get_post($var)
{
  return mysql_real_escape_string($_POST[$var]);
}
?>
</div>

