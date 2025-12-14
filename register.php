<?php


require 'libs/variables.php';


require 'libs/functions.php';
include "libs/ayar.php";

?>
<?php include 'partials/_navbar.php' ?>

<?php  include 'partials/_header.php' ?>


<?php 
 $usernameErr = $emailErr = $passwordErr = $repasswordErr = "";
 $username = $email = $password = $repassword = "";
 $hobbies = [];
//  err başta boş olucak hata mesajlarını yazdırmak için kullandık.
if($_SERVER["REQUEST_METHOD"]=="POST"){ //SERVER ilk yüklendiğinde methodu post ise


  if(empty($_POST["username"])){
    $usernameErr = "username alanını girmelisiniz.";
  }
  elseif(strlen($_POST["username"]) < 5 or strlen($_POST["username"]) > 20){
    $usernameErr = "username 5-20 karakter aralığında olmalıdır.";
  }
  elseif(!preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $_POST["username"])){
    $usernameErr = "username boşluk içermemelidir.";
  }
  else{
    
    $sql = "SELECT id FROM users WHERE username=?";
    if($stmt = mysqli_prepare($baglanti, $sql)){
      $param_username = trim($_POST["username"]);
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      if(mysqli_stmt_execute($stmt)){
         mysqli_stmt_store_result($stmt);
         if(mysqli_stmt_num_rows($stmt) == 1){
          $usernameErr = "kullanıcı adı alınmış!";
         }
         else{
          $username = safe_html($_POST["username"]);
         }
      }
      else{
        echo mysqli_error($baglanti);
        echo " hata oluştu";
      }
    }

  }



 


  if(empty($_POST["email"])){
    $emailErr = "email alanını girmelisiniz.";
  }
  elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    $emailErr = "email hatalıdır.";
  }
  else{
   $sql = "SELECT id FROM users WHERE email=?";
    if($stmt = mysqli_prepare($baglanti, $sql)){
      $param_email = trim($_POST["email"]);
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      if(mysqli_stmt_execute($stmt)){
         mysqli_stmt_store_result($stmt);
         if(mysqli_stmt_num_rows($stmt) == 1){
          $emailErr = "bu email adresi kullanılıyor!";
         }
         else{
          $email = safe_html($_POST["email"]);
         }
      }
      else{
        echo mysqli_error($baglanti);
        echo " hata oluştu";
      }
    }
  }


  if(empty($_POST["password"])){
    $passwordErr = "password alanını girmelisiniz.";
  }
  else{
    $password = safe_html($_POST['password']);
  }


  if($_POST["password"] != $_POST["repassword"]){
   $repasswordErr = "password alanları eşleşmiyor";
  }
  else{
   $repassword = safe_html($_POST['repassword']);
  }



//   if($_POST["city"] == -1){
//     $cityErr = "Lütfen şehir seçiniz";
//   }
//   else{
//    $city = $_POST['city'];
//   }



//   if(!isset($_POST["hobbies"])){
//   $hobbiesErr = "Hobi seçmediniz";
//   }
//   else{
//    $hobbies = $_POST['hobbies'];
//   }
// print_r($hobbies);

if(empty($usernameErr) && empty($emailErr) && empty($passwordErr)&& empty($repasswordErr)){
    $sql = "INSERT INTO users(username,email,password) VALUES(?,?,?)";
    if($stmt = mysqli_prepare($baglanti, $sql)){
        $param_username = $username;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT); //password hash şifreleme yapar.

        mysqli_stmt_bind_param($stmt,"sss", $param_username, $param_email, $param_password);
        if(mysqli_stmt_execute($stmt)){
          header("Location: login.php");
        }
        else{
          echo $baglanti;
          echo "<br>";
          echo "Hata oluştu.";
        }
    }
}





}

?>
    <div class="container my-3">
        <div class="row">
            <div class="col-12">
              <form action="register.php" method="POST" novalidate>
                <div class="mb-3">
                    <label for="username">Kullanıcı Adi:</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                    <div class="text-danger"><?php echo $usernameErr?></div>
                </div>
                <div class="mb-3">
                    <label for="email">E-posta:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                    <div class="text-danger"><?php echo $emailErr?></div>
                </div>
                <div class="mb-3">
                    <label for="password">Parola:</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                    <div class="text-danger"><?php echo $passwordErr?></div>
                </div>
                <div class="mb-3">
                    <label for="repassword">Parola Tekrar:</label>
                    <input type="password" name="repassword" class="form-control">
                    <div class="text-danger"><?php echo $repasswordErr?></div>
                </div>
                <!-- <div class="mb-3">
                    <label for="city">Şehir:</label>
                    <select name="city" class="form-select">
                       <option value="-1" selected>Şehir Seçiniz</option>
                        <?php foreach($sehirler as $plaka => $sehir): ?>

                         <option value="<?php echo $plaka;?>" <?php echo $city == $plaka ?' selected':'';?>>
                            <?php echo $sehir;?>
                        </option>
                       <?php endforeach; ?>
                    </select>
                    <div class="text-danger"><?php echo $cityErr?></div>
                </div>
                <div class="mb-3">
                    <label for="hobiler">Hobiler</label>

                <?php foreach($hobiler as $id => $hobi): ?>
                    <div class="form-check">
                        <input type="checkbox" 
                        name="hobbies[]" 
                        value="<?php echo $id;?>" 
                        id="hobbies_<?php echo $id; ?>"
                        <?php  if(in_array($id, $hobbies)) echo 'checked'?>             
                        >
                        <label for="hobbies_<?php echo $id; ?>" class="form-chechk-label"><?php echo $hobi;?></label>
                    </div>
                <?php endforeach; ?>
                   
                </div> -->
                <!-- <div class="text-danger"><?php echo $hobbiesErr?></div> -->
                <button type="submit" class="btn btn-primary">Kayıt OL</button>
              </form>

        
        
        
       
            </div>
        </div>
       
        
    </div>
<?php include 'partials/_footer.php'; ?>