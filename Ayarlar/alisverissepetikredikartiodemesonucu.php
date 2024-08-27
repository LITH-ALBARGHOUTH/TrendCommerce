
<?php

session_start(); ob_start();
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");
require_once("Ayarlar/sitesayfalari.php");

$oid            =   $_POST['oid'];

    $SepetinTaksitSorgusu       = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE SepetNumarasi = ?");
    $SepetinTaksitSorgusu->execute([$oid]);
    $TaksitKaydi                = $SepetinTaksitSorgusu->fetchAll(PDO::FETCH_ASSOC);

    $TaksitSayisi               =   $TaksitKaydi["TaksitSecimi"];
        if($TaksitSayisi==1){
            $TaksitSayisi       =   "";
        }


$hashparams     =   $_POST["HASHPARAMS"];
$hashparamsval  =   $_POST["HASHPARAMSVAL"];
$hashparam      =   $_POST["HASH"];
$storekey       =   DonusumleriGeriDondur($StoreKey);
$paramsval      =   "";
$index1         =   0;
$index2         =   0;
    while($index1<@strlen($hashparams)){
        $index2 =   @strpos($hashparams, ":",$index1);
        $vl     =   $_POST[@substr($hashparams,$index1,$index2-$index1)];
            if($vl==null){
                $vl =   "";
                $paramsval  =   $paramsval.$vl;
                $index1     =   $index2+1;
            }
    }
$hashval        =   $paramsval.$storekey;
$hash           =   @base64_encode(@pack('H*',@sha1($hashval)));
    if($paramsval!=$hashparamsval || $hashparam!=$hash )
        echo "<h4>Güvenlik Uyarısı! Sayısal İmza Geçerli Değil.</h4>";

$name           =   DonusumleriGeriDondur($ApiKullanicisi);
$password       =   DonusumleriGeriDondur($ApiSifresi);
$clientid       =   $_POST["clientid"];
$mode           =   "P";
$type           =   "Auth";
$expires        =   $_POST["Ecom_Payment_Card_ExpDate_Month"];
$cv2            =   $_POST['cv2'];
$tutar          =   $_POST["amount"];
$taksit         =   $TaksitSayisi;


$lip            =   GetHostByName($REMOTE_ADDR);
$email          =   "";
$mdStatus       =   $_POST['mdStatus'];
$xid            =   $_POST['xid'];
$eci            =   $_POST['eci'];
$cavv           =   $_POST['cavv'];
$md             =   $_POST['md'];

if($mdStatus == "1" || $mdStatus == "2" || $mdStatus == "3" || $mdStatus == "4"){

    $request    =   "DATA-<?xml version=\"1.0\" encoding=\"ISO-8859-9\"?>"."<CC5Request>"."<Name>{NAME}</Name>"."<Password>{PASSWORD}</Password>"."<ClientId>{CLIENTID}</ClientId>"."<IPAddress>{IP}</IPAddress>"."<Email>{EMAIL}</Email>"."<Mode>P</Mode>".
    "<OrderId>{OID}</OrderId>"."<GroupId></GroupId>"."<TransId></TransId>"."<UserId></UserId>"."<Type>{TYPE}</Type>"."<Number>{MD}</Number>"."<Expires></Expires>"."<Cvv2Val></Cvv2Val>"."<Total>{TUTAR}</Total>"."<Currency>949</Currency>".
    "<Taksit>{TAKSIT}</Taksit>"."<PayerTxnId>{XID}</PayerTxnId>"."<PayerSecurityLevel>{ECI}</PayerSecurityLevel>"."<PayerAuthenticationCode>{CAVV}</PayerAuthenticationCode>"."<CardholderPresentCode>13</CardholderPresentCode>"."<BillTo>".
    "<Name></Name>"."<Street1></Street1>"."<Street2></Street2>"."<Street3></Street3>"."<City></City>"."<StateProv></StateProv>"."<PostalCode></PostalCode>"."<Country></Country>"."<Company></Company>"."<TelVoice></TelVoice>"."</BillTo>".
    "<ShipTo>"."<Name></Name>"."<Street1></Street1>"."<Street2></Street2>"."<Street3></Street3>"."<City></City>"."<StateProv></StateProv>"."<PostalCode></PostalCode>"."<Country></Country>"."</ShipTo>"."<Extra></Extra>"."</CC5Request>";

    $request    =   @str_replace("{NAME}",$name,$request);
    $request    =   @str_replace("{PASSWORD}",$password,$request);
    $request    =   @str_replace("{CLIENTID}",$clientid,$request);
    $request    =   @str_replace("{IP}",$lip,$request);
    $request    =   @str_replace("{OID}",$oid,$request);
    $request    =   @str_replace("{TYPE}",$type,$request);
    $request    =   @str_replace("{XID}",$xid,$request);
    $request    =   @str_replace("{ECI}",$eci,$request);
    $request    =   @str_replace("{CAVV}",$cavv,$request);
    $request    =   @str_replace("{MD}",$md,$request);
    $request    =   @str_replace("{TUTAR}",$tutar,$request);
    $request    =   @str_replace("{TAKSIT}",$taksit,$request);

    $url        =   "https://<sunucu_adresi>/<apiserver_path>";
    $ch         =   curl_init();

    @curl_setopt($ch,CURLOPT_URL,$url);
    @curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,1);
    @curl_setopt($ch,CURLOPT_SSLVERSION,3);
    @curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
    @curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    @curl_setopt($ch,CURLOPT_TIMEOUT,90);
    @curl_setopt($ch,CURLOPT_POSTFIELDS,$request);
    $result     =   @curl_exec($ch);
        if(@curl_errno($ch)){
            print @curl_errno($ch);
        }else{
            @curl_close($ch);
        }

        $Response           =   "";
        $OrderId            =   "";
        $AuthCode           =   "";
        $ProcResturnCode    =   "";
        $ErrMssg            =   "";
        $HOSTMSG            =   "";
        $HostRefNum         =   "";
        $TransId            =   "";
        $response_tag       =   "Response";
        $posf               =   @strpos($result,("<".$response_tag.">"));
        $posl               =   @strpos($result,("</".$response_tag.">"));
        $posf               =   $posf+@strlen($response_tag)+2;
        $Response           =   @substr($result,$posf,$posl-$posf);
        $response_tag       =   "OrderId";
        $posf               =   @strpos($result,("<".$response_tag.">"));
        $posl               =   @strpos($result,("</".$response_tag.">"));
        $posf               =   $posf+@strlen($response_tag)+2;
        $OrderId            =   @substr($result,$posf,$posl-$posf);
        $response_tag       =   "AuthCode";
        $posf               =   @strpos($result,("<".$response_tag.">"));
        $posl               =   @strpos($result,("</".$response_tag.">"));
        $posf               =   $posf+@strlen($response_tag)+2;
        $AuthCode           =   @substr($result,$posf,$posl-$posf);
        $response_tag       =   "ProcReturnCode";
        $posf               =   @strpos($result,("<".$response_tag.">"));
        $posl               =   @strpos($result,("</".$response_tag.">"));
        $posf               =   $posf+@strlen($response_tag)+2;
        $ProcReturnCode     =   @substr($result,$posf,$posl-$posf);
        $response_tag       =   "ErrMsg";
        $posf               =   @strpos($result,("<".$response_tag.">"));
        $posl               =   @strpos($result,("</".$response_tag.">"));
        $posf               =   $posf+@strlen($response_tag)+2;
        $ErrMsg             =   @substr($result,$posf,$posl-$posf);
        $response_tag       =   "HostRefNum";
        $posf               =   @strpos($result,("<".$response_tag.">"));
        $posl               =   @strpos($result,("</".$response_tag.">"));
        $posf               =   $posf+@strlen($response_tag)+2;
        $HostRefNum         =   @substr($result,$posf,$posl-$posf);
        $response_tag       =   "TransId";
        $posf               =   @strpos($result,("<".$response_tag.">"));
        $posl               =   @strpos($result,("</".$response_tag.">"));
        $posf               =   $posf+@strlen($response_tag)+2;
        $TransId            =   @substr($result,$posf,$posl-$posf);
            if($Response==="Approved"){


                $AlisveriSepetiSorgusu      = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE SepetNumarasi = ?");
            $AlisveriSepetiSorgusu->execute([$oid]);
            $AlisveriSepetiSayisi       = $AlisveriSepetiSorgusu->rowCount();
            $AlisveriSepetiUrunleri     = $AlisveriSepetiSorgusu->fetchAll(PDO::FETCH_ASSOC);


            if($AlisveriSepetiSayisi>0){

                $UrununToplamFiyati                   = 0;
                $UrununToplamKargoFiyati              = 0;


                foreach($AlisveriSepetiUrunleri as $SepetSatirlari){
                        $SepetId                      = $SepetSatirlari["id"];
                        $SepetNumarasi                = $SepetSatirlari["SepetNumarasi"];
                        $SepettekiUyeId               = $SepetSatirlari["UyeId"];
                        $SepettekiUrunId              = $SepetSatirlari["UrunId"];
                        $SepettekiAdresId             = $SepetSatirlari["AdresId"];
                        $SepettekiVaryantId           = $SepetSatirlari["VaryantId"];
                        $SepettekiKargoId             = $SepetSatirlari["KargoId"];
                        $SepettekiUrunAdedi           = $SepetSatirlari["UrunAdedi"];
                        $SepettekiOdemeSecimi         = $SepetSatirlari["OdemeSecimi"];
                        $SepettekiTaksitSecimi        = $SepetSatirlari["TaksitSecimi"];
                        
                        $UrunBilgileriSorgusu         = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                        $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
                        $UrunBilgileriKayitlari       = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                            $UrununTuru               = $UrunBilgileriKayitlari["UrunTuru"];
                            $UrununAdi                = $UrunBilgileriKayitlari["UrunAdi"];
                            $UrununFiyati             = $UrunBilgileriKayitlari["UrunFiyati"];
                            $UrununParaBirimi         = $UrunBilgileriKayitlari["ParaBirimi"];
                            $UrununKdvOrani           = $UrunBilgileriKayitlari["KdvOrani"];
                            $UrununKargoUcreti        = $UrunBilgileriKayitlari["KargoUcreti"];
                            $UrununResmi              = $UrunBilgileriKayitlari["UrunResmiBir"];
                            $UrununVaryantBasligi     = $UrunBilgileriKayitlari["VaryantBasligi"];
                            

                        $UrunVaryantBilgileriSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
                        $UrunVaryantBilgileriSorgusu->execute([$SepettekiVaryantId]);
                        $VaryantKaydi                       = $UrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                            $VaryantAdi                     = $VaryantKaydi["VaryantAdi"];

                        $KargoBilgileriSorgusu              = $VeriTabaniBaglantisi->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
                        $KargoBilgileriSorgusu->execute([$SepettekiKargoId]);
                        $KargoKaydi                         = $KargoBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                            $KargonunAdi                    = $KargoKaydi["KargoFirmasiAdi"];

                        $AdresBilgileriSorgusu              = $VeriTabaniBaglantisi->prepare("SELECT * FROM adresler WHERE id = ? LIMIT 1");
                        $AdresBilgileriSorgusu->execute([$SepettekiAdresId]);
                        $AdresKaydi                         = $AdresBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                            $AdresAdiSoyadi                 = $AdresKaydi["AdiSoyadi"];
                            $Adres                          = $AdresKaydi["Adres"];
                            $AdresIlce                      = $AdresKaydi["Ilce"];
                            $AdresSehir                     = $AdresKaydi["Sehir"];
                            $AdresToparla                   = $Adres . " " . $AdresIlce . "/" . $AdresSehir;
                            $AdresTelefonNumarasi           = $AdresKaydi["TelefonNumarasi"];
                    

                        if($UrununParaBirimi=="USD"){
                            $UrunFiyatiHesapla          = $UrununFiyati*$DolarKuru;
                        }elseif($UrununParaBirimi=="EUR"){
                            $UrunFiyatiHesapla          = $UrununFiyati*$EuroKuru;
                        }else{
                            $UrunFiyatiHesapla          = $UrununFiyati;
                        }

                        $UrununToplamFiyati                   = ($UrunFiyatiHesapla*$SepettekiUrunAdedi);
                        $UrununToplamKargoFiyati              = ($UrununKargoUcreti*$SepettekiUrunAdedi);  


                        $SiparisEkle    =   $VeriTabaniBaglantisi->prepare("INSERT INTO siparisler(UyeId,SiparisNumarasi,UrunId,UrunTuru,UrunAdi,UrunFiyati,KdvOrani,UrunAdedi,ToplamUrunFiyati,KargoFirmasiSecimi,KargoUcreti,UrunResmiBir,VaryantBasligi,
                        VaryantSecimi,AdresAdiSoyadi,AdresDetay,AdresTelefon,OdemeSecimi,TaksitSecimi,SiparisTarihi,SiparisIPAdresi,OnayDurumu,KargoDurumu,KargoGonderiKodu) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $SiparisEkle->execute([$SepettekiUyeId,$SepetNumarasi,$SepettekiUrunId,$UrununTuru,$UrununAdi,$UrunFiyatiHesapla,$UrununKdvOrani,$SepettekiUrunAdedi,$UrununToplamFiyati,$KargonunAdi,$UrununToplamKargoFiyati,$UrununResmi,
                        $UrununVaryantBasligi,$VaryantAdi,$AdresAdiSoyadi,$AdresToparla,$AdresTelefonNumarasi,'Kredi Kartı',$TaksitSayisi,$ZamanDamgasi,$IPAdresi,0,0,0]);
                        $EklemeKontrol  =   $SiparisEkle->rowCount();

                        if($EklemeKontrol>0){

                            $SepettenSilmeSorgusu    =   $VeriTabaniBaglantisi->prepare("DELETE FROM sepet WHERE id=? AND UyeId=? LIMIT 1 ");
                            $SepettenSilmeSorgusu->execute([$SepetId,$SepettekiUyeId]);
                        }

                            $UrunSatisArttirmaSorgusu   =   $VeriTabaniBaglantisi->prepare(" UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi+? WHERE id=? ");
                            $UrunSatisArttirmaSorgusu->execute([$SepettekiUrunAdedi,$SepettekiUrunId]);

                            $StokGuncellemeSorgusu   =   $VeriTabaniBaglantisi->prepare(" UPDATE urunvaryantlari SET StokAdedi=StokAdedi-? WHERE id=? LIMIT 1 ");
                            $StokGuncellemeSorgusu->execute([$SepettekiUrunAdedi,$SepettekiVaryantId]);


                    }

                    $KargoFiyatiIcinSiparislerSorgusu      = $VeriTabaniBaglantisi->prepare("SELECT SUM(ToplamUrunFiyati) AS ToplamUcret FROM siparisler WHERE UyeId = ? AND SiparisNumarasi=?");
                    $KargoFiyatiIcinSiparislerSorgusu->execute([$SepettekiUyeId,$SepetNumarasi]);
                    $KargoFiyatiKaydi                      = $KargoFiyatiIcinSiparislerSorgusu->fetch(PDO::FETCH_ASSOC);
                        $AlisverisToplamUcreti             = $KargoFiyatiKaydi["ToplamUcret"];

                        if($AlisverisToplamUcreti>=$UcretsizKargoBaraji){
                            $SiparisiGuncelle       =   $VeriTabaniBaglantisi->prepare("UPDATE siparisler SET KargoUcreti=? WHERE UyeId=? AND SiparisNumarasi=? ");
                            $SiparisiGuncelle->execute([0,$SepettekiUyeId,$SepetNumarasi]);
                        }
            }

            }else{
                echo "Ödeme İşleminiz Sırasında Hata Oluştu. Hata= ".$ErrMsg;
            }

}else{
    echo "Kredi Kartı Bankası 3D Onayı Vermedi, Lütfen Bilgilerinizi Kontrol Edip Tekrar Deneyiniz. Sorununuz Devam Eder ise Lütfen Kartınızın Sahibi Olan Bankanın Müşteri Temsilcileriyle İletişime Geçiniz.";
}



$VeriTabaniBaglantisi = null;
ob_end_flush();
?>