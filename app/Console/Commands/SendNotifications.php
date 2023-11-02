<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\SupplierRequest;
use App\Models\User;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:send-notifications';
    protected $signature = 'fcm:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar mensajes via FCM';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Buscando solicitudes de proveedores con estado "Por validar"');

        $requestsToNotify = $this->getRequestsForRAndToVa();
        // $users = User::whereHas('role', function ($query) {
        //     $query->where('name', 'compras');
        // })->get();

        // foreach ($users as $user) {
        //     $user->sendFCM('');
        // }
        $pendingRequestsCount = count($requestsToNotify);

        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'compras');
        })->get();

        foreach ($users as $user) {
            $message = "Hay $pendingRequestsCount solicitudes pendientes por recibir y validar.";
            $user->sendFCM($message);
            $this->info('Mensaje FCM enviado al usuario de compras con ID: ' . $user->id);
        }

    }
    private function getRequestsForRAndToVa()
    {
        $estados = DB::table('state_requests')
            ->whereIn('name', ['Por validar', 'Por recibir'])
            ->pluck('id')
            ->toArray();

        return DB::table('supplier_requests')
            ->join('transitions_state_requests', 'supplier_requests.id', '=', 'transitions_state_requests.id_supplier_request')
            ->where(function ($query) use ($estados) {
                $query->whereIn('transitions_state_requests.to_state_id', $estados)
                    ->orWhereIn('transitions_state_requests.from_state_id', $estados);
            })
            ->whereRaw('transitions_state_requests.id = (SELECT MAX(id) FROM transitions_state_requests WHERE id_supplier_request = supplier_requests.id)')
            ->select('supplier_requests.*')
            ->get();
    }
}
