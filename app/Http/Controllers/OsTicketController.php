<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OsTicketController extends Controller
{
    private const DEPT = 1;
    private const TEAM = 2;
    private const STAF = 3;

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function queryBuilder($qry_elements)
    {
        $response = null;
        if (!empty($qry_elements)) {
            $response = "";
            foreach ($qry_elements as $element) {
                $response = "{$response} {$element}";
            }
            $response = DB::connection('mysql2')
                ->select("SELECT {$response}");
        }
        return $response;
    }

    public function actorEmails($ticket_status, $actor)
    {
        $response = null;
        if (!empty($ticket_status) && !empty($actor)) {
            $email = "ost_staff.email";
            $join = "";
            if ($actor == 1) {
                $join = "LEFT JOIN ost_email ON ost_email.dept_id=ost_department.email_id";
                $email = "ost_email.email";
            }
            $field = "{$email} AS email ";
            $table = $this->ticketTables();
            info($table);
            $table = "{$table} {$join}";
            $where = $this->ticketWhereByStatus($ticket_status);
            $order = " ORDER BY ost_thread_event.thread_id ASC";

            $query_array = [$field, $table, $where, $order];
            info(print_r($query_array, true));

            $response = [
                "ticket_status" => $ticket_status,
                "actor" => $actor,
                "emails" => $this->queryBuilder($query_array
                )];
        }
        return $response;
    }

    public function ticketWhereByStatus($ticket_status)
    {
        $response = null;
        if (!empty($ticket_status)) {
            $response = "WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event";
            switch ($ticket_status) {
                case 1:
                    $response = "{$response} GROUP BY ost_thread_event.thread_id)";
                    break;
                case 2:
                    $response = "{$response} GROUP BY ost_thread_event.thread_id) AND ost_ticket.status_id = 3";
                    break;
                case 3:
                    $response = "{$response} WHERE ost_thread_event.state ='reopened' GROUP BY ost_thread_event.thread_id) AND ost_ticket.status_id IN (1,6)";
                    break;
                case 4:
                    $response = "{$response} WHERE ost_thread_event.state ='transferred' GROUP BY ost_thread_event.thread_id) AND ost_ticket.status_id IN (1,6)";
                    break;
                case 5:
                    $response = "{$response} WHERE ost_thread_event.state ='overdue' GROUP BY ost_thread_event.thread_id) "
                        . "AND ost_thread_event.thread_id NOT IN (SELECT thread_id FROM ost_thread_event WHERE ost_thread_event.state ='closed' GROUP BY thread_id ORDER BY id DESC) "
                        . "AND ost_ticket.status_id IN (1,6)";
                    break;
                    info('----------------------------------------------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>');
                    info($response);
                case 6:
                    $response = "{$response} GROUP BY ost_thread_event.thread_id) AND ost_ticket.status_id IN (1,6)";
                    break;
            }
        }
        info($ticket_status);
        return $response;
    }

    public function ticketTables()
    {
        return "FROM ost_thread_event "
            . "JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id "
            . "JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id "
            . "LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id "
            . "LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id "
            . "LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id "
            . "LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id "
            . "LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id "
            . "LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id "
            . "LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id "
            . "LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id";
    }

    public function ticketFields($count = null)
    {
        $field = $count == null ? "ost_ticket.number AS chamado,"
        . " ost_ticket.ticket_id,"
        . " ost_user.name AS usuario,"
        . " ost_user_email.address AS email,"
        . " ost_user__cdata.phone AS telefone,"
        . " ost_help_topic.topic AS curso,"
        . " ost_ticket__cdata.subject AS assunto,"
        . " ost_department.name AS departamento,"
        . " CONCAT(ost_staff.firstname,' ',ost_staff.lastname) AS staff,"
        . " ost_thread_event.thread_id,"
        . " CASE"
        . "     WHEN ost_thread_event.state = 'closed' THEN 'Fechado'"
        . "     WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'"
        . "     WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'"
        . "     WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'"
        . "     WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'"
        . "     WHEN ost_thread_event.state = 'edited' THEN 'Editado'"
        . "     ELSE ost_thread_event.state"
        . " END AS status_evento,"
        . " ost_ticket_status.name AS status_chamado,"
        . " DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,"
        . " DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "COUNT(ost_ticket.number) AS total";
        return $field;
    }

    public function countElements($query_elements)
    {

    }

}
