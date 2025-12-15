@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4 mb-0">{{ $expense->description }}</h2>
                        <div>
                            <a href="{{ route('expenses.edit', $expense) }}" 
                               class="btn btn-sm btn-outline-primary me-2">
                                {{ __('Edit') }}
                            </a>

                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('{{ __('Are you sure you want to delete this expense?') }}')">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <p class="fs-5 mb-1">
                        {{ __('Total') }}: <strong>Rp{{ number_format($expense->total_amount, 0, ',', '.') }}</strong>
                    </p>
                    <p class="text-muted mb-0">
                        {{ __('Paid by') }}: <strong>{{ $expense->creator->name }}</strong>
                    </p>

                    @if($expense->receipt_path)
                        <div class="mt-3">
                            <p class="fw-bold mb-2">{{ __('Receipt') }}:</p>
                            <img src="{{ asset('storage/' . $expense->receipt_path) }}" 
                                 alt="Receipt" 
                                 class="img-fluid rounded border"
                                 style="max-height: 200px; object-fit: contain;">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Participants & Balances -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="h5 mb-0">{{ __('Participants & Balance') }}</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @php
                            $creditors = [];
                            $debtors = [];
                            $payerId = $expense->created_by;
                            $payerInList = false;
                        @endphp

                        @foreach($expense->participants as $p)
                            @php
                                $balance = $p->paid_amount - $p->share_amount;
                                if ($p->user_id == $payerId) $payerInList = true;
                                if ($balance > 0) {
                                    $creditors[] = ['name' => $p->user->name, 'amount' => $balance];
                                } elseif ($balance < 0) {
                                    $debtors[] = ['name' => $p->user->name, 'amount' => abs($balance)];
                                }
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $p->user->name }}</span>
                                <span class="text-muted small">
                                    {{ __('Paid') }}: Rp{{ number_format($p->paid_amount, 0, ',', '.') }} |
                                    {{ __('Share') }}: Rp{{ number_format($p->share_amount, 0, ',', '.') }} |
                                    <span class="{{ $balance >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $balance >= 0 ? '+' : '' }}Rp{{ number_format(abs($balance), 0, ',', '.') }}
                                    </span>
                                </span>
                            </li>
                        @endforeach

                        @if(!$payerInList)
                            @php
                                $payer = \App\Models\User::find($payerId);
                                $balance = $expense->total_amount;
                                $creditors[] = ['name' => $payer->name, 'amount' => $balance];
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $payer->name }}</span>
                                <span class="text-muted small">
                                    {{ __('Paid') }}: Rp{{ number_format($expense->total_amount, 0, ',', '.') }} |
                                    {{ __('Share') }}: Rp0 |
                                    <span class="text-success">
                                        +Rp{{ number_format($balance, 0, ',', '.') }}
                                    </span>
                                </span>
                            </li>
                        @endif
                    </ul>

                    <!-- Settlement Suggestion -->
                    @if(!empty($debtors) && !empty($creditors))
                        <div class="mt-4 pt-3 border-top">
                            <h4 class="h6">{{ __('Payment Suggestion') }}</h4>
                            <ul class="list-unstyled mt-2 mb-0">
                                @php
                                    foreach ($debtors as &$debtor) {
                                        foreach ($creditors as &$creditor) {
                                            if ($debtor['amount'] > 0 && $creditor['amount'] > 0) {
                                                $pay = min($debtor['amount'], $creditor['amount']);
                                                $debtor['amount'] -= $pay;
                                                $creditor['amount'] -= $pay;
                                                echo '<li class="text-muted">• ' . e($debtor['name']) . ' → ' . e($creditor['name']) . ': Rp' . number_format($pay, 0, ',', '.') . '</li>';
                                            }
                                        }
                                    }
                                @endphp
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('groups.show', $expense->group) }}" 
                   class="btn btn-link text-decoration-none">
                    &larr; {{ __('Back to Group') }}
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-link {
        color: #4f46e5;
    }
    
    html.dark .btn-link {
        color: #a5b4fc;
    }
    
    .btn-outline-danger {
        color: #dc2626;
        border-color: #dc2626;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc2626;
        color: white;
    }
    
    html.dark .btn-outline-danger {
        color: #f87171;
        border-color: #f87171;
    }
    
    html.dark .btn-outline-danger:hover {
        background-color: #f87171;
        color: white;
    }
    
    .text-danger {
        color: #dc2626 !important;
    }
    
    html.dark .text-danger {
        color: #f87171 !important;
    }
</style>

@endsection
