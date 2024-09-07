    <?php

    namespace UrduDateLibrary;

    use UrduDateLibrary\Helpers\HijriConverter;
    use UrduDateLibrary\Helpers\IslamicEvents;
    use UrduDateLibrary\Helpers\DateDifferenceCalculator;

    class UrduDate {
        protected $hijriConverter;
        protected $islamicEvents;
        protected $dateDifferenceCalculator;
        protected $translations;

        public function __construct() {
            $this->hijriConverter = new HijriConverter();
            $this->islamicEvents = new IslamicEvents();
            $this->dateDifferenceCalculator = new DateDifferenceCalculator();
            $this->translations = require __DIR__ . '/Translations/ur.php';
        }

        // Hijri Conversion Function

        public function convertToHijri( string $gregorianDate ): string {
            $hijriDate = $this->hijriConverter->gregorianToHijri( $gregorianDate );
            return $this->formatDateWithLabels( $hijriDate, 'روز', 'مہینہ', 'سال' );
        }

        // Get Islamic Event by Hijri Date

        public function getIslamicEvent( string $hijriDate ): ?string {
            return $this->islamicEvents->getIslamicEvent( $hijriDate );
        }

        // Date Difference in Urdu

        public function getDateDifference( string $date1, string $date2 ): string {
            return $this->convertToUrdu( $this->dateDifferenceCalculator->getDateDifference( $date1, $date2 ) ) . ' دن';
        }

        // Time Formatting in Urdu

        public function formatTimeInUrdu( string $time ): string {
            $formattedTime = date( 'H:i', strtotime( $time ) );
            return $this->convertToUrdu( $formattedTime );
        }

        // Relative Time in Urdu

        public function relativeTime( string $date ): string {
            $now = time();
            $dateTimestamp = strtotime( $date );
            $diff = $now - $dateTimestamp;

            if ( $diff < 60 * 60 ) {
                return $this->translations['relative']['today'];
            } elseif ( $diff < 60 * 60 * 24 ) {
                return $this->translations['relative']['yesterday'];
            } elseif ( $diff < 60 * 60 * 24 * 7 ) {
                return $this->convertToUrdu( floor( $diff / ( 60 * 60 * 24 ) ) ) . ' دن پہلے';
            } else {
                return $this->convertToUrdu( floor( $diff / ( 60 * 60 * 24 * 7 ) ) ) . ' ہفتے پہلے';
            }
        }

        // Gregorian to Urdu Month/Day Name with labels

        public function getUrduMonthDayName( string $gregorianDate ): string {
            $day = date( 'd', strtotime( $gregorianDate ) );
            $month = date( 'm', strtotime( $gregorianDate ) );
            $year = date( 'Y', strtotime( $gregorianDate ) );

            $urduMonth = $this->translations['months'][$month];
            $urduDay = $this->convertToUrdu( $day );
            $urduYear = $this->convertToUrdu( $year );

            return "روز: $urduDay، مہینہ: $urduMonth، سال: $urduYear";
        }

        // Helper Function to Convert Numbers to Urdu

        public function convertToUrdu( string $number ): string {
            return strtr( $number, $this->translations['numerals'] );
        }

        // Helper Function to Format Date with Labels ( Improved with Checks )

        private function formatDateWithLabels( string $date, string $dayLabel, string $monthLabel, string $yearLabel ): string {
            $parts = explode( '-', $date );

            // Ensure we have all parts ( day, month, year )
            if ( count( $parts ) === 3 ) {
                $urduDay = $this->convertToUrdu( $parts[0] ?? '' );
                $urduMonth = $this->translations['months'][$parts[1]] ?? '';
                $urduYear = $this->convertToUrdu( $parts[2] ?? '' );

                return "$dayLabel: $urduDay، $monthLabel: $urduMonth، $yearLabel: $urduYear";
            }

            // Return an empty or fallback string if the date is not in the expected format
            return 'Invalid Date Format';
        }
    }
