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

<section class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Internal Book Request Form</h1>
        <p class="text-sm text-gray-500 mt-1">SQLMap Training — POST Parameter Injection</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
        <form method="POST" action="" class="space-y-4">
            <div>
                <label for="book_id" class="block text-sm font-medium text-gray-700 mb-1">Book ID</label>
                <input type="text" id="book_id" name="book_id" placeholder="Enter book ID (e.g. 1)"
                       class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="<?= isset($_POST['book_id']) ? htmlspecialchars($_POST['book_id']) : '' ?>">
            </div>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded transition">
                Lookup Book
            </button>
        </form>

        <?php if ($searched): ?>
            <?php if ($error_msg): ?>
                <div class="bg-red-50 border border-red-300 rounded p-4 mt-6">
                    <p class="text-sm font-semibold text-red-700">MySQL Error:</p>
                    <pre class="text-xs text-red-600 mt-1 whitespace-pre-wrap"><?= htmlspecialchars($error_msg) ?></pre>
                </div>
            <?php elseif ($row): ?>
                <div class="bg-green-50 border border-green-300 rounded p-4 mt-6">
                    <h2 class="text-lg font-semibold text-green-800 mb-2">Book Found</h2>
                    <table class="w-full text-sm">
                        <tr class="border-b"><td class="py-1 font-medium text-gray-600 w-32">ID</td><td class="py-1"><?= htmlspecialchars($row['id']) ?></td></tr>
                        <tr class="border-b"><td class="py-1 font-medium text-gray-600">Title</td><td class="py-1"><?= htmlspecialchars($row['title']) ?></td></tr>
                        <tr class="border-b"><td class="py-1 font-medium text-gray-600">Author</td><td class="py-1"><?= htmlspecialchars($row['author']) ?></td></tr>
                        <tr><td class="py-1 font-medium text-gray-600">Published</td><td class="py-1"><?= htmlspecialchars($row['published_year']) ?></td></tr>
                    </table>
                </div>
            <?php else: ?>
                <div class="bg-yellow-50 border border-yellow-300 rounded p-4 mt-6">
                    <p class="text-sm text-yellow-700">No book found with that ID.</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
