<?php
include '../auth/check.php';
include '../auth/dbconnect.php';

if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
}

// Competition entries (students)
$competition_entries_query = "SELECT * FROM competition_entries WHERE user_id = $user_id ORDER BY submitted_at DESC";
$competition_entries = mysqli_query($conn, $competition_entries_query);

// Adult entries
$adult_entries_query = "SELECT * FROM adult_entries WHERE user_id = $user_id ORDER BY submitted_at DESC";
$adult_entries = mysqli_query($conn, $adult_entries_query);
$select_prize=mysqli_query($conn , "select * from settings where name = 'price'");
$prize = mysqli_fetch_assoc($select_prize);
$select_adultprize=mysqli_query($conn , "select * from settings where name = 'essay_prize'");
$adultPrize = mysqli_fetch_assoc($select_adultprize);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Entries</title>
    <?php include '../components/meta-links.php' ?>
</head>

<body class="bg-light">
    <?php include 'user-sidebar.php' ?>
    <div class="content-area">
        <main>
            <section class="px-md-5 pb-md-5">
                <header class="header p-4 mb-5 text-center rounded" style="border-bottom: 6px solid var(--accent-gold);">
                    <h1 class="fw-bold mb-3 mb-md-0 text-center"><i class="bi bi-pencil-square me-2"></i>Competition Entries</h1>
                    <p class="mb-1 text-light">All your competition submissions are displayed here.</p>
                </header>

                <div class="row justify-content-center">

                    <!-- Student Competition Entries -->
                    <?php while ($entry = mysqli_fetch_assoc($competition_entries)) { ?>
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="admin-order-card card p-4 h-100 d-flex flex-column">

                                <!-- Header -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0 fw-bold woodendark fs-2">
                                        <i class="bi bi-journal-text me-2"></i> Essay Entry
                                    </h5>
                                    <span class="badge btn-edit"><?php echo $entry['status'] ?></span>
                                </div>

                                <!-- Main Content -->
                                <div class="d-flex flex-column flex-md-row">
                                    <div class="flex-grow-1 mb-3 mb-md-0 woodendark">
                                        <h6 class="fw-bold woodendark">Topic: <?php echo htmlspecialchars($entry['topic']) ?></h6>
                                        <p class="mb-1"><strong>Words:</strong> <?php echo $entry['word_count'] ?></p>
                                        <p class="mb-1"><strong>Submitted At:</strong> <?php echo $entry['submitted_at'] ?></p>
                                        <?php if($entry['status'] == 'winner'){ ?>
                                            <h4 class="fst-italic"><strong>Congratulations You Are The Winner <i class="bi bi-trophy-fill"></i>The prize is given to you by the author.</strong></h4>
                                            <p class="mb-1"><strong>Prize:</strong> <?php echo "$".$prize['value'] .".00"?></p>

                                            <?php }else{ ?>
                                                   <h4 class="fst-italic woodmedium"><strong>You didn’t win this time, but thank you for participating. Better luck next time!</strong></h4>
                                                <?php } ?>
                                        <div class="mt-2">
                                           <a href="./view-essay.php?id=<?= $entry['id'] ?>" class="btn btn-gold">View Essay</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- Adult Entries -->
                    <?php while ($adult = mysqli_fetch_assoc($adult_entries)) { ?>
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="admin-order-card card p-4 h-100 d-flex flex-column">

                                <!-- Header -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0 fw-bold woodendark fs-2">
                                        <i class="bi bi-file-earmark-text me-2"></i> Adult Entry
                                    </h5>
                                    <span class="badge btn-edit"><?php echo $adult['status'] ?></span>
                                </div>

                                <!-- Main Content -->
                                <div class="flex-grow-1 mb-3 mb-md-0">
                                    <p class="mb-1"><strong>Name:</strong> <?php echo $adult['name'] ?></p>
                                    <p class="mb-1"><strong>Email:</strong> <?php echo $adult['email'] ?></p>
                                    <p class="mb-1"><strong>Submitted At:</strong> <?php echo $adult['submitted_at'] ?></p>
                                     <?php if($adult['status'] == 'winner'){ ?>
                                           <h4 class="fst-italic"><strong>Congratulations You Are The Winner <i class="bi bi-trophy-fill"></i>The prize is given to you by the author.</strong></h4>
                                            <p class="mb-1"><strong>Prize:</strong> <?php echo "$". $adultPrize['value'] .".00" ?></p>

                                            <?php }else{ ?>
                                                 <h4 class="fst-italic woodmedium"><strong>You didn’t win this time, but thank you for participating. Better luck next time!</strong></h4>
                                                <?php } ?>
                                    <div class="mt-2">
                                        <a href="../competition/uploads/adult/<?php echo $adult['pdf_file'] ?>" target="_blank" class="btn btn-gold">View PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </section>
        </main>
    </div>
    <?php include '../components/script.php' ?>
</body>
</html>
