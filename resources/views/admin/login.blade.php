<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Admin Login
        </h2>

        <!-- Error Message -->
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-600 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf

            <!-- Username -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter username">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter password">
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-200">
                Login
            </button>
        </form>

    </div>

</body>
</html>
