<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Sponsorify</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="main flex h-screen justify-center items-center">
        <div class="card shrink-0 w-full max-w-xl shadow-2xl bg-base-100">
            <div role="alert" class="alert alert-error {{ $failed ? '' : 'hidden' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Error! Task failed successfully.</span>
            </div>
            <form class="card-body" method="POST" action="">
                @csrf
                <div class="card-head flex items-center justify-center">
                    <h1 class="text-2xl font-bold">Sponsorify - Admin</h1>
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" placeholder="email" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="password" class="input input-bordered"
                        required />
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary font-bold">Login</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>
