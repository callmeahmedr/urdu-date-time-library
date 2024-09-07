<?php

namespace UrduDateLibrary\Helpers;

class DateDifferenceCalculator {
    protected $translations;

    public function __construct() {
        $this->translations = require __DIR__ . '/../Translations/ur.php';
    }

    public function getDateDifference( string $date1, string $date2 ): string {
        $timestamp1 = strtotime( $date1 );
        $timestamp2 = strtotime( $date2 );

        $diff = abs( $timestamp1 - $timestamp2 );
        $days = floor( $diff / ( 60 * 60 * 24 ) );

        return $this->convertToUrdu( $days ) . ' دن';
    }

    protected function convertToUrdu( int $number ): string {
        return strtr( $number, $this->translations['numerals'] );
    }
}
