
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">CourseApp</a>
       
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link active">Anasayfa</a>
            </li>
           <?php if(isAdmin()):?>
                <li class="nav-item">
                    <a href="admin-categories.php" class="nav-link">Admin Categories</a>
                </li>
                <li class="nav-item">
                    <a href="admin-courses.php" class="nav-link">Admin Courses</a>
                </li>
            <?php endif; ?>

        </ul>
         <ul class="navbar-nav me-2">
            
        <?php if(isLoggedIn()):?>

           <li class="nav-item">
                <a href="logout.php" class="nav-link active">Logout</a>
            </li>
            <li class="nav-item">
                <a href="login.php" class="nav-link active">Hoşgeldiniz, <?php echo $_SESSION["username"]; ?></a>
            </li>
            

         <?php else: ?>

            <li class="nav-item">
                <a href="login.php" class="nav-link active">Login</a>
            </li>
            
           
            <li class="nav-item">
                <a href="register.php" class="nav-link">Register</a>
            </li>

        <?php endif; ?>
        </ul>
         <form action="courses.php" class="d-flex" method="GET">
            <input type="text" name="q" class="form-control me-2" placeholder="ara">
            <button type="submit" class="btn btn-outline-warning">Ara</button>
        </form>
    </div>
</nav>