@extends('layout.layout')

@section('title', 'Category Management')

@section('content')
    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Id. </th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th>
                            <div class="addButton">
                                <button class="btn btn-success" onclick="my_modal_1000.showModal()">Add Category</button>
                                <dialog id="my_modal_1000" class="modal">
                                    <div class="modal-box">
                                        <form method="dialog">
                                            <button
                                                class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                        </form>
                                        <form action="/admin/category" method="post">
                                            @csrf
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Category Name</span>
                                                </div>
                                                <input type="text" name="category" placeholder="Type here"
                                                    class="input input-bordered w-full max-w-xs" @required(true) />
                                            </label>
                                            <label class="form-control w-full max-w-xs">
                                                <div class="label">
                                                    <span class="label-text">Category Description</span>
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
                    @foreach ($data as $category)
                        <tr>
                            <th>{{ $category->id }}</th>
                            <td>{{ $category->category }}</td>
                            <td>{{ $category->description }}</td>
                            <td class="flex gap-2">
                                <div class="updateButton">
                                    <button class="btn btn-warning"
                                        onclick="my_modal_{{ $category->id }}.showModal()">Update</button>
                                    <dialog id="my_modal_{{ $category->id }}" class="modal">
                                        <div class="modal-box">
                                            <form method="dialog">
                                                <button
                                                    class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                            </form>
                                            <form action="/admin/category/{{ $category->id }}" method="post">
                                                @method('patch')
                                                @csrf
                                                <label class="form-control w-full max-w-xs">
                                                    <div class="label">
                                                        <span class="label-text">Category Name</span>
                                                    </div>
                                                    <input type="text" name="category" value={{ $category->category }}
                                                        placeholder="Type here" class="input input-bordered w-full max-w-xs"
                                                        @required(true) />
                                                </label>
                                                <label class="form-control w-full max-w-xs">
                                                    <div class="label">
                                                        <span class="label-text">Category Description</span>
                                                    </div>
                                                    <input type="text" name="description"
                                                        value="{{ $category->description }}" placeholder="Type here"
                                                        class="input input-bordered w-full max-w-xs" @required(true) />
                                                </label>
                                                <button class="btn btn-success my-4">Submit</button>
                                            </form>
                                        </div>
                                    </dialog>
                                </div>
                                <form action="/admin/category/{{ $category->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-error">Delete</button>
                                </form>
                            </td>
                            <td></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
