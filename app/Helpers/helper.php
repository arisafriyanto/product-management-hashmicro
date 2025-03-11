<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah(?float $number, bool $withPrefix = false): string
    {
        if (empty($number)) {
            return '';
        }

        $formatted = number_format($number, 0, ',', '.');
        return $withPrefix ? 'Rp. ' . $formatted : $formatted;
    }
}
