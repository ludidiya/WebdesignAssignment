<?php
session_start();
?>

<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
?>


<div id="write" class="container">
<form action="Manufacture.php" method="post">
	<h2>Statistics by Manufacturers</h2>
	<hr>
	<p>You can select one or more Manuefacturers.</p>
	<div class="inbox">  
		<div class="item">
			<input type="checkbox" name="1">
			<p class="featureTable">Asinex</p>
		</div>
		<div class="item">
			<input type="checkbox" name="2">
			<p class="featureTable">KeyOrganics</p>
		</div>
		<div class="item">
			<input type="checkbox" name="3">
			<p class="featureTable">MayBridge</p>
		</div>
		<div class="item">
			<input type="checkbox" name="4">
			<p class="featureTable">Nanosyn</p>
		</div>
		<div class="item">
			<input type="checkbox" name="5">
			<p class="featureTable">Oai40000</p>
		</div>
		<div class="item">
			<input  class="button" type="submit" value="Submit" />
		</div>	
	</div>
	<script  src="script.js"></script>
</form>

<h2>Results of Manufacturer(s) statistics</h2>
<hr>


<?php
// Results
if ( !empty( $_POST ) ) {
	echo <<<_MAIN2
	<table align="center" id="myTable">
    <thead>
    <tr>
    <th>Manufacturer</th>
    <th>Features</th>
	<th>Average</th>
    <th>Maximum</th>
    <th>Minimum</th>
  </tr>
    </thead>
    
        <tbody>

_MAIN2;

// the information is stored in login.php
	$db_server = mysql_connect( $db_hostname, $db_username, $db_password );
	if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
	mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );


	if ($_POST['1']==on){
		// buid command to get the statistics of each feature in sepecific manufacture
	    //1. natm
	    $query_natm = sprintf( "SELECT AVG(natm), MAX(natm), MIN(natm) FROM Compounds WHERE ManuID=1" );
	    $result_natm = mysql_query( $query_natm );
		$row_natm = mysql_fetch_row( $result_natm );
		//2. ncar
		$query_ncar = sprintf( "SELECT AVG(ncar), MAX(ncar), MIN(ncar) FROM Compounds WHERE ManuID=1" );
	    $result_ncar = mysql_query( $query_ncar );
		$row_ncar = mysql_fetch_row( $result_ncar );
		//3. nnit
		$query_nnit = sprintf( "SELECT AVG(nnit), MAX(nnit), MIN(nnit) FROM Compounds WHERE ManuID=1" );
	    $result_nnit = mysql_query( $query_nnit );
		$row_nnit = mysql_fetch_row( $result_nnit );
		//4. noxy
		$query_noxy = sprintf( "SELECT AVG(noxy), MAX(noxy), MIN(noxy) FROM Compounds WHERE ManuID=1" );
	    $result_noxy = mysql_query( $query_noxy );
		$row_noxy = mysql_fetch_row( $result_noxy );
		//5. nsul
		$query_nsul = sprintf( "SELECT AVG(nsul), MAX(nsul), MIN(nsul) FROM Compounds WHERE ManuID=1" );
	    $result_nsul = mysql_query( $query_nsul );
		$row_nsul = mysql_fetch_row( $result_nsul );
		//6. ncycl
		$query_ncycl = sprintf( "SELECT AVG(ncycl), MAX(ncycl), MIN(ncycl) FROM Compounds WHERE ManuID=1" );
	    $result_ncycl = mysql_query( $query_ncycl );
		$row_ncycl = mysql_fetch_row( $result_ncycl );
		//7. nhdon
		$query_nhdon = sprintf( "SELECT AVG(nhdon), MAX(nhdon), MIN(nhdon) FROM Compounds WHERE ManuID=1" );
	    $result_nhdon = mysql_query( $query_nhdon );
		$row_nhdon = mysql_fetch_row( $result_nhdon );
		//8. nhacc
		$query_nhacc = sprintf( "SELECT AVG(nhacc), MAX(nhacc), MIN(nhacc) FROM Compounds WHERE ManuID=1" );
	    $result_nhacc = mysql_query( $query_nhacc );
		$row_nhacc = mysql_fetch_row( $result_nhacc );
		//9. nrotb
		$query_nrotb = sprintf( "SELECT AVG(nrotb), MAX(nrotb), MIN(nrotb) FROM Compounds WHERE ManuID=1" );
	    $result_nrotb = mysql_query( $query_nrotb );
		$row_nrotb = mysql_fetch_row( $result_nrotb );
		//10. mw
		$query_mw = sprintf( "SELECT AVG(mw), MAX(mw), MIN(mw) FROM Compounds WHERE ManuID=1" );
	    $result_mw = mysql_query( $query_mw );
		$row_mw = mysql_fetch_row( $result_mw );
		//11. TPSA
		$query_TPSA = sprintf( "SELECT AVG(TPSA), MAX(TPSA), MIN(TPSA) FROM Compounds WHERE ManuID=1" );
	    $result_TPSA = mysql_query( $query_TPSA );
		$row_TPSA = mysql_fetch_row( $result_TPSA );
		//12. XLogP
		$query_XLogP = sprintf( "SELECT AVG(XLogP), MAX(XLogP), MIN(XLogP) FROM Compounds WHERE ManuID=1" );
	    $result_XLogP = mysql_query( $query_XLogP );
		$row_XLogP = mysql_fetch_row( $result_XLogP );

		// buid the table body
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Atoms</td>";
		echo '<td>' .round($row_natm[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Carbons</td>";
		echo '<td>' .round($row_ncar[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Nitrogens</td>";
		echo '<td>' .round($row_nnit[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Oxygens</td>";
		echo '<td>' .round($row_noxy[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Sulphurs</td>";
		echo '<td>' .round($row_nsul[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Cycles</td>";
		echo '<td>' .round($row_ncycl[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Hydrogen Donors</td>";
		echo '<td>' .round($row_nhdon[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Hydrogen Acceptors	</td>";
		echo '<td>' .round($row_nhacc[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Number of Rotatable Bonds</td>";
		echo '<td>' .round($row_nrotb[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Molecular Weight</td>";
		echo '<td>' .round($row_mw[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>The Polar Surface Area</td>";
		echo '<td>' .round($row_TPSA[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Asinex</td>";
		echo "<td>Estimated LogP</td>";
		echo '<td>' .round($row_XLogP[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 2 ], 4) . '</td>';
		echo "</tr>"; 
		
		

	}
	if ($_POST['2']==on){
		// buid command to get the statistics of each feature in sepecific manufacture
	    //1. natm
	    $query_natm = sprintf( "SELECT AVG(natm), MAX(natm), MIN(natm) FROM Compounds WHERE ManuID=2" );
	    $result_natm = mysql_query( $query_natm );
		$row_natm = mysql_fetch_row( $result_natm );
		//2. ncar
		$query_ncar = sprintf( "SELECT AVG(ncar), MAX(ncar), MIN(ncar) FROM Compounds WHERE ManuID=2" );
	    $result_ncar = mysql_query( $query_ncar );
		$row_ncar = mysql_fetch_row( $result_ncar );
		//3. nnit
		$query_nnit = sprintf( "SELECT AVG(nnit), MAX(nnit), MIN(nnit) FROM Compounds WHERE ManuID=2" );
	    $result_nnit = mysql_query( $query_nnit );
		$row_nnit = mysql_fetch_row( $result_nnit );
		//4. noxy
		$query_noxy = sprintf( "SELECT AVG(noxy), MAX(noxy), MIN(noxy) FROM Compounds WHERE ManuID=2" );
	    $result_noxy = mysql_query( $query_noxy );
		$row_noxy = mysql_fetch_row( $result_noxy );
		//5. nsul
		$query_nsul = sprintf( "SELECT AVG(nsul), MAX(nsul), MIN(nsul) FROM Compounds WHERE ManuID=2" );
	    $result_nsul = mysql_query( $query_nsul );
		$row_nsul = mysql_fetch_row( $result_nsul );
		//6. ncycl
		$query_ncycl = sprintf( "SELECT AVG(ncycl), MAX(ncycl), MIN(ncycl) FROM Compounds WHERE ManuID=2" );
	    $result_ncycl = mysql_query( $query_ncycl );
		$row_ncycl = mysql_fetch_row( $result_ncycl );
		//7. nhdon
		$query_nhdon = sprintf( "SELECT AVG(nhdon), MAX(nhdon), MIN(nhdon) FROM Compounds WHERE ManuID=2" );
	    $result_nhdon = mysql_query( $query_nhdon );
		$row_nhdon = mysql_fetch_row( $result_nhdon );
		//8. nhacc
		$query_nhacc = sprintf( "SELECT AVG(nhacc), MAX(nhacc), MIN(nhacc) FROM Compounds WHERE ManuID=2" );
	    $result_nhacc = mysql_query( $query_nhacc );
		$row_nhacc = mysql_fetch_row( $result_nhacc );
		//9. nrotb
		$query_nrotb = sprintf( "SELECT AVG(nrotb), MAX(nrotb), MIN(nrotb) FROM Compounds WHERE ManuID=2" );
	    $result_nrotb = mysql_query( $query_nrotb );
		$row_nrotb = mysql_fetch_row( $result_nrotb );
		//10. mw
		$query_mw = sprintf( "SELECT AVG(mw), MAX(mw), MIN(mw) FROM Compounds WHERE ManuID=2" );
	    $result_mw = mysql_query( $query_mw );
		$row_mw = mysql_fetch_row( $result_mw );
		//11. TPSA
		$query_TPSA = sprintf( "SELECT AVG(TPSA), MAX(TPSA), MIN(TPSA) FROM Compounds WHERE ManuID=2" );
	    $result_TPSA = mysql_query( $query_TPSA );
		$row_TPSA = mysql_fetch_row( $result_TPSA );
		//12. XLogP
		$query_XLogP = sprintf( "SELECT AVG(XLogP), MAX(XLogP), MIN(XLogP) FROM Compounds WHERE ManuID=2" );
	    $result_XLogP = mysql_query( $query_XLogP );
		$row_XLogP = mysql_fetch_row( $result_XLogP );

		// buid the table body
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Atoms</td>";
		echo '<td>' .round($row_natm[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Carbons</td>";
		echo '<td>' .round($row_ncar[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Nitrogens</td>";
		echo '<td>' .round($row_nnit[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Oxygens</td>";
		echo '<td>' .round($row_noxy[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Sulphurs</td>";
		echo '<td>' .round($row_nsul[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Cycles</td>";
		echo '<td>' .round($row_ncycl[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Hydrogen Donors</td>";
		echo '<td>' .round($row_nhdon[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Hydrogen Acceptors	</td>";
		echo '<td>' .round($row_nhacc[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Number of Rotatable Bonds</td>";
		echo '<td>' .round($row_nrotb[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Molecular Weight</td>";
		echo '<td>' .round($row_mw[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>The Polar Surface Area</td>";
		echo '<td>' .round($row_TPSA[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>KeyOrganics</td>";
		echo "<td>Estimated LogP</td>";
		echo '<td>' .round($row_XLogP[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 2 ], 4) . '</td>';
		echo "</tr>";
		
		 
	}
	if ($_POST['3']==on){
		// buid command to get the statistics of each feature in sepecific manufacture
	    //1. natm
	    $query_natm = sprintf( "SELECT AVG(natm), MAX(natm), MIN(natm) FROM Compounds WHERE ManuID=3" );
	    $result_natm = mysql_query( $query_natm );
		$row_natm = mysql_fetch_row( $result_natm );
		//2. ncar
		$query_ncar = sprintf( "SELECT AVG(ncar), MAX(ncar), MIN(ncar) FROM Compounds WHERE ManuID=3" );
	    $result_ncar = mysql_query( $query_ncar );
		$row_ncar = mysql_fetch_row( $result_ncar );
		//3. nnit
		$query_nnit = sprintf( "SELECT AVG(nnit), MAX(nnit), MIN(nnit) FROM Compounds WHERE ManuID=3" );
	    $result_nnit = mysql_query( $query_nnit );
		$row_nnit = mysql_fetch_row( $result_nnit );
		//4. noxy
		$query_noxy = sprintf( "SELECT AVG(noxy), MAX(noxy), MIN(noxy) FROM Compounds WHERE ManuID=3" );
	    $result_noxy = mysql_query( $query_noxy );
		$row_noxy = mysql_fetch_row( $result_noxy );
		//5. nsul
		$query_nsul = sprintf( "SELECT AVG(nsul), MAX(nsul), MIN(nsul) FROM Compounds WHERE ManuID=3" );
	    $result_nsul = mysql_query( $query_nsul );
		$row_nsul = mysql_fetch_row( $result_nsul );
		//6. ncycl
		$query_ncycl = sprintf( "SELECT AVG(ncycl), MAX(ncycl), MIN(ncycl) FROM Compounds WHERE ManuID=3" );
	    $result_ncycl = mysql_query( $query_ncycl );
		$row_ncycl = mysql_fetch_row( $result_ncycl );
		//7. nhdon
		$query_nhdon = sprintf( "SELECT AVG(nhdon), MAX(nhdon), MIN(nhdon) FROM Compounds WHERE ManuID=3" );
	    $result_nhdon = mysql_query( $query_nhdon );
		$row_nhdon = mysql_fetch_row( $result_nhdon );
		//8. nhacc
		$query_nhacc = sprintf( "SELECT AVG(nhacc), MAX(nhacc), MIN(nhacc) FROM Compounds WHERE ManuID=3" );
	    $result_nhacc = mysql_query( $query_nhacc );
		$row_nhacc = mysql_fetch_row( $result_nhacc );
		//9. nrotb
		$query_nrotb = sprintf( "SELECT AVG(nrotb), MAX(nrotb), MIN(nrotb) FROM Compounds WHERE ManuID=3" );
	    $result_nrotb = mysql_query( $query_nrotb );
		$row_nrotb = mysql_fetch_row( $result_nrotb );
		//10. mw
		$query_mw = sprintf( "SELECT AVG(mw), MAX(mw), MIN(mw) FROM Compounds WHERE ManuID=3" );
	    $result_mw = mysql_query( $query_mw );
		$row_mw = mysql_fetch_row( $result_mw );
		//11. TPSA
		$query_TPSA = sprintf( "SELECT AVG(TPSA), MAX(TPSA), MIN(TPSA) FROM Compounds WHERE ManuID=3" );
	    $result_TPSA = mysql_query( $query_TPSA );
		$row_TPSA = mysql_fetch_row( $result_TPSA );
		//12. XLogP
		$query_XLogP = sprintf( "SELECT AVG(XLogP), MAX(XLogP), MIN(XLogP) FROM Compounds WHERE ManuID=3" );
	    $result_XLogP = mysql_query( $query_XLogP );
		$row_XLogP = mysql_fetch_row( $result_XLogP );

		// buid the table body
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Atoms</td>";
		echo '<td>' .round($row_natm[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Carbons</td>";
		echo '<td>' .round($row_ncar[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Nitrogens</td>";
		echo '<td>' .round($row_nnit[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Oxygens</td>";
		echo '<td>' .round($row_noxy[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Sulphurs</td>";
		echo '<td>' .round($row_nsul[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Cycles</td>";
		echo '<td>' .round($row_ncycl[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Hydrogen Donors</td>";
		echo '<td>' .round($row_nhdon[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Hydrogen Acceptors	</td>";
		echo '<td>' .round($row_nhacc[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Number of Rotatable Bonds</td>";
		echo '<td>' .round($row_nrotb[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Molecular Weight</td>";
		echo '<td>' .round($row_mw[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>The Polar Surface Area</td>";
		echo '<td>' .round($row_TPSA[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>MayBridge</td>";
		echo "<td>Estimated LogP</td>";
		echo '<td>' .round($row_XLogP[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 2 ], 4) . '</td>';
		echo "</tr>"; 
		
	}
	if ($_POST['4']==on){
		// buid command to get the statistics of each feature in sepecific manufacture
	    //1. natm
	    $query_natm = sprintf( "SELECT AVG(natm), MAX(natm), MIN(natm) FROM Compounds WHERE ManuID=4" );
	    $result_natm = mysql_query( $query_natm );
		$row_natm = mysql_fetch_row( $result_natm );
		//2. ncar
		$query_ncar = sprintf( "SELECT AVG(ncar), MAX(ncar), MIN(ncar) FROM Compounds WHERE ManuID=4" );
	    $result_ncar = mysql_query( $query_ncar );
		$row_ncar = mysql_fetch_row( $result_ncar );
		//3. nnit
		$query_nnit = sprintf( "SELECT AVG(nnit), MAX(nnit), MIN(nnit) FROM Compounds WHERE ManuID=4" );
	    $result_nnit = mysql_query( $query_nnit );
		$row_nnit = mysql_fetch_row( $result_nnit );
		//4. noxy
		$query_noxy = sprintf( "SELECT AVG(noxy), MAX(noxy), MIN(noxy) FROM Compounds WHERE ManuID=4" );
	    $result_noxy = mysql_query( $query_noxy );
		$row_noxy = mysql_fetch_row( $result_noxy );
		//5. nsul
		$query_nsul = sprintf( "SELECT AVG(nsul), MAX(nsul), MIN(nsul) FROM Compounds WHERE ManuID=4" );
	    $result_nsul = mysql_query( $query_nsul );
		$row_nsul = mysql_fetch_row( $result_nsul );
		//6. ncycl
		$query_ncycl = sprintf( "SELECT AVG(ncycl), MAX(ncycl), MIN(ncycl) FROM Compounds WHERE ManuID=4" );
	    $result_ncycl = mysql_query( $query_ncycl );
		$row_ncycl = mysql_fetch_row( $result_ncycl );
		//7. nhdon
		$query_nhdon = sprintf( "SELECT AVG(nhdon), MAX(nhdon), MIN(nhdon) FROM Compounds WHERE ManuID=4" );
	    $result_nhdon = mysql_query( $query_nhdon );
		$row_nhdon = mysql_fetch_row( $result_nhdon );
		//8. nhacc
		$query_nhacc = sprintf( "SELECT AVG(nhacc), MAX(nhacc), MIN(nhacc) FROM Compounds WHERE ManuID=4" );
	    $result_nhacc = mysql_query( $query_nhacc );
		$row_nhacc = mysql_fetch_row( $result_nhacc );
		//9. nrotb
		$query_nrotb = sprintf( "SELECT AVG(nrotb), MAX(nrotb), MIN(nrotb) FROM Compounds WHERE ManuID=4" );
	    $result_nrotb = mysql_query( $query_nrotb );
		$row_nrotb = mysql_fetch_row( $result_nrotb );
		//10. mw
		$query_mw = sprintf( "SELECT AVG(mw), MAX(mw), MIN(mw) FROM Compounds WHERE ManuID=4" );
	    $result_mw = mysql_query( $query_mw );
		$row_mw = mysql_fetch_row( $result_mw );
		//11. TPSA
		$query_TPSA = sprintf( "SELECT AVG(TPSA), MAX(TPSA), MIN(TPSA) FROM Compounds WHERE ManuID=4" );
	    $result_TPSA = mysql_query( $query_TPSA );
		$row_TPSA = mysql_fetch_row( $result_TPSA );
		//12. XLogP
		$query_XLogP = sprintf( "SELECT AVG(XLogP), MAX(XLogP), MIN(XLogP) FROM Compounds WHERE ManuID=4" );
	    $result_XLogP = mysql_query( $query_XLogP );
		$row_XLogP = mysql_fetch_row( $result_XLogP );

		// buid the table body
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Atoms</td>";
		echo '<td>' .round($row_natm[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Carbons</td>";
		echo '<td>' .round($row_ncar[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Nitrogens</td>";
		echo '<td>' .round($row_nnit[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Oxygens</td>";
		echo '<td>' .round($row_noxy[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Sulphurs</td>";
		echo '<td>' .round($row_nsul[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Cycles</td>";
		echo '<td>' .round($row_ncycl[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Hydrogen Donors</td>";
		echo '<td>' .round($row_nhdon[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Hydrogen Acceptors	</td>";
		echo '<td>' .round($row_nhacc[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Number of Rotatable Bonds</td>";
		echo '<td>' .round($row_nrotb[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Molecular Weight</td>";
		echo '<td>' .round($row_mw[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>The Polar Surface Area</td>";
		echo '<td>' .round($row_TPSA[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Nanosyn</td>";
		echo "<td>Estimated LogP</td>";
		echo '<td>' .round($row_XLogP[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 2 ], 4) . '</td>';
		echo "</tr>";
		
	}
	if ($_POST['5']==on){
		// buid command to get the statistics of each feature in sepecific manufacture
	    //1. natm
	    $query_natm = sprintf( "SELECT AVG(natm), MAX(natm), MIN(natm) FROM Compounds WHERE ManuID=5" );
	    $result_natm = mysql_query( $query_natm );
		$row_natm = mysql_fetch_row( $result_natm );
		//2. ncar
		$query_ncar = sprintf( "SELECT AVG(ncar), MAX(ncar), MIN(ncar) FROM Compounds WHERE ManuID=5" );
	    $result_ncar = mysql_query( $query_ncar );
		$row_ncar = mysql_fetch_row( $result_ncar );
		//3. nnit
		$query_nnit = sprintf( "SELECT AVG(nnit), MAX(nnit), MIN(nnit) FROM Compounds WHERE ManuID=5" );
	    $result_nnit = mysql_query( $query_nnit );
		$row_nnit = mysql_fetch_row( $result_nnit );
		//4. noxy
		$query_noxy = sprintf( "SELECT AVG(noxy), MAX(noxy), MIN(noxy) FROM Compounds WHERE ManuID=5" );
	    $result_noxy = mysql_query( $query_noxy );
		$row_noxy = mysql_fetch_row( $result_noxy );
		//5. nsul
		$query_nsul = sprintf( "SELECT AVG(nsul), MAX(nsul), MIN(nsul) FROM Compounds WHERE ManuID=5" );
	    $result_nsul = mysql_query( $query_nsul );
		$row_nsul = mysql_fetch_row( $result_nsul );
		//6. ncycl
		$query_ncycl = sprintf( "SELECT AVG(ncycl), MAX(ncycl), MIN(ncycl) FROM Compounds WHERE ManuID=5" );
	    $result_ncycl = mysql_query( $query_ncycl );
		$row_ncycl = mysql_fetch_row( $result_ncycl );
		//7. nhdon
		$query_nhdon = sprintf( "SELECT AVG(nhdon), MAX(nhdon), MIN(nhdon) FROM Compounds WHERE ManuID=5" );
	    $result_nhdon = mysql_query( $query_nhdon );
		$row_nhdon = mysql_fetch_row( $result_nhdon );
		//8. nhacc
		$query_nhacc = sprintf( "SELECT AVG(nhacc), MAX(nhacc), MIN(nhacc) FROM Compounds WHERE ManuID=5" );
	    $result_nhacc = mysql_query( $query_nhacc );
		$row_nhacc = mysql_fetch_row( $result_nhacc );
		//9. nrotb
		$query_nrotb = sprintf( "SELECT AVG(nrotb), MAX(nrotb), MIN(nrotb) FROM Compounds WHERE ManuID=5" );
	    $result_nrotb = mysql_query( $query_nrotb );
		$row_nrotb = mysql_fetch_row( $result_nrotb );
		//10. mw
		$query_mw = sprintf( "SELECT AVG(mw), MAX(mw), MIN(mw) FROM Compounds WHERE ManuID=5" );
	    $result_mw = mysql_query( $query_mw );
		$row_mw = mysql_fetch_row( $result_mw );
		//11. TPSA
		$query_TPSA = sprintf( "SELECT AVG(TPSA), MAX(TPSA), MIN(TPSA) FROM Compounds WHERE ManuID=5" );
	    $result_TPSA = mysql_query( $query_TPSA );
		$row_TPSA = mysql_fetch_row( $result_TPSA );
		//12. XLogP
		$query_XLogP = sprintf( "SELECT AVG(XLogP), MAX(XLogP), MIN(XLogP) FROM Compounds WHERE ManuID=5" );
	    $result_XLogP = mysql_query( $query_XLogP );
		$row_XLogP = mysql_fetch_row( $result_XLogP );

		// buid the table body
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Atoms</td>";
		echo '<td>' .round($row_natm[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_natm[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Carbons</td>";
		echo '<td>' .round($row_ncar[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncar[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Nitrogens</td>";
		echo '<td>' .round($row_nnit[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nnit[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Oxygens</td>";
		echo '<td>' .round($row_noxy[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_noxy[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Sulphurs</td>";
		echo '<td>' .round($row_nsul[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nsul[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Cycles</td>";
		echo '<td>' .round($row_ncycl[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_ncycl[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Hydrogen Donors</td>";
		echo '<td>' .round($row_nhdon[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhdon[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Hydrogen Acceptors	</td>";
		echo '<td>' .round($row_nhacc[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nhacc[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Number of Rotatable Bonds</td>";
		echo '<td>' .round($row_nrotb[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_nrotb[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Molecular Weight</td>";
		echo '<td>' .round($row_mw[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_mw[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>The Polar Surface Area</td>";
		echo '<td>' .round($row_TPSA[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_TPSA[ 2 ], 4) . '</td>';
		echo "</tr>";
		echo "<tr>";
		echo "<td>Oai40000</td>";
		echo "<td>Estimated LogP</td>";
		echo '<td>' .round($row_XLogP[ 0 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 1 ], 4) . '</td>';
		echo '<td>' .round($row_XLogP[ 2 ], 4) . '</td>';
		echo "</tr>"; 
		
	}

	echo "</tbody>";
	echo "</table>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";



}//( !empty( $_POST ) ) 
else{
	echo "<p>No query is given!";
	echo "<br>";
	
}


?>



</div>



