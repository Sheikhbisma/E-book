 <!-- Navigation Bar -->
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
     <div class="container">
         <a class="navbar-brand" href="#">
             <i class="fas fa-book-open me-2"></i>E-Book
         </a>


         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarNav">
             <!-- Mobile Search Box -->

             <ul class="navbar-nav ms-auto align-items-center gap-3">
                 <li class="nav-item">
                     <a class="nav-link active" href="#">
                         <i class="fas fa-home me-1"></i> Home
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="./books/index.php">
                         <i class="fas fa-book me-1"></i> Books
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">
                         <i class="fas fa-th-large me-1"></i> Categories
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="#">
                         <i class="fas fa-gift me-1"></i> Free Books
                     </a>
                 </li>
                 <!-- <li class="nav-item">
                     <a class="nav-link" href="#">
                         <i class="fas fa-envelope me-1"></i> Contact
                     </a>
                 </li> -->
                 <li class="nav-item">
                     <a class="nav-link" href="#">
                         <i class="fas fa-trophy me-1"></i> Competition
                     </a>
                 </li>

               <div class="d-flex gap-2 ms-5">
                  <!-- Cart Icon -->
                 <li class="nav-item">
                     <a class="nav-link cart-icon" href="#">
                         <i class="fas fa-shopping-cart fs-5">
                             <span class="position-absolute top-0 start-95 translate-middle badge rounded-pill bg-danger">
                                 5
                                 <span class="visually-hidden">unread messages</span>
                             </span>
                         </i>

                     </a>
                 </li>

                 <!-- User Dropdown -->
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                         <i class="fas fa-user-circle me-1"></i> Account
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end">
                         <li><a class="dropdown-item" href="#"><i class="fas fa-sign-in-alt me-2"></i> Login</a></li>
                         <li><a class="dropdown-item" href="#"><i class="fas fa-user-plus me-2"></i> Register</a></li>
                      
                         <li><a class="dropdown-item" href="#"><i class="fas fa-bookmark me-2"></i> My Dashboard</a></li>
                        
                         <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                     </ul>
                 </li>
               </div>
             </ul>
         </div>
     </div>
 </nav