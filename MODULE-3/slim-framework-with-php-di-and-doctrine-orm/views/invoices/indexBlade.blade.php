<!DOCTYPE html>
<html>

<head>
    <title>Invoices</title>
</head>

<body>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            border: 1px #eee solid;
            padding: 5px;
        }

        .color-green {
            color: green;
        }

        .color-red {
            color: red;
        }

        .color-gray {
            color: gray;
        }

        .color-orange {
            color: orange;
        }
    </style>
    <table>
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Due Date</th>
            </tr>
        </thead>
        <tbody>
            <!-- THIS IS A BLADE EXAMPLE -->
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice['invoice_number'] }}</td>
                    <td>${{ number_format($invoice['amount'], 2) }}</td>
                    <td>"{{ $invoice['status'] }}"</td>
                    <td>
                        @if ($invoice['dueDate'])
                            {{ date('m/d/Y', strtotime($invoice['dueDate'])) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No invoices found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</html>













{{-- 

você pode:




 
1) EXTEND LAYOUTS 


2) INCLUDE FILES:




<div>
    
    @include('shared.errors')


    <form>
        <!-- Form Contents -->
    </form>

</div>



@includeWhen(@boolean, 'view.name', ['status' => 'complete'])


@includeUnless(@boolean, 'view.name', ['status' => 'complete'])






3) ESCREVER IF E SWITCH STATEMENTS...



@if (count($records) === 1) 
    I have one record!

@elseif(count($records) > 1)
    I have multiple records!

@else 
    I don't have any records!


@endif





4) USAR CONDITIONAL CLASSES..





@php 

    $isActive = false;
    $hasError = true;

@endphp 



<span @class(
    [
        'p-4',
        'font-bold' => $isActive,
        'text-gray-500' => ! $isActive,
        'bg-red' => $hasError
    ]
)></span>


span class="p-4 text-gray-500 bg-red"></span>






5) BUILDAR COMPONENTS...





6) PODE ATÉ MESMO RODAR RAW PHP,
    NO SEU HTML:



    
@php 

    $isActive = false;
    $hasError = true;

@endphp 



 --}}



