<?php
session_start();
?>

<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
$dbfs = array( "natm", "ncar", "nnit", "noxy", "nsul", "ncycl", "nhdon", "nhacc", "nrotb", "mw", "TPSA", "XLogP" );
?>


<div id="write" class="container">
<form action="feature_selection.php" method="post">
	<h2>Statistics by Features</h2>
	<hr>
	<p>You can select one or more Feartures.</p>
	<div class="inbox">  
		<div class="item">
			<input type="checkbox" name="natm">
			<p class="featureTable">Number of Atoms &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
			<input type="checkbox" name="ncar">
			<p class="featureTable">Number of Carbons</p>
		</div>
		<div class="item">
			<input type="checkbox" name="nnit">
			<p class="featureTable">Number of Nitrogens &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
			<input type="checkbox" name="noxy">
			<p class="featureTable">Number of Oxygens</p>
		</div>
		<div class="item">
			<input type="checkbox" name="nsul">
			<p class="featureTable">Number of Sulphurs &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
			<input type="checkbox" name="ncycl">
			<p class="featureTable">Number of Cycles</p>
		</div>
		<div class="item">
			<input type="checkbox" name="nhdon">
			<p class="featureTable">Number of Hydrogen Donors &nbsp;</p>
			<input type="checkbox" name="nhacc">
			<p class="featureTable">Number of Hydrogen Acceptors</p>
		</div>
		<div class="item">
			<input type="checkbox" name="nrotb">
			<p class="featureTable">Number of Rotatable Bonds &nbsp; &nbsp;</p>
			<input type="checkbox" name="mw">
			<p class="featureTable">Molecular Weight</p>
		</div>
		<div class="item">
			<input type="checkbox" name="TPSA">
			<p class="featureTable">The Polar Surface Area &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
			<input type="checkbox" name="XLogP">
			<p class="featureTable">Estimated LogP</p>
		</div>
		<div class="item">
			<input class="button" type="submit" value="Submit">
		</div>	
	</div>
	<script  src="script.js"></script>
</form>


<h2>Results of feature(s) statistics</h2>
<hr>


<?php
// Results
if ( !empty( $_POST ) ) {
	echo <<<_MAIN2
	<table class="pure-table tablesorter" align="center" id="myTable">
    <thead>
    <th>Features</th>
    <th>Average</th>
    <th>Maximum</th>
    <th>Minimum</th>
    <th>Standard Deviation</th>
    <th>Variance</th>
  </tr>
    </thead>
    
        <tbody>

_MAIN2;


	// connect to MySQL
// the information is stored in login.php
	$db_server = mysql_connect( $db_hostname, $db_username, $db_password );
	if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
	mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );

	// calculate the average and standard deviation for the chosen feature
	if ( $_POST[ 'natm' ] == on ) {
		// claculate the statistics
		// sprintf: Return a formatted string
		$query = sprintf( "SELECT AVG(natm), MAX(natm), MIN(natm), STDDEV(natm), VARIANCE(natm) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Atoms</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'ncar' ] == on ) {
		$query = sprintf( "SELECT AVG(ncar), MAX(ncar), MIN(ncar), STDDEV(ncar), VARIANCE(ncar) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Carbons</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'nnit' ] == on ) {
		$query = sprintf( "SELECT AVG(nnit), MAX(nnit), MIN(nnit), STDDEV(nnit), VARIANCE(nnit) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Nitrogens</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'noxy' ] == on ) {
		$query = sprintf( "SELECT AVG(noxy), MAX(noxy), MIN(noxy), STDDEV(noxy), VARIANCE(noxy) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Oxygens</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'nsul' ] == on ) {
		$query = sprintf( "SELECT AVG(nsul), MAX(nsul), MIN(nsul), STDDEV(nsul), VARIANCE(nsul) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Sulphurs</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'ncycl' ] == on ) {
		$query = sprintf( "SELECT AVG(ncycl), MAX(ncycl), MIN(ncycl), STDDEV(ncycl), VARIANCE(ncycl) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Cycles</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'nhdon' ] == on ) {
		$query = sprintf( "SELECT AVG(nhdon), MAX(nhdon), MIN(nhdon), STDDEV(nhdon), VARIANCE(nhdon) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Hydrogen Donors</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'nhacc' ] == on ) {
		$query = sprintf( "SELECT AVG(nhacc), MAX(nhacc), MIN(nhacc), STDDEV(nhacc), VARIANCE(nhacc) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Hydrogen Acceptors</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'nrotb' ] == on ) {
		$query = sprintf( "SELECT AVG(nrotb), MAX(nrotb), MIN(nrotb), STDDEV(nrotb), VARIANCE(nrotb) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Number of Rotatable Bonds</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'mw' ] == on ) {
		$query = sprintf( "SELECT AVG(mw), MAX(mw), MIN(mw), STDDEV(mw), VARIANCE(mw) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Molecular Weight</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'TPSA' ] == on ) {
		$query = sprintf( "SELECT AVG(TPSA), MAX(TPSA), MIN(TPSA), STDDEV(TPSA), VARIANCE(TPSA) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>The Polar Surface Area</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	if ( $_POST[ 'XLogP' ] == on ) {
		$query = sprintf( "SELECT AVG(XLogP), MAX(XLogP), MIN(XLogP), STDDEV(XLogP), VARIANCE(XLogP) FROM Compounds" );
		$result = mysql_query( $query );
		$row = mysql_fetch_row( $result );
		echo '<tr>';
		echo "<td>Estimated LogP</td>";
		echo '<td>' .round($row[ 0 ], 4) . '</td>';
		echo '<td>' .round($row[ 1 ], 4) . '</td>';
		echo '<td>' .round($row[ 2 ], 4) . '</td>';
		echo '<td>' .round($row[ 3 ], 4) . '</td>';
		echo '<td>' .round($row[ 4 ], 4) . '</td>';
		echo '</tr>';

	}
	echo '</tbody>';
	echo '</table>';
	echo "</div>";
} else {
	echo "<p>No query is given!";
	echo "<br>";
	echo "</p>";
	echo "</div>";

}

mysql_close( $db_server );

echo <<<_TAIL1
<br>
<br>
<br>
</body>
</html>
_TAIL1;
?>


</div>