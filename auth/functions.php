<?php
// 4 parameters for validation
function validateForm($contact, $address, $location, $pass, $conpass){
    // all errors stores in array
    $errors = [];

    if(!preg_match('/^03[0-9]{9}$/', $contact)){
        $errors['contact'] = "Contact number must be like 03XXXXXXXXX (11 digits)";
    }

    if(strlen(trim($address)) < 10){
        $errors['address'] = "Address must be at least 10 characters long";
    }

    if(!preg_match('/^[A-Za-z, ]{3,}$/', $location)){
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
   return "<div class='alert alert-$class alert-dismissible w-25 fade show position-fixed' role='alert'
   style='bottom: 20px; right: 20px; z-index: 9999; width: auto; min-width: 300px;'>
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
function getnotification($status , $create){
    $return = [
        "Done" => "Order Is Approved",
        "Shipped"=>"Order Is Shipped",
        "delivered"=>"order Is Delivered date and time: $create",
        "Pending"=>"order Is pending date and time: $create"
    ];
    return "
<div class='card bg-white border-0 shadow-sm mb-2'>
    <div class='card-body d-flex align-items-center justify-content-between'>
        
        <!-- Icon + Status -->
        <div class='d-flex align-items-center'>
            <div class='me-3 fs-4 woodendark'>
                <i class='bi bi-clock'></i>
            </div>
            <div>
                <h6 class='mb-1 fw-bold'>{$status}</h6>
                <small class='text-muted'>{$return[$status]}</small>
            </div>
        </div>


    </div>
</div>";

}

?>