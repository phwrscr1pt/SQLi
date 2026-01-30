<?php include 'includes/header.php'; ?>

<!-- Welcome Banner -->
<div class="mb-8 bg-gradient-to-r from-blue-700 to-blue-900 rounded-lg p-6 text-white">
    <h1 class="text-2xl font-bold">Welcome, Employee</h1>
    <p class="text-blue-200 mt-1">You are connected to the SecureCorp internal network. Please use the navigation above to access company resources.</p>
    <p class="text-xs text-blue-300 mt-3">Session active &mdash; Last login: <?= date('M d, Y \a\t h:i A') ?></p>
</div>

<!-- Dashboard Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    <!-- Company News -->
    <div class="lg:col-span-2 bg-white border border-gray-200 rounded-lg p-6">
        <h2 class="text-lg font-semibold text-slate-800 mb-4">Company News</h2>
        <div class="divide-y divide-gray-100">
            <div class="py-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-700">Q1 2025 Earnings Report Published</span>
                    <span class="text-xs text-gray-400">Jan 28, 2025</span>
                </div>
                <p class="text-sm text-gray-500 mt-1">Revenue grew 12% year-over-year. Full report available on the Finance portal.</p>
            </div>
            <div class="py-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-700">Updated Information Security Policy</span>
                    <span class="text-xs text-gray-400">Jan 22, 2025</span>
                </div>
                <p class="text-sm text-gray-500 mt-1">All employees must complete the annual security awareness training by February 15th. Contact IT for details.</p>
            </div>
            <div class="py-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-700">New Partner Onboarding Program</span>
                    <span class="text-xs text-gray-400">Jan 15, 2025</span>
                </div>
                <p class="text-sm text-gray-500 mt-1">SecureCorp is expanding its partner network. Verification procedures have been updated for Q2.</p>
            </div>
            <div class="py-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-700">Warehouse Inventory System Upgrade</span>
                    <span class="text-xs text-gray-400">Jan 10, 2025</span>
                </div>
                <p class="text-sm text-gray-500 mt-1">The inventory search module has been migrated to a new database backend. Report any issues to ops@securecorp.local.</p>
            </div>
            <div class="py-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-slate-700">Office Closure: Presidents' Day</span>
                    <span class="text-xs text-gray-400">Jan 5, 2025</span>
                </div>
                <p class="text-sm text-gray-500 mt-1">All offices will be closed on February 17th. Remote access remains available for essential personnel.</p>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">

        <!-- Quick Links -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">Quick Links</h2>
            <ul class="space-y-2 text-sm">
                <li><a href="/lab0_bypass.php" class="text-blue-600 hover:underline">Employee Login Portal</a></li>
                <li><a href="/lab1_truncate.php" class="text-blue-600 hover:underline">New Employee Registration</a></li>
                <li><a href="/lab2_error.php" class="text-blue-600 hover:underline">Warehouse Inventory Search</a></li>
                <li><a href="/lab3_blind.php" class="text-blue-600 hover:underline">Partner Code Verification</a></li>
                <li><a href="/lab4_rce.php" class="text-blue-600 hover:underline">System Diagnostics Tool</a></li>
            </ul>
        </div>

        <!-- System Status -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h2 class="text-lg font-semibold text-slate-800 mb-4">System Status</h2>
            <ul class="space-y-3 text-sm">
                <li class="flex items-center justify-between">
                    <span class="text-gray-600">Intranet</span>
                    <span class="inline-flex items-center gap-1.5 text-green-700 font-medium"><span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span> Online</span>
                </li>
                <li class="flex items-center justify-between">
                    <span class="text-gray-600">HR Database</span>
                    <span class="inline-flex items-center gap-1.5 text-green-700 font-medium"><span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span> Online</span>
                </li>
                <li class="flex items-center justify-between">
                    <span class="text-gray-600">Inventory DB</span>
                    <span class="inline-flex items-center gap-1.5 text-green-700 font-medium"><span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span> Online</span>
                </li>
                <li class="flex items-center justify-between">
                    <span class="text-gray-600">Mail Server</span>
                    <span class="inline-flex items-center gap-1.5 text-yellow-700 font-medium"><span class="w-2 h-2 bg-yellow-500 rounded-full inline-block"></span> Degraded</span>
                </li>
            </ul>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>
