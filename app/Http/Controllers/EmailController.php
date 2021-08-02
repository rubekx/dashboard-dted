<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OsTicketController;
use App\Models\Email;

class EmailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $emails = Email::all();
        $total = $this->countTickets(5);
        $os_ticket = new OsTicketController;
        $os_ticket = $os_ticket->actorEmails(5, 2);
        // $os_ticket='';
        return view('emails.sended')->with([
            'os_ticket' => $os_ticket,
            'emails' => $emails,
            'total' => $total,
        ]);
    }

    public function countTickets($type)
    {
        $count = 0;
        if (!empty($type)) {
            $count = new DashboardController;
            $count = $count->countTicketsByStatus($type);
        }
        return $count;
    }

    public function sendEmails($type, $total = null)
    {
        if (!empty($type)) {
            $total_emals = $this->countTickets($type);
        }
    }

    public function cancelProcess()
    {

    }

}
