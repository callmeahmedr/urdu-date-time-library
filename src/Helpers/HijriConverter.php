<?php

namespace UrduDateLibrary\Helpers;

class HijriConverter {
    // Array to hold Urdu translations, including Hijri month names and numerals
    protected $translations;

    /**
     * Constructor initializes the translations by loading from the external file.
     */
    public function __construct() {
        $this->translations = require __DIR__ . '/../Translations/ur.php';
    }

    /**
     * Convert a Gregorian date to a Hijri date in Urdu.
     *
     * @param string $date The Gregorian date in 'Y-m-d' format.
     * @return string The Hijri date in Urdu format (e.g., '۱۲ ربیع الاول ۱۴۴۵').
     */
    public function gregorianToHijri(string $date): string {
        // Convert Gregorian date to Unix timestamp
        $timestamp = strtotime($date);
        
        // Calculate Hijri date components using a basic formula
        list($hijriYear, $hijriMonth, $hijriDay) = $this->convertUsingBasicFormula($timestamp);

        // Format Hijri date into Urdu
        $urduDate = $this->convertToUrdu($hijriDay) . ' ' . $this->getHijriMonthName($hijriMonth) . ' ' . $this->convertToUrdu($hijriYear);

        return $urduDate;
    }

    /**
     * Convert a Unix timestamp to Hijri date components using a basic formula.
     *
     * @param int $timestamp The Unix timestamp.
     * @return array An array containing Hijri year, month, and day.
     */
    protected function convertUsingBasicFormula(int $timestamp): array {
        // Extract Gregorian year, month, and day from the timestamp
        $gregorianYear = date('Y', $timestamp);
        $gregorianMonth = date('m', $timestamp);
        $gregorianDay = date('d', $timestamp);

        // Calculate Hijri year, month, and day
        $hijriYear = $gregorianYear - 622 + (int)(($gregorianMonth > 2 || ($gregorianMonth == 2 && $gregorianDay >= 19)) ? 1 : 0);
        $hijriMonth = (($gregorianMonth + 9) % 12) + 1;
        $hijriDay = $gregorianDay;

        return [$hijriYear, $hijriMonth, $hijriDay];
    }

    /**
     * Get the Urdu name of a Hijri month based on its number.
     *
     * @param int $monthNumber The Hijri month number (1-12).
     * @return string The Hijri month name in Urdu. Returns an empty string if not found.
     */
    protected function getHijriMonthName(int $monthNumber): string {
        return $this->translations['hijri_months'][$monthNumber] ?? '';
    }

    /**
     * Convert a number from Arabic numerals to Urdu numerals.
     *
     * @param string $number The number to convert.
     * @return string The number in Urdu numerals.
     */
    protected function convertToUrdu(string $number): string {
        return strtr($number, $this->translations['numerals']);
    }
}
