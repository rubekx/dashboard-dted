<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select ost_thread_event.* from ost_thread_event,
        // (select thread_id,max(`timestamp`) as timestamp from ost_thread_event group by thread_id) max_thread
        // where ost_thread_event.thread_id=max_thread.thread_id
        // and ost_thread_event.timestamp=max_thread.timestamp;select ost_thread_event.* from ost_thread_event,
        // (select thread_id,max(`timestamp`) as timestamp from ost_thread_event group by thread_id) max_thread
        // where ost_thread_event.thread_id=max_thread.thread_id
        // and ost_thread_event.timestamp=max_thread.timestamp;

        // SELECT *
        // FROM ost_thread_event
        // WHERE id IN (
        //     SELECT MAX(id)
        //     FROM ost_thread_event
        //     GROUP BY thread_id
        // );
        return $this->ticketCreated();
    }

    public static function ticketCreated()
    {
        // Show tickets created
        // SELECT * FROM `ost_thread_event` WHERE `thread_id` != 0 AND `state` = 'created'  AND thread_id is not null ORDER BY thread_id ASC
        $sql = "SELECT 
            ost_ticket.number AS chamado,
            ost_ticket.ticket_id,
            ost_thread_event.username AS usuario,
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
            WHERE ost_thread_event.id IN (SELECT MAX(ost_thread_event.id) FROM ost_thread_event GROUP BY ost_thread_event.thread_id)
            -- AND ost_thread_event.thread_id <> 0
            -- AND ost_thread_event.thread_id is not null
            ORDER BY ost_thread_event.thread_id ASC
            ";
        return DB::connection('mysql2')->select($sql);

        // return DB::connection('mysql2')
        //     ->table('ost_thread_event')
        //     ->select(
                // 'ost_ticket.number as Chamado',
                // 'ost_thread_event.username as Usuario',
                // 'ost_ticket__cdata.subject',
                // 'ost_thread_event.state',
                // 'ost_thread_event.timestamp as Envio'
        //     )
        // // ->select('ost_thread.*')
        //     ->join('ost_thread', 'ost_thread.id', '=', 'ost_thread_event.thread_id')
        //     ->join('ost_ticket', 'ost_ticket.ticket_id', '=', 'ost_thread.object_id')
        //     ->join('ost_ticket__cdata', 'ost_ticket__cdata.ticket_id', '=', 'ost_ticket.ticket_id')
        //     ->where('ost_thread_event.thread_id', '<>', 0)
        //     ->where('ost_thread_event.state', '=', 'created')
        // // ->where(function ($query) {
        // //     $query->whereIn('id', '>', 100);
        // // })
        //     ->orderBy('ost_thread_event.thread_id', 'ASC')
        //     ->get();
    }

    public function ticketsClosed()
    {

    }

    public function ticketsReopened()
    {

    }

    public function ticketsAssigned()
    {

    }

    public function ticketsTransferred()
    {

    }

    public function ticketsOverdue()
    {

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
