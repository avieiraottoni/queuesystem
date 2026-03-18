<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class MainController extends Controller
{
    public function index() {

        // get list of active queues for the authenticated user's company
        $queues = $this->getQueueList();
        $data = [
            'subtitle'  => 'Home',
            'queues'    => $queues
        ];

        dd($data);

        return view('home', $data);
    }

    private function getQueueList() {
        $company_id = Auth::user()->id_company;

        return Queue::where('id_company', $company_id)
            ->where('status', 'active')
            ->whereNull('deleted_at')
            ->withCount([
                'tickets as total_tickets'  => function($query) {
                    $query->whereNotNull('queue_ticket_status')
                        ->whereNull('deleted_at');
                },
                'tickets as total_dismissed' => function($query) {
                    $query->where('queue_ticket_status', 'dismissed')
                        ->whereNull('deleted_at');
                },
                'tickets as total_not_attended' => function($query) {
                    $query->where('queue_ticket_status', 'not_attended')
                        ->whereNull('deleted_at');
                },
                'tickets as total_called' => function($query) {
                    $query->where('queue_ticket_status', 'called')
                        ->whereNull('deleted_at');
                },
                'tickets as total_waiting' => function($query) {
                    $query->where('queue_ticket_status', 'waiting')
                        ->whereNull('deleted_at');
                },
            ])->get();
    }
}
