<?php
function validateForm($contact, $address, $location, $pass, $conpass){
    $errors = [];

    if(!preg_match('/^03[0-9]{9}$/', $contact)){
        $errors['contact'] = "Contact number must be like 03XXXXXXXXX (11 digits)";
    }

    if(strlen(trim($address)) < 10){
        $errors['address'] = "Address must be at least 10 characters long";
    }

    if(!preg_match('/^[A-Za-z ]{3,}$/', $location)){
        $errors['location'] = "Location should contain only letters and be at least 3 characters";
    }

    if(strlen($pass) < 8){
        $errors['pass'] = "Password must be at least 8 characters long";
    } elseif(!preg_match('/^[A-Za-z0-9@#\-]+$/', $pass)){
        $errors['pass'] = "Password may contain letters, numbers, @, # and - only";
    }

    if($conpass !== $pass){
        $errors['conpass'] = "Passwords do not match";
    }

    return $errors; 
}
function showErr($err , $class){
   return "<div class='alert alert-$class alert-dismissible w-100 fade show' role='alert'>
 $err
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
function sanitize_data($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data , ENT_QUOTES);
   return $data;
}
function totalItems($conn , $user_id){
    $products = $select = mysqli_query($conn, "select sum(quantity) as sum from cart where user_id = '$user_id'");
$fetch_book = mysqli_fetch_assoc($select);
$_SESSION['totalProducts'] = $fetch_book['sum'];
return $products;
}
?>