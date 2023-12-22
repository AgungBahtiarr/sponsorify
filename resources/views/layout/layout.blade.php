<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Sponsorify</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/d2632f5afd.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col items-start justify-start overflow-hidden">
            <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-square btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-6 h-6 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </label>
            <div class="flex justify-center w-full lg:mt-12 ">
                <h1 class="text-4xl font-semibold">Sponsorify - @yield('page')</h1>
            </div>

            <div class="container w-full h-full">
                @yield('content')
            </div>
        </div>
        <div class="drawer-side overflow-hidden">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="flex flex-col justify-center items-center px-6 py-12 bg-base-200">
                <h1 class="text-2xl font-bold">Sponsorify</h1>
            </div>
            <div class="navmenu p-4 w-80 min-h-full bg-base-200 text-base-content flex flex-col justify-between">
                <ul class="menu">
                    <!-- Sidebar content here -->
                    <li><a href="/admin"><i class="fa-solid fa-house"></i> Dashboard</a></li>
                    <li><a href="/admin/user"><i class="fa-solid fa-user"></i>User Management</a></li>
                    <li><a href="/admin/role"><i class="fa-solid fa-users-gear"></i>Role Management</a></li>
                    <li><a href="/admin/category"><i class="fa-solid fa-list"></i>Category Management</a></li>
                    <li><a href="/admin/status"><i class="fa-solid fa-check-to-slot"></i>Status Management</a></li>
                    <li><a href="/admin/sponsor"><i class="fa-solid fa-briefcase"></i>Sponsor Management</a></li>
                    <li><a href="/admin/event"><i class="fa-solid fa-calendar-days"></i>Event Management</a></li>
                </ul>
                <ul class="mb-40 menu rounded-lg min-h-full bg-red-500 flex items-center">
                    <li>
                        <form action="/admin/logout" method="POST">
                            @csrf
                            @method('delete')
                            <button class=" text-white font-semibold">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>

</html>
