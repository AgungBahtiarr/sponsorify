@extends('layout.layout')

@section('title', 'User Management')

@section('content')
    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Id. </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($data as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div>
                                        <div class="font-bold">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>{{ $user->role->role }}</td>
                            <td class="flex gap-2">
                                <div class="update-button">
                                    <button class="btn btn-warning"
                                        onclick="my_modal_{{ $user->id }}.showModal()">Update</button>
                                    <dialog id="my_modal_{{ $user->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <form action="/admin/user/{{ $user->id }}" method="post">
                                                @csrf
                                                @method('patch')
                                                <label class="form-control w-full max-w-xs">
                                                    <div class="label">
                                                        <span class="label-text">Name</span>
                                                    </div>
                                                    <input type="text" name="name" placeholder="Type here"
                                                        class="input input-bordered w-full max-w-xs"
                                                        value={{ $user->name }} @required(true) />
                                                </label>
                                                <label class="form-control w-full max-w-xs">
                                                    <div class="label">
                                                        <span class="label-text">Email</span>
                                                    </div>
                                                    <input type="text" name="email" placeholder="Type here"
                                                        class="input input-bordered w-full max-w-xs"
                                                        value={{ $user->email }} @required(true) />
                                                </label>
                                                <label class="form-control w-full max-w-xs">
                                                    <div class="label">
                                                        <span class="label-text">Role</span>
                                                    </div>
                                                    <select name="id_role" class="select select-bordered">
                                                        <option value={{ $user->id_role }}>{{ $user->role->role }}</option>
                                                        @foreach ($roles as $role)
                                                            <option value={{ $role->id }}>{{ $role->role }}</option>
                                                        @endforeach
                                                    </select>
                                                </label>
                                                <button class="btn btn-success my-4">Submit</button>
                                            </form>
                                        </div>
                                    </dialog>
                                </div>
                                <div class="delete-button">
                                    <form action="/admin/user/{{ $user->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-error">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
