<?php

namespace UrduDateLibrary;

class UrduDate {
    protected $dateFormat = 'Y-m-d';
    // Default date format
    protected $timeFormat = 'H:i:s';
    // Default time format

    /**
    * Format a given date into Urdu with day, month, and year.
    *
    * @param string $date The date in Y-m-d format.
    * @return string The formatted date in Urdu.
    */

    public function formatDate( string $date ): string {
        $timestamp = strtotime( $date );
        $day = $this->convertToUrdu( date( 'd', $timestamp ) );
        $month = $this->getMonthName( date( 'm', $timestamp ) );
        $year = $this->convertToUrdu( date( 'Y', $timestamp ) );

        return "$day $month $year";
    }

    /**
    * Get the Urdu name of a month by its number.
    *
    * @param string $monthNumber The month number ( 1-12 ).
    * @return string The month name in Urdu.
    */

    public function getMonthName( string $monthNumber ): string {
        $translations = require __DIR__ . '/Translations/ur.php';
        return $translations['months'][$monthNumber] ?? '';
    }

    /**
    * Get the Urdu name of a day for a given date.
    *
    * @param string $date The date in Y-m-d format.
    * @return string The day name in Urdu.
    */

    public function getDayName( string $date ): string {
        $timestamp = strtotime( $date );
        $dayOfWeek = date( 'N', $timestamp );
        // 1 = Monday, 7 = Sunday
        $translations = require __DIR__ . '/Translations/ur.php';

        return $translations['days'][$dayOfWeek] ?? '';
    }

    /**
    * Convert a given number to Urdu numerals.
    *
    * @param string $number The number to convert.
    * @return string The number in Urdu numerals.
    */

    public function convertToUrdu( string $number ): string {
        $urduNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        return strtr( $number, array_combine( range( 0, 9 ), $urduNumbers ) );
    }

    /**
    * Display relative time in Urdu ( e.g., "Today", "Yesterday" ).
    *
    * @param string $date The date to compare.
    * @return string The relative time in Urdu.
    */

    public function relativeTime( string $date ): string {
        $timestamp = strtotime( $date );
        $today = strtotime( date( 'Y-m-d' ) );
        $difference = $today - $timestamp;
        $translations = require __DIR__ . '/Translations/ur.php';

        if ( $difference == 0 ) {
            return $translations['relative']['today'];
        } elseif ( $difference == 86400 ) {
            return $translations['relative']['yesterday'];
        } elseif ( $difference == -86400 ) {
            return $translations['relative']['tomorrow'];
        }

        return date( $this->dateFormat, $timestamp );
        // Default: formatted date
    }

    /**
    * Convert a Gregorian date to a Hijri date and return it in Urdu.
    *
    * @param string $date The Gregorian date in Y-m-d format.
    * @return string The Hijri date in Urdu.
    */

    public function convertToHijri( string $date ): string {
        $hijriConverter = new Helpers\HijriConverter();
        return $hijriConverter->gregorianToHijri( $date );
    }
}
