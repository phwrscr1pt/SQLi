<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureCorp Intranet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-slate-800 font-sans min-h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-2">
                    <span class="text-xl font-bold text-blue-700 tracking-tight">SecureCorp</span>
                    <span class="text-xs text-gray-400 uppercase tracking-widest hidden sm:inline">Intranet Portal</span>
                </div>
                <div class="flex items-center space-x-1">
                    <a href="/index.php" class="px-3 py-2 rounded text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">Home</a>
                    <a href="/lab0_bypass.php" class="px-3 py-2 rounded text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">Login</a>
                    <a href="/lab1_truncate.php" class="px-3 py-2 rounded text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">HR Register</a>
                    <a href="/lab2_error.php" class="px-3 py-2 rounded text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">Inventory</a>
                    <a href="/lab3_blind.php" class="px-3 py-2 rounded text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">Partner Verify</a>
                    <a href="/lab4_rce.php" class="px-3 py-2 rounded text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-gray-50 transition">Admin Tools</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
