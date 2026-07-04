<?php

namespace App\Services\PhotoCard\Support;

use Illuminate\Support\Carbon;

/**
 * Reusable Bengali digit / date formatting for photocards.
 *
 * Honors a PHP-style date_format string (e.g. "d M, Y") and localises
 * both the month names and the digits to Bengali, producing output like
 * "২৪ এপ্রিল, ২০২৬".
 */
class BengaliFormatter
{
    protected const DIGITS = [
        '0' => '০', '1' => '১', '2' => '২', '3' => '৩', '4' => '৪',
        '5' => '৫', '6' => '৬', '7' => '৭', '8' => '৮', '9' => '৯',
    ];

    protected const MONTHS = [
        1 => 'জানুয়ারি',
        2 => 'ফেব্রুয়ারি',
        3 => 'মার্চ',
        4 => 'এপ্রিল',
        5 => 'মে',
        6 => 'জুন',
        7 => 'জুলাই',
        8 => 'আগস্ট',
        9 => 'সেপ্টেম্বর',
        10 => 'অক্টোবর',
        11 => 'নভেম্বর',
        12 => 'ডিসেম্বর',
    ];

    /**
     * Convert ASCII digits within any string to Bengali digits.
     */
    public function toBengaliDigits(string|int $value): string
    {
        return strtr((string) $value, self::DIGITS);
    }

    /**
     * Format a date using a PHP date() format, localised to Bengali.
     *
     * Supported tokens: d, j (day), m, n (numeric month), M, F (month name),
     * Y, y (year). Any other characters pass through literally. Falls back to
     * "j M, Y" when no format is supplied.
     */
    public function formatDate(Carbon $date, ?string $format = null): string
    {
        $format = $format ?: 'j M, Y';

        $out = '';
        $len = strlen($format);

        for ($i = 0; $i < $len; $i++) {
            $token = $format[$i];

            $out .= match ($token) {
                'd' => $this->toBengaliDigits($date->format('d')),
                'j' => $this->toBengaliDigits($date->format('j')),
                'm' => $this->toBengaliDigits($date->format('m')),
                'n' => $this->toBengaliDigits((int) $date->format('n')),
                'M', 'F' => self::MONTHS[(int) $date->format('n')],
                'Y' => $this->toBengaliDigits($date->format('Y')),
                'y' => $this->toBengaliDigits($date->format('y')),
                default => $token,
            };
        }

        return $out;
    }
}
