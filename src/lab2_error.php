<?php
// Simulate a dev environment that leaks errors
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'includes/header.php';
include 'db.php';

$results = [];
$error_msg = '';
$searched = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];
    $searched = true;

    $query = "SELECT * FROM products WHERE name LIKE '%$search%'";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    } else {
        $error_msg = $conn->error;
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Inventory Search</h1>
    <p class="text-gray-500 mt-1">Search corporate asset records by product name or keyword.</p>
    <span class="inline-block mt-2 text-xs font-semibold uppercase tracking-wider bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded">Lab 2 — Error-Based Extraction</span>
</div>

<div class="max-w-xl mb-6">
    <form method="POST" class="flex gap-3">
        <input type="text" name="search" class="flex-grow border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Search products (e.g. Laptop, Monitor)..." required>
        <button type="submit" class="bg-blue-600 text-white text-sm font-medium px-5 py-2 rounded hover:bg-blue-700 transition whitespace-nowrap">Search</button>
    </form>
</div>

<?php if ($error_msg): ?>
    <div class="mb-6 p-4 rounded border bg-red-50 border-red-300">
        <p class="text-sm font-semibold text-red-700 mb-1">Database Error:</p>
        <pre class="text-xs text-red-600 whitespace-pre-wrap font-mono"><?= htmlspecialchars($error_msg) ?></pre>
    </div>
<?php endif; ?>

<?php if ($searched && !$error_msg): ?>
    <?php if (count($results) > 0): ?>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600">ID</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600">Product Name</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600">Description</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3"><?= htmlspecialchars($row['id']) ?></td>
                            <td class="px-4 py-3 font-medium"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="px-4 py-3 text-gray-500"><?= htmlspecialchars($row['description']) ?></td>
                            <td class="px-4 py-3">$<?= htmlspecialchars($row['price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="p-4 rounded border bg-gray-50 border-gray-200 text-gray-500 text-sm">
            No products found matching your search.
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="mt-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-700 mb-1">Scenario Brief</h3>
    <p class="text-sm text-gray-500">A secret 4-digit PIN code is stored somewhere in this database. The inventory system appears to be running in development mode with verbose error output. Enumerate the database schema to locate the hidden table, discover the correct column, and extract the PIN.</p>
</div>

<?php include 'includes/footer.php'; ?>
