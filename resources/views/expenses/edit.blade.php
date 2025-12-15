@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">{{ __('Edit Expense') }}</h1>

    <form action="{{ route('expenses.update', $expense) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 text-red-700 rounded dark:bg-red-900/30 dark:text-red-300">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">{{ __('Description') }}</label>
            <input type="text" name="description" required
                   class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                   value="{{ old('description', $expense->description) }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">{{ __('Total Amount') }}</label>
            <input type="number" step="0.01" name="total_amount" required
                   class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white"
                   value="{{ old('total_amount', $expense->total_amount) }}">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">{{ __('Receipt (Optional)') }}</label>
            <input type="file" name="receipt" accept="image/*">
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('Max 2MB. JPG, PNG') }}</p>
            @if($expense->receipt_path)
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ __('Current receipt:') }} <a href="{{ asset('storage/' . $expense->receipt_path) }}" target="_blank" class="text-indigo-600 hover:underline">{{ __('View') }}</a></p>
            @endif
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 dark:text-gray-300 mb-2">{{ __('Who participated in this expense?') }}</label>
            <div class="space-y-2 bg-gray-50 dark:bg-gray-800 p-4 rounded">
                @php $currentParticipants = $expense->participants->pluck('user_id')->toArray(); @endphp
                @foreach($expense->group->users as $user)
                    <label class="flex items-center">
                        <input type="checkbox" 
                                name="participant_ids[]" 
                                value="{{ $user->id }}"
                                @if(old('participant_ids'))
                                    {{ in_array($user->id, old('participant_ids')) ? 'checked' : '' }}
                                @else
                                    {{ in_array($user->id, $currentParticipants) ? 'checked' : '' }}
                                @endif>
                        <span class="ml-2 text-gray-900 dark:text-gray-100">{{ $user->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('participant_ids')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ __('Update Expense') }}
            </button>
            <a href="{{ route('expenses.show', $expense) }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded">
                {{ __('Cancel') }}
            </a>
        </div>
    </form>
</div>
@endsection