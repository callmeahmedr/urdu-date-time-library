<?php

require 'vendor/autoload.php';

use UrduDateLibrary\UrduDate;

$urduDate = new UrduDate();

// 1. Hijri Conversion (Gregorian to Hijri) with Labels
echo "Hijri Conversion for 2024-09-07: " . $urduDate->convertToHijri('2024-09-07') . "<br>";

// 2. Get Islamic Event by Hijri Date
echo "Islamic Event for Hijri Date 12-10 (Eid al-Adha): " . $urduDate->getIslamicEvent('12-10') . "<br>";

// 3. Date Difference in Urdu (Between Two Gregorian Dates)
echo "Date Difference between 2024-09-01 and 2024-09-07: " . $urduDate->getDateDifference('2024-09-01', '2024-09-07') . "<br>";

// 4. Time Formatting in Urdu (for a given time)
echo "Formatted Time in Urdu for 14:30: " . $urduDate->formatTimeInUrdu('14:30') . "<br>";

// 5. Relative Time in Urdu (based on how far the date is from today)
echo "Relative Time for 2024-09-06: " . $urduDate->relativeTime('2024-09-06') . "<br>";

// 6. Get Urdu Month and Day Name for Gregorian Date with Labels
echo "Urdu Month/Day Name for Gregorian Date 2024-09-07: " . $urduDate->getUrduMonthDayName('2024-09-07') . "<br>";
