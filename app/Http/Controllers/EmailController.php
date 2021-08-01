<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DashboardController;
use App\Models\Email;

class EmailController extends Controller
{

    public function index()
    {
        $emails = Email::all();
        $total = $this->countTickets(5);
        return view('emails.sended')->with([
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
