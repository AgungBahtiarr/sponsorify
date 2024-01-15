@extends('layout.layout')

@section('title', 'Transaction')
@section('page', 'Transaction')

@section('content')
    <div class="mx-8 mt-8">
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Event Name</th>
                        <th>Sponsorshp Name</th>
                        <th>Proposal</th>
                        <th>Total funds</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $transaction)
                        <tr>
                            <th>{{ $transaction->id }}</th>
                            <td>{{ $transaction->event->name }}</td>
                            <td>{{ $transaction->sponsorship->name }}</td>
                            <td>
                                <form action="{{ url($transaction->proposal->proposal) }}" method="get">
                                    <button class="btn btn-primary">Download</button>
                                </form>
                            </td>
                            <td>{{ $transaction->sponsorship_funds }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
