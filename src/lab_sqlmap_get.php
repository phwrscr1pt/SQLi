<?php
// Errors fully visible — intentional for SQLMap detection
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'includes/header.php';
include 'db.php';

$row = null;
$error_msg = '';
$searched = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $searched = true;

    $query = "SELECT * FROM library_books WHERE id = $id";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        $error_msg = $conn->error;
    }
}
?>

<?php if ($searched): ?>
    <!-- Book Detail View -->
    <div class="mb-6">
        <a href="/lab_sqlmap_get.php" class="text-sm text-blue-600 hover:text-blue-800 transition">&larr; Back to Catalog</a>
        <h1 class="text-2xl font-bold text-slate-900 mt-2">Book Details</h1>
    </div>

    <?php if ($error_msg): ?>
        <div class="mb-6 p-4 rounded border bg-red-50 border-red-300">
            <p class="text-sm font-semibold text-red-700 mb-1">Database Error:</p>
            <pre class="text-xs text-red-600 whitespace-pre-wrap font-mono"><?= htmlspecialchars($error_msg) ?></pre>
        </div>
    <?php elseif ($row): ?>
        <div class="max-w-2xl bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="bg-blue-700 px-6 py-4">
                <h2 class="text-xl font-semibold text-white"><?= htmlspecialchars($row['title']) ?></h2>
            </div>
            <div class="px-6 py-5 space-y-3">
                <div class="flex items-center border-b border-gray-100 pb-3">
                    <span class="text-sm font-medium text-gray-500 w-36">Catalog ID</span>
                    <span class="text-sm text-gray-900"><?= htmlspecialchars($row['id']) ?></span>
                </div>
                <div class="flex items-center border-b border-gray-100 pb-3">
                    <span class="text-sm font-medium text-gray-500 w-36">Author</span>
                    <span class="text-sm text-gray-900"><?= htmlspecialchars($row['author']) ?></span>
                </div>
                <div class="flex items-center">
                    <span class="text-sm font-medium text-gray-500 w-36">Published Year</span>
                    <span class="text-sm text-gray-900"><?= htmlspecialchars($row['published_year']) ?></span>
                </div>
            </div>
            <div class="bg-gray-50 border-t border-gray-200 px-6 py-3">
                <span class="text-xs text-gray-400">SecureCorp Library Management System &mdash; Internal Use Only</span>
            </div>
        </div>
    <?php else: ?>
        <div class="p-4 rounded border bg-gray-50 border-gray-200 text-gray-500 text-sm">
            No book found with that catalog ID.
        </div>
    <?php endif; ?>

<?php else: ?>
    <!-- Catalog Landing Page -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-blue-700 to-blue-900 rounded-lg shadow-md px-8 py-10 text-white">
            <h1 class="text-3xl font-bold">SecureCorp Library Catalog</h1>
            <p class="mt-2 text-blue-200 text-sm">Search our collection of technical and professional resources available to all employees.</p>
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-lg font-semibold text-slate-800">Featured Books</h2>
        <p class="text-sm text-gray-500 mt-1">Browse our most popular titles. Click "View Details" to see full information.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Book 1 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col">
            <div class="bg-blue-50 border-b border-blue-100 px-5 py-4">
                <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-2 py-0.5 rounded mb-2">Security</span>
                <h3 class="text-base font-semibold text-slate-900">Hacking 101</h3>
            </div>
            <div class="px-5 py-4 flex-grow">
                <p class="text-sm text-gray-500">Jon Erickson</p>
                <p class="text-xs text-gray-400 mt-1">Published: 2008</p>
            </div>
            <div class="px-5 py-3 border-t border-gray-100">
                <a href="/lab_sqlmap_get.php?id=1" class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded transition">View Details</a>
            </div>
        </div>

        <!-- Book 2 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col">
            <div class="bg-blue-50 border-b border-blue-100 px-5 py-4">
                <span class="inline-block bg-green-600 text-white text-xs font-semibold px-2 py-0.5 rounded mb-2">Database</span>
                <h3 class="text-base font-semibold text-slate-900">SQL for Dummies</h3>
            </div>
            <div class="px-5 py-4 flex-grow">
                <p class="text-sm text-gray-500">Allen G. Taylor</p>
                <p class="text-xs text-gray-400 mt-1">Published: 2019</p>
            </div>
            <div class="px-5 py-3 border-t border-gray-100">
                <a href="/lab_sqlmap_get.php?id=2" class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded transition">View Details</a>
            </div>
        </div>

        <!-- Book 3 -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden flex flex-col">
            <div class="bg-blue-50 border-b border-blue-100 px-5 py-4">
                <span class="inline-block bg-purple-600 text-white text-xs font-semibold px-2 py-0.5 rounded mb-2">Social Eng.</span>
                <h3 class="text-base font-semibold text-slate-900">The Art of Deception</h3>
            </div>
            <div class="px-5 py-4 flex-grow">
                <p class="text-sm text-gray-500">Kevin Mitnick</p>
                <p class="text-xs text-gray-400 mt-1">Published: 2002</p>
            </div>
            <div class="px-5 py-3 border-t border-gray-100">
                <a href="/lab_sqlmap_get.php?id=3" class="inline-block w-full text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded transition">View Details</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
