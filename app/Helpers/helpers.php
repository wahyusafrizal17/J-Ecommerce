<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($value) {
        $number = preg_replace('/[^0-9.]/', '', $value);
        return number_format((float)$number, 0, ',', '.');
    }
}
