<?php
session_start();
?>

<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
?>


<div id="write" class="container">
<h2>1. SMILES Display</h2><hr>


<?php
require_once 'login.php';
if ( isset( $_GET[ 'cid' ] ) ) {
	$db_server = mysql_connect( $db_hostname, $db_username, $db_password );
	if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
	mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );
	$cid = $_GET[ 'cid' ];
	$query = "SELECT * FROM Smiles WHERE cid = $cid";
	$result = mysql_query( $query );
	if ( !result )die( "unable to process query: " . mysql_error() );
	$row = mysql_fetch_row( $result );

	// fetch the smile string
	$mysmiles = $row[ 2 ];

	// convert to url
	$convurl = "https://cactus.nci.nih.gov/chemical/structure/" . urlencode( $mysmiles ) . "/image";

	$convstr = base64_encode( file_get_contents( $convurl ) );

	echo "<p><b>The 2D structure of Compound $cid</b></p><br>";

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

}

?>

<br>
<h2>2. JSmol Display</h2><hr>
<p><b>The 3D structure of Compound <?php echo $cid ?></b></p>
<p><b>Note:</b> You can zoom and rotate the model by cliking the 'spin on/off' button or with your mouce.</p>
<center><script type="text/javascript" src="https://chemapps.stolaf.edu/jmol/jmol.php?model=<?php echo $mysmiles?>&inline"></script><center>
<script>jmolCheckbox('spin on','spin off',"spin on/off")</script>
<br>


<h2>3. Molecule File</h2><hr>
<p><b>SDF format of Compound <?php echo $cid ?></b></p>
<textarea id="content" rows="20" cols="180" style="text-align: left;width: 50%;font-size: 15px;"><?php echo $sdf ?></textarea>
<br>
<br>
<br>
<br>



</div>

