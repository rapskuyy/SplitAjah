@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="mb-5">
    <div class="row mb-5 align-items-center">
        <div class="col-md-6">
            <h1 class="h1 fw-bold">{{ __('My Groups') }}</h1>
            <p class="text-muted">{{ __('Manage and view all your expense groups') }}</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('groups.create') }}" class="btn btn-lg btn-primary">
                <i class="bi bi-plus-circle me-2"></i>{{ __('Create Group') }}
            </a>
        </div>
    </div>

    @if(auth()->user()->groups->isEmpty())
        <div class="alert alert-info text-center py-5 mt-5">
            <h5>{{ __('No groups yet') }}</h5>
            <p class="mb-0">{{ __('Create your first group to start splitting expenses') }}</p>
        </div>
    @else
        <div class="row g-4">
            @foreach(auth()->user()->groups as $group)
                <div class="col-lg-6 col-xl-5">
                    <div class="card h-100 shadow-sm border-0 transition-all" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div class="card-body p-5">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h3 class="card-title h2 fw-bold mb-0">{{ $group->name }}</h3>
                                </div>
                                <span class="badge bg-primary rounded-pill fs-6">
                                    <i class="bi bi-people me-1"></i>{{ $group->users->count() }}
                                </span>
                            </div>
                            
                            <p class="text-muted mb-4">
                                <i class="bi bi-people-fill text-success me-2"></i>
                                <strong>{{ $group->users->count() }}</strong> {{ $group->users->count() === 1 ? __('member') : __('members') }}
                            </p>

                            <hr class="my-4">

                            <div class="d-flex flex-column gap-2">
                                <a href="{{ route('groups.show', $group) }}" class="btn btn-outline-primary btn-lg w-100">
                                    <i class="bi bi-eye me-2"></i>{{ __('View Expenses') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-footer bg-light border-top py-3">
                            <small class="text-muted">
                                <i class="bi bi-calendar3 me-2"></i>Created {{ $group->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .card:hover {
        transform: translateY(-8px) !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
    }
</style>

@endsection