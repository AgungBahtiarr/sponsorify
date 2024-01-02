@extends('layout.layout')

@section('title', 'Dashboard')
@section('page', 'Dashboard')

@section('content')
    <div class="chart flex justify-center">
        <div class="w-1/2">
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('myChart');

            const data = {
                labels: [
                    "January",
                    "February",
                    "March",
                    "April",
                    "May",
                    "June",
                    "July",
                    "August",
                    "September",
                    "October",
                    "November",
                    "December",
                ],
                datasets: [{
                    label: 'Data Transaction',
                    data: [{{ $transaction[0] }}, {{ $transaction[1] }}, {{ $transaction[2] }},
                        {{ $transaction[3] }}, {{ $transaction[4] }}, {{ $transaction[5] }},
                        {{ $transaction[6] }}, {{ $transaction[7] }}, {{ $transaction[8] }},
                        {{ $transaction[9] }}, {{ $transaction[10] }}, {{ $transaction[11] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            };

            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            });
        </script>
    </div>

    <div class="flex flex-col justify-center items-center mt-12">
        <div class="stats shadow">
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-regular fa-user fa-2xl"></i>
                </div>
                <div class="stat-title">Total Users</div>
                <div class="stat-value">{{ count($users) }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-users fa-2xl"></i>
                </div>
                <div class="stat-title">Event Organaizer</div>
                <div class="stat-value">{{ count($events) }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-users fa-2xl"></i>
                </div>
                <div class="stat-title">Sponsorship</div>
                <div class="stat-value">{{ count($sponsorships) }}</div>
            </div>
        </div>

        <div class="stats shadow mt-24">
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-people-arrows fa-2xl"></i>
                </div>
                <div class="stat-title">Role Users</div>
                <div class="stat-value">{{ count($roles) }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-layer-group fa-2xl"></i>
                </div>
                <div class="stat-title">Category</div>
                <div class="stat-value">{{ count($categories) }}</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-clipboard fa-2xl"></i>
                </div>
                <div class="stat-title">Status</div>
                <div class="stat-value">{{ count($statuses) }}</div>
            </div>
        </div>
    </div>
@endsection
