@extends('layout.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col justify-center items-center h-full">
        <div class="stats shadow">
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-regular fa-user fa-2xl"></i>
                </div>
                <div class="stat-title">Total Users</div>
                <div class="stat-value">31K</div>
                <div class="stat-desc">Jan 1st - Feb 1st</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-users fa-2xl"></i>
                </div>
                <div class="stat-title">Event Organaizer</div>
                <div class="stat-value">4,200</div>
                <div class="stat-desc">↗︎ 400 (22%)</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-users fa-2xl"></i>
                </div>
                <div class="stat-title">Sponsorship</div>
                <div class="stat-value">1,200</div>
                <div class="stat-desc">↘︎ 90 (14%)</div>
            </div>
        </div>

        <div class="stats shadow mt-24">
            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-people-arrows fa-2xl"></i>
                </div>
                <div class="stat-title">Role Users</div>
                <div class="stat-value">31K</div>
                <div class="stat-desc">Jan 1st - Feb 1st</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-layer-group fa-2xl"></i>
                </div>
                <div class="stat-title">Category</div>
                <div class="stat-value">4,200</div>
                <div class="stat-desc">↗︎ 400 (22%)</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-secondary">
                    <i class="fa-solid fa-clipboard fa-2xl"></i>
                </div>
                <div class="stat-title">Status</div>
                <div class="stat-value">1,200</div>
                <div class="stat-desc">↘︎ 90 (14%)</div>
            </div>
        </div>
    </div>
@endsection
