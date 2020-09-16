<?php

namespace App\Core\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method static Builder|static filter(array $attributes = [], string $filterClass = null)
 */
trait Filterable
{
    use \EloquentFilter\Filterable;
}
