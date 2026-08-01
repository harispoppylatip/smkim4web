@extends('layouts.app')

@section('title', $editMode ? 'Edit User' : 'Tambah User')
@section('page_title', $editMode ? 'Edit User' : 'Tambah User')

@section('content')
    {{-- Error Alert (validation) --}}
    @if ($errors->any())
        <div class="flex items-center gap-3 bg-[#fff1f1] text-[#ba1a1a] rounded-lg p-4 mb-6 text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl border border-[#e2e2e5] overflow-hidden">
            <div class="px-6 py-4 bg-[#f9f9fc] border-b border-[#e2e2e5] flex items-center gap-3">
                <span class="material-symbols-outlined text-[#001e40]">manage_accounts</span>
                <h3 class="text-sm font-semibold text-[#1a1c1e]">
                    {{ $editMode ? 'Ubah Data User' : 'User Baru' }}
                </h3>
            </div>

            <div class="p-6">
                <form method="POST"
                    action="{{ $editMode ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                    @csrf
                    @if ($editMode)
                        @method('PUT')
                    @endif

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required
                            placeholder="cth: Admin Berita"
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
                            placeholder="cth: editor@smkistiqomah.sch.id"
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Role</label>
                        <select name="role" required
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                            <option value="admin" @selected(old('role', $user->role ?? '') === 'admin')>
                                Admin — akses semua menu
                            </option>
                            <option value="editor" @selected(old('role', $user->role ?? '') === 'editor')>
                                Editor — hanya kelola berita
                            </option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">
                            Password {{ $editMode ? '(kosongkan jika tidak diubah)' : '' }}
                        </label>
                        <input type="password" name="password" {{ $editMode ? '' : 'required' }} minlength="8"
                            placeholder="Minimal 8 karakter"
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                    </div>

                    <div class="mb-6">
                        <label class="text-xs font-semibold text-[#43474f] mb-1 block">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" {{ $editMode ? '' : 'required' }} minlength="8"
                            placeholder="Ulangi password"
                            class="form-input w-full rounded-lg border border-[#c3c6d1] p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#001e40] focus:border-transparent">
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                            class="px-4 py-2 bg-[#001e40] text-white rounded-lg text-sm font-semibold hover:bg-[#003366] transition-colors">
                            {{ $editMode ? 'Simpan Perubahan' : 'Tambah User' }}
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                            class="px-4 py-2 border border-[#c3c6d1] text-[#43474f] rounded-lg text-sm font-semibold hover:bg-[#f3f3f6] transition-colors">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
