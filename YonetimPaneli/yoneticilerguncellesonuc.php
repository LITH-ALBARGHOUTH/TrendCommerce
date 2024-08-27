<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                        = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                        = "";
    }
    if(isset($_POST["Sifre"])){
        $GelenSifre                     = Guvenlik($_POST["Sifre"]);
    }else{
        $GelenSifre                     = "";
    }
    if(isset($_POST["IsimSoyisim"])){
        $GelenIsimSoyisim               = Guvenlik($_POST["IsimSoyisim"]);
    }else{
        $GelenIsimSoyisim               = "";
    }
    if(isset($_POST["EmailAdresi"])){
        $GelenEmailAdresi               = Guvenlik($_POST["EmailAdresi"]);
    }else{
        $GelenEmailAdresi               = "";
    }
    if(isset($_POST["TelefonNumarasi"])){
        $GelenTelefonNumarasi           = Guvenlik($_POST["TelefonNumarasi"]);
    }else{
        $GelenTelefonNumarasi           = "";
    }

    if( ($GelenID !="") && ($GelenIsimSoyisim !="") && ($GelenEmailAdresi !="") && ($GelenTelefonNumarasi !="") ){
        $MevcutSifreSorgusu                     =   $VeriTabaniBaglantisi->prepare("SELECT * FROM yoneticiler WHERE id=? LIMIT 1");
        $MevcutSifreSorgusu->execute([$GelenID]);
        $MevcutSifreKontrol                     =   $MevcutSifreSorgusu->rowCount();
        $MevcutSifreKaydi                       =   $MevcutSifreSorgusu->fetch(PDO::FETCH_ASSOC);

        if($MevcutSifreKontrol>0){
            $YoneticininMevcutSifresi           =   $MevcutSifreKaydi["Sifre"];
            if($GelenSifre==""){
                $YoneticiIcinKaydedilecekSifre  =   $YoneticininMevcutSifresi;
            }else{
                $YoneticiIcinKaydedilecekSifre  =   md5($GelenSifre);
            }

            $YoneticiGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE yoneticiler SET Sifre=?, IsimSoyisim=?, EmailAdresi=?, TelefonNumarasi=? WHERE id=? LIMIT 1");
            $YoneticiGuncellemeSorgusu->execute([$YoneticiIcinKaydedilecekSifre,$GelenIsimSoyisim,$GelenEmailAdresi,$GelenTelefonNumarasi,$GelenID]);
            $YoneticiGuncellemeKontrol              =   $YoneticiGuncellemeSorgusu->rowCount();
    
                if($YoneticiGuncellemeKontrol>0){
                    header("Location: index.php?SKD=0&SKI=76");
                    exit();
                }else{
                    header("Location: index.php?SKD=0&SKI=77");
                    exit();
                }
        }else{
            header("Location: index.php?SKD=0&SKI=77");
            exit();
        }

    }else{
        header("Location: index.php?SKD=0&SKI=77");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>


