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
            left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
            JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
            left JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
            left JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
            LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
            LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
            LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
            LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id

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
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        left JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        left JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
            LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
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
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        left JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        left JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)
        AND ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='reopened' GROUP BY ost_thread_event.thread_id)
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
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        left JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        left JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)
        AND ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='assigned' GROUP BY ost_thread_event.thread_id)
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
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        left JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        left JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
        LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)
        AND ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='transferred' GROUP BY ost_thread_event.thread_id)
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
        ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
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
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
        left JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id=ost_ticket.ticket_id
        left JOIN ost_ticket_status ON ost_ticket_status.id=ost_ticket.status_id
        LEFT JOIN ost_user ON ost_user.id=ost_ticket.user_id
        LEFT JOIN ost_user__cdata ON ost_user__cdata.user_id=ost_user.id
        LEFT JOIN ost_user_email ON ost_user_email.user_id=ost_user.id
            LEFT JOIN ost_help_topic ON ost_help_topic.topic_id=ost_ticket.topic_id
        WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)
        AND ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event WHERE ost_thread_event.state ='overdue' GROUP BY ost_thread_event.thread_id)
        AND ost_ticket.status_id IN (1,6)
        ORDER BY ost_thread_event.thread_id ASC
        ";
        return DB::connection('mysql2')->select($sql);
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
            } else {
                $data = DashboardController::ticketsOverdue();
            }
            return Datatables::of($data)
                // ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ticket_id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Edit</a>';
                //     $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->ticket_id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteCustomer">Delete</a>';
                //     return $btn;
                // })
                // ->rawColumns(['action'])
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
            ]);
    }

}
