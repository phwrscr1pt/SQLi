<?php
include 'includes/header.php';
include 'db.php';

$message = '';
$msg_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Check if user already exists — NO length validation in PHP (by design)
    $check = "SELECT * FROM users WHERE username = '$user'";
    $result = $conn->query($check);

    if ($result && $result->num_rows > 0) {
        $message = "Error: Username \"" . htmlspecialchars($user) . "\" is already taken.";
        $msg_type = 'error';
    } else {
        $insert = "INSERT INTO users (username, password, role) VALUES ('$user', '$pass', 'employee') ON DUPLICATE KEY UPDATE password='$pass'";
        if ($conn->query($insert)) {
            $message = "Account created successfully for \"" . htmlspecialchars($user) . "\". You may now log in via the HR Portal.";
            $msg_type = 'success';
        } else {
            $message = "Registration failed: " . htmlspecialchars($conn->error);
            $msg_type = 'error';
        }
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">New Hire Registration</h1>
    <p class="text-gray-500 mt-1">Create your corporate employee account to access internal systems.</p>
    <span class="inline-block mt-2 text-xs font-semibold uppercase tracking-wider bg-green-100 text-green-700 px-2 py-0.5 rounded">Lab 1 — SQL Truncation</span>
</div>

<?php if ($message): ?>
    <div class="mb-6 p-4 rounded border <?= $msg_type === 'success' ? 'bg-green-50 border-green-300 text-green-800' : 'bg-red-50 border-red-300 text-red-800' ?>">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="max-w-md">
    <form method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Choose Username</label>
            <input type="text" name="username" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter desired username" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Choose Password</label>
            <input type="text" name="password" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter desired password" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white text-sm font-medium px-5 py-2 rounded hover:bg-blue-700 transition">Register Account</button>
    </form>
</div>

<div class="mt-8 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-700 mb-1">Scenario Brief</h3>
    <p class="text-sm text-gray-500">You know an "admin" account exists with high privileges. The registration system won't let you create a duplicate. Find a way to take over the admin account by exploiting how the database stores usernames.</p>
</div>

<?php include 'includes/footer.php'; ?>
