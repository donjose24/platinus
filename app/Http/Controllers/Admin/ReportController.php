<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reservation;
use App\Transaction;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function printSalesReport(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $startDate = \DateTime::createFromFormat('Y-m-d', $startDate);
        $endDate = \DateTime::createFromFormat('Y-m-d', $endDate);

        $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->get();

        $pdf = PDF::loadView('reports.transaction', compact('transactions'));
        return $pdf->stream();
    }

    public function printReservations(Request $request)
    {
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $status = $request->get('status');

        $startDate = \DateTime::createFromFormat('Y-m-d', $startDate);
        $endDate = \DateTime::createFromFormat('Y-m-d', $endDate);

        $reservations = Reservation::whereBetween('created_at', [$startDate, $endDate]);

        if ($status != 'all') {
            $reservations = $reservations->where('status', $status);
        }

        $reservations = $reservations->get();

        $pdf = PDF::loadView('reports.reservations', compact('reservations'));
        return $pdf->stream();
    }
}