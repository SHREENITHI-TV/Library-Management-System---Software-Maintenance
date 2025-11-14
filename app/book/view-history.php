<?php
require_once __DIR__ . '/../../dbconnect.php';

include('../../format/header.php');
include('../../format/sidebar.php');

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo "Missing id";
    include('../../format/footer.php');
    exit;
}
$book_id = (int)$_GET['id'];

// Get current book title
$bk = $conn->prepare("SELECT title FROM books WHERE book_id = ?");
$bk->bind_param("i", $book_id);
$bk->execute();
$bkRes = $bk->get_result();
$book = $bkRes->fetch_assoc();
$bk->close();

// Get versions (include diff_json)
$sql = "SELECT version_no, title, author, publisher, year, category, changed_by, changed_at, diff_json
        FROM book_versions
        WHERE book_id = ?
        ORDER BY version_no DESC";
$st = $conn->prepare($sql);
$st->bind_param("i", $book_id);
$st->execute();
$res = $st->get_result();

// small helper to render a cell with optional "old → new"
function render_cell($field, $row, $diff) {
    $val = htmlspecialchars($row[$field]);
    if (isset($diff[$field])) {
        $before = htmlspecialchars($diff[$field]['before']);
        $after  = htmlspecialchars($diff[$field]['after']);
        return '<div>'.$before.' <span class="badge bg-warning text-dark">→</span> '.$after.'</div>';
    }
    return $val;
}
?>
<div class="container">
  <br>
  <div class="d-flex justify-content-between align-items-center mb-2">
    <h2 class="mb-0">History: <?php echo htmlspecialchars($book ? $book['title'] : 'Book #'.$book_id); ?></h2>
    <a href="book.php" class="btn btn-secondary btn-sm">Back</a>
</div>


  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Version</th>
        <th>Title</th>
        <th>Author</th>
        <th>Publisher</th>
        <th>Year</th>
        <th>Category</th>
        <th>Changed By</th>
        <th>Changed At</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $res->fetch_assoc()):
        $diff = [];
        if (!empty($row['diff_json'])) {
            $tmp = json_decode($row['diff_json'], true);
            if (is_array($tmp)) $diff = $tmp;
        }
      ?>
      <tr>
        <td><?php echo (int)$row['version_no']; ?></td>
        <td><?php echo render_cell('title', $row, $diff); ?></td>
        <td><?php echo render_cell('author', $row, $diff); ?></td>
        <td><?php echo render_cell('publisher', $row, $diff); ?></td>
        <td><?php echo render_cell('year', $row, $diff); ?></td>
        <td><?php echo render_cell('category', $row, $diff); ?></td>
        <td><?php echo htmlspecialchars($row['changed_by']); ?></td>
        <td><?php echo htmlspecialchars($row['changed_at']); ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php include('../../format/footer.php'); ?>
