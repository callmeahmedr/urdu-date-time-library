<?php

require 'vendor/autoload.php';

use UrduDateLibrary\UrduDate;

$urduDate = new UrduDate();

// Test Hijri Conversion
$gregorianDate = '2024-09-07';
echo "Hijri Conversion for $gregorianDate: " . $urduDate->convertToHijri($gregorianDate) . "<br>";

// Test Islamic Event
$hijriDate = '12-10'; // Example Hijri date format
echo "Islamic Event for Hijri Date $hijriDate: " . $urduDate->getIslamicEvent($hijriDate) . "<br>";

// Test Date Difference
$date1 = '2024-09-01';
$date2 = '2024-09-07';
echo "Date Difference between $date1 and $date2: " . $urduDate->getDateDifference($date1, $date2) . "<br>";

// Test Time Formatting
$time = '14:30';
echo "Formatted Time in Urdu for $time: " . $urduDate->formatTimeInUrdu($time) . "<br>";

// Test Relative Time
$pastDate = '2024-09-06';
echo "Relative Time for $pastDate: " . $urduDate->relativeTime($pastDate) . "<br>";

// Test Urdu Month/Day Name
echo "Urdu Month/Day Name for Gregorian Date $gregorianDate: " . $urduDate->getUrduMonthDayName($gregorianDate) . "<br>";
