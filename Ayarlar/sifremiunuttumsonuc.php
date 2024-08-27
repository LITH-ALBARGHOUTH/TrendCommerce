<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'FrameWorks/PHPMailer/src/Exception.php';
require 'FrameWorks/PHPMailer/src/PHPMailer.php';
require 'FrameWorks/PHPMailer/src/SMPT.php';

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
if( ($GelenEmailAdresi!="") || ($GelenTelefonNumarasi!="")){
    $KontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi =? OR TelefonNumarasi=? AND SilinmeDurumu=?");
    $KontrolSorgusu->execute([$GelenEmailAdresi,$GelenTelefonNumarasi,0]);
    $KullaniciSayisi = $KontrolSorgusu->rowCount();
    $KullaniciKaydi  = fetch(PDO::FETCH_ASSOC);

    if($KullaniciSayisi>0){

            $MailIcerigiHazirla     = "Merhaba Sayın " . $KullaniciKaydi["IsimSoyisim"] . "<br /><br />Sitemizin Üzerinde Bulunan Hesabınızın Şifresini 
            Sıfırlamak İçin Lütfen <a href='" .$SiteLinki "/index.php?SK=43&AktivasyonKodu=". $KullaniciKaydi["AktivasyonKodu"] ."&Email=". 
            $KullaniciKaydi["EmailAdresi"] ."'>BURAYA TIKLAYINIZ</a><br /><br />Saygılarımızla, Mutlu Alışverişler Dileriz...<br />" . $SiteAdi;

            $MailGonder = new PHPMailer(true);

            try {
                $MailGonder->SMTPDebug    = 0;                                                           
                $MailGonder->isSMTP();                                                                  
                $MailGonder->Host         = DonusumleriGeriDondur($SiteEmailHostAdresi);                
                $MailGonder->SMTPAuth     = true;
                $MailGonder->CharSet      = "UTF-8";                                                           
                $MailGonder->Username     = DonusumleriGeriDondur($SiteEmailAdresi);                       
                $MailGonder->Password     = DonusumleriGeriDondur($SiteEmailSifresi);                     
                $MailGonder->SMTPSecure   = 'tls';                                   
                $MailGonder->Port         = 587;
                $MailGonder->SMTPOptions  = array(
                                                'ssl' => array(
                                                    'verify_peer' => false,
                                                    'verify_peer_name' => false,
                                                    'allow_self_signed' => true
                                                )
                                                );                                                         
                $MailGonder->setFrom(DonusumleriGeriDondur($SiteEmailAdresi), DonusumleriGeriDondur($SiteAdi));
                $MailGonder->addAddress(DonusumleriGeriDondur($KullaniciKaydi["EmailAdresi"]), DonusumleriGeriDondur($KullaniciKaydi["IsimSoyisim"]));
                $MailGonder->addReplyTo(DonusumleriGeriDondur($SiteEmailAdresi),DonusumleriGeriDondur($SiteAdi));
                $MailGonder->isHTML(true);                               
                $MailGonder->Subject = DonusumleriGeriDondur($SiteAdi) . ' Şifre Sıfırlama';
                $MailGonder->MsgHTML($MailIcerigiHazirla);

                $MailGonder->send();

                header("Location:index.php?SK=39");
                exit();

            } catch (Exception $e) {
                header("Location:index.php?SK=40");
                exit();
            }
        
        }else{
            header("Location:index.php?SK=41");
            exit();
        }

}else{
    header("Location:index.php?SK=42");
    exit();

}

?>