<?php
session_start();
?>

<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
?>

<div id="write" class="container">
<h2>Compound search result</h2>
<hr>


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

	// manufacturer id
	$sid[ $j ] = $row[ 0 ];

	// manufacturer name
	$snm[ $j ] = $row[ 1 ];

	// build the first part of command
	// containing selected ManuID
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


// overloop

if ( $setpar ){
	$firstsl = False;
	$compsel = "SELECT * FROM Compounds WHERE (";
	if ( ( $_POST[ 'natmax' ] != "" ) && ( $_POST[ 'natmin' ] != "" ) ) {
		$compsel = $compsel . "(natm >= " . get_post( 'natmin' ) . " and  natm <= " . get_post( 'natmax' ) . ")";
		$firstsl = True;
	}
	if ( ( $_POST[ 'ncrmax' ] != "" ) && ( $_POST[ 'ncrmin' ] != "" ) ) {
		if ( $firstsl )$compsel = $compsel . " and ";
		$compsel = $compsel . "(ncar >= " . get_post( 'ncrmin' ) . " and  ncar <= " . get_post( 'ncrmax' ) . ")";
		$firstsl = True;
	}
	if ( ( $_POST[ 'nntmax' ] != "" ) && ( $_POST[ 'nntmin' ] != "" ) ) {
		if ( $firstsl )$compsel = $compsel . " and ";
		$compsel = $compsel . "(nnit >= " . get_post( 'nntmin' ) . " and  nnit <= " . get_post( 'nntmax' ) . ")";
		$firstsl = True;
	}
	if ( ( $_POST[ 'noxmax' ] != "" ) && ( $_POST[ 'noxmin' ] != "" ) ) {
		if ( $firstsl )$compsel = $compsel . " and ";
		$compsel = $compsel . "(noxy >= " . get_post( 'noxmin' ) . " and  noxy <= " . get_post( 'noxmax' ) . ")";
		$firstsl = True;
	}
	if ( ( $_POST[ 'nsulmax' ] != "" ) && ( $_POST[ 'nsulmin' ] != "" ) ) {
		if ( $firstsl )$compsel = $compsel . " and ";
		$compsel = $compsel . "(noxy >= " . get_post( 'nsulmin' ) . " and  noxy <= " . get_post( 'nsulmax' ) . ")";
		$firstsl = True;
	}
	if ( ( $_POST[ 'ncyclmax' ] != "" ) && ( $_POST[ 'ncyclmin' ] != "" ) ) {
		if ( $firstsl )$compsel = $compsel . " and ";
		$compsel = $compsel . "(noxy >= " . get_post( 'ncyclmin' ) . " and  noxy <= " . get_post( 'ncyclmax' ) . ")";
		$firstsl = True;
	}
	if ( ( $_POST[ 'nhdonmax' ] != "" ) && ( $_POST[ 'nhdonmin' ] != "" ) ) {
		if ( $firstsl )$compsel = $compsel . " and ";
		$compsel = $compsel . "(noxy >= " . get_post( 'nhdonmin' ) . " and  noxy <= " . get_post( 'nhdonmax' ) . ")";
		$firstsl = True;
	}
	if ( ( $_POST[ 'nhaccmax' ] != "" ) && ( $_POST[ 'nhaccmin' ] != "" ) ) {
		if ( $firstsl )$compsel = $compsel . " and ";
		$compsel = $compsel . "(noxy >= " . get_post( 'nhaccmin' ) . " and  noxy <= " . get_post( 'nhaccmax' ) . ")";
		$firstsl = True;
	}
	if ( ( $_POST[ 'nrotbmax' ] != "" ) && ( $_POST[ 'nrotbmin' ] != "" ) ) {
		if ( $firstsl )$compsel = $compsel . " and ";
		$compsel = $compsel . "(noxy >= " . get_post( 'nrotbmin' ) . " and  noxy <= " . get_post( 'nrotbmax' ) . ")";
		$firstsl = True;
	}
	// stop search



	// show table
	if ( $firstsl ){
		$compsel = $compsel.") and ".$mansel;
    
    	echo "\n";
    	$result = mysql_query($compsel);
    	if(!result) die("unable to process query: " . mysql_error());
    	$rows = mysql_num_rows($result);

    	if($rows > 100) {
    			echo "<p>It has <b>", $rows, "</b> results. The fist 100 compounds are displayed.</p>";
		echo '<p>Return to<a class="contentInd" href="Compound_select.php">Compound Search page.</a>[Click]</p>';

		$rows = 100;
		echo <<<_TAB1
		<table align="center" id="myTable">
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
            <th>nHydroD</th>
            <th>nHydroA</th>
            <th>nRotB</th>
            <th>MW</th>
            <th>TPSA</th>
            <th>LogP</th>
            <th>Display</th>
        </tr>
    </thead>
	<tbody>
_TAB1;
		for ($j=0; $j < $rows; $j++) { 
			$row = mysql_fetch_row( $result );
			if ( $row[ 10 ] == 1 ) {
				$row[ 10 ] = "Asinex";
			} else if ( $row[ 10 ] == 2 ) {
				$row[ 10 ] = "KeyOrganics";
			} else if ( $row[ 10 ] == 3 ) {
				$row[ 10 ] = "MayBridge";
			} else if ( $row[ 10 ] == 4 ) {
				$row[ 10 ] = "Nanosyn";
			} else if ( $row[ 10 ] == 5 ) {
				$row[ 10 ] = "Oai40000";
			}
			echo '<tr>';
			echo '<td>' . $row[ 0 ] . '</td>';
			echo '<td>' . $row[ 11 ] . '</td>';
			echo '<td>' . $row[ 10 ] . '</td>';
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
		echo '</tbody>';
		echo '</table>';
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<br>";
    	}//if($rows > 100)
    	else if($rows==0){
    	echo '<p>No query is found';
		echo '<p>Return to <a class="contentInd" href="Compound_select.php">Compound Search page.</a> [Click]</p>';
    	}// else if($rows==0)
    	else{
		echo "<p>It has <b>", $rows, "</b> results.</p>";
		echo '<p>Return to<a class="contentInd" href="Compound_select.php">Compound Search page.</a>[Click]</p>';
		echo <<<_TAB1
		<table align="center" id="myTable">
    <thead>
        <tr>
            <th>compID</th>
            <th>catName</th>
            <th>Manu</th>
            <th>nAtm</th>
            <th>nCar</th>
            <th>nNit</th>
            <th>nOxy</th>
            <th>nSul</th>
            <th>nCycl</th>
            <th>nHydroDon</th>
            <th>nHydroAcc</th>
            <th>nRotBon</th>
            <th>MW</th>
            <th>TPSA</th>
            <th>LogP</th>
            <th>Display</th>
        </tr>
    </thead>
	<tbody>
_TAB1;
		for ( $j = 0; $j < $rows; ++$j ) {
			$row = mysql_fetch_row( $result );
			if ( $row[ 10 ] == 1 ) {
				$row[ 10 ] = "Asinex";
			} else if ( $row[ 10 ] == 2 ) {
				$row[ 10 ] = "KeyOrganics";
			} else if ( $row[ 10 ] == 3 ) {
				$row[ 10 ] = "MayBridge";
			} else if ( $row[ 10 ] == 4 ) {
				$row[ 10 ] = "Nanosyn";
			} else if ( $row[ 10 ] == 5 ) {
				$row[ 10 ] = "Oai40000";
			}
			echo '<tr>';
			echo '<td>' . $row[ 0 ] . '</td>';
			echo '<td>' . $row[ 11 ] . '</td>';
			echo '<td>' . $row[ 10 ] . '</td>';
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
		echo '</tbody>';
		echo '</table>';
		echo "<br>";
		echo "<br>";
		echo "<br>";
		echo "<br>";
    	}// 

	} // if ( $firstsl )
	else{
		echo '<p>No query is given!';
		echo '<p>Return to <a class="contentInd" href="Compound_select.php">Compound Search page.</a> [Click]</p>';
	}
}//  if ( $setpar )

function get_post( $var ) {
	return mysql_real_escape_string( $_POST[ $var ] );
}

mysql_close( $db_server );
?>


</div>
