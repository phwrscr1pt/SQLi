<?php
// Errors suppressed — simulates production hardened environment
ini_set('display_errors', 0);
error_reporting(0);

include 'includes/header.php';
include 'db.php';

$status = '';
$attempted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $attempted = true;

    $query = "SELECT * FROM invite_codes WHERE code = '$code'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $status = 'valid';
    } else {
        $status = 'invalid';
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Executive Access Portal</h1>
    <p class="text-gray-500 mt-1">Verify your invite code or API key to unlock executive-level resources.</p>
    <span class="inline-block mt-2 text-xs font-semibold uppercase tracking-wider bg-purple-100 text-purple-700 px-2 py-0.5 rounded">Lab 3 — Blind Boolean-Based</span>
</div>

<?php if ($attempted): ?>
    <div class="mb-6 flex items-center justify-center">
        <?php if ($status === 'valid'): ?>
            <div class="inline-flex items-center gap-2 bg-green-50 border border-green-300 rounded-full px-6 py-3">
                <span class="w-3 h-3 bg-green-500 rounded-full inline-block"></span>
                <span class="text-lg font-bold text-green-700 tracking-wide">Status: VALID / ACTIVE</span>
            </div>
        <?php else: ?>
            <div class="inline-flex items-center gap-2 bg-red-50 border border-red-300 rounded-full px-6 py-3">
                <span class="w-3 h-3 bg-red-500 rounded-full inline-block"></span>
                <span class="text-lg font-bold text-red-700 tracking-wide">Status: INVALID</span>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<div class="max-w-md">
    <form method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Enter Invite Code / API Key</label>
            <input type="text" name="code" class="w-full border border-gray-300 rounded px-3 py-2 text-sm font-mono tracking-wider focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="XXXX-XXXX-XXXX" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white text-sm font-medium px-5 py-2 rounded hover:bg-blue-700 transition">Validate</button>
    </form>
</div>

<div class="mt-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-700 mb-1">Scenario Brief</h3>
    <p class="text-sm text-gray-500">This portal validates invite codes against a backend database. You do not have a valid code. The system returns no error details — only "VALID" or "INVALID." Confirm the system is injectable, then use boolean-based blind techniques to extract the admin password from the users table, one character at a time.</p>
</div>

<?php include 'includes/footer.php'; ?>
