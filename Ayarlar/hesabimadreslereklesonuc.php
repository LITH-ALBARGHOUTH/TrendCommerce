
<?php

//if(isset($_SESSION["Kullanici"])){
?> 

<?php
if(isset($_POST["IsimSoyisim"])){
    $GelenIsimSoyisim           = Guvenlik($_POST["IsimSoyisim"]);
}else{
    $GelenIsimSoyisim           = "";
}
if(isset($_POST["Adres"])){
    $GelenAdres                 = Guvenlik($_POST["Adres"]);
}else{
    $GelenAdres                 = "";
}
if(isset($_POST["Ilce"])){
    $GelenIlce                  = Guvenlik($_POST["Ilce"]);
}else{
    $GelenIlce                  = "";
}
if(isset($_POST["Sehir"])){
    $GelenSehir                 = Guvenlik($_POST["Sehir"]);
}else{
    $GelenSehir                 = "";
}
if(isset($_POST["TelefonNumarasi"])){
    $GelenTelefonNumarasi       = Guvenlik($_POST["TelefonNumarasi"]);
}else{
    $GelenTelefonNumarasi       = "";
}
if( ($GelenIsimSoyisim!="") && ($GelenAdres!="") && ($GelenIlce!="") && ($GelenSehir!="") && ($GelenTelefonNumarasi!="") ){



                $AdresEklemeSorgusu = $VeriTabaniBaglantisi->prepare("INSERT INTO adresler(UyeId, AdiSoyadi, Adres, Ilce, Sehir, TelefonNumarasi) 
                VALUES(?, ?, ?, ?, ?, ?)");
                $AdresEklemeSorgusu->execute([$KullaniciID, $GelenIsimSoyisim, $GelenAdres, $GelenIlce, $GelenSehir, $GelenTelefonNumarasi]);
                $EklemeKontrol  = $AdresEklemeSorgusu->rowCount();

                if($EklemeKontrol>0){
                    header("Location:index.php?SK=72");
                    exit();
                }else{
                    header("Location:index.php?SK=73");
                    exit();
                }


}else{
    header("Location:index.php?SK=74"); //Eksik Alan
    exit();

}

?>

<?php
//}else{
    // header("Location: index.php");
    // exit();
//}

?>