<?php
session_start();
?>

<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
?>

<div id="write" class="container">
<h2>1. Catalogue Name Serch</h2>
<hr>

<p>You can get the 2D, 3D and SDF format file by searching the catalogue name of a compound.<br>(e.g SPH1-000-419, SPH1-002-081, SPH1-002-085.)</p><br>


<form action="catName_search.php" method="post">
<pre>
	Input a Catalogue Name:<input type="text" name="catn" placeholder="SPH1-000-419" autocomplete="on" size="30"><br>
	<button type="submit" value="list">Submit</button>
</pre>
</form>

<br>
<h2>2. Molecule Display</h2>
<hr>


<?php
require_once 'login.php';

if ( isset( $_POST[ 'catn' ] ) ) {
	$db_server = mysql_connect( $db_hostname, $db_username, $db_password );
	if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
	mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );
	$catn = get_post('catn');
	$query = "SELECT * FROM Compounds WHERE catn = '".$catn."'";
	$result = mysql_query( $query );
	if ( !result )die( "unable to process query: " . mysql_error() );
	$row = mysql_fetch_row( $result );

	//get the id of the compound
	$cid = $row[0];

	// fetch the smile string
	$query_smile = "SELECT * FROM Smiles WHERE cid=$cid";
	$result_smile = mysql_query( $query_smile );
	if ( !result )die( "unable to process query: " . mysql_error() );
	$row_smile = mysql_fetch_row( $result_smile );
	$mysmiles = $row_smile[ 2 ];

	// convert to url
	$convurl = "https://cactus.nci.nih.gov/chemical/structure/" . urlencode( $mysmiles ) . "/image";

	$convstr = base64_encode( file_get_contents( $convurl ) );

	echo "<h2>1) SMILES Display</h2>";

	echo "<p><b>The 2D structure of $catn</b></p><br>";

	// display the image
	echo '<img src="data:image/gif;base64,' . $convstr . '"/>';

	echo "<p><b>The Simplified Molecular string is: </b><p>";
	echo '<p style="font-size:16px;">' .$mysmiles. '</p>';


	// get the sdf format of the compound
	$query_sdf = "SELECT molecule FROM Molecules WHERE cid = $cid";
	$result_sdf = mysql_query( $query_sdf );
  	if ( !result )die( "unable to process query: " . mysql_error() );
  	$row_sdf = mysql_fetch_row( $result_sdf );
  	$sdf = base64_decode( $row_sdf[ 0 ] );

	mysql_close( $db_server );

	//resukt
	echo "<br>";
	echo "<h2>2) JSmol Display</h2>";
	echo "<p><b>The 3D structure of $catn</b></p>";
	echo "<p><b>Note:</b> You can zoom and rotate the model by cliking the 'spin on/off' button or with your mouce.</p>";
	echo '<center><script type="text/javascript" src="https://chemapps.stolaf.edu/jmol/jmol.php?model='.$mysmiles.'&inline"></script><center>';
	echo '<script>jmolCheckbox("spin on","spin off","spin on/off")</script>';
	echo "<br>";

	echo "<h2>3) Molecule File</h2>";
	echo "<p><b>SDF format of $catn</b></p>";
	echo '<textarea id="content" rows="20" cols="180" style="text-align: left;width: 50%;font-size: 15px;">'.$sdf.'</textarea>';
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";

}else{
	echo "<p>No query is given!</p>";
}


function get_post($var)
{
  return mysql_real_escape_string($_POST[$var]);
}

?>




</div>