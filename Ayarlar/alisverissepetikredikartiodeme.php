<?php

if(isset($_SESSION["Kullanici"])) {


    $SepettekiUrunlerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC");
    $SepettekiUrunlerSorgusu->execute([$KullaniciID]);
    $SepettekiUrunSayisi        = $SepettekiUrunlerSorgusu->rowCount();
    $SepettekiUrunKayitlari     = $SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if($SepettekiUrunSayisi > 0) {
        $SepettekiToplamUrunSayisi          = 0;
        $SepettekiToplamFiyat               = 0;
        $SepettekiToplamKargoFiyatiHesapla  = 0;
        $OdenecekToplamTutariHesapla        = 0;

        foreach($SepettekiUrunKayitlari as $SepetSatirlari) {
            $SepetId                = $SepetSatirlari["id"];
            $SepettekiUrunId        = $SepetSatirlari["UrunId"];
            $SepettekiVaryantId     = $SepetSatirlari["VaryantId"];
            $SepettekiUrunAdedi     = $SepetSatirlari["UrunAdedi"];
            $SepettekSepetNumarasi  = $SepetSatirlari["SepetNumarasi"];

            $UrunBilgileriSorgusu   = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
            $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
            $UrunBilgileriKayitlari = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                $UrununFiyati       = $UrunBilgileriKayitlari["UrunFiyati"];
                $UrununParaBirimi   = $UrunBilgileriKayitlari["ParaBirimi"];
                $UrununKargoUcreti  = $UrunBilgileriKayitlari["KargoUcreti"];



                if($UrununParaBirimi=="USD"){
                    $UrunFiyatiHesapla      =  $UrununFiyati*$DolarKuru;
                    $UrunFiyatiBicimlendir  =  FiyatBicimlendir($UrunFiyatiHesapla);
                }elseif($UrununParaBirimi=="EUR"){
                    $UrunFiyatiHesapla      =  $UrununFiyati*$EuroKuru;
                    $UrunFiyatiBicimlendir  =  FiyatBicimlendir($UrunFiyatiHesapla);
                }else{
                    $UrunFiyatiHesapla      =  $UrununFiyati;
                    $UrunFiyatiBicimlendir  =  FiyatBicimlendir($UrunFiyatiHesapla);
                }
                $UrununToplamFiyatiHesapla     = ($UrunFiyatiHesapla * $SepettekiUrunAdedi);
                $UrununToplamFiyatiBicimlendir = FiyatBicimlendir($UrununToplamFiyatiHesapla);

                $SepettekiToplamUrunSayisi              += $SepettekiUrunAdedi;
                $SepettekiToplamFiyat                   += ($UrunFiyatiHesapla * $SepettekiUrunAdedi);

                $SepettekiToplamKargoFiyatiHesapla      += ($UrununKargoUcreti*$SepettekiUrunAdedi);
                $SepettekiToplamKargoFiyatiBicimlendir   = FiyatBicimlendir($SepettekiToplamKargoFiyatiHesapla);

        }          
                if($SepettekiToplamFiyat>=$UcretsizKargoBaraji){
                    $SepettekiToplamKargoFiyatiHesapla       = 0;
                    $SepettekiToplamKargoFiyatiBicimlendir   = FiyatBicimlendir($SepettekiToplamKargoFiyatiHesapla);
                    $OdenecekToplamTutariBicimlendir         = FiyatBicimlendir($SepettekiToplamFiyat);
                }else{
                    $OdenecekToplamTutariHesapla             = ($SepettekiToplamFiyat+$SepettekiToplamKargoFiyatiHesapla);
                    $OdenecekToplamTutariBicimlendir         = FiyatBicimlendir($OdenecekToplamTutariHesapla);
                }
    



    $clientId       =   DonusumleriGeriDondur($ClientID);
    $amount         =   $OdenecekToplamTutariHesapla;
    $oid            =   $SepettekSepetNumarasi;
    $okUrl          =   "http://www.TrendCommerce.com/alisverissepetikredikartiodemetamam.php";
    $failUrl        =   "http://www.TrendCommerce.com/alisverissepetikredikartiodemehata.php";
    $rnd            =   @microtime();
    $storekey       =   DonusumleriGeriDondur($StoreKey);
    $storetype      =   "3d";
    $hashstr        =   $clientId.$oid.$amount.$okUrl.$failUrl.$rnd.$storekey;
    $hash           =   @base64_encode(@pack("H*",@sha1($hashstr)));
    $description    =   "";
    $xid            =   "";
    $lang           =   "";
    $email          =   "";
    $userid         =   ""; 

?>

<form action="https://<sunucu_adresi>/<3dgate_path>" method="post">
    <input type="hidden" name="clientId" value="<?=$clientId?>" />
    <input type="hidden" name="amount" value="<?=$amount?>" />
    <input type="hidden" name="oid" value="<?=$oid?>" />
    <input type="hidden" name="okUrl" value="<?=$okUrl?>" />
    <input type="hidden" name="failUrl" value="<?=$failUrl?>" />
    <input type="hidden" name="rnd" value="<?=$rnd?>" />
    <input type="hidden" name="hash" value="<?=$hash?>" />
    <input type="hidden" name="storetype" value="3d" />
    <input type="hidden" name="lang" value="tr" />
    
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="800" valign="top">
                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900"><h3>Alışveriş Sepeti</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Aşağıdan Kredi Kartı İle Ödeme Yapabilirsiniz.</td>
                    </tr>
                    <tr height="50">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                        <td width="250">Kredi Kartı Numarası</td>
                        <td colspan="4" width="550"><input type="text" name="pan" class="InputAlanlari" /></td>
                    </tr>
                    <tr height="40">
                        <td>Son Kullanım Tarihi</td>
                        <td width="100"><select name="Ecom_Payment_Card_ExpDate_Month" class="SelectAlanlari">
                            <option value=""></option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </td>
                        <td width="20" align="center">-</td>
                        <td width="100">
                        <select name="Ecom_Payment_Card_ExpDate_Year" class="SelectAlanlari">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                            <option value="2033">2033</option>
                            <option value="2034">2034</option>
                            <option value="2035">2035</option>
                            <option value="2036">2036</option>
                            <option value="2037">2037</option>
                            <option value="2038">2038</option>
                        </select>
                    </td>
                    <td width="330"></td>
                    </tr>
                    <tr height="40">
                        <td>Kart Türü</td>
                        <td colspan="4"><input type="radio" value="1" name="cardType"> Visa <input type="radio" value="2" name="cardType"> MasterCard </td>
                    </tr>
                    <tr height="40">
                        <td>Güvenlik Kodu</td>
                        <td width="100"><input type="text" name="cv2" size="4" value="" class="InputAlanlari" /></td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <tr height="40">
                        <td align="center">&nbsp;</td>
                        <td colspan="4" align="left"><input type="submit" value="Ödeme Yap" class="YesilButon" /></td>
                    </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>

                    <td width="15">&nbsp;</td>
                    
                    <td width="250" valign="top">
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td style="color: #FF9900" align="right"><h3>Sipariş Özeti</h3></td>
                            </tr>
                            <tr height="30">
                                <td valign="top" style="border-bottom: 1px dashed #CCCCCC;" align="right">Toplam <b style="color: red;"><?php echo $SepettekiToplamUrunSayisi; ?></b> Adet Ürün</td>
                            </tr>
                            <tr height="5">
                                <td height="5" style="font-size: 5px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right">Ödenecek Tutar (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $OdenecekToplamTutariBicimlendir; ?></td>
                            </tr>
                            <tr height="5">
                                <td height="5" style="font-size: 5px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right">Ürünlerin Toplam Tutarı (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo FiyatBicimlendir($SepettekiToplamFiyat); ?></td>
                            </tr>
                            <tr height="10">
                                <td style="font-size: 10px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right">Toplam Kargo Ücreti (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $SepettekiToplamKargoFiyatiBicimlendir; ?> TL</td>
                            </tr>
                            <tr height="10">
                                <td style="font-size: 10px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
    </table>
</form>
<?php
    }else{
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>
