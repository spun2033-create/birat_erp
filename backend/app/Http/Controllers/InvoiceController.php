<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Purchase;
use PDF; // barryvdh/laravel-dompdf facade if installed

class InvoiceController extends Controller
{
    public function show($id)
    {
        // Try find sale first, then purchase
        $sale = Sale::with('items.product')->find($id);
        if ($sale) {
            return view('invoice', ['type' => 'sale', 'invoice' => $sale]);
        }
        $purchase = Purchase::with('items.product')->find($id);
        if ($purchase) {
            return view('invoice', ['type' => 'purchase', 'invoice' => $purchase]);
        }
        abort(404);
    }

    public function pdf($id, Request $request)
    {
        // size param: A4 or A5
        $size = $request->input('size', 'A4');

        $sale = Sale::with('items.product')->find($id);
        $data = null;
        $type = null;
        if ($sale) { $data = $sale; $type = 'sale'; }
        else { $purchase = Purchase::with('items.product')->find($id); if ($purchase) { $data = $purchase; $type='purchase'; } }

        if (!$data) abort(404);

        // Render view to HTML
        $html = view('invoice', ['type' => $type, 'invoice' => $data])->render();

        // Generate PDF using Dompdf (requires barryvdh/laravel-dompdf)
        if (class_exists('\Barryvdh\DomPDF\Facade\Pdf')) {
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)->setPaper($size);
            return $pdf->download("invoice_{$id}.pdf");
        }

        // Fallback: return HTML
        return response($html);
    }
}
