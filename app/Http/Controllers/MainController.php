<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\QueueTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use function PHPUnit\Framework\returnArgument;

class MainController extends Controller
{
    public function index() {

        // get list of active queues for the authenticated user's company
        $data = [
            'subtitle'      => 'Home',
            'queues'        => $this->getQueueList(),
            'companyName'   => Auth::user()->company->company_name,
            'companyTotal'  => $this->getCompanyTotals()
        ];

        //dd($data);
        return view('main.home', $data);
    }

    private function getQueueList() {
        $company_id = Auth::user()->id_company;

        return Queue::where('id_company', $company_id)
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

    private function getCompanyTotals() {
        $companyId = Auth::user()->id_company;
        $totalQueues = Queue::where('id_company', $companyId)->count();

        // get all tickets of the company
        $tickets = QueueTicket::whereHas('queue', function ($query)use ($companyId){
            $query->where('id_company', $companyId);
        })->get();

        return [
            'total_queues'          => $totalQueues,
            'total_tickets'         => $tickets->count(),
            'total_dismissed'       => $tickets->where('queue_ticket_status', 'dismissed')->count(),
            'total_not_attended'    => $tickets->where('queue_ticket_status', 'not_attended')->count(),
            'total_called'          => $tickets->where('queue_ticket_status', 'called')->count(),
            'total_waiting'         => $tickets->where('queue_ticket_status', 'waiting')->count(),
        ];
    }

    public function queueDetails($id) {

        // try to decrypt the id
        try {
            $id = Crypt::decrypt($id);
        } catch (\Throwable $e) {
            abort(403, 'ID de fila inválido.');
        }

        // check if the queue exists and belongs 
        // to the authenticated user's company
        $queue = Queue::where('id', $id)
            ->where('id_company', Auth::user()->id_company)
            ->withCount([
                'tickets as total_tickets' => function($query) {
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
                }
            ])
            ->firstOrFail();
        
        if(!$queue) {
            abort(404, 'Fila não econtrada');
        }

        // get the tickets from the queue
        $tickets = $queue->tickets()->get();

        $data = [
            'subtitle'  => 'Detalhes',
            'queue'     => $queue,
            'tickets'   => $tickets
        ];

        return view('main.queue_details', $data);
    }
}
