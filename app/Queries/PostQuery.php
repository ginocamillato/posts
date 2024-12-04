<?php

namespace App\Queries;

use App\Models\Post;
use App\Filters\PostFilter;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class PostQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Post::query();

        parent::__construct($query);

        $this
            ->defaultSort('-posts.id')
            ->allowedSorts([
                AllowedSort::field('id', 'posts.id'),
                AllowedSort::field('title', 'posts.title'),
            ])
            ->allowedFilters([
                AllowedFilter::custom('search', new PostFilter),
            ]);
    }
}