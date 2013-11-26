<?php

	/**
	 * Validates a date with the inputed format.
	 * Version 1.0
	 * 
	 * @param type $date
	 * @param type $format
	 * @return boolean
	 */
	function validate_date( $date = null, $format = 'YYYY-MM-DD', $debug = FALSE ){

		// Return FALSE if $date empty
		if( ! $date )
			return FALSE;

		// $date is trimed
		$date = trim( $date );

		// If $format empty return to default, else UPPERCASE and trim.
		$format = empty( $format ) ? 'YYYY-MM-DD' : strtoupper( $format );

		// $format is 10 char in length and contains all the required chars
		if( strlen( $format ) != 10 ||
		    strpos( $format, 'YYYY' ) === FALSE ||
		    strpos( $format, 'MM' ) === FALSE ||
		    strpos( $format, 'DD' ) === FALSE
		)
			return FALSE;

		// Get $format serparator
		$date_seperator = str_replace( array( 'Y', 'M', 'D' ) , '', $format );
		$date_seperator = $date_seperator[0];

		// Explode $format into parts
		$format_parts = explode( $date_seperator, $format );

		// Explode our date into parts
		$date_parts = explode( $date_seperator, $date );

		// Count $date_parts; Quicker than doing it inline
		$date_parts_count = count( $date_parts );

		// Cycle through $date_parts, compare the length to the equivilent $format_parts length, set to var
		for( $i = 0; $i < $date_parts_count; $i++ ){

			// Check each datepart is a valid in
			if( ! filter_var( ( int ) $date_parts[ $i ], FILTER_VALIDATE_INT ) )
				return FALSE;

			// Compare $date_part length to equivilent $format_part length
			if( strlen( $date_parts[ $i ] ) != strlen( $format_parts[ $i ] )  )
				return FALSE;

			// Set our variables so we check it's a valid date later
			if( $format_parts[ $i ][0] == 'Y' ){

				$year = $date_parts[ $i ];

			} elseif( $format_parts[ $i ][0] == 'M' ){

				$month = $date_parts[ $i ];

			} elseif( $format_parts[ $i ][0] == 'D' ){

				$day = $date_parts[ $i ];

			}

		}

		// Finally, check it's a valid date
		if( checkdate( $month, $day, $year ) ){

			return TRUE;

		} else {

			return FALSE;

		}

	}