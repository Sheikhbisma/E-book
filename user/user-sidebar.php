
    <button class=".user-menu-btn" id="userMenuBtn">
        <i class="bi bi-list"></i>
    </button>
<div class="sidebar " id="userSidebar">
    <h2 class="text-center mb-4 fw-bold golden">User Panel</h2>

    <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a>
    <a href="competition.php"><i class="bi bi-trophy-fill"></i> Competition</a>
    <a href="books.php"><i class="bi bi-people"></i> Books</a>
    <a href="orders.php"><i class="bi bi-cart"></i> Orders</a>
    <a href="../index.php"> <i class="bi bi-arrow-left"></i> back to home</a>
    <a href="profile.php"><i class="bi bi-person-lines-fill"></i> Profile</a>
    <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
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