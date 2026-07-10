@extends('admin.layouts.app')

@section('title', 'Admin Users')
@section('page-title', 'Admin Users')

@section('breadcrumb')
    <a href="{{ route('admin.dashboard') }}"
        class="text-xs font-body text-gray-400 hover:text-crimson-500 transition-colors">Dashboard</a>
    <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
    <span class="text-xs font-body text-gray-500">Admin Users</span>
@endsection

@section('content')

    @php
        use App\Models\Admin;
        $authAdmin = Auth::guard('admin')->user();

        $admins = $admins ?? collect([
            (object) ['id' => 1, 'name' => 'Super Admin', 'email' => 'admin@redsol.com', 'role' => 'super_admin', 'is_active' => true, 'last_login_at' => now()->subHours(1), 'created_at' => now()->subYear()],
            (object) ['id' => 2, 'name' => 'Zaid Engineer', 'email' => 'zaid@redsol.com', 'role' => 'content_editor', 'is_active' => true, 'last_login_at' => now()->subDay(), 'created_at' => now()->subMonths(6)],
            (object) ['id' => 3, 'name' => 'Sales Manager', 'email' => 'sales@redsol.com', 'role' => 'sales', 'is_active' => true, 'last_login_at' => now()->subDays(3), 'created_at' => now()->subMonths(3)],
            (object) ['id' => 4, 'name' => 'Viewer Account', 'email' => 'viewer@redsol.com', 'role' => 'viewer', 'is_active' => false, 'last_login_at' => now()->subMonths(2), 'created_at' => now()->subMonths(4)],
        ]);
    @endphp

    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
        @foreach(Admin::ROLES as $key => $label)
            @php
                $count = $admins->where('role', $key)->count();
                $colorClass = match ($key) {
                    'super_admin' => 'bg-red-50 border-red-100 text-red-700',
                    'content_editor' => 'bg-blue-50 border-blue-100 text-blue-700',
                    'sales' => 'bg-green-50 border-green-100 text-green-700',
                    default => 'bg-gray-50 border-gray-200 text-gray-600',
                };
            @endphp
            <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 flex items-center gap-3">
                <span
                    class="inline-flex items-center justify-center w-8 h-8 rounded-lg border text-xs font-display font-700 {{ $colorClass }}">
                    {{ $count }}
                </span>
                <div>
                    <div class="font-display font-700 text-gray-900 text-sm">{{ $label }}</div>
                    <div class="font-body text-[10px] text-gray-400">{{ $count }} user{{ $count === 1 ? '' : 's' }}</div>
                </div>
            </div>
        @endforeach
    </div>

    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-5">
        <div class="flex items-center gap-2 flex-wrap">
            @foreach(['all' => 'All', 'super_admin' => 'Super Admin', 'content_editor' => 'Content Editor', 'sales' => 'Sales', 'viewer' => 'Viewer', 'active' => 'Active', 'inactive' => 'Inactive'] as $val => $label)
                <a href="{{ request()->fullUrlWithQuery(['filter' => $val]) }}" class="px-3 py-1.5 rounded-lg text-xs font-display font-600 tracking-wide transition-all
                          {{ request('filter', 'all') === $val
                ? 'bg-crimson-500 text-white shadow-sm shadow-crimson-500/25'
                : 'bg-white text-gray-500 border border-gray-200 hover:border-gray-300 hover:text-gray-900' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-crimson-500 text-white font-display font-600 text-sm
                       hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25 shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Add Admin User
        </button>
    </div>

    
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-gray-100 bg-gray-50/50">
                        <th
                            class="text-left px-5 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                            User</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                            Role</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden md:table-cell">
                            Permissions</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase">
                            Status</th>
                        <th
                            class="text-left px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase hidden lg:table-cell">
                            Last Login</th>
                        <th
                            class="px-4 py-3 font-body text-[10px] font-700 text-gray-400 tracking-widest uppercase text-right">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($admins as $admin)
                        @php
                            $isCurrentUser = $admin->id === $authAdmin->id;
                            $badgeClass = match ($admin->role) {
                                'super_admin' => 'bg-red-100 text-red-700 border-red-200',
                                'content_editor' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'sales' => 'bg-green-100 text-green-700 border-green-200',
                                default => 'bg-gray-100 text-gray-600 border-gray-200',
                            };
                            $perms = Admin::PERMISSIONS[$admin->role] ?? [];
                        @endphp
                        <tr class="hover:bg-gray-50/60 transition-colors group {{ !$admin->is_active ? 'opacity-60' : '' }}">

                            
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-xl shrink-0 flex items-center justify-center font-display font-700 text-sm
                                                {{ $admin->is_active ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-500' }}">
                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-body text-sm font-600 text-gray-800">{{ $admin->name }}</span>
                                            @if($isCurrentUser)
                                                <span
                                                    class="text-[10px] font-display font-700 px-1.5 py-0.5 rounded-md bg-crimson-500/10 text-crimson-600 border border-crimson-500/20">You</span>
                                            @endif
                                        </div>
                                        <div class="font-body text-xs text-gray-400">{{ $admin->email }}</div>
                                    </div>
                                </div>
                            </td>

                            
                            <td class="px-4 py-4">
                                <span
                                    class="inline-block text-[10px] font-display font-700 tracking-wide px-2 py-1 rounded-md border {{ $badgeClass }}">
                                    {{ Admin::ROLES[$admin->role] ?? ucfirst($admin->role) }}
                                </span>
                            </td>

                            
                            <td class="px-4 py-4 hidden md:table-cell">
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($perms, 0, 3) as $perm)
                                        <span class="text-[10px] font-body text-gray-500 px-1.5 py-0.5 rounded bg-gray-100">
                                            {{ str_replace('_', ' ', $perm) }}
                                        </span>
                                    @endforeach
                                    @if(count($perms) > 3)
                                        <span class="text-[10px] font-body text-gray-400 px-1.5 py-0.5 rounded bg-gray-100">
                                            +{{ count($perms) - 3 }} more
                                        </span>
                                    @endif
                                </div>
                            </td>

                            
                            <td class="px-4 py-4">
                                @if($admin->is_active)
                                    <span
                                        class="inline-flex items-center gap-1.5 text-[10px] font-700 font-display px-2 py-1 rounded-lg bg-green-50 text-green-600 border border-green-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>Active
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 text-[10px] font-700 font-display px-2 py-1 rounded-lg bg-gray-100 text-gray-500 border border-gray-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>Inactive
                                    </span>
                                @endif
                            </td>

                            
                            <td class="px-4 py-4 hidden lg:table-cell">
                                <span class="font-body text-xs text-gray-400">
                                    {{ $admin->last_login_at ? $admin->last_login_at->diffForHumans() : 'Never' }}
                                </span>
                            </td>

                            
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-end gap-1.5">
                                    
                                    <button
                                        onclick="openEditModal({{ json_encode(['id' => $admin->id, 'name' => $admin->name, 'email' => $admin->email, 'role' => $admin->role, 'is_active' => $admin->is_active]) }})"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-crimson-500 hover:border-crimson-500/30 hover:bg-crimson-50 transition-all">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    
                                    @if(!$isCurrentUser)
                                                        <form method="POST" action="{{ route('admin.admins.toggleActive', $admin->id) }}">
                                                            @csrf
                                                            <button type="submit" title="{{ $admin->is_active ? 'Deactivate' : 'Activate' }}" class="w-7 h-7 rounded-lg border flex items-center justify-center transition-all
                                                                           {{ $admin->is_active
                                        ? 'border-gray-200 text-gray-400 hover:text-orange-500 hover:border-orange-200 hover:bg-orange-50'
                                        : 'border-green-200 text-green-500 hover:bg-green-50' }}">
                                                                @if($admin->is_active)
                                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                                    </svg>
                                                                @else
                                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>
                                                                @endif
                                                            </button>
                                                        </form>

                                                        
                                                        <form method="POST" action="{{ route('admin.admins.destroy', $admin->id) }}"
                                                            onsubmit="return confirm('Delete {{ addslashes($admin->name) }}? This cannot be undone.')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-red-500 hover:border-red-200 hover:bg-red-50 transition-all">
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center font-body text-gray-400">No admin users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    
    <div id="addModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
            onclick="document.getElementById('addModal').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">

            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-base">Add Admin User</h3>
                </div>
                <button onclick="document.getElementById('addModal').classList.add('hidden')"
                    class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.admins.store') }}" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Full
                        Name <span class="text-crimson-500">*</span></label>
                    <input type="text" name="name" required placeholder="e.g. Content Manager"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                </div>
                <div>
                    <label class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Email
                        Address <span class="text-crimson-500">*</span></label>
                    <input type="email" name="email" required placeholder="user@redsol.com"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label
                            class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Password
                            <span class="text-crimson-500">*</span></label>
                        <input type="password" name="password" required placeholder="Min. 8 characters"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                    </div>
                    <div>
                        <label
                            class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Confirm
                            <span class="text-crimson-500">*</span></label>
                        <input type="password" name="password_confirmation" required placeholder="Repeat password"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Role
                            <span class="text-crimson-500">*</span></label>
                        <select name="role" required
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all cursor-pointer">
                            @foreach(Admin::ROLES as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label
                            class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Status</label>
                        <select name="is_active"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all cursor-pointer">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                
                <div class="bg-gray-50 border border-gray-100 rounded-xl p-4">
                    <p class="font-body text-xs text-gray-500 font-600 mb-2">Role permissions preview:</p>
                    @foreach(Admin::PERMISSIONS as $role => $perms)
                        <div id="perms-{{ $role }}" class="hidden flex-wrap gap-1">
                            @foreach($perms as $perm)
                                <span
                                    class="text-[10px] font-body text-gray-500 px-1.5 py-0.5 rounded bg-gray-200">{{ str_replace('_', ' ', $perm) }}</span>
                            @endforeach
                        </div>
                    @endforeach
                    <div id="perms-super_admin" class="flex flex-wrap gap-1">
                        @foreach(Admin::PERMISSIONS['super_admin'] as $perm)
                            <span
                                class="text-[10px] font-body text-gray-500 px-1.5 py-0.5 rounded bg-gray-200">{{ str_replace('_', ' ', $perm) }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Create User
                    </button>
                    <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-display font-600 text-sm hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
            onclick="document.getElementById('editModal').classList.add('hidden')"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="h-4 w-0.5 bg-crimson-500 rounded-full"></div>
                    <h3 class="font-display font-700 text-gray-900 text-base">Edit Admin User</h3>
                </div>
                <button onclick="document.getElementById('editModal').classList.add('hidden')"
                    class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="editForm" method="POST" action="" class="p-6 space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Full
                        Name</label>
                    <input type="text" name="name" id="editName" required
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                </div>
                <div>
                    <label
                        class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Email</label>
                    <input type="email" name="email" id="editEmail" required
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                </div>
                <div>
                    <label class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">New
                        Password <span class="text-gray-400 font-400 normal-case tracking-normal">(leave blank to keep
                            current)</span></label>
                    <input type="password" name="password" placeholder="Leave blank to keep current"
                        class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 placeholder-gray-400 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label
                            class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Role</label>
                        <select name="role" id="editRole"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all cursor-pointer">
                            @foreach(Admin::ROLES as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label
                            class="block font-body text-xs font-600 text-gray-500 tracking-widests uppercase mb-1.5">Status</label>
                        <select name="is_active" id="editActive"
                            class="w-full px-3 py-2.5 rounded-xl border border-gray-200 font-body text-sm text-gray-700 bg-white focus:outline-none focus:border-crimson-500 focus:ring-2 focus:ring-crimson-500/10 transition-all cursor-pointer">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-crimson-500 text-white font-display font-700 text-sm hover:bg-crimson-600 transition-all hover:shadow-lg hover:shadow-crimson-500/25">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Changes
                    </button>
                    <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-display font-600 text-sm hover:bg-gray-50 transition-all">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function openEditModal(data) {
            document.getElementById('editForm').action = '/admin/admins/' + data.id;
            document.getElementById('editName').value = data.name;
            document.getElementById('editEmail').value = data.email;
            document.getElementById('editRole').value = data.role;
            document.getElementById('editActive').value = data.is_active ? '1' : '0';
            document.getElementById('editModal').classList.remove('hidden');
        }

        // Live permissions preview on role change
        const roleSelect = document.querySelector('select[name="role"]');
        if (roleSelect) {
            roleSelect.addEventListener('change', function () {
                document.querySelectorAll('[id^="perms-"]').forEach(el => el.classList.add('hidden'));
                const target = document.getElementById('perms-' + this.value);
                if (target) target.classList.remove('hidden');
            });
        }
    </script>
@endpush