<?php

namespace App\Queries;

use App\Filters\UserFilter;
use App\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;

class UserQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = User::query();

        parent::__construct($query);
        $this
            ->defaultSort('-users.id')
            ->allowedSorts([
                AllowedSort::field('id', 'users.id'),
                AllowedSort::field('email', 'users.email'),
                AllowedSort::field('name', 'users.name'),
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new UserFilter),
            ]);
    }
}