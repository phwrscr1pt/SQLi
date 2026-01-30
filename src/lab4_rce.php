<?php
include 'includes/header.php';
include 'db.php';

$results = [];
$error_msg = '';
$searched = false;
$waf_blocked = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = $_POST['search'];
    $searched = true;

    // --- Simple WAF / Keyword Firewall ---
    if (stripos($search, '<?php') !== false || stripos($search, 'system') !== false) {
        $waf_blocked = true;
    }

    if (!$waf_blocked) {
        $query = "SELECT name, description FROM products WHERE name LIKE '$search'";
        $result = $conn->query($query);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $results[] = $row;
            }
        } else {
            $error_msg = $conn->error;
        }
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">System Log Export</h1>
    <p class="text-gray-500 mt-1">Search and export system logs for compliance and audit review.</p>
    <span class="inline-block mt-2 text-xs font-semibold uppercase tracking-wider bg-red-100 text-red-700 px-2 py-0.5 rounded">Lab 4 — Remote Code Execution</span>
</div>

<div class="max-w-xl mb-6">
    <form method="POST" class="flex gap-3">
        <input type="text" name="search" class="flex-grow border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter log search query..." required>
        <button type="submit" class="bg-blue-600 text-white text-sm font-medium px-5 py-2 rounded hover:bg-blue-700 transition whitespace-nowrap">Export</button>
    </form>
</div>

<?php if ($waf_blocked): ?>
    <div class="mb-6 p-4 rounded border bg-orange-50 border-orange-400">
        <p class="text-sm font-bold text-orange-800">WAF BLOCK: Malicious keywords detected!</p>
        <p class="text-xs text-orange-600 mt-1">Your request has been flagged and logged by the SecureCorp Web Application Firewall.</p>
    </div>
<?php endif; ?>

<?php if ($error_msg): ?>
    <div class="mb-6 p-4 rounded border bg-red-50 border-red-300">
        <p class="text-sm font-semibold text-red-700 mb-1">Export Error:</p>
        <pre class="text-xs text-red-600 whitespace-pre-wrap font-mono"><?= htmlspecialchars($error_msg) ?></pre>
    </div>
<?php endif; ?>

<?php if ($searched && !$waf_blocked && !$error_msg): ?>
    <?php if (count($results) > 0): ?>
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600">Log Entry</th>
                        <th class="text-left px-4 py-3 font-semibold text-gray-600">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row): ?>
                        <tr class="border-b border-gray-100">
                            <td class="px-4 py-3 font-medium"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="px-4 py-3 text-gray-500"><?= htmlspecialchars($row['description']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="p-4 rounded border bg-gray-50 border-gray-200 text-gray-500 text-sm">
            No log entries found. Export file may have been generated.
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="mt-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-700 mb-1">Scenario Brief</h3>
    <p class="text-sm text-gray-500">The log export tool has a search function that queries the database. A basic web application firewall is in place blocking common attack payloads. You suspect it may be possible to write arbitrary files to the server. Determine the web root path, bypass the WAF, and achieve remote code execution.</p>
</div>

<?php include 'includes/footer.php'; ?>
