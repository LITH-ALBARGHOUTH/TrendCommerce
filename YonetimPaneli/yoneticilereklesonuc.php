<?php


if(isset($_SESSION["Yonetici"])){

    if(isset($_POST["KullaniciAdi"])){
        $GelenKullaniciAdi                  = Guvenlik($_POST["KullaniciAdi"]);
    }else{
        $GelenKullaniciAdi                  = "";
    }
    if(isset($_POST["Sifre"])){
        $GelenSifre                         = Guvenlik($_POST["Sifre"]);
    }else{
        $GelenSifre                         = "";
    }
    if(isset($_POST["IsimSoyisim"])){
        $GelenIsimSoyisim                   = Guvenlik($_POST["IsimSoyisim"]);
    }else{
        $GelenIsimSoyisim                   = "";
    }
    if(isset($_POST["EmailAdresi"])){
        $GelenEmailAdresi                   = Guvenlik($_POST["EmailAdresi"]);
    }else{
        $GelenEmailAdresi                   = "";
    }
    if(isset($_POST["TelefonNumarasi"])){
        $GelenTelefonNumarasi               = Guvenlik($_POST["TelefonNumarasi"]);
    }else{
        $GelenTelefonNumarasi               = "";
    }

    $MD5liSifre     =   md5($GelenSifre);


    if( ($GelenKullaniciAdi !="") && ($GelenSifre !="") && ($GelenIsimSoyisim !="") && ($GelenEmailAdresi !="") && ($GelenTelefonNumarasi !="") ){

        $YoneticiKontrolSorgusu             =   $VeriTabaniBaglantisi->prepare("SELECT * FROM yoneticiler WHERE KullaniciAdi=? OR  EmailAdresi=? ");
        $YoneticiKontrolSorgusu->execute([$GelenKullaniciAdi,$GelenEmailAdresi]);
        $YoneticiKontrol                    =   $YoneticiKontrolSorgusu->rowCount();

            if($YoneticiKontrol<1){

                $YoneticiEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO yoneticiler (KullaniciAdi, Sifre, IsimSoyisim, EmailAdresi, TelefonNumarasi, SilinemeyenYonetici) 
                values(?,?,?,?,?,?) ");
                $YoneticiEklemeSorgusu->execute([$GelenKullaniciAdi,$MD5liSifre,$GelenIsimSoyisim,$GelenEmailAdresi,$GelenTelefonNumarasi,0]);
                $YoneticiEklemeKontrol              =   $YoneticiEklemeSorgusu->rowCount();

                    if ($YoneticiEklemeKontrol>0) {
                        header("Location: index.php?SKD=0&SKI=72");
                        exit();
                        } else {
                        header("Location: index.php?SKD=0&SKI=73");
                        exit();
                    }
                
            }else{
                header("Location: index.php?SKD=0&SKI=81");
                exit();
            }
            
    }else{
        header("Location: index.php?SKD=0&SKI=73");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
