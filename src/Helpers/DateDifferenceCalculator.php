<?php

namespace UrduDateLibrary\Helpers;

class DateDifferenceCalculator {
    // Array to hold Urdu translations, including numerals
    protected $translations;

    /**
     * Constructor initializes the translations by loading from the external file.
     */
    public function __construct() {
        $this->translations = require __DIR__ . '/../Translations/ur.php';
    }

    /**
     * Calculate the difference in days between two dates and return it in Urdu.
     *
     * @param string $date1 The first date in 'Y-m-d' format.
     * @param string $date2 The second date in 'Y-m-d' format.
     * @return string The difference in days between the two dates, formatted in Urdu.
     */
    public function getDateDifference(string $date1, string $date2): string {
        // Convert both dates to Unix timestamps
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);

        // Calculate the absolute difference in seconds
        $diff = abs($timestamp1 - $timestamp2);

        // Convert the difference from seconds to days
        $days = floor($diff / (60 * 60 * 24));

        // Format the number of days in Urdu and append 'دن'
        return $this->convertToUrdu($days) . ' دن';
    }

    /**
     * Convert a number from Arabic numerals to Urdu numerals.
     *
     * @param int $number The number to convert.
     * @return string The number in Urdu numerals.
     */
    protected function convertToUrdu(int $number): string {
        return strtr((string) $number, $this->translations['numerals']);
    }
}
