<?php

namespace App\View\Components\Partials\Dashboard;

use Illuminate\View\Component;

class Cards extends Component
{
    public $ticketsCreated;
    public $ticketsClosed;
    public $ticketsReopened;
    public $ticketsOpened;
    public $ticketsTransferred;
    public $ticketsOverdue;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ticketsCreated, $ticketsClosed, $ticketsReopened, $ticketsOpened, $ticketsTransferred, $ticketsOverdue)
    {
        $this->ticketsCreated = $ticketsCreated;
        $this->ticketsClosed = $ticketsClosed;
        $this->ticketsReopened = $ticketsReopened;
        $this->ticketsOpened = $ticketsOpened;
        $this->ticketsTransferred = $ticketsTransferred;
        $this->ticketsOverdue = $ticketsOverdue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.partials.dashboard.cards');
    }
}
