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
            $message = "Account created successfully for \"" . htmlspecialchars($user) . "\". You may now log in.";
            $msg_type = 'success';
        } else {
            $message = "Registration failed: " . htmlspecialchars($conn->error);
            $msg_type = 'error';
        }
    }
}
?>

<div class="max-w-md mx-auto mt-8">
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-900">New Employee Registration</h1>
            <p class="text-gray-500 mt-1 text-sm">Create your corporate account to access internal systems</p>
        </div>

        <?php if ($message): ?>
            <div class="mb-6 p-4 rounded border <?= $msg_type === 'success' ? 'bg-green-50 border-green-300 text-green-800' : 'bg-red-50 border-red-300 text-red-800' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Choose a username" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="text" name="password" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Choose a password" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white text-sm font-medium px-5 py-2.5 rounded hover:bg-blue-700 transition">Create Account</button>
        </form>

        <p class="text-xs text-gray-400 text-center mt-6">Already have an account? <a href="/lab0_bypass.php" class="text-blue-500 hover:underline">Sign in here</a>.</p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
