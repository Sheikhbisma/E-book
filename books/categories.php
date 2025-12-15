<?php
include '../auth/dbconnect.php';
include '../auth/functions.php';
include '../auth/check.php';

$result = mysqli_query($conn, "SELECT * FROM books");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Books</title>
    <?php include '../components/meta-links.php'; ?>

    <style>
        :root {
            --bg: #f4f2ee;
            --dark: #2b1b17;
            --dark-soft: #3a2a26;
            --gold: #d4a017;
            --text-light: #f5f5f5;
            --text-muted: #d7ccc8;
        }

        body {
            background: var(--bg);
            font-family: "Segoe UI", system-ui, sans-serif;
        }

        /* SEARCH */
        #search {
            padding: 12px;
            border-radius: 10px;
            border: 1.5px solid #d7ccc8;
            margin-bottom: 20px;
        }

        #search:focus {
            border-color: var(--gold);
            box-shadow: none;
        }

        /* SIDEBAR */
        .sidebar-category {
            background: var(--dark);
            padding: 25px;
            border-radius: 18px;
            color: #fff;
        }

        .sidebar-category h5 {
            text-align: center;
            margin-bottom: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--gold);
            color: #ffe082;
        }

        .form-check-label {
            color: #f5f5f5;
        }

        .form-check-input:checked {
            background-color: var(--gold);
            border-color: var(--gold);
        }

        /* ===== BOOK STYLE CARD ===== */
        .book-card {
            background: linear-gradient(180deg, #241512, #2f1f1b);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(0, 0, 0, .28);
            transition: .35s ease;
            height: 100%;
        }

        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .4);
        }

        /* TOP IMAGE (BOOK COVER) */
        .book-cover {
            background: linear-gradient(to bottom, #1c0f0c, #2b1b17);
            padding: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .book-cover img {
            height: 210px;
            max-width: 100%;
            object-fit: contain;
        }

        /* BOOK BODY */
        .book-info {
            background: var(--dark-soft);
            padding: 16px;
            position: relative;
        }

        /* BOOK SPINE EFFECT */
        .book-info::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 6px;
            height: 100%;
            background: linear-gradient(to bottom, var(--gold), #ffe082);
        }

        .book-info h6 {
            font-size: 1.15rem;
            font-weight: 800;
            color: #ffeb3b;
            margin-bottom: 6px;
            padding-left: 10px;
        }

        .author {
            font-size: .9rem;
            color: var(--text-muted);
            margin-bottom: 10px;
            padding-left: 10px;
        }

        .desc {
            font-size: .88rem;
            color: var(--text-light);
            line-height: 1.5;
            padding-left: 10px;
            margin-bottom: 14px;
        }

        /* CATEGORY TAG */
        .badge {
            margin-left: 10px;
            background: rgba(255, 179, 0, .15) !important;
            color: var(--gold);
            border: 1px solid var(--gold);
            font-weight: 700;
            padding: 6px 16px;
            border-radius: 18px;
            font-size: .75rem;
        }
    </style>
</head>

<body class="p-5 mt-5">
    <?php include '../components/header.php'; ?>

    <div class="container">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-md-3">
                <div class="sidebar-category shadow">
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
                <div class="row g-4">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="col-md-6"
                            data-title="<?= strtolower($row['title']) ?>"
                            data-author="<?= strtolower($row['author']) ?>"
                            data-category="<?= $row['category'] ?>">

                            <div class="book-card">
                                <div class="book-cover">
                                    <img src="../<?= $row['cover_image'] ?>" alt="<?= $row['title'] ?>">
                                </div>

                                <div class="book-info">
                                    <h6><?= $row['title'] ?></h6>
                                    <div class="author"><?= $row['author'] ?></div>
                                    <div class="desc">
                                        <?= substr(strip_tags($row['description']), 0, 95) ?>...
                                    </div>
                                    <span class="badge"><?= $row['category'] ?></span>
                                </div>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>

    <?php include '../components/footer.php'; ?>

    <script>
        function filterBooks() {
            let search = document.getElementById('search').value.toLowerCase();
            let selectedCategories = [];

            document.querySelectorAll('.category:checked').forEach(cb => {
                selectedCategories.push(cb.value);
            });

            document.querySelectorAll('[data-title]').forEach(card => {
                let title = card.dataset.title;
                let author = card.dataset.author;
                let category = card.dataset.category;

            let matchSearch = title.includes(search) || author.includes(search);
              let matchCategory = selectedCategories.length === 0 || selectedCategories.includes(category);

              
            card.style.display = (matchSearch && matchCategory) ? "" : "none";
            });
        }
        document.getElementById('search').addEventListener('keyup', filterBooks);
        document.querySelectorAll('.category').forEach(cb =>
            cb.addEventListener('change', filterBooks)
        );
    </script>

</body>

</html>