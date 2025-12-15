@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-10 mx-auto">
        <h1 class="h2 mb-4">{{ __('Add New Expense') }}</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('expenses.store', $group) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <h5 class="alert-heading">{{ __('Errors:') }}</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }}</label>
                        <input type="text" id="description" name="description" required class="form-control"
                               value="{{ old('description') }}">
                    </div>

                    <div class="mb-3">
                        <label for="total_amount" class="form-label">{{ __('Total Amount') }}</label>
                        <input type="number" id="total_amount" step="0.01" name="total_amount" required class="form-control"
                               value="{{ old('total_amount') }}">
                    </div>

                    <div class="mb-3">
                        <label for="receipt" class="form-label">{{ __('Receipt (Optional)') }}</label>
                        <input type="file" id="receipt" name="receipt" accept="image/*" class="form-control">
                        <small class="text-muted">{{ __('Max 2MB. JPG, PNG') }}</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">{{ __('Who participated in this expense?') }}</label>
                        <div class="border rounded p-3">
                            @foreach($group->users as $user)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="user_{{ $user->id }}"
                                            name="participant_ids[]" 
                                            value="{{ $user->id }}"
                                            @if(old('participant_ids'))
                                                {{ in_array($user->id, old('participant_ids')) ? 'checked' : '' }}
                                            @else
                                                {{ $user->id === auth()->id() ? 'checked' : '' }}
                                            @endif>
                                    <label class="form-check-label" for="user_{{ $user->id }}">
                                        {{ $user->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('participant_ids')<small class="text-danger d-block mt-2">{{ $message }}</small>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('Add Expense') }}</button>
                        <a href="{{ route('groups.show', $group) }}" class="btn btn-outline-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection