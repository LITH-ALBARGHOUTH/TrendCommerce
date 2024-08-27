<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require '/Applications/XAMPP/xamppfiles/htdocs/TrendCommerce/FrameWorks/PHPMailersrc/Exception.php';
// require '/Applications/XAMPP/xamppfiles/htdocs/TrendCommerce/FrameWorks/PHPMailer/src/PHPMailer.php';
// require '/Applications/XAMPP/xamppfiles/htdocs/TrendCommerce/FrameWorks/PHPMailer/src/SMPT.php';



if(isset($_POST["EmailAdresi"])){
    $GelenEmailAdresi           = Guvenlik($_POST["EmailAdresi"]);
}else{
    $GelenEmailAdresi           = "";
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
if(isset($_POST["IsimSoyisim"])){
    $GelenIsimSoyisim           = Guvenlik($_POST["IsimSoyisim"]);
}else{
    $GelenIsimSoyisim           = "";
}
if(isset($_POST["TelefonNumarasi"])){
    $GelenTelefonNumarasi       = Guvenlik($_POST["TelefonNumarasi"]);
}else{
    $GelenTelefonNumarasi       = "";
}
if(isset($_POST["Cinsiyet"])){
    $GelenCinsiyet              = Guvenlik($_POST["Cinsiyet"]);
}else{
    $GelenCinsiyet              = "";
}
if(isset($_POST["SozlesmeOnay"])){
    $GelenSozlesmeOnay          = Guvenlik($_POST["SozlesmeOnay"]);
}else{
    $GelenSozlesmeOnay          = "";
}

$AktivasyonKodu  = AktivasyonKoduUret();
$MD5liSifre      = md5($GelenSifre);

if( ($GelenEmailAdresi!="") && ($GelenSifre!="") && ($GelenSifreTekrar!="") && ($GelenIsimSoyisim!="") && ($GelenTelefonNumarasi!="") && ($GelenCinsiyet!="")){
    
    if($GelenSozlesmeOnay==0){
        header("Location:index.php?SK=29");
        exit();
    }else{
        if($GelenSifre!=$GelenSifreTekrar){
            header("Location:index.php?SK=28");
            exit();
        }else{
            $KontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi =?");
            $KontrolSorgusu->execute([$GelenEmailAdresi]);
            $KullaniciSayisi = $KontrolSorgusu->rowCount();
            if($KullaniciSayisi>0){
                header("Location:index.php?SK=27");
                exit();
            }else{
                $UyeEklemeSorgusu = $VeriTabaniBaglantisi->prepare("INSERT INTO uyeler (EmailAdresi, Sifre, IsimSoyisim, TelefonNumarasi, Cinsiyet, Durumu, 
                KayitTarihi, KayitIpAdresi, AktivasyonKodu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $UyeEklemeSorgusu->execute([$GelenEmailAdresi, $MD5liSifre, $GelenIsimSoyisim, $GelenTelefonNumarasi, $GelenCinsiyet, 0, $ZamanDamgasi, $IPAdresi, 
                $AktivasyonKodu]);
                $KayitKontrol     = $UyeEklemeSorgusu->rowCount();
                if($KayitKontrol>0){

                    $MailIcerigiHazirla     = "Merhaba Sayın " . $GelenIsimSoyisim . "<br /><br />Sitemize Yapmış Olduğunuz Üyelik İşlemini Tamamlamak İçin 
                    Lütfen <a href=" .$SiteLinki . "/Aktivasyon.php?AktivasyonKodu=". $AktivasyonKodu ."&Email=". $GelenEmailAdresi ." >
                    BURAYA TIKLAYINIZ</a><br /><br />Saygılarımızla, Mutlu Alışverişler Dileriz...<br />" . $SiteAdi;

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
                        $MailGonder->addAddress(DonusumleriGeriDondur($GelenEmailAdresi), DonusumleriGeriDondur($GelenIsimSoyisim));
                        $MailGonder->addReplyTo(DonusumleriGeriDondur($SiteEmailAdresi),DonusumleriGeriDondur($SiteAdi));
                        $MailGonder->isHTML(true);                               
                        $MailGonder->Subject = DonusumleriGeriDondur($SiteAdi) . ' Yeni Üyelik Aktivasyonu';
                        $MailGonder->MsgHTML($MailIcerigiHazirla);

                        $MailGonder->send();

                        header("Location:index.php?SK=24");
                        exit();

                    } catch (Exception $e) {
                        header("Location:index.php?SK=25");
                        exit();
                    }

                }else{
                    header("Location:index.php?SK=25");
                    exit();
                }
            }
        }
    }

}else{
    header("Location:index.php?SK=26");
    exit();

}

?>