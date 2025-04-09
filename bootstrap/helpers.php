<?php

declare(strict_types=1);

use App\Models\Option;

/**
 * Get the specified option value.
 */
function get_option(string $name, $default = null)
{
    return Option::get($name, $default);
}
