@extends('layout.layout')

@section('title', 'Status Management')
@section('page', 'Sponsor Mangement')


@section('content')
    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Id.</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th>
                            <div class="addButton">
                                <button class="btn btn-success" onclick="my_modal_1000.showModal()">Add Status</button>
                                <dialog id="my_modal_1000" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button
                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                        <form action="/admin/status" method="post">
                                            @csrf
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Status Name</span>
                                                </div>
                                                <input type="text" name="status" placeholder="Type here"
                                                    class="input input-bordered w-full max-w-xs" @required(true) />
                                            </label>
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Status Description</span>
                                                </div>
                                                <input type="text" name="description" placeholder="Type here"
                                                    class="input input-bordered w-full max-w-xs" @required(true) />
                                            </label>
                                            <button class="btn btn-success my-4">Submit</button>
                                        </form>
                                    </div>
                                </dialog>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($data as $status)
                        <tr>
                            <th>{{ $status->id }}</th>
                            <td>{{ $status->status }}</td>
                            <td>{{ $status->description }}</td>
                            <td class="flex gap-2">
                                <div class="updateButton">
                                    <button class="btn btn-warning"
                                        onclick="my_modal_{{ $status->id }}.showModal()">Update</button>
                                    <dialog id="my_modal_{{ $status->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <form action="/admin/status/{{ $status->id }}" method="post">
                                                @method('patch')
                                                @csrf
                                                <label class="form-control w-full max-w-xs">
                                                    <div class="label">
                                                        <span class="label-text">status Name</span>
                                                    </div>
                                                    <input type="text" name="status" value={{ $status->status }}
                                                        placeholder="Type here" class="input input-bordered w-full max-w-xs"
                                                        @required(true) />
                                                </label>
                                                <label class="form-control w-full max-w-xs">
                                                    <div class="label">
                                                        <span class="label-text">status Description</span>
                                                    </div>
                                                    <input type="text" name="description" placeholder="Type here"
                                                        value="{{ $status->description }}"
                                                        class="input input-bordered w-full max-w-xs" @required(true) />
                                                </label>
                                                <button class="btn btn-success my-4">Submit</button>
                                            </form>
                                        </div>
                                    </dialog>
                                </div>
                                <form action="/admin/status/{{ $status->id }}" method="POST">
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
