@extends('layout.layout')

@section('title', 'Sponsor Mangement')
@section('page', 'Sponsor Mangement')


@section('content')

    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Category</th>
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
                            <td>{{ $sponsor->address }}</td>
                            <td>{{ $sponsor->category->category }}</td>
                            <th>
                                <div class="action flex gap-2 ">
                                    <div class="detailbutton">
                                        <!-- Open the modal using ID.showModal() method -->
                                        <button class="btn btn-info"
                                            onclick="my_modal_{{ $sponsor->id }}.showModal()">Detail</button>
                                        <dialog id="my_modal_{{ $sponsor->id }}" class="modal">
                                            <div class="modal-box flex justify-center items-center">
                                                <div class="card w-96 bg-base-100 shadow-xl">
                                                    <figure><img class="w-52" src="{{ url($sponsor->profile_photo) }}"
                                                            alt="{{ $sponsor->name }}" />
                                                    </figure>
                                                    <div class="card-body">
                                                        <div class="card-title">
                                                            <div class="title w-full flex justify-between">
                                                                <div class="">
                                                                    <h2>{{ $sponsor->name }}</h2>
                                                                    <h4 class="text-sm">{{ $sponsor->category->category }}
                                                                    </h4>
                                                                </div>
                                                                <h2 class="text-slate-500"><i
                                                                        class="fa-solid fa-location-dot"></i>
                                                                    {{ $sponsor->address }}</h2>
                                                            </div>
                                                        </div>
                                                        <p class="mt-4">Description: {{ $sponsor->description }}</p>
                                                        <p>Email: {{ $sponsor->email }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <form method="dialog" class="modal-backdrop">
                                                <button>close</button>
                                            </form>
                                        </dialog>
                                    </div>
                                    <form action="/admin/sponsor/{{ $sponsor->id }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-error">Delete</button>
                                    </form>
                                </div>

                            </th>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>

@endsection
