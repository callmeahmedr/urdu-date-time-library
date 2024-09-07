<?php

namespace UrduDateLibrary\Helpers;

class IslamicEvents {
    protected $translations;

    public function __construct() {
        // Load translations from ur.php
        $this->translations = require __DIR__ . '/../Translations/ur.php';
    }

    /**
    * Get the Islamic event name for a specific Hijri date.
    *
    * @param string $hijriDate The Hijri date in Y-m-d format.
    * @return string|null The event name in Urdu or null if no event is found.
    */

    public function getIslamicEvent( string $hijriDate ): ?string {
        $events = $this->translations['islamic_events'];
        return $events[$hijriDate] ?? null;
    }
}
