<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use App\Models\Expense;
use App\Models\ExpenseParticipant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SplitAjahSeeder extends Seeder
{
    public function run(): void
    {
        // Create users
        $users = User::factory()->count(5)->create([
            'password' => Hash::make('password'),
        ]);

        // Assign names for clarity
        $userNames = ['Alice', 'Bob', 'Charlie', 'Diana', 'Eve'];
        foreach ($users as $index => $user) {
            $user->update(['name' => $userNames[$index]]);
        }

        // Create groups
        $group1 = Group::create([
            'name' => 'Weekend Trip',
            'created_by' => $users[0]->id, // Alice
        ]);

        $group2 = Group::create([
            'name' => 'Office Lunch',
            'created_by' => $users[1]->id, // Bob
        ]);

        $group3 = Group::create([
            'name' => 'Family Dinner',
            'created_by' => $users[3]->id, // Diana
        ]);

        // Add members to groups
        // Group 1: Alice, Bob, Charlie
        $group1->users()->attach([$users[0]->id, $users[1]->id, $users[2]->id]);

        // Group 2: Bob, Charlie, Diana, Eve
        $group2->users()->attach([$users[1]->id, $users[2]->id, $users[3]->id, $users[4]->id]);

        // Group 3: Diana, Eve, Alice
        $group3->users()->attach([$users[3]->id, $users[4]->id, $users[0]->id]);

        // Create expenses
        $this->createExpense(
            group: $group1,
            creator: $users[0], // Alice
            description: 'Hotel Booking',
            totalAmount: 900000,
            participantIds: [$users[0]->id, $users[1]->id, $users[2]->id], // All 3
            receiptPath: null
        );

        $this->createExpense(
            group: $group1,
            creator: $users[1], // Bob
            description: 'Gas for Car',
            totalAmount: 150000,
            participantIds: [$users[0]->id, $users[1]->id], // Only Alice & Bob
            receiptPath: null
        );

        $this->createExpense(
            group: $group2,
            creator: $users[1], // Bob
            description: 'Group Lunch',
            totalAmount: 400000,
            participantIds: [$users[1]->id, $users[2]->id, $users[3]->id, $users[4]->id], // All 4
            receiptPath: null
        );

        $this->createExpense(
            group: $group3,
            creator: $users[3], // Diana
            description: 'Restaurant Bill',
            totalAmount: 600000,
            participantIds: [$users[3]->id, $users[4]->id], // Only Diana & Eve (Alice didn't go)
            receiptPath: null
        );

        $this->command->info('SplitAjah seeder completed!');
    }

    private function createExpense($group, $creator, $description, $totalAmount, $participantIds, $receiptPath)
    {
        $expense = Expense::create([
            'group_id' => $group->id,
            'description' => $description,
            'total_amount' => $totalAmount,
            'receipt_path' => $receiptPath,
            'created_by' => $creator->id,
        ]);

        $totalParticipants = count($participantIds);
        $sharePerPerson = round($totalAmount / $totalParticipants, 2);

        foreach ($participantIds as $index => $userId) {
            $paid = $userId === $creator->id ? $totalAmount : 0;
            $share = $sharePerPerson;

            // Fix rounding for last participant
            if ($index === $totalParticipants - 1) {
                $share = $totalAmount - ($sharePerPerson * ($totalParticipants - 1));
            }

            ExpenseParticipant::create([
                'expense_id' => $expense->id,
                'user_id' => $userId,
                'paid_amount' => $paid,
                'share_amount' => $share,
            ]);
        }
    }
}
