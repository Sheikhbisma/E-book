<button id="menuBtn"
    class="navbar-toggler btn-gold woodendark fw-bold d-lg-none"
    type="button">
    <span class="navbar-toggler-icon"><i class="bi bi-list fw-bold fs-3"></i></span>
</button>
<style>
    #menuBtn {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1001;
        /* sidebar se zyada */
        background-color: black;
        width: 60px;
        color: white;
    }
</style>

<div class="sidebar" id="userSidebar">
    <h2 class="text-center mb-4 fw-bold golden">User Panel</h2>
    <div id="adminpanel" class="collapse show"> <!-- Add "collapse" class --> <a href="dashboard.php"><i class="bi bi-speedometer2"></i> Dashboard</a> <a href="competition.php"><i class="bi bi-trophy-fill"></i> Competition</a> <a href="books.php"><i class="bi bi-people"></i> Books</a> <a href="orders.php"><i class="bi bi-cart"></i> Orders</a> <a href="../index.php"><i class="bi bi-arrow-left"></i> Back to Home</a> <a href="profile.php"><i class="bi bi-person-lines-fill"></i> Profile</a> <a href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a> </div>
</div>
<script>
    const menuBtn = document.getElementById("menuBtn");
    const sidebar = document.getElementById("userSidebar");

    menuBtn.addEventListener("click", () => {
        sidebar.classList.toggle("show");
    });
</script>