<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index()
    {
        return DashboardController::ticketCreated();
    }

    public static function ticketCreated()
    {
        $sql = "SELECT
            ost_ticket.ticket_id as id,
            ost_ticket.number AS chamado,
            ost_ticket.ticket_id,
            ost_user.name AS usuario,
            ost_user_email.address AS email,
            ost_user__cdata.phone AS telefone,
            ost_help_topic.topic AS curso,
            ost_ticket__cdata.subject AS assunto,
            ost_thread_event.state AS status_evento,
            ost_ticket_status.name AS status_chamado,
            ost_ticket.lastupdate AS ultima_atualizacao,
            ost_ticket.created AS envio
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
            -- AND ost_thread_event.thread_id <> 0
            -- AND ost_thread_event.thread_id is not null
            ORDER BY ost_thread_event.thread_id ASC
            ";
        return DB::connection('mysql2')->select($sql);

    }

    public static function ticketsClosed()
    {
        $sql = "SELECT
        ost_ticket.number AS chamado,
        ost_ticket.ticket_id,            
        ost_user.name AS usuario,
            ost_user_email.address AS email,
            ost_user__cdata.phone AS telefone,
            ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_thread_event.state AS status_evento,
        ost_ticket_status.name AS status_chamado,
        ost_ticket.lastupdate AS ultima_atualizacao,
        ost_ticket.created AS envio
        FROM ost_thread_event
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        left JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
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

    public static function ticketsReopened()
    {
        $sql = "SELECT
        ost_ticket.number AS chamado,
        ost_ticket.ticket_id,            
        ost_user.name AS usuario,
            ost_user_email.address AS email,
            ost_user__cdata.phone AS telefone,
            ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_thread_event.state AS status_evento,
        ost_ticket_status.name AS status_chamado,
        ost_ticket.lastupdate AS ultima_atualizacao,
        ost_ticket.created AS envio
        FROM ost_thread_event
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        left JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
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

    public static function ticketsAssigned()
    {
        $sql = "SELECT
        ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
            ost_user_email.address AS email,
            ost_user__cdata.phone AS telefone,
            ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_thread_event.state AS status_evento,
        ost_ticket_status.name AS status_chamado,
        ost_ticket.lastupdate AS ultima_atualizacao,
        ost_ticket.created AS envio
        FROM ost_thread_event
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        left JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
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

    public static function ticketsTransferred()
    {
        $sql = "SELECT
        ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
            ost_user_email.address AS email,
            ost_user__cdata.phone AS telefone,
            ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_thread_event.state AS status_evento,
        ost_ticket_status.name AS status_chamado,
        ost_ticket.lastupdate AS ultima_atualizacao,
        ost_ticket.created AS envio
        FROM ost_thread_event
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        left JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
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

    public static function ticketsOverdue()
    {
        $sql = "SELECT
        ost_ticket.number AS chamado,
        ost_ticket.ticket_id,
        ost_user.name AS usuario,
            ost_user_email.address AS email,
            ost_user__cdata.phone AS telefone,
            ost_help_topic.topic AS curso,
        ost_ticket__cdata.subject AS assunto,
        ost_thread_event.state AS status_evento,
        ost_ticket_status.name AS status_chamado,
        ost_ticket.lastupdate AS ultima_atualizacao,
        ost_ticket.created AS envio
        FROM ost_thread_event
        left JOIN ost_thread ON ost_thread.id=ost_thread_event.thread_id
        left JOIN ost_ticket ON ost_ticket.ticket_id=ost_thread.object_id
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

    public static function indexTable(Request $request)
    {
        info($request);
        if ($request->ajax()) {
            // $data = User::latest()->get();
            $data = DashboardController::ticketCreated();
            // info($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCustomer">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCustomer">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('dashboard');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
