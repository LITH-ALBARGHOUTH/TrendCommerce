<?php

try {
    $VeriTabaniBaglantisi = new PDO('mysql:host=localhost;dbname=firat;charset=UTF8', 'root', '');
} catch (PDOException $Hata) {
    // Hata mesajını
    //error_log($Hata->getMessage(), 3, '/path/to/error.log');
    die();
}

$AyarlarSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM Ayarlar LIMIT 1");
$AyarlarSorgusu->execute();
$AyarSayisi = $AyarlarSorgusu->rowCount();
$Ayarlar = $AyarlarSorgusu->fetch(PDO::FETCH_ASSOC);

if ($AyarSayisi > 0) {
    $SiteAdi              = $Ayarlar["SiteAdi"];
    $SiteTitle            = $Ayarlar["SiteTitle"];
    $SiteDescription      = $Ayarlar["SiteDescription"];
    $SiteKeywords         = $Ayarlar["SiteKeywords"];
    $SiteCopyrightMetni   = $Ayarlar["SiteCopyrightMetni"];
    $SiteLogosu           = $Ayarlar["SiteLogosu"];
    $SiteLinki            = $Ayarlar["SiteLinki"];
    $SiteEmailAdresi      = $Ayarlar["SiteEmailAdresi"];
    $SiteEmailSifresi     = $Ayarlar["SiteEmailSifresi"];
    $SiteEmailHostAdresi  = $Ayarlar["SiteEmailHostAdresi"];
    $SosyalLinkFacebook   = $Ayarlar["SosyalLinkFacebook"];
    $SosyalLinkX          = $Ayarlar["SosyalLinkX"];
    $SosyalLinkLinkedin   = $Ayarlar["SosyalLinkLinkedin"];
    $SosyalLinkInstagram  = $Ayarlar["SosyalLinkInstagram"];
    $SosyalLinkPinterest  = $Ayarlar["SosyalLinkPinterest"];
    $SosyalLinkYoutube    = $Ayarlar["SosyalLinkYoutube"];
    $DolarKuru            = $Ayarlar["DolarKuru"];
    $EuroKuru             = $Ayarlar["EuroKuru"];
    $UcretsizKargoBaraji  = $Ayarlar["UcretsizKargoBaraji"];
    $ClientID             = $Ayarlar["ClientID"];
    $StoreKey             = $Ayarlar["StoreKey"];
    $ApiKullanicisi       = $Ayarlar["ApiKullanicisi"];
    $ApiSifresi           = $Ayarlar["ApiSifresi"];


} else {
    // Hata mesajını
    //error_log("Site Ayar Sorgusu Hatalı.", 3, '/path/to/error.log');
    die();
}

$MetinlerSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM sozlesmelervemetinler LIMIT 1");
$MetinlerSorgusu->execute();
$MetinlerSayisi = $MetinlerSorgusu->rowCount();
$Metinler = $MetinlerSorgusu->fetch(PDO::FETCH_ASSOC);

if ($MetinlerSayisi > 0) {
    $HakkimizdaMetni                 = $Metinler["HakkimizdaMetni"];
    $UyelikSozlesmeMetni             = $Metinler["UyelikSozlesmeMetni"];
    $KullanimKosullariMetni          = $Metinler["KullanimKosullariMetni"];
    $GizlilikSozlesmesiMetni         = $Metinler["GizlilikSozlesmesiMetni"];
    $MesafeliSatisSozlesmesiMetni    = $Metinler["MesafeliSatisSozlesmesiMetni"];
    $TeslimatMetni                   = $Metinler["TeslimatMetni"];
    $IptalIadeDegisimMetni           = $Metinler["IptalIadeDegisimMetni"];
} else {
    // Hata mesajını
    //error_log("Site Ayar Sorgusu Hatalı.", 3, '/path/to/error.log');
    die();
}
if(@$_SESSION["Kullanici"]) {
    $KullaniciSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE EmailAdresi =? LIMIT 1");
    $KullaniciSorgusu->execute([$_SESSION["Kullanici"]]);
    $KullaniciSayisi = $KullaniciSorgusu->rowCount();
    $Kullanici = $KullaniciSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($KullaniciSayisi > 0) {
        $KullaniciID       = $Kullanici["id"];
        $EmailAdresi       = $Kullanici["EmailAdresi"];
        $Sifre             = $Kullanici["Sifre"];
        $IsimSoyisim       = $Kullanici["IsimSoyisim"];
        $TelefonNumarasi   = $Kullanici["TelefonNumarasi"];
        $Cinsiyet          = $Kullanici["Cinsiyet"];
        $Durumu            = $Kullanici["Durumu"];
        $KayitTarihi       = $Kullanici["KayitTarihi"];
        $KayitIpAdresi     = $Kullanici["KayitIpAdresi"];
        $AktivasyonKodu    = $Kullanici["AktivasyonKodu"];
    } else {
        // Hata mesajını
        //error_log("Site Ayar Sorgusu Hatalı.", 3, '/path/to/error.log');
        die();
    }
}

if($_SESSION["Yonetici"]) {
    $YoneticiSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM yoneticiler WHERE KullaniciAdi =? LIMIT 1");
    $YoneticiSorgusu->execute([$_SESSION["Yonetici"]]);
    $YoneticiSayisi         = $YoneticiSorgusu->rowCount();
    $Yonetici               = $YoneticiSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($YoneticiSayisi > 0) {
        $YoneticiID                 = $Yonetici["id"];
        $YoneticiKullaniciAdi       = $Yonetici["KullaniciAdi"];
        $YoneticiSifre              = $Yonetici["Sifre"];
        $YoneticiIsimSoyisim        = $Yonetici["IsimSoyisim"];
        $YoneticiEmailAdresi        = $Yonetici["EmailAdresi"];
        $YoneticiTelefonNumarasi    = $Yonetici["TelefonNumarasi"];
    } else {
        // Hata mesajını
        //error_log("Site Ayar Sorgusu Hatalı.", 3, '/path/to/error.log');
        die();
    }
}







?>


