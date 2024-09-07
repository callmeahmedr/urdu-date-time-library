<?php

namespace UrduDateLibrary\Helpers;

class HijriConverter {
    protected $translations;

    public function __construct() {
        $this->translations = require __DIR__ . '/../Translations/ur.php';
    }

    /**
    * Convert a Gregorian date to a Hijri date.
    *
    * @param string $date The Gregorian date in Y-m-d format.
    * @return string The Hijri date in Urdu.
    */

    public function gregorianToHijri( string $date ): string {
        $timestamp = strtotime( $date );
        list( $hijriYear, $hijriMonth, $hijriDay ) = $this->convertUsingBasicFormula( $timestamp );

        $urduDate = $this->convertToUrdu( $hijriDay ) . ' ' . $this->getHijriMonthName( $hijriMonth ) . ' ' . $this->convertToUrdu( $hijriYear );

        return $urduDate;
    }

    /**
    * Convert a Gregorian timestamp to a Hijri date using a basic formula.
    *
    * @param int $timestamp The Unix timestamp.
    * @return array Hijri year, month, and day.
    */
    protected function convertUsingBasicFormula( int $timestamp ): array {
        $gregorianYear = date( 'Y', $timestamp );
        $gregorianMonth = date( 'm', $timestamp );
        $gregorianDay = date( 'd', $timestamp );

        $hijriYear = $gregorianYear - 622 + ( int )( ( $gregorianMonth > 2 || ( $gregorianMonth == 2 && $gregorianDay >= 19 ) ) ? 1 : 0 );
        $hijriMonth = ( ( $gregorianMonth + 9 ) % 12 ) + 1;
        $hijriDay = $gregorianDay;

        return [$hijriYear, $hijriMonth, $hijriDay];
    }

    /**
    * Get the Urdu name of a Hijri month by its number.
    *
    * @param int $monthNumber The Hijri month number ( 1-12 ).
    * @return string The Hijri month name in Urdu.
    */
    protected function getHijriMonthName( int $monthNumber ): string {
        return $this->translations['hijri_months'][$monthNumber] ?? '';
    }

    /**
    * Convert a number to Urdu numerals.
    *
    * @param string $number The number to convert.
    * @return string The number in Urdu numerals.
    */
    protected function convertToUrdu( string $number ): string {
        return strtr( $number, $this->translations['numerals'] );
    }
}
