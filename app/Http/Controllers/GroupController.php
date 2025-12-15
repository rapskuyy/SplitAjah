<?php

namespace App\Http\Controllers;

use App\Models\User; 
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    // ✅ ADD THIS METHOD
    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $group = auth()->user()->createdGroups()->create([
            'name' => $request->name,
        ]);

        $group->users()->attach(auth()->user());

        return redirect()->route('dashboard')->with('success', 'Group created!');
    }

    public function show(Group $group)
    {
        return view('groups.show', compact('group'));
    }

    public function addMember(Request $request, \App\Models\Group $group){
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $user = User::where('email', $request->email)->first();

    // Prevent adding yourself
    if ($user->id === auth()->id()) {
        return back()->withErrors(['email' => __('You cannot add yourself.')]);
    }

    // Check if already in group
    if ($group->users()->where('user_id', $user->id)->exists()) {
        return back()->withErrors(['email' => __('This user is already in the group.')]);
    }

    // Add to group
    $group->users()->attach($user->id);

    return back()->with('member_added', __(':name has been added to the group.', ['name' => $user->name]));
}
 public function destroy(\App\Models\Group $group){
    // Only allow creator to delete
    if ($group->created_by !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $groupName = $group->name;
    $group->delete(); // This will cascade-delete expenses & participants

    return redirect()->route('dashboard')->with('success', __('Group ":name" has been deleted.', ['name' => $groupName]));
}



}