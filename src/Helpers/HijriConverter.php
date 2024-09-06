<?php

namespace UrduDateLibrary\Helpers;

class HijriConverter {
    /**
    * Convert a Gregorian date to a Hijri date.
    *
    * @param string $date The Gregorian date in Y-m-d format.
    * @return string The Hijri date in Urdu.
    */

    public function gregorianToHijri( string $date ): string {
        // Convert Gregorian to Hijri ( basic implementation using PHP's calendar functions)
        $timestamp = strtotime($date);
        list($hijriYear, $hijriMonth, $hijriDay) = $this->toHijri($timestamp);
        
        $urduDate = $this->convertToUrdu($hijriDay) . ' ' . $this->getHijriMonthName($hijriMonth) . ' ' . $this->convertToUrdu($hijriYear);
        
        return $urduDate;
    }

    /**
     * Convert a timestamp to Hijri date using PHP's calendar functions.
        *
        * @param int $timestamp The Unix timestamp.
        * @return array Hijri year, month, and day.
        */
        protected function toHijri( int $timestamp ): array {
            // This function uses PHP's built-in `cal_from_jd()` to convert dates
        $jd = GregorianToJD(date('m', $timestamp), date('d', $timestamp), date('Y', $timestamp));
        $hijriDate = cal_from_jd($jd, CAL_ISLAMIC);
        return [$hijriDate['year'], $hijriDate['month'], $hijriDate['day']];
    }

    /**
     * Get the Urdu name of a Hijri month by its number.
     *
     * @param int $monthNumber The Hijri month number (1-12).
     * @return string The Hijri month name in Urdu.
     */
    protected function getHijriMonthName(int $monthNumber): string
    {
        $translations = require __DIR__ . '/../Translations/ur.php';
        return $translations['hijri_months'][$monthNumber] ?? '';
    }

    /**
     * Convert a number to Urdu numerals.
     *
     * @param string $number The number to convert.
     * @return string The number in Urdu numerals.
     */
    protected function convertToUrdu(string $number): string
    {
        $urduNumbers = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
            return strtr( $number, array_combine( range( 0, 9 ), $urduNumbers ) );
        }
    }
