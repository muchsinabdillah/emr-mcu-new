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
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">System Medical Check Up (Stress Checker)</h1>
                </div>

                <div class="mt-5">

                @if (! session()->has('results'))
                <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600"></div>
                <!-- Form -->
                <form method="post" action="{{ route('faq.store') }}">

                    {{ csrf_field() }}

                    <div class="grid gap-y-4">

                    <!-- Form Group -->
                    @foreach($questioners as $index => $questioner)
                        <div class="p-2 border rounded">
                            <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{ $index+1 }}</span>
                            <label for="faq_{{ $questioner["id"] }}" class="block text-center text-sm font-bold mb-2 light:text-white">{{ $questioner["text"] }}</label>
                            <div class="relative">
                                <select name="faq[]" id="faq_{{ $questioner["id"] }}" class="py-3 px-4 pe-9 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none light:bg-neutral-700 light:border-transparent light:text-neutral-400 light:focus:ring-neutral-600">
                                    @foreach($answers as $answer)
                                        <option value="{{ $answer["id"] }}">{{ $answer["text"] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Form Group -->

                    <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">Periksa</button>

                    </div>
                </form>
                <!-- End Form -->
                </div>
                @else
                <div>
                <table class="table-auto border text-center w-full">
                    <thead>
                        <tr>
                            <th class="border">No.</th>
                            <th class="border">Category</th>
                            <th class="border">Total</th>
                            <th class="border">Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('results') as $index => $result)
                        <tr>
                            <td class="border">{{ $index }}</td>
                            <td class="border">{{ $result['category']['category'] }}</td>
                            <td class="border">{{ $result['total'] }}</td>
                            <td class="border">{{ $result['grade'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                @endif

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>
</body>
</html>