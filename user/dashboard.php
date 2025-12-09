<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php include '../components/meta-links.php'; ?>

</head>


<body>
    <?php include("user-sidebar.php"); ?>
    <div class="content-area text-dark">
        <h2 class="mb-4 main-title">👋 Welcome Back</h2>

        <!-- TOP STATS -->
        <div class="row g-4">

            <div class="col-md-3">
                <div class="glass-card card">
                    <div class="d-flex">
                        <div class="icon-round bg-primary me-3"><i class="bi bi-book"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0 card-title">42 Books</h5>
                            <small class="text-muted">Total books in your library</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="glass-card card">
                    <div class="d-flex">
                        <div class="icon-round bg-success me-3"><i class="bi bi-check2-circle"></i></div>
                        <div>
                            <h5 class="fw-bold mb- card-title">18 Completed</h5>
                            <small class="text-muted">Keep up the good work!</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="glass-card card">
                    <div class="d-flex">
                        <div class="icon-round bg-warning me-3"><i class="bi bi-hourglass-split"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0 card-title">24 Pending</h5>
                            <small class="text-muted">You can finish them 🔥</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="glass-card card">
                    <div class="d-flex">
                        <div class="icon-round bg-info me-3"><i class="bi bi-award"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0 card-title">5 Achievements</h5>
                            <small class="text-muted">New badges unlocked</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <!-- PROGRESS + NOTIFICATIONS -->
        <div class="row g-4 mt-2">

            <!-- Progress -->
            <div class="col-md-6">
                <div class="glass-card card">
                    <h4 class="section-title card-title ">📚 Reading Progress</h4>

                    <p class="mb-1">PHP Basics <span class="float-end">80%</span></p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-success" style="width: 80%;"></div>
                    </div>

                    <p class="mb-1">Bootstrap Mastery <span class="float-end">50%</span></p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-info" style="width: 50%;"></div>
                    </div>

                    <p class="mb-1">JavaScript Course <span class="float-end">30%</span></p>
                    <div class="progress mb-1">
                        <div class="progress-bar bg-warning" style="width: 30%;"></div>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="col-md-6">
                <div class="glass-card card">
                    <h4 class="section-title card-title">🔔 Notifications</h4>

                    <ul class="list-group">
                        <li class="list-group-item border-0">📘 New Book Added: <b>Laravel Essentials</b></li>
                        <li class="list-group-item border-0">🏆 Achievement Unlocked: <b>Pro Reader</b></li>
                        <li class="list-group-item border-0">🔄 Profile updated successfully</li>
                    </ul>
                </div>
            </div>

        </div>


        <!-- ORDERS + ACTIVITY -->
        <div class="row g-4 mt-2">

            <!-- Recent Orders Table -->
            <div class="col-md-7">
                <div class="glass-card card">
                    <h4 class="section-title card-title">🛒 Recent Orders</h4>

                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Book</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>#1023</td>
                                <td>PHP Pro Guide</td>
                                <td><span class="badge bg-success">Delivered</span></td>
                            </tr>
                            <tr>
                                <td>#1018</td>
                                <td>Bootstrap Mastery</td>
                                <td><span class="badge bg-warning">Pending</span></td>
                            </tr>
                            <tr>
                                <td>#1012</td>
                                <td>JS Secrets</td>
                                <td><span class="badge bg-danger">Canceled</span></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>

            <!-- Activity Log -->
            <div class="col-md-5">
                <div class="glass-card card">
                    <h4 class="section-title card-title">📌 Activity Log</h4>
                    <ul>
                        <li>Started: <b>JavaScript Fundamentals</b></li>
                        <li>Finished: <b>PHP Basics</b></li>
                        <li>Added 2 new books</li>
                        <li>Visited competition page</li>
                    </ul>
                </div>
            </div>

        </div>

    </div> <!-- content-area -->
    <?php include '../components/script.php'; ?>


</body>

</html>