<?php 
require 'libs/variables.php';
require 'libs/functions.php';

// session_start();

if(empty($_GET["id"])){
    header('Location: admin-courses.php');
}

$id = $_GET["id"];

$result = getCourseById($id);
$course = mysqli_fetch_assoc($result);

if($_SERVER["REQUEST_METHOD"]=="POST"){
  if(deleteCourse($id)){
   $_SESSION["message"] = $id ." numaralı kurs silinmiştir!";
   $_SESSION["type"] = "danger";
   
   header('Location: admin-courses.php');
    }
    else{
        echo "hata";
    }
}


?>  
<?php include 'partials/_navbar.php'; ?>
<?php include 'partials/_header.php'; ?>



<div class="container my-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                        <b><?php echo $course["baslik"]  ?></b> isimli kursu silmek istiyor musunuz ?<br>
                        <button type="submit" class="btn btn-danger mt-2">Sil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

 </div>
<?php include 'partials/_footer.php'; ?>



