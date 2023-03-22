<?php

namespace Stepanenko3\LaravelApiSkeleton\Database\Eloquent;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Stepanenko3\LaravelApiSkeleton\Http\Schemas\HttpSchema;

abstract class Model extends BaseModel
{
    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    public function scopeApplySchema(
        QueryBuilder | EloquentBuilder $builder,
        HttpSchema $schema,
    ): QueryBuilder | EloquentBuilder {
        return $schema->applyToQuery($builder);
    }

    public function scopeOnly(
        QueryBuilder | EloquentBuilder $q,
        ?array $values,
        string $field = 'id',
    ): QueryBuilder | EloquentBuilder {
        return $q->when(
            $values,
            fn ($query) => $query->whereIn(
                $this->qualifyColumn($field),
                $values,
            ),
        );
    }

    public function scopeExclude(
        QueryBuilder | EloquentBuilder $q,
        ?array $values,
        string $field = 'id',
    ): QueryBuilder | EloquentBuilder {
        return $q->when(
            $values,
            fn ($query) => $query->whereNotIn(
                $this->qualifyColumn($field),
                $values,
            ),
        );
    }
}
