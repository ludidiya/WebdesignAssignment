<?php
session_start();
?>

<?php
include "navigation.html";
require_once 'login.php';
require_once 'redir.php';
?>

<div id="write" class="container">
<h2>Results of features statistics</h2>
<hr>

<?php
// Results
  echo <<<_MAIN2
  <table class="pure-table tablesorter" align="center" id="myTable">
    <thead><th>Features</th><th>Average</th><th>Maximum</th><th>Minimum</th><th>Standard Deviation</th>
  </tr>
    </thead>
        <tbody>

_MAIN2;


  // connect to MySQL
    $db_server = mysql_connect( $db_hostname, $db_username, $db_password );
    if ( !$db_server )die( "Unable to connect to database: " . mysql_error() );
    mysql_select_db( $db_database, $db_server )or die( "Unable to select database: " . mysql_error() );
 
    $query_natm = sprintf( "SELECT AVG(natm), MAX(natm), MIN(natm), STDDEV(natm) FROM Compounds" );
    $result_natm = mysql_query( $query_natm );
    $row_natm = mysql_fetch_row( $result_natm );
    echo '<tr>';
    echo "<td>Number of Atoms</td>";
    echo '<td>' .round($row_natm[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_natm[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_natm[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_natm[ 3 ], 4) . '</td>';
    echo '</tr>';


    $query_ncar = sprintf( "SELECT AVG(ncar), MAX(ncar), MIN(ncar), STDDEV(ncar) FROM Compounds" );
    $result_ncar = mysql_query( $query_ncar );
    $row_ncar = mysql_fetch_row( $result_ncar );
    echo '<tr>';
    echo "<td>Number of Carbons</td>";
    echo '<td>' .round($row_ncar[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_ncar[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_ncar[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_ncar[ 3 ], 4) . '</td>';
    echo '</tr>';

 
    $query_nnit = sprintf( "SELECT AVG(nnit), MAX(nnit), MIN(nnit), STDDEV(nnit) FROM Compounds" );
    $result_nnit = mysql_query( $query_nnit );
    $row_nnit = mysql_fetch_row( $result_nnit );
    echo '<tr>';
    echo "<td>Number of Nitrogens</td>";
    echo '<td>' .round($row_nnit[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_nnit[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_nnit[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_nnit[ 3 ], 4) . '</td>';
    echo '</tr>';

 
    $query_noxy = sprintf( "SELECT AVG(noxy), MAX(noxy), MIN(noxy), STDDEV(noxy) FROM Compounds" );
    $result_noxy = mysql_query( $query_noxy );
    $row_noxy = mysql_fetch_row( $result_noxy );
    echo '<tr>';
    echo "<td>Number of Oxygens</td>";
    echo '<td>' .round($row_noxy[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_noxy[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_noxy[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_noxy[ 3 ], 4) . '</td>';
    echo '</tr>';


    $query_nsul = sprintf( "SELECT AVG(nsul), MAX(nsul), MIN(nsul), STDDEV(nsul) FROM Compounds" );
    $result_nsul = mysql_query( $query_nsul );
    $row_nsul = mysql_fetch_row( $result_nsul );
    echo '<tr>';
    echo "<td>Number of Sulphurs</td>";
    echo '<td>' .round($row_nsul[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_nsul[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_nsul[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_nsul[ 3 ], 4) . '</td>';
    echo '</tr>';


    $query_ncycl = sprintf( "SELECT AVG(ncycl), MAX(ncycl), MIN(ncycl), STDDEV(ncycl) FROM Compounds" );
    $result_ncycl = mysql_query( $query_ncycl );
    $row_ncycl = mysql_fetch_row( $result_ncycl );
    echo '<tr>';
    echo "<td>Number of Cycles</td>";
    echo '<td>' .round($row_ncycl[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_ncycl[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_ncycl[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_ncycl[ 3 ], 4) . '</td>';
    echo '</tr>';

  
    $query_nhdon = sprintf( "SELECT AVG(nhdon), MAX(nhdon), MIN(nhdon), STDDEV(nhdon) FROM Compounds" );
    $result_nhdon = mysql_query( $query_nhdon );
    $row_nhdon = mysql_fetch_row( $result_nhdon );
    echo '<tr>';
    echo "<td>Number of Hydrogen Donors</td>";
    echo '<td>' .round($row_nhdon[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_nhdon[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_nhdon[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_nhdon[ 3 ], 4) . '</td>';
    echo '</tr>';


    $query_nhacc = sprintf( "SELECT AVG(nhacc), MAX(nhacc), MIN(nhacc), STDDEV(nhacc) FROM Compounds" );
    $result_nhacc = mysql_query( $query_nhacc );
    $row_nhacc = mysql_fetch_row( $result_nhacc );
    echo '<tr>';
    echo "<td>Number of Hydrogen Acceptors</td>";
    echo '<td>' .round($row_nhacc[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_nhacc[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_nhacc[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_nhacc[ 3 ], 4) . '</td>';
    echo '</tr>';


    $query_nrotb = sprintf( "SELECT AVG(nrotb), MAX(nrotb), MIN(nrotb), STDDEV(nrotb) FROM Compounds" );
    $result_nrotb = mysql_query( $query_nrotb );
    $row_nrotb = mysql_fetch_row( $result_nrotb );
    echo '<tr>';
    echo "<td>Number of Rotatable Bonds</td>";
    echo '<td>' .round($row_nrotb[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_nrotb[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_nrotb[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_nrotb[ 3 ], 4) . '</td>';
    echo '</tr>';

    $query_mw = sprintf( "SELECT AVG(mw), MAX(mw), MIN(mw), STDDEV(mw)FROM Compounds" );
    $result_mw = mysql_query( $query_mw );
    $row_mw = mysql_fetch_row( $result_mw );
    echo '<tr>';
    echo "<td>Molecular Weight</td>";
    echo '<td>' .round($row_mw[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_mw[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_mw[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_mw[ 3 ], 4) . '</td>';
    echo '</tr>';

    $query_TPSA = sprintf( "SELECT AVG(TPSA), MAX(TPSA), MIN(TPSA), STDDEV(TPSA) FROM Compounds" );
    $result_TPSA = mysql_query( $query_TPSA );
    $row_TPSA = mysql_fetch_row( $result_TPSA );
    echo '<tr>';
    echo "<td>The Polar Surface Area</td>";
    echo '<td>' .round($row_TPSA[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_TPSA[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_TPSA[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_TPSA[ 3 ], 4) . '</td>';
    echo '</tr>';

 
    $query_XLogP = sprintf( "SELECT AVG(XLogP), MAX(XLogP), MIN(XLogP), STDDEV(XLogP) FROM Compounds" );
    $result_XLogP = mysql_query( $query_XLogP );
    $row_XLogP = mysql_fetch_row( $result_XLogP );
    echo '<tr>';
    echo "<td>Estimated LogP</td>";
    echo '<td>' .round($row_XLogP[ 0 ], 4) . '</td>';
    echo '<td>' .round($row_XLogP[ 1 ], 4) . '</td>';
    echo '<td>' .round($row_XLogP[ 2 ], 4) . '</td>';
    echo '<td>' .round($row_XLogP[ 3 ], 4) . '</td>';
    echo '</tr>';

    echo '</tbody>';
    echo '</table>';
    echo "</div>";


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