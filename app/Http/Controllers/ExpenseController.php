<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Expense;
use App\Models\ExpenseParticipant;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    // Show form to create expense
    public function create(Group $group)
    {
        if (!$group->users()->where('user_id', auth()->id())->exists()) {
            abort(403, 'You are not a member of this group.');
        }
        return view('expenses.create', compact('group'));
    }

    // Save new expense
    public function store(Request $request, Group $group)
    {
        if (!$group->users()->where('user_id', auth()->id())->exists()) {
            abort(403, 'You are not a member of this group.');
        }

        $request->validate([
            'description' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0.01',
            'participant_ids' => 'required|array|min:1',
            'participant_ids.*' => 'integer|exists:users,id',
            'receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $receiptPath = null;
        if ($request->hasFile('receipt')) {
            $receiptPath = $request->file('receipt')->store('receipts', 'public');
        }

        $expense = Expense::create([
            'group_id' => $group->id,
            'description' => $request->description,
            'total_amount' => $request->total_amount,
            'receipt_path' => $receiptPath,
            'created_by' => auth()->id(),
        ]);

        $participantIds = $request->participant_ids ?? [];
        $groupUserIds = $group->users->pluck('id')->toArray();
        $participantIds = array_intersect($participantIds, $groupUserIds);
        $participantIds = array_values(array_unique($participantIds));

        // if (!in_array(auth()->id(), $participantIds)) {
        //     $participantIds[] = auth()->id();
        // }

        // if (empty($participantIds)) {
        //     $participantIds = [auth()->id()];
        // }

        if (empty($participantIds)) {
        return back()->withErrors(['participant_ids' => 'Please select at least one participant.']);
        }

        $totalParticipants = count($participantIds);
        $sharePerPerson = round($request->total_amount / $totalParticipants, 2);

        foreach ($participantIds as $index => $userId) {
            $paid = $userId === auth()->id() ? $request->total_amount : 0;
            $share = $sharePerPerson;

            if ($index === $totalParticipants - 1) {
                $share = $request->total_amount - ($sharePerPerson * ($totalParticipants - 1));
            }

            ExpenseParticipant::create([
                'expense_id' => $expense->id,
                'user_id' => $userId,
                'paid_amount' => $paid,
                'share_amount' => $share,
            ]);
        }

        return redirect()->route('groups.show', $expense->group)
                         ->with('success', __('Expense added successfully!'));
    }

    // Show expense details
    public function show(Expense $expense)
    {
        if (!$expense->group->users()->where('user_id', auth()->id())->exists()) {
            abort(403, 'You are not authorized to view this expense.');
        }
        return view('expenses.show', compact('expense'));
    }

    // Show list of user's expenses (optional)
    public function index()
    {
        $expenses = auth()->user()->expenses;
        return view('expenses.index', compact('expenses'));
    }

    // Show edit form
    public function edit(Expense $expense)
    {
        if ($expense->created_by !== auth()->id()) {
            abort(403, 'You can only edit your own expenses.');
        }
        return view('expenses.edit', compact('expense'));
    }

    // Update expense
    public function update(Request $request, Expense $expense)
    {
        if ($expense->created_by !== auth()->id()) {
            abort(403, 'You can only update your own expenses.');
        }

        $request->validate([
            'description' => 'required|string|max:255',
            'total_amount' => 'required|numeric|min:0.01',
            'participant_ids' => 'nullable|array',
            'participant_ids.*' => 'integer|exists:users,id',
            'receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $receiptPath = $expense->receipt_path;
        if ($request->hasFile('receipt')) {
            $receiptPath = $request->file('receipt')->store('receipts', 'public');
        }

        $expense->update([
            'description' => $request->description,
            'total_amount' => $request->total_amount,
            'receipt_path' => $receiptPath,
        ]);

        $participantIds = $request->participant_ids ?? [];
        $groupUserIds = $expense->group->users->pluck('id')->toArray();
        $participantIds = array_intersect($participantIds, $groupUserIds);
        $participantIds = array_unique($participantIds);

        if (!in_array($expense->created_by, $participantIds)) {
            $participantIds[] = $expense->created_by;
        }

        if (empty($participantIds)) {
            $participantIds = [$expense->created_by];
        }

        $totalParticipants = count($participantIds);
        $sharePerPerson = round($request->total_amount / $totalParticipants, 2);

        // Delete old participants
        $expense->participants()->delete();

        // Add updated participants
        foreach ($participantIds as $index => $userId) {
            $paid = $userId === $expense->created_by ? $request->total_amount : 0;
            $share = $sharePerPerson;

            if ($index === $totalParticipants - 1) {
                $share = $request->total_amount - ($sharePerPerson * ($totalParticipants - 1));
            }

            ExpenseParticipant::create([
                'expense_id' => $expense->id,
                'user_id' => $userId,
                'paid_amount' => $paid,
                'share_amount' => $share,
            ]);
        }

        return redirect()->route('expenses.show', $expense)
                         ->with('success', __('Expense updated successfully!'));
    }

    // Delete expense
    public function destroy(Expense $expense)
    {
        if ($expense->created_by !== auth()->id()) {
            abort(403, 'You can only delete your own expenses.');
        }
        $group = $expense->group;
        $expense->delete(); // Cascades to participants
        return redirect()->route('groups.show', $group)
                         ->with('success', __('Expense deleted successfully!'));
    }
}