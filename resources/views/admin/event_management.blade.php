@extends('layout.layout')

@section('title', 'Event Mangement')
@section('page', 'Event Mangement')

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
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $event)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle w-12 h-12">
                                            <img src={{ url($event->profile_photo) }} alt="event Image" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $event->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $event->email }}
                            </td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->users->name }}</td>
                            <th>
                                <form action="/admin/event/{{ $event->id }}" method="post">
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
