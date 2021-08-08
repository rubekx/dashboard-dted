<?php

namespace App\Repositories\Ticket;

use App\Repositories\Ticket\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TicketRepository implements TicketRepositoryInterface
{
    /**
     * @var DB
     */
    protected $db;

    /**
     * DB constructor.
     * @param DB $db
     */
    public function __construct()
    {
        $this->db = DB::connection('mysql2');
    }

    /**
     * @return string the returned string contains JSON
     */
    public function all()
    {
        return $this->db->table('ost_ticket_status')->get();
    }

    /**
     * @param int $ticket_id
     * @return string the returned string contains JSON
     */
    public function tickteByID($ticket_id)
    {

    }

    /**
     * @param int $number
     * @return string the returned string contains JSON
     */
    public function tickteByNumber($number)
    {

    }
    /**
     * @param int $thread_id
     * @return string the returned string contains JSON
     */
    public function tickteByThreadId($thread_id)
    {

    }

    /**
     * @param int $object_id
     * @return string the returned string contains JSON
     */
    public function tickteByObjectId($object_id)
    {

    }

    /**
     * @param array $state
     * @return string the returned string contains JSON
     */
    public function ticktesByState($state)
    {

    }

}
