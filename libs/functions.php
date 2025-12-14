<?php 
session_start();
function isLoggedIn(){

return (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true);
}

function isAdmin(){
return (isLoggedIn() && isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin");
}
function getCategories(){
  include "ayar.php";

  $query = "SELECT * FROM category";
  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;
}

function getCourses(bool $anasayfa, bool $onay){
  include "ayar.php";

  $query = "SELECT * FROM courses ";

  if($anasayfa){
    $query .= "WHERE anasayfa=1";
  }

  if($onay){
     if(str_contains($query, "WHERE")){
       $query .= " and onay=1";
     }
     else{
      $query .= " WHERE onay=1";
     }
  }

  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;
}
function getCoursesByFilters($categoryId,$keyword,$page){
  include "ayar.php";
  
  $pageCount = 3;
  $offset = ($page - 1) * $pageCount;
  $query = "";
  if(!empty($categoryId)){
     $query = "from kurs_kategori kc INNER JOIN courses k on kc.kurs_id=k.id WHERE kc.kategori_id = $categoryId and onay=1";
  }
  else{
    $query = "from courses WHERE onay=1";
  }
  
  if(!empty($keyword)){
    $query .=  " AND baslik LIKE '%$keyword%' or altbaslik LIKE '%$keyword%'";
  }

  $total_sql = "SELECT COUNT(*) ".$query;
  $count_data = mysqli_query($baglanti,$total_sql);
  $count = mysqli_fetch_array($count_data)[0];
  $total_pages = ceil($count / $pageCount); 

  $sql = "SELECT * ".$query." LIMIT $offset, $pageCount";

  $sonuc = mysqli_query($baglanti,$sql);
  mysqli_close($baglanti);
  return array(
    "total_pages" => $total_pages,
    "data" => $sonuc
  );
}

function getCoursesByKeyword($q){
  include "ayar.php";

  $query = "SELECT * FROM courses WHERE baslik LIKE '%$q%' or altbaslik LIKE '%$q%'";
  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;
}

function getCategoriesByCourseId(int $course_id){
  include "ayar.php";
  $query = "SELECT * FROM `kurs_kategori` kc inner join category c on kc.kategori_id = c.id WHERE kc.kurs_id=$course_id;";
  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;

}

function createCategory(string $kategori){
  include "ayar.php";
  $query = "INSERT INTO category(kategori_adi) VALUES(?)";
  $stmt = mysqli_prepare($baglanti,$query);
  mysqli_stmt_bind_param($stmt, 's',$kategori);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  return $stmt;

}

function createCourse(string $baslik, string $altbaslik, string $aciklama, string $resim,int $yorumSayisi = 0, int $begeniSayisi = 0, int $onay = 0,){
  include "ayar.php";
  $query = "INSERT INTO courses(baslik, altbaslik, aciklama, resim, yorumSayisi, begeniSayisi, onay) VALUES(?,?,?,?,?,?,?)";
  $stmt = mysqli_prepare($baglanti,$query);
  mysqli_stmt_bind_param($stmt, 'ssssiii', $baslik, $altbaslik,$aciklama, $resim,$yorumSayisi, $begeniSayisi, $onay);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  return $stmt;

}

function getCategoryById(int $id){
  include "ayar.php";
  $query = "SELECT * FROM category WHERE id='$id'";
  $sonuc = mysqli_query($baglanti, $query);
  mysqli_close($baglanti);
  return $sonuc;
}

function getCourseById(int $id){
  include "ayar.php";
  $query = "SELECT * FROM courses WHERE id='$id'";
  $sonuc = mysqli_query($baglanti, $query);
  mysqli_close($baglanti);
  return $sonuc;
}

function getCoursesByCategoryId(int $id){
  include "ayar.php";
  $query = "SELECT * FROM kurs_kategori kc INNER JOIN courses k on kc.kurs_id=k.id WHERE kc.kategori_id = $id and onay=1";
  $sonuc = mysqli_query($baglanti, $query);
  mysqli_close($baglanti);
  return $sonuc;
}

function editCategory($id,string $category){
  include  "ayar.php";

  $query ="UPDATE category SET kategori_adi='$category' WHERE id=$id";
  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;

}
function editCourse($id,string $baslik, string $altbaslik, string $aciklama, string $resim, int $onay, int $anasayfa){
  include  "ayar.php";

  $query ="UPDATE courses SET baslik='$baslik', altbaslik='$altbaslik', aciklama = '$aciklama', resim='$resim',onay=$onay ,anasayfa=$anasayfa WHERE id=$id";
  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;

}

function addCourseCategories(int $id, array $categoreis){
  include "ayar.php";
  $query = "";
  foreach($categoreis as $catid){
   $query .= "INSERT INTO kurs_kategori(kurs_id,kategori_id) VALUES($id,$catid);";
  }
  $sonuc = mysqli_multi_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;
}

function  clearCourseCategories(int $id){
  include "ayar.php";
  $query = "DELETE from kurs_kategori WHERE kurs_id='$id'";
  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;
}

function categoryDelete(int $id){
  include "ayar.php";
  $query = "DELETE from category WHERE id='$id'";
  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;
}

function deleteCourse(int $id){
  include "ayar.php";
  $query = "DELETE from courses WHERE id='$id'";
  $sonuc = mysqli_query($baglanti,$query);
  mysqli_close($baglanti);
  return $sonuc;
}

function uploadImage(array $file){
  if(isset($file)){
    $dest_path = "./img/";
    $filename = $file["name"];
    $fileSourcePath = $file["tmp_name"];
    $fileDestPath = $dest_path.$filename;

    move_uploaded_file($fileSourcePath, $fileDestPath);
  }
}

function getDb(){
  $myFile = fopen("db.json","r");
  $size = filesize("db.json");
  $data = json_decode(fread($myFile,$size), true);
  fclose($myFile);
  return $data;
}



function kursekle(string $baslik,string $altbaslik,string $resim,string $yayinTarihi,int $yorumSayisi=0,int $begeniSayisi=0,bool $onay = true){
   $db = getDb(); 

    array_push($db["kurslar"], array(
    "baslik"=>$baslik,
    "altbaslik"=>$altbaslik,
    "resim"=>$resim,
    "yayinTarihi"=>$yayinTarihi,
    "yorumSayisi"=>$yorumSayisi,
    "begeniSayisi"=>$begeniSayisi,
    "onay"=> $onay
    ));
    
    $myFile = fopen("db.json","w");
    fwrite($myFile, json_encode($db, JSON_PRETTY_PRINT));
    fclose($myFile);
}




function urlDuzenle($baslik){
    return str_replace([" "],["-"],strtolower($baslik));
}
function kisaAciklama($altbaslik){
     if (strlen($altbaslik) > 50){
       return substr($altbaslik,0,50)."...";
     }
     else{
        return $altbaslik;
     }
                     
            
                    
}


function safe_html($data){
  $data = trim($data); // boşlukları yok sayar.
  $data = stripslashes($data); //sqlde süzme işlemi yapar.
  $data = htmlspecialchars($data); // etiketlerin < > karşlıgını getirir.
  return $data;
}

?>