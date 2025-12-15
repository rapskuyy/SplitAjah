@extends('layouts.app')

@section('content')
<div class="mb-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1 class="h2">{{ $group->name }}</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('expenses.create', $group) }}" class="btn btn-success">
                <i class="bi bi-plus-circle me-2"></i>{{ __('Add Expense') }}
            </a>
        </div>
    </div>

    @if($group->expenses->isEmpty())
        <div class="alert alert-info text-center py-5">
            {{ __('No expenses yet.') }}
        </div>
    @else
        <div class="row">
            @foreach($group->expenses as $expense)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <a href="{{ route('expenses.show', $expense) }}" class="card-title text-decoration-none expense-link">
                                        {{ $expense->description }}
                                    </a>
                                    <p class="card-text text-muted small mt-2">
                                        {{ $expense->created_at->format('d M Y') }} · 
                                        {{ __('by') }} {{ $expense->creator->name }}
                                    </p>
                                </div>
                                <h5 class="card-title">Rp {{ number_format($expense->total_amount, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>{{ __('Back to Dashboard') }}
        </a>
    </div>
</div>

<!-- Add Member by Email -->
<div class="card mt-5">
    <div class="card-body">
        <h5 class="card-title mb-4">{{ __('Add Member') }}</h5>
        <form method="POST" action="{{ route('groups.add-member', $group) }}">
            @csrf
            <div class="input-group mb-3">
                <input type="email" 
                       name="email" 
                       required
                       placeholder="{{ __('Enter member email') }}"
                       class="form-control"
                       value="{{ old('email') }}">
                <button class="btn btn-primary" type="submit">{{ __('Add') }}</button>
            </div>
            @error('email')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            @if(session('member_added'))
                <div class="alert alert-success" role="alert">{{ session('member_added') }}</div>
            @endif
            @if(session('member_error'))
                <div class="alert alert-danger" role="alert">{{ session('member_error') }}</div>
            @endif
        </form>
    </div>
</div>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title mb-4">{{ __('Members') }}</h5>
        <div class="list-group list-group-flush">
            @foreach($group->users as $member)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">{{ $member->name }}</h6>
                        <small class="text-muted">{{ $member->email }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Delete Group Button (only for creator) -->
@if(auth()->id() === $group->created_by)
    <div class="mt-4">
        <form action="{{ route('groups.destroy', $group) }}" method="POST" id="deleteGroupForm">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Are you sure you want to delete this group? All expenses will be permanently deleted.') }}')">
                <i class="bi bi-trash me-2"></i>{{ __('Delete Group') }}
            </button>
        </form>
    </div>
@endif

<style>
    .list-group-item {
        background-color: white;
        color: #1e293b;
    }
    
    html.dark .list-group-item {
        background-color: #334155;
        color: #e2e8f0;
        border-color: #475569;
    }
    
    .expense-link {
        color: #1e293b;
        font-weight: 600;
    }
    
    html.dark .expense-link {
        color: #e2e8f0;
    }
    
    .expense-link:hover {
        color: #4f46e5;
        text-decoration: underline !important;
    }
    
    html.dark .expense-link:hover {
        color: #a5b4fc;
        text-decoration: underline !important;
    }
</style>

@endsection
