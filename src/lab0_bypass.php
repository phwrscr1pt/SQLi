<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'includes/header.php';
include 'db.php';

$message = '';
$success = false;
$row = null;
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    $result = $conn->query($query);

    if (!$result) {
        $error_msg = $conn->error;
    } elseif ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $success = true;
        $message = "Login successful. Welcome, " . htmlspecialchars($row['username']) . "!";
    } else {
        $message = "Invalid credentials. Access denied.";
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">HR Portal Login</h1>
    <p class="text-gray-500 mt-1">Authenticate to access Human Resources records.</p>
    <span class="inline-block mt-2 text-xs font-semibold uppercase tracking-wider bg-blue-100 text-blue-700 px-2 py-0.5 rounded">Lab 0 — Authentication Bypass</span>
</div>

<?php if ($error_msg): ?>
    <div class="mb-6 p-4 rounded border bg-red-50 border-red-300">
        <p class="text-sm font-semibold text-red-700 mb-1">Database Error:</p>
        <pre class="text-xs text-red-600 whitespace-pre-wrap font-mono"><?= htmlspecialchars($error_msg) ?></pre>
    </div>
<?php elseif ($message): ?>
    <div class="mb-6 p-4 rounded border <?= $success ? 'bg-green-50 border-green-300 text-green-800' : 'bg-red-50 border-red-300 text-red-800' ?>">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<?php if ($success && $row): ?>
    <div class="mb-6 border border-gray-200 rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">ID</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Username</th>
                    <th class="text-left px-4 py-3 font-semibold text-gray-600">Role</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-gray-100">
                    <td class="px-4 py-3"><?= htmlspecialchars($row['id']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($row['username']) ?></td>
                    <td class="px-4 py-3"><?= htmlspecialchars($row['role'] ?? 'employee') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<div class="max-w-md">
    <form method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <input type="text" name="username" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter employee ID" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="text" name="password" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter password" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white text-sm font-medium px-5 py-2 rounded hover:bg-blue-700 transition">Sign In</button>
    </form>
</div>

<div class="mt-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-700 mb-1">Scenario Brief</h3>
    <p class="text-sm text-gray-500">You are a contractor who discovered the HR login page. You do not have valid credentials. Find a way to bypass authentication and access the system.</p>
</div>

<?php include 'includes/footer.php'; ?>
