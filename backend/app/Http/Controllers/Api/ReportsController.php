<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Payment;
use App\Models\StockMovement;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    // Day Book: list all transactions chronologically
    public function dayBook(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $purchases = Purchase::when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        })->get()->map(function ($p) {
            return [
                'date' => $p->created_at,
                'type' => 'purchase',
                'ref' => $p->invoice_no,
                'party_id' => $p->party_id,
                'debit' => $p->total,
                'credit' => 0,
            ];
        });

        $sales = Sale::when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        })->get()->map(function ($s) {
            return [
                'date' => $s->created_at,
                'type' => 'sale',
                'ref' => $s->invoice_no,
                'party_id' => $s->party_id,
                'debit' => 0,
                'credit' => $s->total,
            ];
        });

        $payments = Payment::when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        })->get()->map(function ($pay) {
            return [
                'date' => $pay->created_at,
                'type' => 'payment',
                'ref' => $pay->id,
                'party_id' => $pay->party_id,
                'debit' => 0,
                'credit' => $pay->amount,
            ];
        });

        $all = collect()->concat($purchases)->concat($sales)->concat($payments)->sortBy('date')->values();

        // compute running balance (simple net: credits - debits)
        $running = 0;
        $result = $all->map(function ($row) use (&$running) {
            $running += ($row['credit'] - $row['debit']);
            $row['running_balance'] = $running;
            return $row;
        });

        return response()->json(['data' => $result]);
    }

    // Profit & Loss simple aggregation
    public function profitLoss(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $sales = Sale::when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        })->sum('total');

        $purchases = Purchase::when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        })->sum('total');

        // expenses could come from payments with ref_type = 'expense' or from an expenses table (not implemented). We'll sum payments as expenses for now.
        $expenses = Payment::when($from && $to, function ($q) use ($from, $to) {
            $q->whereBetween('created_at', [$from, $to]);
        })->sum('amount');

        $grossProfit = $sales - $purchases;
        $netProfit = $grossProfit - $expenses;

        return response()->json(['data' => [
            'sales' => $sales,
            'purchases' => $purchases,
            'gross' => $grossProfit,
            'expenses' => $expenses,
            'net' => $netProfit,
        ]]);
    }
}
