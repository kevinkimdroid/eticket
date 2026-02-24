@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<h1 class="text-2xl font-bold mb-6">Users & Roles</h1>
<div class="mb-4">
    <a href="{{ route('admin.users.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">Add User</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <table class="w-full">
        <thead class="bg-slate-50">
            <tr>
                <th class="text-left p-4 font-medium text-slate-600">Name</th>
                <th class="text-left p-4 font-medium text-slate-600">Email</th>
                <th class="text-left p-4 font-medium text-slate-600">Role</th>
                <th class="text-left p-4 font-medium text-slate-600">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
            <tr class="border-t border-slate-100 hover:bg-slate-50/50">
                <td class="p-4 font-medium">{{ $u->name }}</td>
                <td class="p-4">{{ $u->email }}</td>
                <td class="p-4">
                    <span class="px-2.5 py-1 rounded-lg text-xs font-medium {{ $u->role === 'admin' ? 'bg-indigo-100 text-indigo-700' : 'bg-emerald-100 text-emerald-700' }}">
                        {{ ucfirst($u->role) }}
                    </span>
                </td>
                <td class="p-4">
                    <a href="{{ route('admin.users.edit', $u) }}" class="text-indigo-600 hover:text-indigo-700 font-medium text-sm">Edit</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="p-8 text-slate-500 text-center">No users yet</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
