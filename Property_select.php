<?php
session_start();
?>

<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
?>

<?php
// conected to MySQL
$db_server = mysql_connect( $db_hostname, $db_username, $db_password );
if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );
$query = "select * from Manufacturers";
$result = mysql_query( $query );
if ( !$result )die( "unable to process query: " . mysql_error() );
$rows = mysql_num_rows( $result );
$smask = $_SESSION[ 'supmask' ];


for ( $j = 0; $j < $rows; ++$j ) {
	$row = mysql_fetch_row( $result );
	$sid[ $j ] = $row[ 0 ];
	$snm[ $j ] = $row[ 1 ];
	$sact[ $j ] = 0;
	$tvl = 1 << ( $sid[ $j ] - 1 );
	if ( $tvl == ( $tvl & $smask ) ) {
		$sact[ $j ] = 1;
	}
}
if ( isset( $_POST[ 'supplier' ] ) ) {
	$supplier = $_POST[ 'supplier' ];

	
	$nele = sizeof( $supplier );

	
	for ( $k = 0; $k < $rows; ++$k ) {
		$sact[ $k ] = 0;
		for ( $j = 0; $j < $nele; ++$j ) {
			
			if ( strcmp( $supplier[ $j ], $snm[ $k ] ) == 0 )$sact[ $k ] = 1;
		}
	}

	// update $smask
	$smask = 0;
	for ( $j = 0; $j < $rows; ++$j ) {
		if ( $sact[ $j ] == 1 ) {
			$smask = $smask + ( 1 << ( $sid[ $j ] - 1 ) );
		}
	}
	$_SESSION[ 'supmask' ] = $smask;
}
?>

<div id="write" class="container">
	<h2>
		Step 1: Select Manufacturers
	</h2><hr>
	<p>All the five manufacturers will be selected by default.</p>

<?php
	echo '<form method="post">';
for ( $j = 0; $j < $rows; ++$j ) {
	echo '<label style="display: inline;max-width: 70%;margin-bottom: 12px;font-weight: 700;font-family: optima, sans-serif;font-size: 16px;">';
	echo '<input type="checkbox" name="supplier[]" value="';
	echo $snm[ $j ];
	echo '" checked="">';
	echo $snm[ $j ];
	echo "\n";
	echo '</label>';
}

echo <<<_TAIL1
<input type="submit" value="Submit" />
</form>
_TAIL1;
?>


<h2>
	Step 2: Search by Property<hr>
</h2>
<p>
	The following results have been filtered by Step1, you can go back to reset the suppliers.<br>
</p>

<?php
// show currently selected suppliers to the screen
echo '<p><b>The selected supplier(s) : </b> ';
$array = [];
for ( $j = 0; $j < $rows; ++$j ) {
	if ( $sact[ $j ] == 1 ) {
		array_push( $array, $snm[ $j ] );
		
	}
}
$_SESSION[ "select_man" ] = $array;
echo '<p style="color:red;">';
echo implode( ", ", $array );
echo '</p>';
?>

<div> 
<form action="Property_result.php" method="post">
		<pre>
<b>Please select one characteristic to dispaly:</b><br>
Molecular Weight (MW)        <input type="radio" name="tgval" value="mw">
Polar Surface Area (TPSA)    <input type="radio" name="tgval" value="TPSA">
Estimated LogP (XLogP)       <input type="radio" name="tgval" value="XLogP">

<b>Note: </b>The results retrieved based on your input value allows -/+ 1 deviation for MW and -/+ 0.1 deviations for TPSA and XlogP.<br>

Value:  <input type="number" ng-model="number" max="744" min="-5" name="cval">
		</pre>
		<button type="submit" value="Ok">Submit</button>
</form>
</div>



<?php

//CONNECT TO MYSQL
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());     
$query = "select * from Manufacturers";
$result = mysql_query($query);
if(!$result) die("unable to process query: " . mysql_error());
$manrows = mysql_num_rows($result);
$manarray = array();
for($j = 0 ; $j < $manrows ; ++$j)
  {
    $row = mysql_fetch_row($result);
    $manarray[$j] = $row[1];
  }

echo <<<_TAIL1
</table>
<br>
<br>
<br>
<br>
<br>
_TAIL1;
?>

</div>



