<?php
session_start();
?>
<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
$dbfs = array( "natm", "ncar", "nnit", "noxy", "nsul", "ncycl", "nhdon", "nhacc", "nrotb", "mw", "TPSA", "XLogP" );
$nms = array( "number of atoms", "number of carbons", "number of nitrogens", "number of oxygens", "number of sulphurs", "number of cycles", "number of hydrogen donors", "number of hydrogen acceptors", "nu
mber of rotatable bonds", "molecular weight", "the polar surface area", "estimated LogP" );
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

  <h2>Statistics of Correlation</h2><hr>

 <h2>
    Step 1: Select Manufacturers
  </h2>
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

<h2>Step 2: Select two features</h2>
<hr>

<?php
// show currently selected suppliers to the screen
$array = [];
for ( $j = 0; $j < $rows; ++$j ) {
  if ( $sact[ $j ] == 1 ) {
    array_push( $array, $snm[ $j ] );
    
  }
}
$_SESSION[ "select_man" ] = $array;
echo '<p>The correlation between any two features will be calculated using all the compounds from: <font color="red"> '.implode( ", ", $array ). '</font> (Go back to Step 1 to change the selection)</p><br>';
?>


<div id="featuresExpression" style="background-color: #EEEEEE;height: 450px;/* height: 399px; */width: 500px;float: left;text-align:left;font-family:optima,sans-serif;font-size:15px;line-height:30px;padding: 15px 39px;">
	<b>Features and Abbreviation</b><br>
	<b>&nbsp&nbsp1. natm</b>: Number of Atoms<br>
	<b>&nbsp&nbsp2. ncar</b>: Number of Carbons<br>
	<b>&nbsp&nbsp3. nnit</b>: Number of Nitrogens<br>
	<b>&nbsp&nbsp4. noxy</b>: Number of Oxygens<br>
	<b>&nbsp&nbsp5. nsul</b>: Number of Sulphurs<br>
	<b>&nbsp&nbsp6. ncycl</b>: Number of Cycles<br>
	<b>&nbsp&nbsp7. nhdon</b>: Number of Hydrogen Donors<br>	
	<b>&nbsp&nbsp8. nhacc</b>: Number of Hydrogen Acceptors<br>
	<b>&nbsp&nbsp9. nrotb</b>: Number of Rotatable Bonds<br>
	<b>&nbsp&nbsp10 mw</b>: Molecular Weight<br>
	<b>&nbsp&nbsp11. TPSA</b>: The Polar Surface Area<br>	
	<b>&nbsp&nbsp12. XLogP</b>: Estimated LogP	
</div>

<div id="selection" style="background-color: #EEEEEE;height: 450px;width: 500px;float: right;font-family: optima, sans-serif;text-align: left;padding: 15px 20px;font-size: 15px;">
	<form action="correlation.php" method="post">
		<label>Feature 1</label>
		<select name="F1">
			<option selected="">natm</option>
			<option>ncar</option>
			<option>nnit</option>
			<option>noxy</option>
			<option>nsul</option>
			<option>ncycl</option>
			<option>nhdon</option>
			<option>nhacc</option>
			<option>nrotb</option>
			<option>mw</option>
			<option>TPSA</option>
			<option>XLogP</option>
		</select>
		<label>&nbsp&nbspFeature 2</label>
		<select name="F2">
			<option>natm</option>
			<option selected="">ncar</option>
			<option>nnit</option>
			<option>noxy</option>
			<option>nsul</option>
			<option>ncycl</option>
			<option>nhdon</option>
			<option>nhacc</option>
			<option>nrotb</option>
			<option>mw</option>
			<option>TPSA</option>
			<option>XLogP</option>
		</select>
		<input type="submit" value="Submit">
	</form>



<?php
if ( isset( $_POST[ 'F1' ] ) && isset( $_POST[ 'F2' ] ) ) {
  $select1 = 0;
  $select2 = 0;

  $value1 = $_POST[ 'F1' ];
  $value2 = $_POST[ 'F2' ];

  for ( $j = 0; $j < sizeof( $dbfs ); ++$j ) {
    if ( strcmp( $dbfs[ $j ], $value1 ) == 0 )$select1 = $j;
  }
  for ( $j = 0; $j < sizeof( $dbfs ); ++$j ) {
    if ( strcmp( $dbfs[ $j ], $value2 ) == 0 )$select2 = $j;
  }

  $db_server = mysql_connect( $db_hostname, $db_username, $db_password );
  if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
  mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );
  $query = "select * from Manufacturers";
  $result = mysql_query( $query );
  if ( !$result )die( "unable to process query: " . mysql_error() );
  $rows = mysql_num_rows( $result );
  $smask = $_SESSION[ 'supmask' ];

  $firstmn = False;
  $mansel = "(";
  for ( $j = 0; $j < $rows; ++$j ) {
    $row = mysql_fetch_row( $result );
    $sid[ $j ] = $row[ 0 ];
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

  $comtodo = "./correlate3.py " . $dbfs[ $select1 ] . " " . $dbfs[ $select2 ] . " \"" . $mansel . "\"";
  echo '<br>';
  echo "<b>Result:</b>";
  echo "<br>";
  echo "<br>";
  echo "<pre>";
  printf( "<p>Correlation between <b>%s</b> and <b>%s</b> is: <br>", $nms[ $select1 ], $nms[ $select2 ] );
  $rescor = system( $comtodo );
  printf("\n" );
  echo "</pre>";
}else {
  echo '<br>';
  echo "<b>Result:</b>";
  echo "<br>";
  echo "<br>";
  echo '<pre><p style="color:red;"">Choose two features and click Submit to see the resul!</p></pre><br><br><br>';
}



echo <<<_TAIL1
</div>
</div>
<br>
<br>
<br>
</body>
</html>
_TAIL1;
mysql_close( $db_server );
?>


