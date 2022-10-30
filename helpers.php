<?php

declare(strict_types=1);


use App\Models\User;
use Carbon\Exceptions\InvalidFormatException;

if (!function_exists('user')) {
    /**
     * @return ?User
     */
    function user(): ?User
    {
        return auth()->user() ?? request()->user();
    }
}

if (!function_exists('has_unique_values')) {
    /**
     * Check if the array has duplicates values or not.
     *
     * @param array $arr
     * @return bool
     */
    function has_unique_values(array $arr): bool
    {
        return count($arr) === count(array_unique($arr));
    }
}


if (!function_exists('trim_till')) {
    /**
     * pluck string.
     *
     * @param string $string
     * @param string $stopNeedle
     * @param string|null $startNeedle
     * @return string
     */
    function trim_till(string $string, string $stopNeedle, ?string $startNeedle = null): string
    {
        $startPosition = is_null($startNeedle) ? 0 : strpos($string, $startNeedle);
        return trim(substr($string, $startPosition, strpos($string, $stopNeedle)));
    }
}

if (!function_exists('average')) {
    /**
     * Get the average of array elements
     *
     * @param array $values
     * @return float|int
     */
    function average(array $values): float|int
    {
        $sum = array_sum($values);
        $count = count($values);
        return ($count !== 0) ? $sum / $count : NAN;
    }
}

if (!function_exists('replace_keys')) {
    /**
     * @param array $arr
     * @param string|array $oldKey
     * @param string|array $newKey
     * @return array
     */
    function replace_keys(array $arr, string|array $oldKey, string|array $newKey): array
    {
        if (is_string($oldKey) && is_string($newKey)) {
            $keys = array_keys($arr);
            $keys[array_search($oldKey, $keys)] = $newKey;
            return array_combine($keys, $arr);
        }

        if (is_array($oldKey) && is_array($newKey)) {
            if (count($newKey) !== count($oldKey)) {
                return $arr;
            }

            foreach ($oldKey as $index => $key) {
                $keys = array_keys($arr);
                $keys[array_search($key, $keys)] = $newKey[$index];
                $arr = array_combine($keys, $arr);
            }
        }

        return $arr;
    }

    if (!function_exists('format_date')) {
        /**
         * @param $value
         * @param string $format
         * @return string|null
         */
        function format_date($value, string $format = 'Y-m-d'): string|null
        {
            return !is_null($value) ? (\Illuminate\Support\Carbon::parse($value)->format($format)) : null;
        }
    }

    if (!function_exists('uniqueId')) {
        /**
         * @param int $length
         * @return string
         * @throws Exception
         */
        function uniqueId(int $length = 13): string
        {
            if (function_exists("random_bytes")) {
                $bytes = random_bytes((int)ceil($length / 2));
            } elseif (function_exists("openssl_random_pseudo_bytes")) {
                $bytes = openssl_random_pseudo_bytes((int)ceil($length / 2));
            } else {
                throw new Exception("no cryptographically secure random function available");
            }
            return substr(bin2hex($bytes), 0, $length);
        }
    }


    if (!function_exists('array_to_obj')) {
        /**
         * Convert array to object.
         *
         * @param array $array
         * @return object
         */
        function array_to_obj(array $array): object
        {
            return (object) json_decode(json_encode($array), FALSE);
        }
    }
}

if (!function_exists('has_unique_values')) {
    /**
     * Check if the array has duplicates values or not.
     *
     * @param array $arr
     * @return bool
     */
    function has_unique_values(array $arr): bool
    {
        return count($arr) === count(array_unique($arr));
    }
}

if (!function_exists('is_valid_date')) {
    /**
     * Check if the given string is a valid date.
     *
     * @param string $value
     * @return bool
     */
    function is_valid_date(string $value): bool
    {
        try {

            return (bool)format_date($value);

        }catch (InvalidFormatException $_){

            return false;
        }

    }
}


if (!function_exists('extract_int')) {
    /**
     * Extract int from string
     *
     * @param string $value
     * @return int
     */
    function extract_int(string $value): int
    {
        return (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }
}



if (!function_exists('extract_numbers')) {
    /**
     * Extract int from string
     *
     * @param string $value
     * @return array
     */
    function extract_numbers(string $value): array
    {
        preg_match_all('!\d+\.?\d+!', $value, $matches);

        return $matches;
    }
}
