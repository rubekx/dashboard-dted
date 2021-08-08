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
     * @param string $state
     * @param int $count
     * @return string the returned string contains JSON
     */
    public function ticktesByState($state, $count = null)
    {
        $count = is_null($count) ? 'taable' : $count;
        return $this->db->table('ost_thread_event')
            ->join('ost_thread', 'ost_thread.id', '=', 'ost_thread_event.thread_id')
            ->join('ost_ticket', 'ost_ticket.ticket_id', '=', 'ost_thread.object_id')
            ->leftJoin('ost_ticket__cdata', 'ost_ticket__cdata.ticket_id', '=', 'ost_ticket.ticket_id')
            ->leftJoin('ost_ticket_status', 'ost_ticket_status.id', '=', 'ost_ticket.status_id')
            ->leftJoin('ost_user', 'ost_user.id', '=', 'ost_ticket.user_id')
            ->leftJoin('ost_user__cdata', 'ost_user__cdata.user_id', '=', 'ost_user.id')
            ->leftJoin('ost_user_email', 'ost_user_email.user_id', '=', 'ost_user.id')
            ->leftJoin('ost_help_topic', 'ost_help_topic.topic_id', '=', 'ost_ticket.topic_id')
            ->leftJoin('ost_staff', 'ost_staff.staff_id', '=', 'ost_thread_event.staff_id')
            ->leftJoin('ost_department', 'ost_department.id', '=', 'ost_thread_event.dept_id')
            ->where(function ($query) use ($state) {
                switch ($state) {
                    case 1:
                        $query->whereIn('ost_thread_event.id', $this->db->table('ost_thread_event')->selectRaw('MAX(id)')->groupBy('thread_id'));
                        break;
                    case 2:
                        $query->whereIn('ost_thread_event.id', $this->db->table('ost_thread_event')->selectRaw('MAX(id)')->groupBy('thread_id'))->where('ost_ticket.status_id', 3);
                        break;
                    case 3:
                        $query->whereIn('ost_thread_event.id', $this->db->table('ost_thread_event')->selectRaw('MAX(id)')->where('state', 'reopened')->groupBy('thread_id'))->whereIn('ost_ticket.status_id', [1, 6]);
                        break;
                    case 4:
                        $query->whereIn('ost_thread_event.id', $this->db->table('ost_thread_event')->selectRaw('MAX(id)')->where('state', 'transferred')->groupBy('thread_id'))->whereIn('ost_ticket.status_id', [1, 6]);
                        break;
                    case 5:
                        $query->whereIn('ost_thread_event.id', $this->db->table('ost_thread_event')->selectRaw('MAX(id)')->where('state', 'overdue')->groupBy('thread_id'))
                            ->whereNotIn('ost_thread_event.thread_id', $this->db->table('ost_thread_event')->select('thread_id')->where('state', 'closed')->groupBy('thread_id')->orderBy('id', 'DESC'))
                            ->whereIn('ost_ticket.status_id', [1, 6]);
                        break;
                    case 6:
                        $query->whereIn('ost_thread_event.id', $this->db->table('ost_thread_event')->selectRaw('MAX(id)')->groupBy('thread_id'))->whereIn('ost_ticket.status_id', [1, 6]);
                        break;
                }
            })
            ->when($count, function ($query, $count) {
                $query->select($this->responseTicktesByState($count));
                return $count == 1 ? $query->first()->total : $query->get();
            });
    }

    /**
     * @param int $role
     * @return object the returned string contains JSON
     */
    public function responseTicktesByState($count)
    {
        return $this->db->raw($count == 1 ? "COUNT(ost_ticket.number) AS total" : ""
            . "ost_ticket.number AS chamado,"
            . "ost_ticket.ticket_id,"
            . "ost_user.name AS usuario,"
            . "ost_user_email.address AS email,"
            . "ost_user__cdata.phone AS telefone,"
            . "ost_help_topic.topic AS curso,"
            . "ost_ticket__cdata.subject AS assunto,"
            . "ost_department.name AS departamento,"
            . "CONCAT(ost_staff.firstname,' ',ost_staff.lastname) AS staff,"
            . "ost_thread_event.thread_id,"
            . " CASE "
            . "     WHEN ost_thread_event.state = 'closed' THEN 'Fechado'"
            . "     WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'"
            . "     WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'"
            . "     WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'"
            . "     WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'"
            . "     WHEN ost_thread_event.state = 'edited' THEN 'Editado'"
            . "     ELSE ost_thread_event.state"
            . " END AS status_evento,"
            . "ost_ticket_status.name AS status_chamado,"
            . "DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,"
            . "DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio"
        );
    }
}
