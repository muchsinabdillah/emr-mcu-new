<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="robots" content="max-snippet:-1, max-image-preview:large, max-video-preview:-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rumah Sakit Yarsi | Otentikasi</title>

    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://preline.co/assets/css/main.min.css">
</head>

<body class="bg-gray-200">
<div class="container mx-auto">
    <div class="grid grid-rows-2 grid-flow-col gap-2 mt-5 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">

        <div class="row-start-1 row-span-2">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <img class="inline-flex justify-center items-center w-28 h-28" src="{{ URL::asset('logo.png') }}" alt="Rumah Sakit Yarsi">
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sistem Medical Check Up</h1>
                </div>

                <div class="mt-5">

                <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600"></div>

                <!-- Form -->
                <form method="post" action="{{ url('proses_login') }}">

                    {{ csrf_field() }}

                    @php
                        $isUsernameError = $errors->has('username');
                        $isPasswordError = $errors->has('password');
                        $isCaptchaError = $errors->has('captcha');
                    @endphp

                    <div class="grid gap-y-4">

                    <!-- Form Group -->
                    <div>
                        <div class="relative">
                            <select name="acl" class="py-3 px-4 pe-9 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:focus:ring-neutral-600">
                                @foreach($acl as $role)
                                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div>
                        <label for="username" class="block text-sm mb-2 dark:text-white">Username</label>
                        <div class="relative">
                            <input type="text" id="username" name="username" class="peer py-3 pe-0 ps-8 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required aria-describedby="username-error">
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                            <svg class="flex-shrink-0 size-4 text-gray-500 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            </div>
                            <div @class([ 'hidden' => ! $isUsernameError, 'absolute', 'inset-y-0', 'end-0', 'pe-3', 'pointer-events-none', ])>
                                <svg class="size-5 text-red-500 m-3" width="13" height="13" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                </svg>
                            </div>
                        </div>
                        <p @class([ 'hidden' => ! $isUsernameError, 'text-xs', 'text-red-600', 'mt-2', ]) id="username-error">{{ $errors->first('username') }}</p>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div>
                        <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required aria-describedby="password-error">
                            <button type="button" data-hs-toggle-password='{
                                "target": "#password"
                            }' class="absolute top-0 end-0 p-3.5 rounded-e-md">
                            <svg class="flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                            </svg>
                            </button>
                            <div @class([ 'hidden' => ! $isPasswordError, 'absolute', 'inset-y-0', 'end-0', 'pe-3', 'pointer-events-none', ])>
                            <svg class="size-5 text-red-500 mt-3 mb-3 mr-5" width="13" height="13" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                            </svg>
                            </div>
                        </div>
                        <p @class([ 'hidden' => ! $isPasswordError, 'text-xs', 'text-red-600', 'mt-2', ]) id="password-error">{{ $errors->first('password') }}</p>
                    </div>
                    <!-- End Form Group -->

                    <!-- Form Group -->
                    <div>
                        <label for="captcha" class="block text-sm mb-2 dark:text-white">Captcha</label>
                        <div class="relative">
                            <input type="text" id="captcha" name="captcha" class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required aria-describedby="captcha-error">
                            <div @class([ 'hidden' => ! $isCaptchaError, 'absolute', 'inset-y-0', 'end-0', 'pe-3', 'pointer-events-none', ])>
                                <svg class="size-5 text-red-500 m-3" width="13" height="13" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                </svg>
                            </div>
                        </div>
                        <p @class([ 'hidden' => ! $isCaptchaError, 'text-xs', 'text-red-600', 'mt-2', ]) id="captcha-error">{{ $errors->first('captcha') }}</p>
                    </div>
                    <!-- End Form Group -->

                    <p @class([ 'hidden' => ! $errors->has('login_gagal'), 'text-xs', 'text-red-600', 'mt-2', ]) id="auth-error">{{ $errors->first('login_gagal') }}</p>
                    <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">Masuk</button>

                    </div>
                </form>
                <!-- End Form -->
                </div>
            </div>
        </div>

        <div class="row-end-2 row-span-2 mx-auto mt-auto mb-auto flex flex-col bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
            <div class="m-2">
                <img src="{{ captcha_src('flat') }}" alt="captcha" />
            </div>
            <div class="m-2">
                <button onClick="window.location.reload();" type="button" class="inline-flex flex-shrink-0 justify-center items-center size-8 rounded-full text-gray-500 hover:bg-blue-100 hover:text-blue-800 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:text-neutral-500 dark:hover:bg-blue-900 dark:hover:text-blue-200">
                    <svg class="w-5 h-5 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>
</body>
</html>