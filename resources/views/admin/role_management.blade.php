@extends('layout.layout')

@section('title', 'Role Management')
@section('page', 'Role Management')


@section('content')
    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th>Role Name</th>
                        <th>Action</th>
                        <th><button class="btn btn-success" onclick="my_modal_1000.showModal()">Add Role</button>
                            <dialog id="my_modal_1000" class="modal">
                                <div class="modal-box">
                                    <form method="dialog">
                                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                    </form>
                                    <form action="/admin/role" method="post">
                                        @csrf
                                        <label class="form-control w-full max-w-xs">
                                            <div class="label">
                                                <span class="label-text">Role Name</span>
                                            </div>
                                            <input type="text" name="role" placeholder="Type here"
                                                class="input input-bordered w-full max-w-xs" @required(true) />
                                        </label>
                                        <button class="btn btn-success my-4">Submit</button>
                                    </form>
                                </div>
                            </dialog>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($data as $role)
                        <tr>
                            <th>{{ $role->id }}</th>
                            <td>{{ $role->role }}</td>
                            <td class="flex gap-2">
                                <div class="updateButton">
                                    <button class="btn btn-warning"
                                        onclick="my_modal_{{ $role->id }}.showModal()">Update</button>
                                    <dialog id="my_modal_{{ $role->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <form action="/admin/role/{{ $role->id }}" method="post">
                                                @method('patch')
                                                @csrf
                                                <label class="form-control w-full max-w-xs">
                                                    <div class="label">
                                                        <span class="label-text">Role Name</span>
                                                    </div>
                                                    <input type="text" name="role" value={{ $role->role }}
                                                        placeholder="Type here" class="input input-bordered w-full max-w-xs"
                                                        @required(true) />
                                                </label>
                                                <button class="btn btn-success my-4">Submit</button>
                                            </form>
                                        </div>
                                    </dialog>
                                </div>
                                <form action="/admin/role/{{ $role->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-error">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
