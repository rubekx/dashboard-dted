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
    public static function index()
    {
        return DashboardController::ticketsCreated();
    }

    public static function ticketsCreated($count = null)
    {
        $select = $count == null ? "ost_ticket.ticket_id,
        ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
        ost_user_email.address AS email,
        ost_user__cdata.phone AS telefone,
        ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_department.name as departamento,
        CONCAT(ost_staff.firstname,' ',ost_staff.lastname) as staff,
        ost_thread_event.thread_id,
        CASE
            WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
            WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
            WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
            WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
            WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
            WHEN ost_thread_event.state = 'edited' THEN 'Editado'
            ELSE ost_thread_event.state
        END as status_evento,
        ost_ticket_status.name AS status_chamado,
        DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
        DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "count(ost_ticket.ticket_id) as total";

        $sql = "SELECT " . $select . "
            FROM ost_thread_event
            LEFT JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
            JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
            LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
            LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
            LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
            LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
            LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
            LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
            LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id
            LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id
            WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)

            ORDER BY ost_thread_event.thread_id ASC
            ";
        return DB::connection('mysql2')->select($sql);

    }

    public static function ticketsClosed($count = null)
    {
        $select = $count == null ? "ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
        ost_user_email.address AS email,
        ost_user__cdata.phone AS telefone,
        ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_department.name as departamento,
        CONCAT(ost_staff.firstname,' ',ost_staff.lastname) as staff,
        ost_thread_event.thread_id,
        CASE
            WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
            WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
            WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
            WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
            WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
            WHEN ost_thread_event.state = 'edited' THEN 'Editado'
            ELSE ost_thread_event.state
        END as status_evento,
        ost_ticket_status.name AS status_chamado,
        DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
        DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "count(ost_ticket.number) as total";

        $sql = "SELECT " . $select . "
        FROM ost_thread_event
        LEFT JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id
        LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)
        AND ost_ticket.status_id = 3
        ORDER BY ost_thread_event.thread_id ASC
        ";
        return DB::connection('mysql2')->select($sql);
    }

    public static function ticketsReopened($count = null)
    {
        $select = $count == null ? "ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
        ost_user_email.address AS email,
        ost_user__cdata.phone AS telefone,
        ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_department.name as departamento,
        CONCAT(ost_staff.firstname,' ',ost_staff.lastname) as staff,
        ost_thread_event.thread_id,
        CASE
            WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
            WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
            WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
            WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
            WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
            WHEN ost_thread_event.state = 'edited' THEN 'Editado'
            ELSE ost_thread_event.state
        END as status_evento,
        ost_ticket_status.name AS status_chamado,
        DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
        DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "count(ost_ticket.number) as total";

        $sql = "SELECT " . $select . "
        FROM ost_thread_event
        LEFT JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id
        LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='reopened' GROUP BY ost_thread_event.thread_id)
        AND ost_ticket.status_id IN (1,6)
        ORDER BY ost_thread_event.thread_id ASC
        ";
        return DB::connection('mysql2')->select($sql);
    }

    public static function ticketsAssigned($count = null)
    {
        $select = $count == null ? "ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
        ost_user_email.address AS email,
        ost_user__cdata.phone AS telefone,
        ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_department.name as departamento,
        CONCAT(ost_staff.firstname,' ',ost_staff.lastname) as staff,
        ost_thread_event.thread_id,
        CASE
            WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
            WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
            WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
            WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
            WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
            WHEN ost_thread_event.state = 'edited' THEN 'Editado'
            ELSE ost_thread_event.state
        END as status_evento,
        ost_ticket_status.name AS status_chamado,
        DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
        DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "count(ost_ticket.number) as total";

        $sql = "SELECT " . $select . "

        FROM ost_thread_event
        LEFT JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id
        LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='assigned' GROUP BY ost_thread_event.thread_id)
        AND ost_ticket.status_id IN (1,6)
        ORDER BY ost_thread_event.thread_id ASC
        ";
        return DB::connection('mysql2')->select($sql);
    }

    public static function ticketsTransferred($count = null)
    {
        $select = $count == null ? "ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
        ost_user_email.address AS email,
        ost_user__cdata.phone AS telefone,
        ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_department.name as departamento,
        CONCAT(ost_staff.firstname,' ',ost_staff.lastname) as staff,
        ost_thread_event.thread_id,
        CASE
            WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
            WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
            WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
            WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
            WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
            WHEN ost_thread_event.state = 'edited' THEN 'Editado'
            ELSE ost_thread_event.state
        END as status_evento,
        ost_ticket_status.name AS status_chamado,
        DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
        DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "count(ost_ticket.number) as total";

        $sql = "SELECT " . $select . "

        FROM ost_thread_event
        LEFT JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id
        LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='transferred' GROUP BY ost_thread_event.thread_id)
        AND ost_ticket.status_id IN (1,6)
        ORDER BY ost_thread_event.thread_id ASC
        ";
        return DB::connection('mysql2')->select($sql);
    }

    public static function ticketsOverdue($count = null)
    {
        $select = $count == null ? "ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
        ost_user_email.address AS email,
        ost_user__cdata.phone AS telefone,
        /*ost_help_topic.topic AS curso,*/
        ost_ticket__cdata.subject AS assunto,
        ost_thread_event.staff_id,
        ost_thread_event.dept_id,
        ost_department.name as departamento,
        CONCAT(ost_staff.firstname,' ',ost_staff.lastname) as staff,
        ost_thread_event.thread_id,
        CASE
            WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
            WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
            WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
            WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
            WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
            WHEN ost_thread_event.state = 'edited' THEN 'Editado'
            ELSE ost_thread_event.state
        END as status_evento,
        ost_ticket_status.name AS status_chamado,
        DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
        DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "count(ost_ticket.number) as total";

        $sql = "SELECT " . $select . "
        FROM ost_thread_event
        JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id
        LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id
        WHERE
        ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='overdue' GROUP BY ost_thread_event.thread_id)
        AND
        ost_thread_event.thread_id not IN (SELECT thread_id from ost_thread_event where ost_thread_event.state ='closed'GROUP BY thread_id ORDER BY id DESC)
        AND
        ost_ticket.status_id IN (1,6)
        ORDER BY ost_thread_event.thread_id ASC
        ";

        return DB::connection('mysql2')->select($sql);
    }

    public static function ticketsOpened($count = null)
    {
        $select = $count == null ? "ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
        ost_user_email.address AS email,
        ost_user__cdata.phone AS telefone,
        ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_department.name as departamento,
        CONCAT(ost_staff.firstname,' ',ost_staff.lastname) as staff,
        ost_thread_event.thread_id,
        CASE
            WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
            WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
            WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
            WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
            WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
            WHEN ost_thread_event.state = 'edited' THEN 'Editado'
            ELSE ost_thread_event.state
        END as status_evento,
        ost_ticket_status.name AS status_chamado,
        DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
        DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio" : "count(ost_ticket.number) as total";

        $sql = "SELECT " . $select . "
        FROM ost_thread_event
        LEFT JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        LEFT JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        LEFT JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        LEFT JOIN ost_staff ON ost_staff.staff_id=ost_thread_event.staff_id
        LEFT JOIN ost_department ON ost_department.id=ost_thread_event.dept_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)
        AND ost_ticket.status_id IN (1,6)
        ORDER BY ost_thread_event.thread_id ASC
        ";

        return DB::connection('mysql2')->select($sql);
    }

    public function threadEntryAjax($thread_id)
    {
        $sql = "SELECT poster, body, CASE WHEN staff_id != 0 THEN 'Staff' ELSE 'Solicitante' END AS ator, created AS data_post FROM ost_thread_entry WHERE thread_id = '" . $thread_id . "' ORDER BY thread_id ASC";
        $result = DB::connection('mysql2')->select($sql);

        $thread_data = [];
        foreach ($result as $res) {
            $thread_data[] = [
                'data_envio' => $res->data_post,
                'autor' => $res->poster,
                'tipo_autor' => $res->ator,
                'message' => $res->body,
                'tipo' => 1,
                'status' => null,
                'transferido' => null,
            ];
        }

        $sql = "SELECT ost_thread_event.staff_id, ost_thread_event.team_id, ost_thread_event.dept_id,
        CASE
        WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
        WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
        WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
        WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
        WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
        WHEN ost_thread_event.state = 'edited' THEN 'Editado'
        ELSE ost_thread_event.state
        END as status_evento,
        CASE
        WHEN ost_thread_event.uid_type = 'S' THEN 'Staff'
        WHEN ost_thread_event.uid_type = 'U' THEN 'Solicitante'
        ELSE ost_thread_event.uid_type
        END as tipo_autor, ost_thread_event.uid, ost_thread_event.timestamp AS  data_post, ost_thread_event.username FROM ost_thread_event WHERE ost_thread_event.thread_id = '" . $thread_id . "' ORDER BY ost_thread_event.thread_id ASC";
        $result = DB::connection('mysql2')->select($sql);

        foreach ($result as $res) {
            $thread_data[] = [
                'data_envio' => $res->data_post,
                'autor' => $res->uid . ' ' . $res->username,
                'status' => $res->status_evento,
                'tipo_autor' => $res->tipo_autor,
                'message' => $res->status_evento,
                'transferido_staf' => $res->staff_id != 0 ? '' : null,
                'transferido_depa' => $res->dept_id != 0 ? '' : null,
                'transferido_team' => $res->team_id != 0 ? '' : null,
                'tipo' => 2,
            ];
        }

        usort($thread_data, [$this, 'date_compare']);
        // $thread_data = json_encode($thread_data);
        // return $thread_data;

        $msg_staff = '<div class="card bg-primary"><div class="card-header">Featured</div><div class="card-body" style="background-color:#00AA9E;"><p class="card-text"></p></div></div>';

        $response = '';
        foreach ($thread_data as $res) {
            // $response = $response . '<b>' . $res['tipo_autor'] . ':</b> ' . $res['autor'] . ' ' . '<b>Data:</b> ' . $res['data_envio'] . '<br><b>Post:</b> ' . $res['message'] . '<hr>';
            $color = $res['tipo_autor'] == "Staff" ? 'secondary' : 'primary';
            $tipo = $res['tipo'] == 1 ? 'postou' : $res['status'];
            $response = $response . '<div class="card" style="margin-bottom:10px;">
                                        <div class="card-header bg-' . $color . ' text-white">' . $res['tipo_autor'] .' '.$res['autor'].' '.$tipo .' '.$res['data_envio'] .' </div>
                                            <div class="card-body">
                                                <p class="card-text">' . $res['message'] . '</p>
                                            </div>
                                        </div>
                                    </div>';
            /**
             * Solicitante - Solicitante
             * Staff - legenda (secretario / tecnico dted)
             * Detalhe - De "fulano' atribuido para 'outro fulano"
             * Adicionar caixa criada pelo sistema com status (Ex: Marcado em atraso)
             * Data no formato BR e remover segundo
             * listar o polo do solicitante
             * diponibilizar anexos dos chamados
             *
             */
        }

        return $response;
    }

    public function date_compare($element1, $element2)
    {
        $datetime1 = strtotime($element1['data_envio']);
        $datetime2 = strtotime($element2['data_envio']);
        return $datetime1 - $datetime2;
    }

    public static function ticketsTableAjax(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 1) {
                $data = DashboardController::ticketsCreated();
            } elseif ($request->type == 2) {
                $data = DashboardController::ticketsClosed();
            } elseif ($request->type == 3) {
                $data = DashboardController::ticketsReopened();
            } elseif ($request->type == 4) {
                $data = DashboardController::ticketsTransferred();
            } elseif ($request->type == 5) {
                $data = DashboardController::ticketsOverdue();
            } else {
                $data = DashboardController::ticketsOpened();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a data-toggle="tooltip" data-id="' . $row->thread_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm showMessages">Detalhes</a>';
                    // $btn = '<button type="button" data-id="' . $row->thread_id . '" class="btn btn-primary" data-toggle="modal" showMessages data-target="#modalThreadEntry">Open modal</button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public static function indexTable(Request $request)
    {
        $ticketsCreated = DashboardController::ticketsCreated(1);
        $ticketsClosed = DashboardController::ticketsClosed(1);
        $ticketsReopened = DashboardController::ticketsReopened(1);
        $ticketsTransferred = DashboardController::ticketsTransferred(1);
        $ticketsOverdue = DashboardController::ticketsOverdue(1);
        $ticketsOpened = DashboardController::ticketsOpened(1);
        // if ($request->ajax()) {
        //     info($request->ajax());
        //     $data = DashboardController::ticketsCreated();
        //     return Datatables::of($data)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {

        //             $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ticket_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Edit</a>';

        //             $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ticket_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCustomer">Delete</a>';

        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
        return view('dashboard')
            ->with([
                'ticketsCreated' => $ticketsCreated[0]->total,
                'ticketsClosed' => $ticketsClosed[0]->total,
                'ticketsReopened' => $ticketsReopened[0]->total,
                'ticketsTransferred' => $ticketsTransferred[0]->total,
                'ticketsOverdue' => $ticketsOverdue[0]->total,
                'ticketsOpened' => $ticketsOpened[0]->total,
            ]);
    }

}

// SELECT ost_ticket.number AS chamado,
// ost_ticket.ticket_id,
// ost_user.name AS solicitante,
// ost_user_email.address AS solicitante_email,
// ost_user__cdata.phone AS telefone,
// ost_help_topic.topic AS curso,
// ost_ticket__cdata.subject AS assunto,
// ost_thread_event.staff_id,
// ost_thread_event.dept_id,
// CASE
//     WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
//     WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
//     WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
//     WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
//     WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
//     WHEN ost_thread_event.state = 'edited' THEN 'Editado'
//     ELSE ost_thread_event.state
// END as status_evento,
// ost_ticket_status.name AS status_chamado,
// DATE_FORMAT(ost_ticket.lastupdate, '%d/%m/%Y %H:%i:%s') ultima_atualizacao,
// DATE_FORMAT(ost_ticket.created, '%d/%m/%Y %H:%i:%s') envio
// FROM ost_thread_event
//  JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
// JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
//  JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
//  JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
//  JOIN ost_user ON ost_user.id=ost_ticket.user_id
//  JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
//  JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
//  JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id

// WHERE
// ost_thread_event.id IN
// (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='overdue' GROUP BY ost_thread_event.thread_id)
// AND
// ost_ticket.status_id IN (1,6)
//  and ost_thread_event.thread_id not IN (SELECT thread_id from ost_thread_event where ost_thread_event.state ='closed'GROUP BY thread_id ORDER BY id DESC)
// ORDER BY ost_thread_event.thread_id desc

// SELECT ost_ticket.number AS chamado,
// ost_ticket.ticket_id,
// ost_user.name AS solicitante,
// ost_user_email.address AS solicitante_email,
// ost_user__cdata.phone AS telefone,
// ost_help_topic.topic AS curso,
// ost_ticket__cdata.subject AS assunto,
// ost_thread_event.staff_id,
// ost_thread_event.dept_id,
// CASE
//     WHEN ost_thread_event.state = 'closed' THEN 'Fechado'
//     WHEN ost_thread_event.state = 'transferred' THEN 'Transferido'
//     WHEN ost_thread_event.state = 'reopened' THEN 'Reaberto'
//     WHEN ost_thread_event.state = 'overdue' THEN 'Atrasado'
//     WHEN ost_thread_event.state = 'resent' THEN 'Reenviado'
//     WHEN ost_thread_event.state = 'edited' THEN 'Editado'
//     ELSE ost_thread_event.state
// END as status_evento,
// ost_ticket_status.name AS status_chamado,
// ost_ticket.lastupdate AS ultima_atualizacao,
// ost_ticket.created AS envio
// FROM ost_thread_event
//  JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
// JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
//  JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
//  JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
//  JOIN ost_user ON ost_user.id=ost_ticket.user_id
//  JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
//  JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
//  JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id

// WHERE
// ost_thread_event.id IN
// (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='overdue' GROUP BY ost_thread_event.thread_id)
// AND
// ost_ticket.status_id IN (1,6)
//  and ost_thread_event.thread_id not IN (SELECT thread_id from ost_thread_event where ost_thread_event.state ='closed'GROUP BY thread_id ORDER BY id DESC)
// ORDER BY ost_thread_event.thread_id desc
