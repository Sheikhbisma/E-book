
<button class="mobile-nav-toggle" id="mobileToggle">
    <i class="bi bi-list"></i>
</button>

<div class="admin-sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>Admin</h3>
    </div>

    <ul class="sidebar-menu">
        <li class=""><a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
        <li><a href="./view-users.php"><i class="bi bi-people"></i> Users</a></li>
        <li><a href="./addbooks.php"><i class="bi bi-people"></i> Books</a></li>
        <li><a href="./freebooks.php"><i class="bi bi-gear"></i> Free books</a></li>
        <li><a href="./view-orders.php"><i class="bi bi-cart"></i> Orders</a></li>
        <li><a href="./admin_dashboard.php"><i class="bi bi-bar-chart"></i> Competition</a></li>
        <li><a href="./inc/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
    </ul>
</div>

<div class="content-area">
    </div>
    <script>
const mobileToggle = document.getElementById('mobileToggle');
const sidebar = document.getElementById('sidebar');

mobileToggle.addEventListener('click', (e) => {
    e.stopPropagation(); // Click event ko document tak jane se rokta hai
    sidebar.classList.toggle('active');
});

// Sidebar ke bahar click karne par band ho jaye
document.addEventListener('click', (e) => {
    if (sidebar.classList.contains('active')) {
        if (!sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    }
});
    </script>