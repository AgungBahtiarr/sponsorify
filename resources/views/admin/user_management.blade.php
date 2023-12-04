@extends('layout.layout')

@section('title', 'User Management')

@section('content')
    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                        <th><button class="btn btn-success">Add User</button></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr>
                        <td>1.</td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle w-12 h-12">
                                        <img src="/tailwind-css-component-profile-2@56w.png"
                                            alt="Avatar Tailwind CSS Component" />
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">Hart Hagerty</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            agungbahtiar@gmail.com
                        </td>
                        <td>Event</td>
                        <td class="flex gap-2"><button class="btn btn-warning">Update</button><button
                                class="btn btn-error">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
