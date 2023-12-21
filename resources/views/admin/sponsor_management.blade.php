@extends('layout.layout')

@section('title', 'Sponsor Mangement')

@section('content')

    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Description</th>
                        <th>Address</th>
                        <th>Category</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $sponsor)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle w-12 h-12">
                                            <img src={{ url($sponsor->profile_photo) }} alt="Sponsor Image" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $sponsor->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $sponsor->email }}
                            </td>
                            <td>{{ $sponsor->description }}</td>
                            <td>{{ $sponsor->address }}</td>
                            <td>{{ $sponsor->category->category }}</td>
                            <td>{{ $sponsor->user->name }}</td>
                            <th>
                                <form action="/admin/sponsor/{{ $sponsor->id }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-error">Delete</button>
                                </form>
                            </th>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>

@endsection
