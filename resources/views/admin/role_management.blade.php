@extends('layout.layout')

@section('title', 'Role Management')

@section('content')
    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th><button class="btn btn-success">Add Role</button></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr>
                        <th>1</th>
                        <td>Cy Ganderton</td>
                        <td>Quality Control Specialist</td>
                        <td class="flex gap-2"><button class="btn btn-warning">Update</button><button
                                class="btn btn-error">Delete</button></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>Cy Ganderton</td>
                        <td>Quality Control Specialist</td>
                        <td class="flex gap-2"><button class="btn btn-warning">Update</button><button
                                class="btn btn-error">Delete</button></td>
                    </tr>
                    <tr>
                        <th>3</th>
                        <td>Cy Ganderton</td>
                        <td>Quality Control Specialist</td>
                        <td class="flex gap-2"><button class="btn btn-warning">Update</button><button
                                class="btn btn-error">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
