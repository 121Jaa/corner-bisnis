<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;

class UserBusinessController extends Controller
{
    /**
     * Assign satu / banyak usaha ke user
     */
    public function assign(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'business_ids' => 'required|array|min:1',
            'business_ids.*' => 'exists:businesses,id',
        ], [
            'business_ids.required' => 'Pilih minimal 1 usaha.',
            'business_ids.min' => 'Pilih minimal 1 usaha.',
        ]);

        // Update semua business yang dipilih → set user_id
        $count = Business::whereIn('id', $request->business_ids)
            ->update(['user_id' => $user->id]);

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', $count . ' usaha berhasil di-assign ke ' . ($user->display_name ?? $user->name) . '!');
    }

    /**
     * Unassign (lepas) usaha dari user
     */
    public function unassign($id, $businessId)
    {
        $user = User::findOrFail($id);
        $business = Business::findOrFail($businessId);

        // Pastiin business ini emang punya user tsb
        if ($business->user_id !== $user->id) {
            return back()->with('error', 'Usaha ini bukan milik user tersebut.');
        }

        $business->update(['user_id' => null]);

        return redirect()
            ->route('admin.users.edit', $user->id)
            ->with('success', 'Usaha "' . $business->name . '" berhasil dilepas dari ' . ($user->display_name ?? $user->name) . '!');
    }
}