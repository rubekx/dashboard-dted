<?php

namespace App\Repository\QueryBuilder;

use App\Repository\QueryBuilderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BaseRepository implements QueryBuilderRepositoryInterface
{
    /**
     * @var DB
     */
    protected $db;

    /**
     * BaseRepository constructor.
     * @param DB $db
     */
    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * @param string $query
     * @return string
     */
    public function queryBuilder(array $query): string
    {
        return $this->db->connection('mysql2')->select("SELECT {$query}");
    }

}
