<?php

namespace App\Repository;

// use Illuminate\Support\Facades\DB;

/**
 * Interface QueryBuilderRepositoryInterface
 * @package App\Repositories
 */
interface QueryBuilderRepositoryInterface
{
    /**
     * @return string the returned string contains JSON
     */
    public function queryBuilder(string $query): string;
}
