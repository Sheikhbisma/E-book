<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';

$result = mysqli_query($conn, "SELECT * FROM books");
$total_books = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Books</title>
<?php  include '../components/meta-links.php' ?>
   




</head>

<body class="pt mt-5">
    <?php include '../components/header.php'; ?>

    <div class="container">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-md-3">
                <div class="sidebar-category shadow header">
                    <input type="text" id="search" class="form-control" placeholder="Search book or author">
                    <h5>Categories</h5>
                    <?php
                    $cats = ["Comics", "Novels", "Story Books", "General Knowledge", "Children Books"];
                    foreach ($cats as $cat) {
                    ?>
                        <div class="form-check mb-2">
                            <input class="form-check-input category" type="checkbox" value="<?= $cat ?>">
                            <label class="form-check-label"><?= $cat ?></label>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- BOOKS -->
            <div class="col-md-9">
                <div id="noResults" class="text-center text-light mt-4" style="display:none;">
    <i class="bi bi-search fs-1 text-warning"></i>
    <h5 class="mt-2 fs-1">No results found</h5>
    <p class="cream fw-bold fs-3">Try a different keyword or category</p>
</div>

                <div class="row g-4">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-md-6"
                            data-title="<?= strtolower($row['title']) ?>"
                            data-author="<?= strtolower($row['author']) ?>"
                            data-category="<?= $row['category'] ?>">

                            <div class="book-card ">
                                <div class="book-cover header">
                                    <img src="../<?= $row['cover_image'] ?>" alt="<?= $row['title'] ?>">
                                </div>

                                <div class="book-info">
                                    <h6><?= $row['title'] ?></h6>
                                    <div class="author"><?= $row['author'] ?></div>
                                    <div class="desc">
                                        <?= substr(strip_tags($row['description']), 0, 95) ?>...
                                    </div>
                                    <span class="badges"><?= $row['category'] ?></span>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

    <?php include '../components/footer.php'; ?>
  <?php include '../components/script.php'; ?>
    <script>
      function filterBooks() {
    let search = document.getElementById('search').value.toLowerCase();
    let selectedCategories = [];
    let visibleCount = 0;

    document.querySelectorAll('.category:checked').forEach(cb => {
        selectedCategories.push(cb.value);
    });

    document.querySelectorAll('[data-title]').forEach(card => {
        let title = card.dataset.title;
        let author = card.dataset.author;
        let category = card.dataset.category;

        let matchSearch = title.includes(search) || author.includes(search);
        let matchCategory = selectedCategories.length === 0 || selectedCategories.includes(category);

        if (matchSearch && matchCategory) {
            card.style.display = "";
            visibleCount++;
        } else {
            card.style.display = "none";
        }
    });

    // NO RESULT MESSAGE
    document.getElementById('noResults').style.display =
        visibleCount === 0 ? "block" : "none";
}

        document.getElementById('search').addEventListener('keyup', filterBooks);
        document.querySelectorAll('.category').forEach(cb =>
            cb.addEventListener('change', filterBooks)
        );
    </script>

</body>

</html>