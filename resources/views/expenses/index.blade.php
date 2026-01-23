@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">{{ __('messages.all_expenses') }}</h1></h1>
    </div>

    @if($expenses->isEmpty())
        <div class="text-center py-10 text-gray-500 dark:text-gray-400">
            {{ __('messages.no_expenses_yet') }}
        </div>
    @else
        <div class="space-y-4">
            @foreach($expenses as $expense)
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <div class="flex justify-between">
                        <a href="{{ route('expenses.show', $expense) }}" class="font-medium hover:underline">{{ $expense->description }}</a>
                        <span>Rp{{ number_format($expense->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ $expense->created_at->format('d M Y') }} · {{ $expense->group->name }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection