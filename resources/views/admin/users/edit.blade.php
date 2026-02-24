@extends('layouts.admin')
@section('title', 'Edit User')
@section('content')
<h1 class="text-2xl font-bold mb-6">Edit User</h1>
<div class="max-w-md">
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium text-slate-700 mb-1">Name</label>
            <input type="text" name="name" required value="{{ old('name', $user->name) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block font-medium text-slate-700 mb-1">Email</label>
            <input type="email" name="email" required value="{{ old('email', $user->email) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block font-medium text-slate-700 mb-1">Role</label>
            <select name="role" required class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="organizer" {{ old('role', $user->role) === 'organizer' ? 'selected' : '' }}>Organizer</option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            <p class="text-slate-500 text-xs mt-1">Admin: full access. Organizer: events, bookings, scan.</p>
            @error('role')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block font-medium text-slate-700 mb-1">New Password <span class="text-slate-400 font-normal">(leave blank to keep)</span></label>
            <input type="password" name="password" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block font-medium text-slate-700 mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">Update</button>
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 font-medium">Cancel</a>
        </div>
    </form>
</div>
@endsection
