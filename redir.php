<?php
if ( !( isset( $_SESSION[ 'forname' ] ) && isset( $_SESSION[ 'surname' ] ) ) ) {
	header( 'location: complib.php' );
}
?>
