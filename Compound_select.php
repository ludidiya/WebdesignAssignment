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
	// manufacture id
	$sid[ $j ] = $row[ 0 ];
	// manufacture name
	$snm[ $j ] = $row[ 1 ];
	// 
	$sact[ $j ] = 0;
	$tvl = 1 << ( $sid[ $j ] - 1 );
	if ( $tvl == ( $tvl & $smask ) ) {
		$sact[ $j ] = 1;
	}
}
if ( isset( $_POST[ 'manufacturer' ] ) ) {
	$manufacturer = $_POST[ 'manufacturer' ];

	// number of selections
	$nele = sizeof( $manufacturer );

	for ( $k = 0; $k < $rows; ++$k ) {
		$sact[ $k ] = 0;
		for ( $j = 0; $j < $nele; ++$j ) {
			if ( strcmp( $manufacturer[ $j ], $snm[ $k ] ) == 0 )$sact[ $k ] = 1;
		}
	}

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
		Step 1: Select Manufacturers<hr>
	</h2><br>
	<p>All the five manufacturers will be selected by default.</p>

<?php
	echo '<form method="post">';
for ( $j = 0; $j < $rows; ++$j ) {
	echo '<label style="display: inline;max-width: 70%;margin-bottom: 12px;font-weight: 700;font-family: optima, sans-serif;font-size: 16px;">';
	echo '<input type="checkbox" name="manufacturer[]" value="';
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
	Step 2: Search by Compound<hr>
</h2>
<p>
	The following results have been filtered by Step1, you can go back to reset the manufacturers.<br>
</p>

<?php
// show currently selected suppliers to the screen
echo '<p><b>The selected manufacturer(s) : </b></p> ';
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

<p>Now, input some compound ranges to filter data. The reasonable maximum minimum for each component has been given. <b>Please don't go out of range!</b></p>


<?php
//connect to the mysql
$db_server = mysql_connect($db_hostname,$db_username,$db_password);
if(!$db_server) die("Unable to connect to database: " . mysql_error());
mysql_select_db($db_database,$db_server) or die ("Unable to select database: " . mysql_error());     
$query = "select * from Manufacturers";
$result = mysql_query($query);
if(!$result) die("unable to process query: " . mysql_error());
$rows = mysql_num_rows($result);
$smask = $_SESSION["supmask"];


$firstmn = False;
$mansel = "(";
for ( $j = 0; $j < $rows; ++$j ) {
	$row = mysql_fetch_row( $result );
	// the id of manufacturer
	$sid[ $j ] = $row[ 0 ];
	// manufacturer name
	$snm[ $j ] = $row[ 1 ];
	$sact[ $j ] = 0;
	$tvl = 1 << ( $sid[ $j ] - 1 );
	if ( $tvl == ( $tvl & $smask ) ) {
		$sact[ $j ] = 1;
		if ( $firstmn )$mansel = $mansel . " or ";
		$firstmn = True;
		$mansel = $mansel . " (ManuID = " . $sid[ $j ] . ")";
	}
}
$mansel = $mansel . ")";
$setpar = isset( $_POST[ 'natmax' ] );



echo <<<_TAIL1
   <form action="Compound_result.php" method="post">
   <div>
   <pre>
   Number of Atoms			Min      <input type="text" name="natmin" placeholder="14" autocomplete="off"/>		Max      <input type="text" name="natmax" placeholder="81" autocomplete="off"/>

   Number of Carbons			Min      <input type="text" name="ncrmin" placeholder="3" autocomplete="off"/>		Max      <input type="text" name="ncrmax" placeholder="37" autocomplete="off"/>

   Number of Nitrogens			Min      <input type="text" name="nntmin" placeholder="2" autocomplete="off"/>		Max      <input type="text" name="nntmax" placeholder="4" autocomplete="off"/>

   Number of Oxygens			Min      <input type="text" name="noxmin" placeholder="2" autocomplete="off"/>		Max      <input type="text" name="noxmax" placeholder="4" autocomplete="off"/>

   Number of Sulphurs			Min      <input type="text" name="nsulmin" placeholder="0" autocomplete="off"/>		Max      <input type="text" name="nsulmax" placeholder="4" autocomplete="off"/>

   Number of Cycles			Min      <input type="text" name="ncyclmin" placeholder="0" autocomplete="off"/>		Max      <input type="text" name="ncyclmax" placeholder="6" autocomplete="off"/>

   Number of Hydrogen Donors		Min      <input type="text" name="nhdonmin" placeholder="0" autocomplete="off"/>		Max      <input type="text" name="nhdonmax" placeholder="6" autocomplete="off"/>

   Number of Hydrogen Acceptors		Min      <input type="text" name="nhaccmin" placeholder="0" autocomplete="off"/>		Max      <input type="text" name="nhaccmax" placeholder="8" autocomplete="off"/>

   Number of Rotatable Bonds		Min      <input type="text" name="nrotbmin" placeholder="3" autocomplete="off"/>		Max      <input type="text" name="nrotbmax" placeholder="6" autocomplete="off"/> 
										
										<input type="submit" value="Submit" />
</pre>
</div>
</form>
<br>
<br>
<br><br>
_TAIL1;

mysql_close( $db_server );

?> 

</div>

