<?php
// Errors fully visible — intentional for SQLMap detection
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'includes/header.php';
include 'db.php';

$row = null;
$error_msg = '';
$searched = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $searched = true;

    $query = "SELECT * FROM library_books WHERE id = $book_id";
    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
    } else {
        $error_msg = $conn->error;
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Internal Book Request</h1>
    <p class="text-gray-500 mt-1">Submit a request to check out a book from the SecureCorp corporate library.</p>
</div>

<div class="max-w-xl mx-auto">
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
        <div class="bg-blue-700 px-6 py-4">
            <h2 class="text-lg font-semibold text-white">Book Request Form</h2>
            <p class="text-blue-200 text-xs mt-1">All fields are required. Requests are reviewed within 2 business days.</p>
        </div>

        <form method="POST" action="" class="px-6 py-5 space-y-4">
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">Employee ID</label>
                <input type="text" id="employee_id" name="employee_id" placeholder="e.g. EMP-10042"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="<?= isset($_POST['employee_id']) ? htmlspecialchars($_POST['employee_id']) : '' ?>">
            </div>

            <div>
                <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department</label>
                <select id="department" name="department"
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <option value="">-- Select Department --</option>
                    <option value="engineering" <?= (isset($_POST['department']) && $_POST['department'] === 'engineering') ? 'selected' : '' ?>>Engineering</option>
                    <option value="security" <?= (isset($_POST['department']) && $_POST['department'] === 'security') ? 'selected' : '' ?>>Information Security</option>
                    <option value="hr" <?= (isset($_POST['department']) && $_POST['department'] === 'hr') ? 'selected' : '' ?>>Human Resources</option>
                    <option value="finance" <?= (isset($_POST['department']) && $_POST['department'] === 'finance') ? 'selected' : '' ?>>Finance</option>
                    <option value="operations" <?= (isset($_POST['department']) && $_POST['department'] === 'operations') ? 'selected' : '' ?>>Operations</option>
                </select>
            </div>

            <div>
                <label for="book_id" class="block text-sm font-medium text-gray-700 mb-1">Book Catalog ID</label>
                <input type="text" id="book_id" name="book_id" placeholder="e.g. 1"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="<?= isset($_POST['book_id']) ? htmlspecialchars($_POST['book_id']) : '' ?>">
                <p class="text-xs text-gray-400 mt-1">Find the ID from the <a href="/lab_sqlmap_get.php" class="text-blue-600 hover:underline">Library Catalog</a>.</p>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2.5 rounded transition">
                Submit Request
            </button>
        </form>

        <?php if ($searched): ?>
            <?php if ($error_msg): ?>
                <div class="mx-6 mb-5 p-4 rounded border bg-red-50 border-red-300">
                    <p class="text-sm font-semibold text-red-700 mb-1">Database Error:</p>
                    <pre class="text-xs text-red-600 whitespace-pre-wrap font-mono"><?= htmlspecialchars($error_msg) ?></pre>
                </div>
            <?php elseif ($row): ?>
                <div class="mx-6 mb-5 border border-green-200 rounded-lg overflow-hidden">
                    <div class="bg-green-50 border-b border-green-200 px-4 py-3">
                        <h3 class="text-sm font-semibold text-green-800">Request Confirmation</h3>
                    </div>
                    <div class="px-4 py-3 space-y-2 text-sm">
                        <div class="flex">
                            <span class="font-medium text-gray-500 w-32">Book Title</span>
                            <span class="text-gray-900"><?= htmlspecialchars($row['title']) ?></span>
                        </div>
                        <div class="flex">
                            <span class="font-medium text-gray-500 w-32">Author</span>
                            <span class="text-gray-900"><?= htmlspecialchars($row['author']) ?></span>
                        </div>
                        <div class="flex">
                            <span class="font-medium text-gray-500 w-32">Published</span>
                            <span class="text-gray-900"><?= htmlspecialchars($row['published_year']) ?></span>
                        </div>
                        <div class="flex">
                            <span class="font-medium text-gray-500 w-32">Status</span>
                            <span class="inline-block bg-green-100 text-green-700 text-xs font-medium px-2 py-0.5 rounded">Pending Review</span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="mx-6 mb-5 p-4 rounded border bg-gray-50 border-gray-200 text-gray-500 text-sm">
                    No book found with that catalog ID. Please verify the ID and try again.
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <p class="text-xs text-gray-400 text-center mt-4">SecureCorp Library Management System &mdash; Internal Use Only</p>
</div>

<?php include 'includes/footer.php'; ?>
