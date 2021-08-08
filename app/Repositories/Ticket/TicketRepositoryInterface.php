<?php

namespace App\Repositories\Ticket;

interface TicketRepositoryInterface
{
    /**
     * @return string the returned string contains JSON
     */
    public function all();

    /**
     * @param int $ticket_id
     * @return string the returned string contains JSON
     */
    public function tickteByID(int $ticket_id);

    /**
     * @param int $number
     * @return string the returned string contains JSON
     */
    public function tickteByNumber(int $number);

    /**
     * @param int $thread_id
     * @return string the returned string contains JSON
     */
    public function tickteByThreadId(int $thread_id);

    /**
     * @param int $object_id
     * @return string the returned string contains JSON
     */
    public function tickteByObjectId(int $object_id);

    /**
     * @param string $state
     * @param int  $count | nullable
     * @return string the returned string contains JSON
     */
    public function ticktesByState(int $state, int $count = null);

    /**
     * @param int $count
     * @return object the returned contains db object
     */
    public function responseTicktesByState(int $count);

}
