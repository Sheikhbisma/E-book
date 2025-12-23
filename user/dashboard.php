<?php
include '../auth/dbconnect.php';
include '../auth/check.php';
$free_book = mysqli_query($conn , "select count(*) as c from freebooks");
$fetch = mysqli_fetch_assoc($free_book)['c'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <?php include '../components/meta-links.php'; ?>

    <style>
        :root {
            --sidebar-width: 240px;
          
        }

        body {
            margin: 0;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        /* --- Sidebar Desktop View --- */
        .sidebar {
            height: 100vh;
            background: url('../images/header.png'), linear-gradient(rgba(77, 54, 46, 0.95), rgba(77, 54, 46, 0.95));
            color: #fff;
            padding-top: 20px;
            position: fixed;
            width: var(--sidebar-width);
            top: 0;
            left: 0;
            z-index: 1000;
            transition: 0.3s;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 15px;
            font-size: 20px;
            min-width: 30px;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* --- Content Area Desktop --- */
        .content-area {
            margin-left: var(--sidebar-width);
            padding: 30px;
            transition: 0.3s;
        }

        /* --- Mobile Toggle Button --- */
        .user-menu-btn {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1100;
            background: var(--brown-theme);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 22px;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        /* --- Responsive Logic (Mobile & Tablet) --- */
        @media (max-width: 991px) {
            .sidebar {
                left: -240px; /* Hide sidebar */
            }

            .sidebar.active {
                left: 0; /* Slide in on click */
                box-shadow: 5px 0 15px rgba(0,0,0,0.4);
            }

            .content-area {
                margin-left: 0;
                padding: 80px 15px 20px 15px;
            }

            .user-menu-btn {
                display: block;
            }
        }

        /* --- Glass Cards & Progress --- */
        .glass-card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
            border: 1px solid #eee !important;
        }

        .icon-round {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color:  #5D4037; ;
            background: var(--brown-theme);
        }

        .section-title { font-weight: 700; margin-bottom: 20px; }
        
        .progress-bar.bg { background: var(--brown-theme); }

        .table-responsive { border: none; }
    </style>
</head>

<body>
    <button class="user-menu-btn" id="userMenuBtn">
        <i class="bi bi-list"></i>
    </button>

    <div class="sidebar" id="userSidebar">
        <h2 class="text-center mb-4 fw-bold golden">User Panel</h2>
        <a href="dashboard.php"><i class="bi bi-speedometer2"></i> <span>Dashboard</span></a>
        <a href="competition.php"><i class="bi bi-trophy-fill"></i> <span>Competition</span></a>
        <a href="books.php"><i class="bi bi-book"></i> <span>Books</span></a>
        <a href="orders.php"><i class="bi bi-cart"></i> <span>Orders</span></a>
        <a href="profile.php"><i class="bi bi-person-lines-fill"></i> <span>Profile</span></a>
        <a href="logout.php"><i class="bi bi-box-arrow-right"></i> <span>Logout</span></a>
    </div>

    <div class="content-area">
        <h2 class="mb-4 main-title golden">👋 Welcome Back</h2>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="glass-card card">
                    <div class="d-flex align-items-center">
                        <div class="icon-round me-3"><i class="bi bi-book"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0">42 Books</h5>
                            <small class="text-muted">Total library</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="glass-card card">
                    <div class="d-flex align-items-center">
                        <div class="icon-round me-3"><i class="bi bi-check2-circle"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0"><?php echo $fetch ?> Free books</h5>
                            <small class="text-muted">Enjoy reading</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="glass-card card">
                    <div class="d-flex align-items-center">
                        <div class="icon-round me-3"><i class="bi bi-hourglass-split"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0">24 Pending</h5>
                            <small class="text-muted">Finish them 🔥</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="glass-card card">
                    <div class="d-flex align-items-center">
                        <div class="icon-round me-3"><i class="bi bi-award"></i></div>
                        <div>
                            <h5 class="fw-bold mb-0">5 Achievements</h5>
                            <small class="text-muted">New badges</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-6">
                <div class="glass-card card">
                    <h4 class="section-title">📚 Reading Progress</h4>
                    <p class="mb-1">Novel <span class="float-end">80%</span></p>
                    <div class="progress mb-3">
                        <div class="progress-bar bg" style="width: 80%;"></div>
                    </div>
                    <p class="mb-1">Comics <span class="float-end">50%</span></p>
                    <div class="progress mb-3">
                        <div class="progress-bar" style="width: 50%; background: #DAA520;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="glass-card card">
                    <h4 class="section-title">🔔 Notifications</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">📘 New Book: <b>The Watchmen</b></li>
                        <li class="list-group-item">🏆 Achievement: <b>Pro Reader</b></li>
                        <li class="list-group-item">🔄 Profile updated successfully</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-7">
                <div class="glass-card card">
                    <h4 class="section-title">🛒 Recent Orders</h4>
                    <div class="table-responsive">
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
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="glass-card card">
                    <h4 class="section-title">📌 Activity Log</h4>
                    <ul class="ps-3 mt-2">
                        <li>Started: <b>JavaScript Fundamentals</b></li>
                        <li>Finished: <b>PHP Basics</b></li>
                        <li>Added 2 new books</li>
                        <li>Visited competition page</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        const userMenuBtn = document.getElementById('userMenuBtn');
        const userSidebar = document.getElementById('userSidebar');

        userMenuBtn.addEventListener('click', function() {
            userSidebar.classList.toggle('active');
        });

        // Close sidebar if clicking outside
        document.addEventListener('click', function(event) {
            if (!userSidebar.contains(event.target) && !userMenuBtn.contains(event.target)) {
                userSidebar.classList.remove('active');
            }
        });
    </script>

    <?php include '../components/script.php'; ?>
</body>
</html>