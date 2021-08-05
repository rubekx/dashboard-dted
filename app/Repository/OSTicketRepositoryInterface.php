<?php
// https://asperbrothers.com/blog/implement-repository-pattern-in-laravel/
namespace App\Repository;

interface OSTicketRepositoryInterface
{
    /**
     * @return string the returned string contains JSON
     */
    public function all(): string;

    /**
     * @param int $ticket_id
     * @return string the returned string contains JSON
     */
    public function tickteByID(int $ticket_id): string;

    /**
     * @param int $number
     * @return string the returned string contains JSON
     */
    public function tickteByNumber(int $number): string;

    /**
     * @param int $thread_id
     * @return string the returned string contains JSON
     */
    public function tickteByThreadId(int $thread_id): string;

    /**
     * @param int $object_id
     * @return string the returned string contains JSON
     */
    public function tickteByObjectId(int $object_id): string;

    /**
     * @param array $state
     * @return string the returned string contains JSON
     */
    public function ticktesByState(string $state): string;

}
