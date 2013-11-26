<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Include the functions
include_once 'validate_date.php';

 date_default_timezone_set( 'GMT' );

// An array of test dates. $key = format (default to YYYY-MM-DD), $value = date.
$should_pass = array();

// Valid Dates
$should_pass[][]		= date( "Y-m-d" );
$should_pass[]['yyyy/mm/dd']	= date( "Y/m/d" );
$should_pass[]['DD/MM/YYYY']	= date( "d/m/Y" );
$should_pass[]['MM/DD/YYYY']	= date( "m/d/Y" );
$should_pass[]['YYYY.MM.DD']	= date( "Y.m.d" );
$should_pass[]['DD.MM.YYYY']	= date( "d.m.Y" );
$should_pass[]['yyyyAmmAdd']	= '2013A01A01';
$should_pass[]['YYYY-MM-DD']	= '2012-02-29';	    // Leap year


$should_fail = array();

// Invalid Dates
$should_fail[]['YYYY-MM-DD']	= NULL;		    // NULL
$should_fail[]['YYYY-MM-DD']	= '';		    // Empty
$should_fail[]['YYYY-MM-DD']	= FALSE;	    // False
$should_fail[]['YYYY-MM-DD']	= TRUE;		    // True

$should_fail[]['YYYY-MM-DD']	= 'thgutururr'; // Random gibberish
$should_fail[]['YYYY-MM-DD']	= '2013-11-31'; // November only has 30 days
$should_fail[]['YYYY-MM-DD']	= '2013-02-O2'; // O instead of zero

$should_fail[]['YYYY-MM-DD']	= '0000-01-01'; // Year set to zero
$should_fail[]['YYYY-MM-DD']	= '2013-00-01'; // Month set to zero
$should_fail[]['YYYY-MM-DD']	= '2013-01-00'; // Day set to zero

$should_fail[]['YYYY-MM-DD']	= '201-01-01'; // Year short a digit
$should_fail[]['YYYY-MM-DD']	= '2013-1-01'; // Month short a digit
$should_fail[]['YYYY-MM-DD']	= '2013-01-1'; // Day short a digit


// Output
echo '<h2>Should Pass</h2>';
echo check_dates( $should_pass );

echo '<h2>Should Fail</h2>';
echo check_dates( $should_fail );



/**
 * Simple function to iterate of dates and check them
 * 
 * @param array $test_dates
 * @return string Output
 */
function check_dates( $test_dates = NULL ){

	$output = '';
    
	if( $test_dates ) foreach( $test_dates as $test_date ){

		foreach( $test_date as $key => $value ){

			$result	= validate_date( $value, $key ) ? 'TRUE' : 'FALSE' ;

			$output	.= "Date tried: <b>{$value}</b>; Format: <b>{$key}</b>; Result: <b>{$result}</b><br />";

		}

	}

	return $output;

}