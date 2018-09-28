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
        $salesField = Transaction::all()->pluck('item', 'item');
        $salesField['all'] = "All";
        return view('admin.reports.index', compact('salesField'));
    }

    public function printSalesReport(Request $request)
    {
        $field = $request->get('field');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $startDate = \DateTime::createFromFormat('Y-m-d', $startDate);
        $endDate = \DateTime::createFromFormat('Y-m-d', $endDate);

        if ($field == 'all') {
            $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->get();
        } else {
            $transactions = Transaction::whereBetween('created_at', [$startDate, $endDate])->where('item', $field)->get();
        }

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