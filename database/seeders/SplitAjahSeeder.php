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
        $users = User::factory()->count(5)->create([
            'password' => Hash::make('password'),
        ]);

        $userNames = ['Alice', 'Bob', 'Charlie', 'Diana', 'Eve'];
        foreach ($users as $index => $user) {
            $user->update(['name' => $userNames[$index]]);
        }

        $group1 = Group::create([
            'name' => 'Weekend Trip',
            'created_by' => $users[0]->id, 
        ]);

        $group2 = Group::create([
            'name' => 'Office Lunch',
            'created_by' => $users[1]->id,
        ]);

        $group3 = Group::create([
            'name' => 'Family Dinner',
            'created_by' => $users[3]->id, 
        ]);


        $group1->users()->attach([$users[0]->id, $users[1]->id, $users[2]->id]);

        $group2->users()->attach([$users[1]->id, $users[2]->id, $users[3]->id, $users[4]->id]);


        $group3->users()->attach([$users[3]->id, $users[4]->id, $users[0]->id]);

    
        $this->createExpense(
            group: $group1,
            creator: $users[0], 
            description: 'Hotel Booking',
            totalAmount: 900000,
            participantIds: [$users[0]->id, $users[1]->id, $users[2]->id], 
            receiptPath: null
        );

        $this->createExpense(
            group: $group1,
            creator: $users[1],
            description: 'Gas for Car',
            totalAmount: 150000,
            participantIds: [$users[0]->id, $users[1]->id], 
            receiptPath: null
        );

        $this->createExpense(
            group: $group2,
            creator: $users[1], 
            description: 'Group Lunch',
            totalAmount: 400000,
            participantIds: [$users[1]->id, $users[2]->id, $users[3]->id, $users[4]->id], 
            receiptPath: null
        );

        $this->createExpense(
            group: $group3,
            creator: $users[3], 
            description: 'Restaurant Bill',
            totalAmount: 600000,
            participantIds: [$users[3]->id, $users[4]->id], 
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
