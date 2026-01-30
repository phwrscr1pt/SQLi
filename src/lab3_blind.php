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

<div class="max-w-md mx-auto mt-8">
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Partner Code Verification</h1>
            <p class="text-gray-500 mt-1 text-sm">Verify your partner API key to access shared resources</p>
        </div>

        <?php if ($attempted): ?>
            <div class="mb-6 flex items-center justify-center">
                <?php if ($status === 'valid'): ?>
                    <div class="inline-flex items-center gap-2 bg-green-50 border border-green-300 rounded-full px-6 py-3">
                        <span class="w-3 h-3 bg-green-500 rounded-full inline-block"></span>
                        <span class="text-sm font-semibold text-green-700">Verified &mdash; Access Granted</span>
                    </div>
                <?php else: ?>
                    <div class="inline-flex items-center gap-2 bg-red-50 border border-red-300 rounded-full px-6 py-3">
                        <span class="w-3 h-3 bg-red-500 rounded-full inline-block"></span>
                        <span class="text-sm font-semibold text-red-700">Invalid Key &mdash; Access Denied</span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Partner API Key</label>
                <input type="text" name="code" class="w-full border border-gray-300 rounded px-3 py-2 text-sm font-mono tracking-wider focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter Partner API Key" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white text-sm font-medium px-5 py-2.5 rounded hover:bg-blue-700 transition">Verify</button>
        </form>

        <p class="text-xs text-gray-400 text-center mt-6">Contact your account manager if you have not received your API key.</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
