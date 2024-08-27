<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'FrameWorks/PHPMailer/src/Exception.php';
require 'FrameWorks/PHPMailer/src/PHPMailer.php';
require 'FrameWorks/PHPMailer/src/SMPT.php';

if(isset($_GET["EmailAdresi"])){
    $GelenEmailAdresi                 = Guvenlik($_GET["EmailAdresi"]);
}else{
    $GelenEmailAdresi                 = "";
}
if(isset($_GET["AktivasyonKodu"])){
    $GelenAktivasyonKodu           = Guvenlik($_GET["AktivasyonKodu"]);
}else{
    $GelenAktivasyonKodu           = "";
}

if(isset($_POST["Sifre"])){
    $GelenSifre                 = Guvenlik($_POST["Sifre"]);
}else{
    $GelenSifre                 = "";
}
if(isset($_POST["SifreTekrar"])){
    $GelenSifreTekrar           = Guvenlik($_POST["SifreTekrar"]);
}else{
    $GelenSifreTekrar           = "";
}
$MD5liSifre      = md5($GelenSifre);

if( ($GelenEmailAdresi!="") && ($GelenAktivasyonKodu!="") && ($GelenSifre!="") && ($GelenSifreTekrar!="")){
        if($GelenSifre!=$GelenSifreTekrar){
            header("Location:index.php?SK=47");
            exit();
        }else{
            $UyeGuncellemeSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE uyeler SET Sifre=? WHERE EmailAdresi=? AND  AktivasyonKodu=? LIMIT 1");
            $UyeGuncellemeSorgusu->execute($MD5liSifre,$GelenEmailAdresi,$GelenAktivasyonKodu);
            $Kontrol     = $UyeGuncellemeSorgusu->rowCount();
                if($Kontrol>0){
                    header("Location:index.php?SK=45");
                    exit();
                }else{
                    header("Location:index.php?SK=46");
                    exit();
                }


            }

}else{
    header("Location:index.php?SK=48");
    exit();

}

?>