<?php
$kategoriler = array(
 array("kategori_adi"=>"Programlama","aktif"=>true),
 array("kategori_adi"=>"Web Geliştirme","aktif"=>false),
 array("kategori_adi"=>"Veri Analizi","aktif"=>false),
 array("kategori_adi"=>"Ofis Uygulamaları","aktif"=>false),
 array("kategori_adi"=>"Mobil Uygulamalar","aktif"=>false)
);
sort($kategoriler);


$sehirler = array(
    "01" => "Adana",
    "06" => "Ankara",
    "16" => "Bursa",
    "26" => "Eskişehir",
    "34" => "İstanbul",
    "35" => "İzmir",
    "41" => "Kocaeli",
);

$hobiler = array(
    "1" =>"Sinema",
    "2" =>"Kitap Okuma",
    "3" =>"Spor Yapmak",
    "4" =>"Müzik dinlemek",
    "5" =>"Diğer",
);

$kurslar = array("1"=>array(
    "baslik"=>"Php Kursu",
    "altbaslik"=>"Sıfırdan İleri seviye web geliştirmeSıfırdan İleri seviye web geliştirmeSıfırdan İleri seviye web geliştirme",
    "resim"=>"img-1.png",
    "yayinTarihi"=>"01.01.2023",
    "yorumSayisi"=>0,
    "begeniSayisi"=>10,
    "onay"=> true
),
"2"=>array(
    "baslik"=>"Python Kursu",
    "altbaslik"=>"Sıfırdan İleri seviye Python Programlama",
    "resim"=>"img-2.png",
    "yayinTarihi"=>"03.03.2023",
    "yorumSayisi"=>10,
    "begeniSayisi"=>0,
    "onay"=> true
),
"3"=>array(
    "baslik"=>"Node.js Kursu",
    "altbaslik"=>"Sıfırdan İleri seviye node.js ile web geliştirmeSıfırdan İleri seviye django ile programlama Sıfırdan İleri seviye django ile programlama",
    "resim"=>"img-3.jpg",
    "yayinTarihi"=>"05.05.2023",
    "yorumSayisi"=>10,
    "begeniSayisi"=>20,
    "onay"=> false
),
"4"=>array(
    "baslik"=>"Django Kursu",
    "altbaslik"=>"Sıfırdan İleri seviye django ile programlama",
    "resim"=>"img-3.jpg",
    "yayinTarihi"=>"05.05.2023",
    "yorumSayisi"=>0,
    "begeniSayisi"=>5,
    "onay"=> true
)


);

const title = "Popüler Kurslar";


const db_user = array(
    "username" => "emirylmz",
    "password" => "1234",
    "name"=> "Emir Yılmaz",
);

?>