<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Short URL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .dark-mode {
            @apply dark;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen transition-all">

<div class="flex items-center justify-center py-10">
    <div class="w-full max-w-lg">
        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">Create Short URL</h2>
            <form id="form" class="flex flex-col space-y-4" method="POST" action="{{ route('url.store') }}">
                @csrf
                <div>
                    <label for="inputField" class="block mb-2 text-sm font-medium">URL</label>
                    <input required name="url" type="text" id="inputField" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Type something...">
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">Submit</button>
            </form>
        </div>

        <!-- Table -->
        <div class="mt-8">
            <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <thead>
                <tr>
                    <th class="py-3 px-6 bg-gray-200 dark:bg-gray-700 text-left">ID</th>
                    <th class="py-3 px-6 bg-gray-200 dark:bg-gray-700 text-left">URL</th>
                    <th class="py-3 px-6 bg-gray-200 dark:bg-gray-700 text-left">Short URL</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach($urls as $url)
                        <tr>
                            <td class="py-3 px-6 border-b border-gray-200 dark:border-gray-700">
                                {{ $url->id }}
                            </td>
                            <td class="py-3 px-6 border-b border-gray-200 dark:border-gray-700">
                                <a href="{{ $url->url }}">{{ $url->url }}</a>
                            </td>
                            <td class="py-3 px-6 border-b border-gray-200 dark:border-gray-700">
                                <a href="{{ $url->full_short_url }}">{{ $url->full_short_url }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
