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
                            <td>{{ $event->users->name }}</td>
                            <th class="flex gap-2">
                                <div class="detailbutton">
                                    <!-- Open the modal using ID.showModal() method -->
                                    <button class="btn btn-info"
                                        onclick="my_modal_{{ $event->id }}.showModal()">Detail</button>
                                    <dialog id="my_modal_{{ $event->id }}" class="modal">
                                        <div class="modal-box flex justify-center items-center">
                                            <div class="card w-96 bg-base-100 shadow-xl">
                                                <figure><img class="w-52" src="{{ url($event->profile_photo) }}"
                                                        alt="{{ $event->name }}" />
                                                </figure>
                                                <div class="card-body">
                                                    <div class="card-title">
                                                        <div class="title w-full flex justify-between">
                                                            <div class="">
                                                                <h2>{{ $event->name }}</h2>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p class="mt-4">Description: {{ $event->description }}</p>
                                                    <p>Email: {{ $event->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="dialog" class="modal-backdrop">
                                            <button>close</button>
                                        </form>
                                    </dialog>
                                </div>
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
