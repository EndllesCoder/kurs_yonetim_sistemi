<?php
require 'libs/variables.php';

require 'libs/functions.php';

?>
<?php include 'partials/_navbar.php' ?>

<?php  include 'partials/_header.php' ?>




<?php 
// session_start();
$categoryErr = $category = "";
 
if($_SERVER["REQUEST_METHOD"]=="POST"){ 


  if(empty($_POST["category"])){
    $categoryErr = "kategori alanı gerekli.";
  }
  else{
    $category = safe_html($_POST["category"]);
  }

  if(empty($categoryErr)){
     createCategory($category);
     $_SESSION["message"] = $category ." adlı kategoriniz eklenmiştir.";
     $_SESSION["type"] = "success";
     header('Location: admin-categories.php');
  }






}

?>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
              <form action="category-create.php" method="POST">
                <div class="mb-3">
                    <label for="category">Kategori Adi:</label>
                    <input type="text" name="category" class="form-control" value="<?php echo $category; ?>">
                    <div class="text-danger"><?php echo $categoryErr; ?></div>
                   
               
                <button type="submit" class="btn btn-primary mt-3">Kaydet</button>
              </form>
             </div>
        
        
        
       
            </div>
        </div>
       
        
    </div>
<?php include 'partials/_footer.php'; ?>