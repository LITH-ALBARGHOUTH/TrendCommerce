<?php
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");

if(isset($_GET["AktivasyonKodu"])){
    $GelenAktivasyonKodu           = Guvenlik($_GET["AktivasyonKodu"]);
}else{
    $GelenAktivasyonKodu           = "";
}
if(isset($_GET["Email"])){
    $GelenEmail                 = Guvenlik($_GET["Email"]);
}else{
    $GelenEmail                 = "";
}
if( ($GelenAktivasyonKodu!="") && ($GelenEmail!="") ){
    $KontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi =? AND AktivasyonKodu =? AND Durumu=? ");
    $KontrolSorgusu->execute([$GelenEmailAdresi, $GelenAktivasyonKodu]);
    $KullaniciSayisi = $KontrolSorgusu->rowCount();

    if($KullaniciSayisi>0){

        $UyeGuncellemeSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE uyeler SET Durumu=1");
        $UyeGuncellemeSorgusu->execute();
        $Kontrol     = $UyeGuncellemeSorgusu->rowCount();
            if($Kontrol>0){
                header("Location:index.php?SK=30");
                exit();
            }else{
                header("Location:" . $SiteLinki);
                exit();
            }
    }else{
        header("Location:" . $SiteLinki);
        exit();
    }
}else{
    header("Location:" . $SiteLinki);
    exit();

}


$VeriTabaniBaglantisi = null;
?>