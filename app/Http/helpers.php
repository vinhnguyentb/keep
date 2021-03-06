<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

if (!function_exists('carbon')) {
    /**
     * Return a new instance of the Carbon library class.
     *
     * @return mixed
     */
    function carbon()
    {
        return app(Carbon::class);
    }
}

if (!function_exists('sort_tasks_by')) {
    /**
     * Generate URL for sorting tasks.
     *
     * @param $attribute
     * @param $text
     * @return string
     */
    function sort_tasks_by($attribute, $text)
    {
        $sorting = [
            'sortBy' => $attribute,
            'direction' => request('direction') == 'asc'
                ? 'desc'
                : 'asc'
        ];

        if (request('page')) {
            $sorting = array_merge($sorting, ['page' => request('page')]);
        }

        return link_to_route('admin.tasks', $text, $sorting);
    }
}

if (!function_exists('sort_accounts_by')) {
    /**
     * Generate URL for sorting accounts.
     *
     * @param $attribute
     * @param $text
     * @return string
     */
    function sort_accounts_by($attribute, $text)
    {
        $sorting = [
            'sortBy' => $attribute,
            'direction' => request('direction') == 'asc'
                ? 'desc'
                : 'asc'
        ];

        if (request('page')) {
            $sorting = array_merge($sorting, ['page' => request('page')]);
        }

        return link_to_route('admin.members', $text, $sorting);
    }
}

if (!function_exists('short_time')) {
    /**
     * Return a short format of a timestamp.
     *
     * @param $timestamp
     * @return string
     */
    function short_time($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d');
    }
}

if (!function_exists('full_time')) {
    /**
     * Return a full format of a timestamp.
     *
     * @param $timestamp
     * @return string
     */
    function full_time($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d, H:i:s');
    }
}

if (!function_exists('humans_time')) {
    /**
     * Return the human-friendly difference time interval.
     *
     * @param $timestamp
     * @return string
     */
    function humans_time($timestamp)
    {
        return Carbon::parse($timestamp)->diffForHumans();
    }
}

if (!function_exists('plural')) {
    /**
     * Plural a word using the associated counter value.
     *
     * @param $pattern
     * @param $counter
     * @return string
     */
    function plural($pattern, $counter)
    {
        if (!is_numeric($counter)) {
            throw new InvalidArgumentException();
        }

        return $counter . ' ' . str_plural($pattern, $counter);
    }
}

if (!function_exists('plural2')) {
    /**
     * Plural a word using the associated counter
     * value with a middle pattern.
     *
     * @param $pattern
     * @param $middle
     * @param $counter
     * @return string
     */
    function plural2($pattern, $middle, $counter)
    {
        if (!is_numeric($counter)) {
            throw new InvalidArgumentException();
        }

        return $counter . ' ' . $middle . ' ' . str_plural($pattern, $counter);
    }
}

if (!function_exists('remaining_days')) {
    /**
     * Get the difference in days between a specified
     * timestamp and current time.
     *
     * @param $finish
     * @return string
     */
    function remaining_days($finish)
    {
        $count = (int)Carbon::now()->diffInDays(Carbon::parse($finish));

        return $count . ' ' . str_plural('day', $count) . ' remaining';
    }
}

if (!function_exists('counting')) {
    /**
     * Count the total number of instances inside a collection or a
     * paginated collection.
     *
     * @param $object
     * @return int
     */
    function counting($object)
    {
        if (!($object instanceof Collection or $object instanceof LengthAwarePaginator)) {
            throw new InvalidArgumentException();
        }

        if ($object instanceof LengthAwarePaginator) {
            return $object->total();
        }

        return $object->count();
    }
}

if (!function_exists('print_attr')) {
    /**
     * Print attribute of object or return a default value.
     *
     * @param $attribute
     * @return string
     */
    function print_attr($attribute)
    {
        if (empty($attribute)) {
            return '-';
        }

        return $attribute;
    }
}

if (!function_exists('blank')) {
    /**
     * Check if a collection or a paginated
     * collection is empty or not.
     *
     * @param $object
     * @return bool
     */
    function blank($object)
    {
        if (!($object instanceof Collection or $object instanceof LengthAwarePaginator)) {
            throw new InvalidArgumentException();
        }

        return $object->isEmpty();
    }
}

if (!function_exists('paginate')) {
    /**
     * Generate the pagination URL. There two cases:
     *  - The normal case with no query string.
     *  - And the paginate with some associated query strings.
     *
     * @param $collection
     * @param array|null $queries
     * @return string
     */
    function paginate($collection, array $queries = null)
    {
        if (request()->has(['sortBy', 'direction'])) {
            if (is_array($queries)) {
                $queries = array_merge($queries, [
                    'sortBy' => request('sortBy'),
                    'direction' => request('direction')
                ]);
            } else {
                $queries = [
                    'sortBy' => request('sortBy'),
                    'direction' => request('direction')
                ];
            }
        }

        if (!$queries) {
            return '<div class="text-center">' . $collection->render() . '</div>';
        } else {
            return '<div class="text-center">' . $collection->appends($queries)->render() . '</div>';
        }
    }
}

if (!function_exists('zero')) {
    /**
     * Check for a "zeroed" value.
     *
     * @param $count
     * @return bool
     */
    function zero($count)
    {
        return $count === 0;
    }
}

if (!function_exists('array_random_val')) {
    /**
     * Generate random values from a given array.
     *
     * @param array $arr
     * @return mixed
     */
    function array_random_val(array $arr)
    {
        return $arr[array_rand($arr)];
    }
}

if (!function_exists('error_text')) {
    /**
     * Utility function to print out the error in forms.
     *
     * @param ViewErrorBag $errors
     * @param $field
     * @return mixed
     */
    function error_text(ViewErrorBag $errors, $field)
    {
        if ($errors->has($field)) {
            return $errors->first($field, '<span class="help-block form-error-text">:message</span>');
        }
    }
}

if (!function_exists('validate_query_string')) {
    /**
     * Check if the current query string is in the allowed set of
     * query strings.
     *
     * @param $current
     * @param array $possible
     * @return bool
     */
    function validate_query_string($current, array $possible)
    {
        if (!$current || !in_array($current, $possible)) {
            return false;
        }

        return true;
    }
}

if (!function_exists('get_by_key')) {
    /**
     * Get the values from an array using a key.
     *
     * @param $key
     * @param array $data
     * @return array
     */
    function get_by_key($key, array $data)
    {
        return array_key_exists($key, $data) ? $data[$key] : [];
    }
}

if (!function_exists('check_session_key')) {
    /**
     * Check if a session key exists and equal to a vlue.
     *
     * @param $key
     * @param $value
     * @return bool
     */
    function certify_session_key($key, $value)
    {
        if (!session()->has($key)) {
            return false;
        }

        if (session($key) === $value) {
            return true;
        }

        return false;
    }
}
