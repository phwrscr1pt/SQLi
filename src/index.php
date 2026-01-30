<?php include 'includes/header.php'; ?>

<div class="mb-8">
    <h1 class="text-2xl font-bold text-slate-900">Employee Portal</h1>
    <p class="text-gray-500 mt-1">Welcome to the SecureCorp internal systems dashboard.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <!-- Lab 0: HR Portal -->
    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition bg-white">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Lab 0</span>
            <span class="text-xs font-medium bg-blue-100 text-blue-700 px-2 py-0.5 rounded">Bypass</span>
        </div>
        <h2 class="text-lg font-semibold text-slate-800 mb-2">HR Portal</h2>
        <p class="text-sm text-gray-500 mb-4">Employee login system for the Human Resources department. Access personnel records and benefits.</p>
        <a href="/lab0/" class="inline-block bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-700 transition">Access System</a>
    </div>

    <!-- Lab 1: Registration -->
    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition bg-white">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Lab 1</span>
            <span class="text-xs font-medium bg-green-100 text-green-700 px-2 py-0.5 rounded">Truncate</span>
        </div>
        <h2 class="text-lg font-semibold text-slate-800 mb-2">New Hire Registration</h2>
        <p class="text-sm text-gray-500 mb-4">Onboarding portal for new employee account creation. Register your corporate credentials here.</p>
        <a href="/lab1/" class="inline-block bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-700 transition">Access System</a>
    </div>

    <!-- Lab 2: Inventory Search -->
    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition bg-white">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Lab 2</span>
            <span class="text-xs font-medium bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded">Error-Based</span>
        </div>
        <h2 class="text-lg font-semibold text-slate-800 mb-2">Inventory Search</h2>
        <p class="text-sm text-gray-500 mb-4">Corporate asset and inventory management system. Search equipment records by department.</p>
        <a href="/lab2/" class="inline-block bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-700 transition">Access System</a>
    </div>

    <!-- Lab 3: Executive Access -->
    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition bg-white">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Lab 3</span>
            <span class="text-xs font-medium bg-purple-100 text-purple-700 px-2 py-0.5 rounded">Blind</span>
        </div>
        <h2 class="text-lg font-semibold text-slate-800 mb-2">Executive Access</h2>
        <p class="text-sm text-gray-500 mb-4">Restricted portal for C-suite executive profiles. Verify authorization to view leadership directory.</p>
        <a href="/lab3/" class="inline-block bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-700 transition">Access System</a>
    </div>

    <!-- Lab 4: Log Export -->
    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition bg-white">
        <div class="flex items-center justify-between mb-3">
            <span class="text-xs font-semibold uppercase tracking-wider text-gray-400">Lab 4</span>
            <span class="text-xs font-medium bg-red-100 text-red-700 px-2 py-0.5 rounded">RCE</span>
        </div>
        <h2 class="text-lg font-semibold text-slate-800 mb-2">System Log Export</h2>
        <p class="text-sm text-gray-500 mb-4">Export system and audit logs for compliance review. Generate reports in multiple formats.</p>
        <a href="/lab4/" class="inline-block bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded hover:bg-blue-700 transition">Access System</a>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
