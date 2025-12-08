<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    div{
        display: flex;
        gap: 20px;
    }
</style>
<body>
    <?php
    include '../auth/dbconnect.php';
    session_start();
    $select = mysqli_query($conn , "select * from books");
    while($r=mysqli_fetch_assoc($select)){
        echo "<div>{$r['id']}
        <img src = './add.jfif'> <a href = '../cart.php?id={$r['id']}'>add to cart</a></div>
        ";
    }
    
    
    ?>
</body>
</html>