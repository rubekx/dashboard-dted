<?php
// https://www.onlinecode.org/jquery-datatable-server-side-sortingpagination-and-searching-using-php-and-mysql/
namespace App\Http\Controllers;

use App\Repositories\Ticket\TicketRepositoryInterface;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    private $repository;

    public function __construct(TicketRepositoryInterface $repository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
    }

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
            $sql = "SELECT poster,body,title,
            CASE
                WHEN staff_id != 0 THEN 'Staff'
                ELSE 'Solicitante'
            END AS ator, created AS data_post
            FROM ost_thread_entry WHERE thread_id = '" . $thread_id . "' ORDER BY thread_id ASC";
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
        if (!empty($thread_id)) {
            $thread_data = [];
            $header = $this->threadHeader($thread_id);
            $message = $header . $message;
            $thread_data = $this->threadEntries($thread_id, $thread_data);
            $thread_data = $this->threadEnvents($thread_id, $thread_data);
            usort($thread_data, [$this, 'date_compare']);
            foreach ($thread_data as $element) {
                $message = $this->threadCard($message, $element);
            }
        }
        return $message;
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
            try {
                $data = $this->repository->ticktesByState($request->type);
            } catch (\Exception $e) {
                info($e);
                $data = [];
            }
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                return $this->buttonTable($row->thread_id);
            })->rawColumns(['action'])->make(true);
        }
    }

    public function buttonTable($id)
    {
        return '<a data-toggle="tooltip" data-id="' . $id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm showMessages">Detalhes</a>';
    }

    public function indexTable()
    {
        return view('dashboard')
            ->with([
                'ticketsCreated' => $this->countTicketsByStatus(1),
                'ticketsClosed' => $this->countTicketsByStatus(2),
                'ticketsReopened' => $this->countTicketsByStatus(3),
                'ticketsTransferred' => $this->countTicketsByStatus(4),
                'ticketsOverdue' => $this->countTicketsByStatus(5),
                'ticketsOpened' => $this->countTicketsByStatus(6),
            ]);
    }

    public function countTicketsByStatus($type)
    {
        try {
            return $this->repository->ticktesByState($type, 1);
        } catch (\Exception $e) {
            info($e);
            return $e;
        }
    }

}
