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
     * @param array $state
     * @return string the returned string contains JSON
     */
    public function ticktesByState(string $state): string;

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
    * @param int $thread_id
    * @return string the returned string contains JSON
    */
   public function tickteByThreadIad(int $thread_id): string;    
   
   /**
   * @param int $thread_id
   * @return string the returned string contains JSON
   */
  public function tickteByThreaadId(int $thread_id): string;

    // ticket_id
    // object_id

}
