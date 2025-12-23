<?php 
include './session.php';
include '../auth/dbconnect.php';

/* SAFE COUNT FUNCTION */
function totalCount($conn, $table){
    $sql = "SELECT COUNT(*) AS total FROM `$table`";
    $result = $conn->query($sql);
    if($result){
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    return 0;
}

/* COUNTS */
$books       = totalCount($conn, "books");
$freebooks   = totalCount($conn, "freebooks");
$customers   = totalCount($conn, "customer_register");
$orders      = totalCount($conn, "orders");
$orderItems  = totalCount($conn, "order_items");
$contact     = totalCount($conn, "contact");

/* CONTACT DATA */
$contacts = $conn->query("SELECT * FROM contact ");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<?php include 'inc/link.php'; ?>

<style>
/* ================= CONTENT ================= */
.content{
    margin-left:240px;
    padding:40px;
    transition:0.3s;
}

/* ================= HEADINGS ================= */
.dashboard-title,
.section-title{
    text-align:center;
    color: var(--headings);
    margin-bottom:30px;
    font-weight:800;
}

/* ================= CARDS ================= */
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:25px;
    margin-bottom:60px;
}

.card-box{
    background: url('../images/card.png'), var(--paper-cream);
    border:1px solid #c8b89a;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    text-align:center;
    transition:0.3s;
}

.card-box:hover{
    transform:translateY(-8px);
}

.card-box h2{
    font-size:42px;
    margin:0;
    color: var(--wood-dark);
}

.card-box p{
    margin-top:10px;
    font-weight:600;
    color: var(--wood-medium);
}

/* ================= TABLE ================= */
.table-box{
    background: url('../images/card.png'), var(--paper-cream);
    border:1px solid #c8b89a;
    padding:25px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    overflow-x:auto;
}

.table{
    min-width:650px;
}

.table thead{
    background: var(--wood-dark);
    color: var(--headings);
}

/* ================= RESPONSIVE ================= */

/* TABLET */
@media(max-width:992px){
    .content{
        margin-left:0;
        padding:25px;
    }

    .cards{
        grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    }

    .card-box h2{
        font-size:34px;
    }
}

/* MOBILE */
@media(max-width:576px){
    .content{
        padding:20px 15px;
    }

    .dashboard-title{
        font-size:26px;
    }

    .section-title{
        font-size:22px;
    }

    .cards{
        grid-template-columns:1fr;
        gap:18px;
    }

    .card-box{
        padding:22px;
    }

    .card-box h2{
        font-size:30px;
    }

    .table{
        font-size:14px;
    }
}
</style>
</head>

<body>

<?php include './sidebar.php'; ?>

<div class="content">

<!-- DASHBOARD HEADING -->
<h1 class="dashboard-title">Admin Dashboard</h1>

<!-- CARDS -->
<div class="cards">

    <div class="card-box">
        <h2><?= $books ?></h2>
        <p>Total Books</p>
    </div>

    <div class="card-box">
        <h2><?= $freebooks ?></h2>
        <p>Free Books</p>
    </div>

    <div class="card-box">
        <h2><?= $customers ?></h2>
        <p>Total Customers</p>
    </div>

    <div class="card-box">
        <h2><?= $orders ?></h2>
        <p>Total Orders</p>
    </div>

    <div class="card-box">
        <h2><?= $orderItems ?></h2>
        <p>Order Items</p>
    </div>

    <div class="card-box">
        <h2><?= $contact ?></h2>
        <p>Contact Messages</p>
    </div>

</div>

<!-- CONTACT MESSAGES -->
<h2 class="section-title">Contact Messages</h2>

<div class="table-box">
<table class="table table-bordered">
<thead>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Message</th>
</tr>
</thead>
<tbody>

<?php if($contacts && $contacts->num_rows > 0): ?>
<?php while($row = $contacts->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['message'] ?></td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="4" class="text-center">No Messages Found</td>
</tr>
<?php endif; ?>

</tbody>
</table>
</div>

</div>

<<<<<<< Updated upstream
=======
<?php include '../components/script.php'; ?>
>>>>>>> Stashed changes
</body>
</html>
