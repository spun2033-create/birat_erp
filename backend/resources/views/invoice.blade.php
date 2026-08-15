<!doctype html>
<html lang="ne">
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <style>
        body { font-family: DejaVu Sans, 'Noto Sans Devanagari', sans-serif; }
        .inv-header { text-align: center; }
        table { width:100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        .right { text-align: right; }
        @page { size: A4; margin: 20mm }
        /* For A5 we will override via PDF generator if requested */
    </style>
</head>
<body>
    <div class="inv-header">
        <h2>कम्पनी नाम</h2>
        <div>Invoice / रसिद</div>
    </div>

    <div>
        <strong>प्रकार:</strong> {{ $type }}<br>
        <strong>इनभ्वाइस #:</strong> {{ $invoice->invoice_no ?? $invoice->id }}<br>
        <strong>मिति:</strong> {{ $invoice->created_at->format('Y-m-d') }}
    </div>

    <table class="mt-4">
        <thead>
            <tr>
                <th>क्रम</th>
                <th>विवरण</th>
                <th>परिमाण</th>
                <th>एकाइ मूल्य</th>
                <th>योग</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $i => $item)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $item->product->name ?? '-' }}</td>
                <td class="right">{{ $item->qty }}</td>
                <td class="right">{{ number_format($item->unit_price,2) }}</td>
                <td class="right">{{ number_format($item->total,2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="right"><strong>जम्मा</strong></td>
                <td class="right">{{ number_format($invoice->total,2) }}</td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top:20px;">
        धन्यवाद!
    </div>
</body>
</html>
