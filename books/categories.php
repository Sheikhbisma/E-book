<?php
include '../auth/dbconnect.php';
$result = mysqli_query($conn, "SELECT * FROM books");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Simple Book Filter</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        .sidebar {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
        }
        .book-card {
            transition: 0.3s;
        }
    </style>
</head>

<body class="bg-light p-4">

<div class="container">

    <!-- 🔍 SEARCH -->
    <input type="text" id="search"
           class="form-control form-control-lg mb-4"
           placeholder="Search by title or author">

    <div class="row">

        <!-- 📂 SIDEBAR -->
        <div class="col-md-3">
            <div class="sidebar shadow-sm">

                <h5 class="fw-bold mb-3">Categories</h5>

                <?php
                $cats = ["Comics","Novels","Story Books","General Knowledge","Children Books"];
                foreach ($cats as $cat) {
                ?>
                    <div class="form-check mb-2">
                        <input class="form-check-input category"
                               type="checkbox"
                               value="<?= $cat ?>">
                        <label class="form-check-label">
                            <?= $cat ?>
                        </label>
                    </div>
                <?php } ?>

            </div>
        </div>

        <!-- 📚 BOOKS -->
        <div class="col-md-9">
            <div class="row g-4" id="books">

                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-md-4 book-card"
                         data-title="<?= strtolower($row['title']) ?>"
                         data-author="<?= strtolower($row['author']) ?>"
                         data-category="<?= $row['category'] ?>">

                        <div class="card shadow-sm h-100">
                            <img src="../<?= $row['cover_image'] ?>"
                                 class="card-img-top"
                                 style="height:220px; object-fit:cover;">

                            <div class="card-body">
                                <h6 class="fw-bold"><?= $row['title'] ?></h6>
                                <p class="text-muted"><?= $row['author'] ?></p>
                                <span class="badge bg-info"><?= $row['category'] ?></span>
                            </div>
                        </div>

                    </div>
                <?php } ?>

            </div>
        </div>

    </div>
</div>
<script>
function filterBooks() {

    let search = document.getElementById('search').value.toLowerCase();

    let selectedCategories = [];
    document.querySelectorAll('.category:checked').forEach(cb => {
        selectedCategories.push(cb.value);
    });

    document.querySelectorAll('.book-card').forEach(card => {

        let title = card.dataset.title;
        let author = card.dataset.author;
        let category = card.dataset.category;

        let matchSearch =
            title.includes(search) || author.includes(search);

        let matchCategory =
            selectedCategories.length === 0 ||
            selectedCategories.includes(category);

        if (matchSearch && matchCategory) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
}

// EVENTS
document.getElementById('search').addEventListener('keyup', filterBooks);
document.querySelectorAll('.category').forEach(cb =>
    cb.addEventListener('change', filterBooks)
);
</script>

</body>
</html>
