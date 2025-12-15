<?php

if (!function_exists('rupiah')) {
    function rupiah($amount)
    {
        if (!is_numeric($amount)) {
            return 'Rp0';
        }
        return 'Rp' . number_format($amount, 0, ',', '.');
    }
}