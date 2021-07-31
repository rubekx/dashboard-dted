<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function tickets($type, $count = null)
    {
        $field = $this->ticketQueryField($count);
        $where = $this->ticketQueryWhere($type);
        $tables = $this->ticketQueryTable();
        $order_by = "ORDER BY ost_thread_event.thread_id ASC";
        $sql = "SELECT " . $field . " " . $tables . " " . $where . " " . $order_by;
        return DB::connection('mysql2')->select($sql);
    }

    public function ticketQueryField($count = null)
    {
        $field = $count == null ? "ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
        ost_user_email.address AS email,
        ost_user__cdata.phone AS telefone,
        ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_department.name AS departamento,
        CONCAT(ost_staff.firstname,' ',ost_staff.lastname) AS staff,
        ost_thread_event.thread_id,
        CASE
            WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
            WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
            WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
            WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
            WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
            WHEN ost_thread_event.state = 'edited' THEN 'Editado'
            ELSE ost_thread_event.state
        END AS status_evento,
        ost_ticket_status.name AS status_chamado,
        DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
        DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "COUNT(ost_ticket.number) AS total";
        return $field;
    }

    public function ticketQueryTable()
    {
        $table = "FROM ost_thread_event
        JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id
        LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id";
        return $table;
    }

    public function ticketQueryWhere($type)
    {
        $where = '';
        if ($type == 1) {
            $where = 'WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)';
        } elseif ($type == 2) {
            $where = "WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id) AND ost_ticket.status_id = 3";
        } elseif ($type == 3) {
            $where = "WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='reopened' GROUP BY ost_thread_event.thread_id) AND ost_ticket.status_id IN (1,6)";
        } elseif ($type == 4) {
            $where = "WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='transferred' GROUP BY ost_thread_event.thread_id) AND ost_ticket.status_id IN (1,6)";
        } elseif ($type == 5) {
            $where = "WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='overdue' GROUP BY ost_thread_event.thread_id)
            AND ost_thread_event.thread_id not IN (SELECT thread_id from ost_thread_event where ost_thread_event.state ='closed'GROUP BY thread_id ORDER BY id DESC)
            AND ost_ticket.status_id IN (1,6)";
        } elseif ($type == 6) {
            $where = "WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id) AND ost_ticket.status_id IN (1,6)";
        }
        return $where;
    }

    /**
     * 230226
     * Solicitante - Solicitante
     * Staff - legenda (secretario / tecnico dted)
     * Detalhe - De "fulano' atribuido para 'outro fulano"
     * Adicionar caixa criada pelo sistema com status (Ex: Marcado em atraso)
     * Data no formato BR e remover segundo
     * listar o polo do solicitante
     * diponibilizar anexos dos chamados
     * SELECT `id`, `form_id`, `object_id`, `object_type`, `sort`, `extra`, `created`, `updated` FROM `ost_form_entry` WHERE `object_id` = $thread_id ORDER BY `object_id` DESC
     * SELECT `entry_id`, `field_id`, `value`, `value_id` FROM `ost_form_entry_values` WHERE `entry_id` = 4569 ORDER BY `entry_id` DESC
     *
     */

    public function formEntryValues($thread_id)
    {
        $response = null;
        if (!empty($thread_id)) {
            $sql = "SELECT ost_form_field.label, ost_form_entry_values.value FROM ost_form_entry
            JOIN ost_form_entry_values ON ost_form_entry_values.entry_id = ost_form_entry.id
            JOIN ost_form_field ON ost_form_field.id=ost_form_entry_values.field_id
            JOIN ost_thread ON ost_thread.object_id=ost_form_entry.object_id
            WHERE ost_form_entry.form_id = 2 AND ost_thread.id = '" . $thread_id . "'";
            $response = DB::connection('mysql2')->select($sql);
        }
        return $response;
    }

    public function ticketDetails($thread_id)
    {
        $response = null;
        if (!empty($thread_id)) {
            $sql = "SELECT
            ost_ticket.number,
            ost_ticket_status.name AS stats,
            ost_ticket.created,
            ost_department.name AS department,
            ost_sla.name AS sla,
            ost_team.name AS team,
            ost_help_topic.topic,
            ost_sla.grace_period
            FROM ost_thread
            JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
            JOIN ost_ticket_status ON ost_ticket.status_id = ost_ticket_status.id
            LEFT JOIN ost_department ON ost_department.id=ost_ticket.dept_id AND ost_ticket.dept_id != 0
            LEFT JOIN ost_sla ON ost_sla.id=ost_ticket.sla_id AND ost_ticket.sla_id != 0
            LEFT JOIN ost_staff ON ost_staff.staff_id=ost_ticket.staff_id AND ost_ticket.staff_id != 0
            LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id AND ost_ticket.topic_id != 0
            LEFT JOIN ost_team ON ost_team.team_id=ost_ticket.team_id AND ost_ticket.team_id != 0
            WHERE ost_thread.id = '" . $thread_id . "'";
            $response = DB::connection('mysql2')->select($sql);

            foreach ($response as $element) {
                $response = [
                    ['Chamado' => $element->number],
                    ['Status' => $element->stats],
                    ['Data de Criação' => $element->created],
                    ['Departamento' => empty($element->department) ? null : $element->department],
                    ['Plano de SLA' => empty($element->sla) ? null : $element->sla],
                    ['Equipe' => empty($element->team) ? null : $element->team],
                    ['Tópico de ajuda' => empty($element->topic) ? null : $element->topic],
                    ['Período de carência' => empty($element->grace_period) ? null : $element->grace_period . ' horas'],
                ];
            }
        }
        return $response;
    }

    public function threadHeader($thread_id)
    {
        $header = '';
        if (!empty($thread_id)) {
            $ticket_details = $this->ticketDetails($thread_id);
            $form_entry_values = $this->formEntryValues($thread_id);
            foreach ($form_entry_values as $element) {
                $header = $this->headerCard($header, $element->label, $element->value);
            }
            foreach ($ticket_details as $element) {
                if (!is_null($element[key($element)])) {
                    $header = $this->headerCard($header, key($element), $element[key($element)]);
                }
            }
        }
        $header = $this->headerCard($header);
        return $header;
    }

    public function threadEntries($thread_id, $response)
    {
        if (!empty($thread_id)) {
            $sql = "SELECT poster, body, title, CASE WHEN staff_id != 0 THEN 'Staff' ELSE 'Solicitante' END AS ator, created AS data_post FROM ost_thread_entry WHERE thread_id = '" . $thread_id . "' ORDER BY thread_id ASC";
            $result = DB::connection('mysql2')->select($sql);
            foreach ($result as $element) {
                $response[] = [
                    'data_envio' => $element->data_post,
                    'autor' => $element->poster,
                    'tipo_autor' => $element->ator,
                    'message' => $element->body,
                    'tipo' => 1,
                    'title' => $element->title,
                ];
            }
        }
        return $response;
    }
    public function threadEnvents($thread_id, $response)
    {
        if (!empty($thread_id)) {
            $sql = "SELECT ost_thread_event.staff_id,
            ost_thread_event.team_id,
            ost_thread_event.dept_id,
            CASE
                WHEN ost_thread_event.uid IS NULL AND ost_thread_event.state ='reopened' THEN ost_thread_event.username
                WHEN ost_thread_event.username='SYSTEM' THEN 'Sistema'
                WHEN ost_thread_event.uid_type='S' THEN CONCAT(ost_staff.firstname,' ',ost_staff.lastname)
                WHEN ost_thread_event.uid_type='U' THEN ost_user.name
            END AS autor,
            CASE
                WHEN ost_thread_event.state = 'closed' THEN 'fechou'
                WHEN ost_thread_event.state = 'transferred' THEN CONCAT('transferiu para',' <b>', ost_department.name,'</b>')
                WHEN ost_thread_event.state = 'reopened' THEN 'reabriu '
                WHEN ost_thread_event.state = 'overdue' THEN 'sinalizou como atrasado'
                WHEN ost_thread_event.state = 'resent' THEN 'reenviou'
                WHEN ost_thread_event.state = 'edited' THEN 'editou'
                WHEN ost_thread_event.state = 'assigned' AND ost_thread_event.data LIKE '%team%' THEN CONCAT('atribuiu isto a',' <b>',ost_team.name,'</b>')
                WHEN ost_thread_event.state = 'assigned' AND ost_thread_event.data NOT LIKE '%team%' THEN CONCAT('atribuiu isto a',' <b>',staff.firstname,' ',staff.lastname,'</b>')
                WHEN ost_thread_event.state = 'created' THEN 'criou'
                ELSE ost_thread_event.state
            END AS status_evento,
            CASE
                WHEN ost_thread_event.uid IS NULL AND ost_thread_event.state ='reopened' THEN 'Solicitante'
                WHEN ost_thread_event.uid_type = 'S' THEN 'Staff'
                WHEN ost_thread_event.uid_type = 'U' THEN 'Solicitante'
            END AS tipo_autor,
            ost_thread_event.uid,
            ost_thread_event.timestamp AS data_post,
            ost_thread_event.username
            FROM ost_thread_event
            LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id AND ost_thread_event.dept_id != 0
            LEFT JOIN ost_team ON ost_team.team_id=ost_thread_event.team_id AND ost_thread_event.team_id != 0
            LEFT JOIN ost_staff ON ost_staff.staff_id = ost_thread_event.uid AND ost_thread_event.uid_type='S'
            LEFT JOIN ost_staff AS staff ON staff.staff_id = ost_thread_event.staff_id AND ost_thread_event.staff_id != 0 AND ost_thread_event.state = 'assigned'
            LEFT JOIN ost_user ON ost_user.id = ost_thread_event.uid AND (ost_thread_event.uid_type='U' OR (ost_thread_event.state ='reopened' AND ost_thread_event.uid IS NULL))
            WHERE ost_thread_event.thread_id = '" . $thread_id . "'
            ORDER BY ost_thread_event.thread_id ASC";

            $result = DB::connection('mysql2')->select($sql);
            foreach ($result as $element) {
                $response[] = [
                    'data_envio' => $element->data_post,
                    'autor' => $element->autor,
                    'status' => $element->status_evento,
                    'tipo_autor' => $element->tipo_autor,
                    'message' => $element->status_evento,
                    'tipo' => 2,
                ];
            }
        }
        return $response;
    }

    public function threadCard($message, $element)
    {
        $data_br = date('d/m/Y H:i:s', strtotime($element['data_envio']));
        $tipo = $element['tipo'] == 1 ? 'postou' : $element['status'];
        $color = $element['tipo_autor'] == "Staff" ? 'secondary' : 'primary';
        $message = $message . '<div class="card" style="margin-bottom:10px;"><div class="card-header bg-' . $color . ' text-white">' . $element['tipo_autor'] . ': <b>' . $element['autor'];
        if ($element['tipo'] == 1) {
            $title = $element['title'] != null ? $element['title'] : '';
            $message = $message . '</b> ' . $tipo . ' ' . $data_br . '  ' . $title . '</div><div class="card-body"><p class="card-text">' . $element['message'] . '</p></div></div></div>';
        } elseif ($element['tipo'] == 2) {
            $message = $message . '</b> ' . $element['message'] . ' ' . $data_br . '</div></div>';
        }
        return $message;
    }

    public function headerCard($message, $key = null, $value = null)
    {
        if (!is_null($key) && !is_null($value)) {
            $message = $message . '<b>' . $key . ':</b> ' . $value . '<br>';
        } else {
            $message = '<div class="alert alert-primary" role="alert">' . $message . '</div>';
        }
        return $message;
    }

    public function threadEntryAjax($thread_id)
    {
        $message = '';
        $thread_data = [];
        $header = $this->threadHeader($thread_id);
        $thread_data = $this->threadEntries($thread_id, $thread_data);
        $thread_data = $this->threadEnvents($thread_id, $thread_data);
        usort($thread_data, [$this, 'date_compare']);
        foreach ($thread_data as $element) {
            $message = $this->threadCard($message, $element);
        }
        $header = $header . $message;
        return $header;
    }

    public function date_compare($element1, $element2)
    {
        $datetime1 = strtotime($element1['data_envio']);
        $datetime2 = strtotime($element2['data_envio']);
        return $datetime1 - $datetime2;
    }

    public function ticketsTableAjax(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->tickets($request->type);
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '<a data-toggle="tooltip" data-id="' . $row->thread_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm showMessages">Detalhes</a>';
                return $btn;
            })->rawColumns(['action'])->make(true);
        }
    }

    public function indexTable()
    {
        return view('dashboard')->with([
            'ticketsCreated' => $this->tickets(1, 1)[0]->total,
            'ticketsClosed' => $this->tickets(2, 1)[0]->total,
            'ticketsReopened' => $this->tickets(3, 1)[0]->total,
            'ticketsTransferred' => $this->tickets(4, 1)[0]->total,
            'ticketsOverdue' => $this->tickets(5, 1)[0]->total,
            'ticketsOpened' => $this->tickets(6, 1)[0]->total,
        ]);
    }
}
