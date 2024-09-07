<?php

namespace UrduDateLibrary;

use UrduDateLibrary\Helpers\HijriConverter;
use UrduDateLibrary\Helpers\IslamicEvents;
use UrduDateLibrary\Helpers\DateDifferenceCalculator;

/**
* UrduDate class provides various functionalities for date and time operations in Urdu.
*/

class UrduDate {
    // Instances of helper classes for Hijri conversion, Islamic events, and date difference calculations
    protected $hijriConverter;
    protected $islamicEvents;
    protected $dateDifferenceCalculator;
    protected $translations;

    /**
    * Constructor initializes helper classes and loads Urdu translations.
    */

    public function __construct() {
        // Initialize the Hijri converter
        $this->hijriConverter = new HijriConverter();

        // Initialize the Islamic events handler
        $this->islamicEvents = new IslamicEvents();

        // Initialize the date difference calculator
        $this->dateDifferenceCalculator = new DateDifferenceCalculator();

        // Load Urdu translations from the external file
        $this->translations = require __DIR__ . '/Translations/ur.php';
    }

    /**
    * Convert a Gregorian date to Hijri date.
    *
    * @param string $gregorianDate Gregorian date in 'YYYY-MM-DD' format
    * @return string Hijri date in 'DD-MM-YYYY' format
    */

    public function convertToHijri( string $gregorianDate ): string {
        return $this->hijriConverter->gregorianToHijri( $gregorianDate );
    }

    /**
    * Get the Islamic event for a given Hijri date.
    *
    * @param string $hijriDate Hijri date in 'MM-DD' format
    * @return string|null Name of the Islamic event or null if not found
    */

    public function getIslamicEvent( string $hijriDate ): ?string {
        return $this->islamicEvents->getIslamicEvent( $hijriDate );
    }

    /**
    * Calculate the difference between two Gregorian dates and return it in Urdu.
    *
    * @param string $date1 First Gregorian date in 'YYYY-MM-DD' format
    * @param string $date2 Second Gregorian date in 'YYYY-MM-DD' format
    * @return string Date difference in Urdu ( e.g., '6 دن' )
    */

    public function getDateDifference( string $date1, string $date2 ): string {
        return $this->dateDifferenceCalculator->getDateDifference( $date1, $date2 );
    }

    /**
    * Format a time string into its Urdu representation.
    *
    * @param string $time Time in 'HH:MM' format
    * @return string Formatted time in Urdu
    */

    public function formatTimeInUrdu( string $time ): string {
        // Format time to 'HH:MM' format
        $formattedTime = date( 'H:i', strtotime( $time ) );
        return $this->convertToUrdu( $formattedTime );
    }

    /**
    * Get the relative time description in Urdu for a given date compared to the current date.
    *
    * @param string $date Date in 'YYYY-MM-DD' format
    * @return string Relative time description in Urdu ( e.g., '1 دن پہلے' )
    */

    public function relativeTime( string $date ): string {
        $now = time();
        // Current timestamp
        $dateTimestamp = strtotime( $date );
        // Timestamp for the given date
        $diff = $now - $dateTimestamp;
        // Difference in seconds

        // Check the difference and return appropriate relative time description
        if ( $diff < 60 * 60 ) {
            return $this->translations['relative']['today'];
        } elseif ( $diff < 60 * 60 * 24 ) {
            return $this->translations['relative']['yesterday'];
        } elseif ( $diff < 60 * 60 * 24 * 7 ) {
            return $this->convertToUrdu( floor( $diff / ( 60 * 60 * 24 ) ) ) . ' دن پہلے';
        } else {
            return $this->convertToUrdu( floor( $diff / ( 60 * 60 * 24 * 7 ) ) ) . ' ہفتہ پہلے';
        }
    }

    /**
    * Get the Urdu name for the day, month, and year of a Gregorian date.
    *
    * @param string $gregorianDate Gregorian date in 'YYYY-MM-DD' format
    * @return string Formatted date in Urdu with labels for day, month, and year
    */

    public function getUrduMonthDayName( string $gregorianDate ): string {
        $day = date( 'd', strtotime( $gregorianDate ) );
        // Extract day
        $month = date( 'm', strtotime( $gregorianDate ) );
        // Extract month
        $year = date( 'Y', strtotime( $gregorianDate ) );
        // Extract year

        // Translate month and day to Urdu
        $urduMonth = $this->translations['months'][$month];
        $urduDay = $this->convertToUrdu( $day );

        // Format the full date in Urdu
        return $urduDay . ' ' . $urduMonth . ' ' . $this->convertToUrdu( $year );
    }

    /**
    * Convert Arabic numerals to Urdu numerals.
    *
    * @param string $number Number string with Arabic numerals
    * @return string Number string with Urdu numerals
    */

    public function convertToUrdu( string $number ): string {
        return strtr( $number, $this->translations['numerals'] );
    }
}
