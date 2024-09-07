<?php

// Load all dependencies ( including UrduDateLibrary ) via Composer's autoloader
require 'vendor/autoload.php';

use UrduDateLibrary\UrduDate;

// Create an instance of UrduDate class
$date = new UrduDate();

// Example 1: Format a Gregorian date to Urdu
echo "Formatted Date: " . $date->formatDate('2024-12-31') . PHP_EOL; // Output: ۳۱ دسمبر ۲۰۲۴

// Example 2: Get the day name in Urdu
echo "Day Name: " . $date->getDayName('2024-12-31') . PHP_EOL; // Output: منگل

// Example 3: Convert to Hijri date
echo "Hijri Date: " . $date->convertToHijri('2024-12-31') . PHP_EOL; // Output: ۸ رجب ۱۴۴۶

// Example 4: Display relative time in Urdu
echo "Relative Time (Yesterday): " . $date->relativeTime('2024-12-30' ) . PHP_EOL; // Output: کل
