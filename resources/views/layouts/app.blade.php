<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Contact Manager') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50 font-[Poppins]">
<!-- Navigation -->
<nav class="bg-white/80 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('contacts.index') }}" class="flex items-center space-x-2">
          <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
            ContactSphere
          </span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('contacts.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium flex items-center space-x-1">
                    <i data-feather="users" class="w-5 h-5"></i>
                    <span>Contacts</span>
                </a>
                <a href="{{ route('groups.index') }}" class="text-gray-600 hover:text-indigo-600 transition-colors font-medium flex items-center space-x-1">
                    <i data-feather="folder" class="w-5 h-5"></i>
                    <span>Groups</span>
                </a>
            </div>

            <!-- Actions + Mobile Toggle -->
            <div class="flex items-center space-x-4">
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <svg class="h-6 w-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Search -->
                <form action="{{ route('contacts.search') }}" method="GET" class="relative">
                    <input
                        type="text" name="search"
                        class="pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 w-full sm:w-48 transition-all"
                        placeholder="Search..."
                        value="{{ request('search') }}"
                    >
                    <i data-feather="search" class="absolute left-3 top-2.5 w-5 h-5 text-gray-400"></i>
                </form>

                <!-- Export -->
                <a href="{{ route('export.contacts') }}" class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 py-2 rounded-lg hover:shadow-lg transition-all flex items-center space-x-2">
                    <i data-feather="download" class="w-5 h-5"></i>
                    <span class="hidden lg:inline">Export</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden bg-white/90 backdrop-blur-md shadow-sm">
        <div class="px-4 pt-2 pb-4 space-y-1">
            <a href="{{ route('contacts.index') }}" class="block text-gray-600 hover:text-indigo-600 py-2 flex items-center space-x-2">
                <i data-feather="users" class="w-5 h-5"></i>
                <span>Contacts</span>
            </a>
            <a href="{{ route('groups.index') }}" class="block text-gray-600 hover:text-indigo-600 py-2 flex items-center space-x-2">
                <i data-feather="folder" class="w-5 h-5"></i>
                <span>Groups</span>
            </a>
            <a href="{{ route('export.contacts') }}" class="block text-gray-600 hover:text-indigo-600 py-2 flex items-center space-x-2">
                <i data-feather="download" class="w-5 h-5"></i>
                <span>Export</span>
            </a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">@yield('title', 'Contact List')</h1>
                <p class="text-gray-500">@yield('subtitle', 'Manage your contacts efficiently')</p>
            </div>
            @hasSection('action-button')
                @yield('action-button')
            @else
                <a href="{{ route('contacts.create') }}" class="mt-4 md:mt-0 bg-gradient-to-r from-teal-500 to-emerald-500 text-white px-6 py-3 rounded-xl hover:shadow-lg transition-all flex items-center space-x-2">
                    <i data-feather="plus" class="w-5 h-5"></i>
                    <span>New Contact</span>
                </a>
            @endif
        </div>

        @yield('content')
    </div>
</main>

<script>
    feather.replace();

    // Toggle mobile menu
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>
</body>
</html>
