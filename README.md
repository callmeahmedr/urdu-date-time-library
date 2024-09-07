# Urdu Date Time Library
The Urdu Date Time Library is a PHP library designed to handle various date and time operations with Urdu localization. It includes functionalities for converting Gregorian dates to Hijri, calculating date differences, formatting times, and providing relative times, all in Urdu.

## Installation
### Method 1
Use composer to install the `urdu-date-time-library` package
```bash
composer require callmeahmedr/urdu-date-time-library
```
### Method 2
Clone the Repository
```bash
git clone https://github.com/callmeahmedr/urdu-date-time-library.git
```
Install Dependencies
```bash
composer install
```

## Usage
Here's a simple example demonstrating how to use the Urdu Date Time Library in your project:
```php
<?php

require 'vendor/autoload.php';

use UrduDateLibrary\UrduDate;

$urduDate = new UrduDate();
```

## Functions
### `convertToHijri($gregorianDate)`:
Converts a Gregorian date (formatted as `YYYY-MM-DD`) to its corresponding Hijri date.
```php
// Hijri Conversion
$gregorianDate = '2024-09-07';
echo "Hijri Conversion for $gregorianDate: " . $urduDate->convertToHijri($gregorianDate) . "<br>";
```

### `getIslamicEvent($hijriDate)`:
Retrieves the Islamic event for a given Hijri date. The Hijri date format should be `MM-DD`.
```php
// Islamic Event
$hijriDate = '12-10'; // Example Hijri date format
echo "Islamic Event for Hijri Date $hijriDate: " . $urduDate->getIslamicEvent($hijriDate) . "<br>";
```

### `getDateDifference($date1, $date2)`:
Calculates the difference between two Gregorian dates and returns it in Urdu.
```php
// Date Difference
$date1 = '2024-09-01';
$date2 = '2024-09-07';
echo "Date Difference between $date1 and $date2: " . $urduDate->getDateDifference($date1, $date2) . "<br>";
```

### `formatTimeInUrdu($time)`:
Formats a time string (in `HH:MM` format) into its Urdu representation.
```php
// Time Formatting
$time = '14:30';
echo "Formatted Time in Urdu for $time: " . $urduDate->formatTimeInUrdu($time) . "<br>";
```

### `relativeTime($date)`:
Provides a relative time description for a given date compared to the current date, such as "1 دن پہلے" (1 day ago) in Urdu.
```php
// Relative Time
$pastDate = '2024-09-06';
echo "Relative Time for $pastDate: " . $urduDate->relativeTime($pastDate) . "<br>";
```

### `getUrduMonthDayName($gregorianDate)`:
Returns the Urdu representation of a Gregorian date, including day, month, and year. The date should be formatted as `YYYY-MM-DD`.
```php
// Urdu Month/Day Name
echo "Urdu Month/Day Name for Gregorian Date $gregorianDate: " . $urduDate->getUrduMonthDayName($gregorianDate) . "<br>";
```

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request with your changes. Ensure that your code adheres to the existing coding style and includes relevant tests.

## License
This project is licensed under the MIT License - see the [LICENSE](https://github.com/callmeahmedr/urdu-date-time-library/blob/main/LICENSE) file for details.
