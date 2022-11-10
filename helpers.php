<?php

declare(strict_types=1);


use App\Models\User;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Support\Collection as SupportCollection;


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


if (!function_exists('value_or_null')) {
    /**
     * get value data
     *
     */
    function value_or_null(mixed $value, $unwantedValue)
    {
        return ($value == $unwantedValue) ? null : $value;
    }
}


if (!function_exists('get_domain')) {
    /**
     * get the main domain from string
     *
     */
    function get_domain(string $url)
    {
        $pieces = parse_url($url);
        $domain = $pieces['host'] ?? '';
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return null;
    }
}


if (!function_exists('is_web_file')) {
    /**
     * @param $file
     * @return bool
     */
    function is_web_file($file): bool
    {
        $fp = @fopen($file, "r");
        if ($fp !== false)
            fclose($fp);

        return (bool)($fp);
    }
}



if (!function_exists('get_domain_name')) {
    /**
     * get the main domain from string
     *
     */
    function get_domain_name(string $url)
    {
        $domain = get_domain($url);

        if (is_null($domain))
        {
            return null;
        }

        if (preg_match('/(\w+)\./i', $domain, $regs)) {
            return $regs[1];
        }
        return null;
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
        preg_match_all('!\d+[\.\-]?\d+!', $value, $matches);
        // preg_match_all('!\d+\.?\d+!', $value, $matches);

        return $matches;
    }
}

if (!function_exists('extract_number')) {
    /**
     * Extract int from string
     *
     * @param string $value
     * @return string
     */
    function extract_number(string $value): string
    {
        preg_match('!\d+[\.\-]?\d*!', $value, $matches);
        return $matches[0] ?? $value;
    }
}



if (!function_exists('swap')) {
    /**
     * @param $a
     * @param $b
     * @return void
     */
    function swap(&$a, &$b): void
    {
        $temp = $a;
        $a = $b;
        $b = $temp;
    }
}


if (!function_exists('dump_sql')) {
    /**
     * Returns sql query with bindings data.
     *
     * @param $builder
     * @return array|mixed|string|string[]|null
     */
    function dump_sql($builder): mixed
    {
        $sql = $builder->toSql();
        $bindings = $builder->getBindings();

        array_walk($bindings, function ($value) use (&$sql) {
            $value = is_string($value) ? var_export($value, true) : $value;
            $sql = preg_replace("/\?/", $value, $sql, 1);
        });
        return $sql;
    }
}


if (!function_exists('carbon')) {
    /**
     * Shortcut for: new Carbon or Carbon::parse()
     *
     * @param ...$args
     * @return Carbon
     */
    function carbon(...$args): Carbon
    {
        return new Carbon(...$args);
    }
}



if (!function_exists('recursive')) {
    /**
     * @param $values
     * @return SupportCollection
     */
    function recursive($values): SupportCollection
    {
        return collect($values)->map(function($value){
            if (is_array($value) || is_object($value)) {
                return recursive($value);
            }
            return $value;
        });

    }
}