<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Sponsorify</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/d2632f5afd.js" crossorigin="anonymous"></script>
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
            <div class="flex justify-center w-full lg:mt-12">
                <h1 class="text-4xl font-semibold">Sponsorify</h1>
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
            <ul class="menu p-4 w-80 min-h-full bg-base-200 text-base-content">
                <!-- Sidebar content here -->
                <li><a href="/admin">Dashboard</a></li>
                <li><a href="/admin/user">User Management</a></li>
                <li><a href="/admin/role">Role Management</a></li>
                <li><a href="/admin/category">Category Management</a></li>
                <li><a href="/admin/status">Status Management</a></li>
            </ul>

        </div>
    </div>
</body>

</html>
