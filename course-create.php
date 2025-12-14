<?php
require 'libs/variables.php';

require 'libs/functions.php';

?>
<?php include 'partials/_navbar.php' ?>

<?php  include 'partials/_header.php' ?>




<?php 
// session_start();
$baslikErr = $baslik = "";
$altbaslikErr = $altbaslik = "";
$resimErr = $resim = "";
$aciklamaErr = $aciklama = "";

 
if($_SERVER["REQUEST_METHOD"]=="POST"){ 
// $kategori_id = $_POST["kategori_id"];

  if(empty($_POST["baslik"])){
    $baslikErr = "başlık alanı gerekli.";
  }
  else{
    $baslik = safe_html($_POST["baslik"]);
  }

  if(empty($_POST["altbaslik"])){
    $altbaslikErr = "altbaşlık alanı gerekli.";
  }
  else{
    $altbaslik = safe_html($_POST["altbaslik"]);
  }

  if(empty($_POST["aciklama"])){
    $aciklamaErr = "açıklama alanı gerekli.";
  }
  else{
    $aciklama = safe_html($_POST["aciklama"]);
  }

  if(empty($_FILES["imageFile"]["name"])){
    $resimErr = "resim alanı gerekli.";
  }
  else{
    uploadImage($_FILES["imageFile"]);
    $resim = $_FILES["imageFile"]["name"];
  }

  // if($_POST["category"] == "0"){
  //   $categoryErr = "kategori alanı boş geçilemez";
  // }
  // else{
  //   $category = $_POST["category"];
  // }


  if(empty($baslikErr) && empty($altbaslikErr) && empty($resimErr) && empty($aciklamaErr)){
     createCourse($baslik,$altbaslik,$aciklama,$resim);
     $_SESSION["message"] = $baslik ." adlı kurs eklenmiştir.";
     $_SESSION["type"] = "success";
     header('Location: admin-courses.php');
  }






}

?>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
                <div class="card card-body">
              <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="baslik">Başlık</label>
                    <input type="text" name="baslik" class="form-control" value="<?php echo $baslik; ?>">
                    <div class="text-danger"><?php echo $baslikErr; ?></div>

                    <label for="altbaslik">AltBaşlık</label>
                    <input type="text" name="altbaslik"  class="form-control" value="<?php echo $altbaslik; ?>">
                    <div class="text-danger"><?php echo $altbaslikErr; ?></div>


                    <label for="aciklama">Açıklama</label>
                    <textarea name="aciklama" id="aciklama"  class="form-control"><?php echo $aciklama; ?></textarea>
                    <div class="text-danger"><?php echo $aciklamaErr; ?></div>

                   <div class="mt-3 input-group">
                    <input type="file" name="imageFile" id="imageFile" class="form-control">
                    <label for="imageFile" class="input-group-text">Yükle</label>
                   </div>
                   <div class="text-danger"><?php echo $resimErr; ?></div>
                <button type="submit" class="btn btn-primary mt-3">Kaydet</button>
              </form>
             </div>
        
        
        
       
            </div>
        </div>
       
        
    </div>
<?php include 'partials/_editor.php'; ?>
<?php include 'partials/_footer.php'; ?>