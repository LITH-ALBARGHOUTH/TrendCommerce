<?php

$IPAdresi               =   $_SERVER["REMOTE_ADDR"];
$ZamanDamgasi           =   time();
$TarihSaat              =   date("d-m-Y H:i:s",$ZamanDamgasi);
$SiteKokDizini          =   $_SERVER["DOCUMENT_ROOT"];
$ResimKlasoruYolu       =   "/TrendCommerce/Resimler/";
$VerotIcinKlasorYolu    =   $SiteKokDizini . $ResimKlasoruYolu;

function SEO($Deger){
    $Icerik         =   trim($Deger);
    $Degisecekler   =   array("Ç","ç","Ğ","ğ","İ","ı","Ö","ö","Ü","ü");
    $Degiskenler    =   array("C","c","G","g","I","i","O","o","U","u");
    $Icerik         =   str_replace($Degisecekler,$Degiskenler,$Icerik);
    $Icerik         =   mb_strtolower($Icerik,"UTF-8");
    $Icerik         =   preg_replace("/[^a-z0-9.]/","-",$Icerik);
    $Icerik         =   preg_replace("/-+/","-",$Icerik);
    $Icerik         =   trim($Icerik,"-");
    return $Icerik;
}

function TarihBul($Deger) {
    $Cevir    = date("d-m-Y H:i:s", $Deger);
    $Sonuc    = $Cevir;
    return $Sonuc;
}
function UcGunIleriTarihBul() {
    global $ZamanDamgasi;
    $BirGun   = 86400;
    $Hesapla  = $ZamanDamgasi+(3*$BirGun);
    $Cevir    = date("d-m-Y", $Hesapla);
    $Sonuc    = $Cevir;
    return $Sonuc;
}

function RakamlarHaricTumKarakterleriSil($Deger) {
    $Islem            = preg_replace("/[^0-9]/", "", $Deger);
    $Sonuc            = $Islem;
    return $Sonuc;
}
function TumBosluklariSil($Deger) {
    $Islem            = preg_replace("/\s|&nbsp;/", "", $Deger);
    $Sonuc            = $Islem;
    return $Sonuc;
}
function DonusumleriGeriDondur($Deger) {
    $GeriDondur       = htmlspecialchars($Deger,ENT_QUOTES);
    $Sonuc            = $GeriDondur;
    return $Sonuc;
}
function Guvenlik($Deger) {
    $BoslukSil        = trim($Deger);
    $TaglariTemizle   = strip_tags($BoslukSil);
    $EtkisizYap       = htmlspecialchars($TaglariTemizle);
    $Sonuc            = $EtkisizYap;
    return $Sonuc;
}
function SayiliIcerikleriFiltrele($Deger) {
    $BoslukSil        = trim($Deger);
    $TaglariTemizle   = strip_tags($BoslukSil);
    $EtkisizYap       = htmlspecialchars($TaglariTemizle);
    $Temizle          = RakamlarHaricTumKarakterleriSil($EtkisizYap);
    $Sonuc            = $Temizle;
    return $Sonuc;
}
function IBANBicimlendir($Deger) {
    $BoslukSil      = trim($Deger);
    $TumBoslukSil   = TumBosluklariSil($BoslukSil);
    $BirinciBlok    = substr($TumBoslukSil,0,4);
    $IkinciBlok     = substr($TumBoslukSil,4,4);
    $UcuncuBlok     = substr($TumBoslukSil,8,4);
    $DorduncuBlok   = substr($TumBoslukSil,12,4);
    $BesinciBlok    = substr($TumBoslukSil,16,4);
    $AltinciBlok    = substr($TumBoslukSil,20,4);
    $YedinciBlok    = substr($TumBoslukSil,24,2);
    $Duzenle        = $BirinciBlok . " " . $IkinciBlok . " " . $UcuncuBlok . " " . $DorduncuBlok . " " . $BesinciBlok . " " . $AltinciBlok . " " . $YedinciBlok;
    $Sonuc          = $Duzenle;
    return $Sonuc;
}
function AktivasyonKoduUret() {
    $IlkBesli        =   rand(10000,99999);
    $IkinciBesli     =   rand(10000,99999);
    $UcuncuBesli     =   rand(10000,99999);
    $DorduncuBesli   =   rand(10000,99999);
    $Kod             =   $IlkBesli . "-" . $IkinciBesli . "-" . $UcuncuBesli . "-" . $DorduncuBesli;
    $Sonuc           =   $Kod;
    return $Sonuc;
}
function FiyatBicimlendir($Deger) {
    $Bicimlendir     = number_format($Deger,"2",",",".");
    $Sonuc           = $Bicimlendir;
    return $Sonuc;
}
function ResimAdiOlustur() {
    $Sonuc           = substr(md5(uniqid(time())),0,25);
    return $Sonuc;
}








?>