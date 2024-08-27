<?php

if(isset($_SESSION["Kullanici"])) {


    $StokIcinSepettekiUrunlerSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?");
    $StokIcinSepettekiUrunlerSorgusu->execute([$KullaniciID]);
    $StokIcinSepettekiUrunSayisi = $StokIcinSepettekiUrunlerSorgusu->rowCount();
    $StokIcinSepettekiUrunKayitlari = $StokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if($StokIcinSepettekiUrunSayisi > 0) {
        foreach($StokIcinSepettekiUrunKayitlari as $StokIcinSepettekiSatirlar) {
            $StokIcinSepetId = $StokIcinSepettekiSatirlar["id"];
            $StokIcinSepettekiVaryantId = $StokIcinSepettekiSatirlar["VaryantId"];
            $StokIcinSepettekiUrunAdedi = $StokIcinSepettekiSatirlar["UrunAdedi"];

            $StokIcinUrunVaryantBilgileriSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
            $StokIcinUrunVaryantBilgileriSorgusu->execute([$StokIcinSepettekiVaryantId]);
            $StokIcinUrunVaryantBilgileriKayitlari = $StokIcinUrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

            if($StokIcinUrunVaryantBilgileriKayitlari) {
                $StokIcinUrununStokAdedi = $StokIcinUrunVaryantBilgileriKayitlari["StokAdedi"];
                if($StokIcinUrununStokAdedi == 0) {
                    $SepetSilSorgusu = $VeriTabaniBaglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
                    $SepetSilSorgusu->execute([$StokIcinSepetId, $KullaniciID]);
                } elseif($StokIcinSepettekiUrunAdedi > $StokIcinUrununStokAdedi) {
                    $SepetGuncellemeSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE sepet SET UrunAdedi = ? WHERE id = ? AND UyeId = ? LIMIT 1");
                    $SepetGuncellemeSorgusu->execute([$StokIcinUrununStokAdedi, $StokIcinSepetId, $KullaniciID]);
                }
            }
        }
    }
?>
<form action="index.php?SK=98" method="post">
    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="800" valign="top">
                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900"><h3>Alışveriş Sepeti</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Adres Ve Kargo Seçimi.</td>
                    </tr>
                    <tr height="50">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40">
                        <td align="left" style="background: #CCCCCC; font-weight: bold;">&nbsp;Adres Seçimi</td>
                    </tr>
                    <tr height="20">
                        <td align="right">
                            <a href="index.php?SK=70" style="color: #646464; text-decoration: none; font-weight: bold;">+ Yeni Adres Ekle</a>
                        </td>
                    </tr>
                    <?php
                    $SepettekiUrunlerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC");
                    $SepettekiUrunlerSorgusu->execute([$KullaniciID]);
                    $SepettekiUrunSayisi        = $SepettekiUrunlerSorgusu->rowCount();
                    $SepettekiUrunKayitlari     = $SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    if($SepettekiUrunSayisi > 0) {
                        $SepettekiToplamUrunSayisi          =0;
                        $SepettekiToplamFiyat               =0;
                        $SepettekiToplamKargoFiyatiHesapla  =0;
                        $OdenecekToplamTutariHesapla        =0;

                        foreach($SepettekiUrunKayitlari as $SepetSatirlari) {
                            $SepetId            = $SepetSatirlari["id"];
                            $SepettekiUrunId    = $SepetSatirlari["UrunId"];
                            $SepettekiVaryantId = $SepetSatirlari["VaryantId"];
                            $SepettekiUrunAdedi = $SepetSatirlari["UrunAdedi"];

                            $UrunBilgileriSorgusu   = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                            $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
                            $UrunBilgileriKayitlari = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                                $UrununFiyati       = $UrunBilgileriKayitlari["UrunFiyati"];
                                $UrununParaBirimi   = $UrunBilgileriKayitlari["ParaBirimi"];
                                $UrunnunKargoUcreti = $UrunBilgileriKayitlari["KargoUcreti"];



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

                                $SepettekiToplamKargoFiyatiHesapla      += ($UrunnunKargoUcreti*$SepettekiUrunAdedi);
                                $SepettekiToplamKargoFiyatiBicimlendir   = FiyatBicimlendir($SepettekiToplamKargoFiyatiHesapla);

                                if($SepettekiToplamFiyat>=$UcretsizKargoBaraji){
                                    $SepettekiToplamKargoFiyatiHesapla       = 0;
                                    $SepettekiToplamKargoFiyatiBicimlendir   = FiyatBicimlendir($SepettekiToplamKargoFiyatiHesapla);
                                    $OdenecekToplamTutariBicimlendir         = FiyatBicimlendir($SepettekiToplamFiyat);
                                }else{
                                    $OdenecekToplamTutariHesapla             = ($SepettekiToplamFiyat+$SepettekiToplamKargoFiyatiHesapla);
                                    $OdenecekToplamTutariBicimlendir         = FiyatBicimlendir($OdenecekToplamTutariHesapla);
                                }
                            }

                            
                        }

                        $AdreslerSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM adresler WHERE UyeId = ? ORDER BY id DESC");
                        $AdreslerSorgusu->execute([$KullaniciID]);
                        $AdreslerSayisi = $AdreslerSorgusu->rowCount();
                        $AdresKayitlari = $AdreslerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                        if($AdreslerSayisi > 0) {
                            foreach($AdresKayitlari as $AdresSatirlari) {
                                ?>
                                <tr height="100">
                                    <td align="left">
                                        <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="50">
                                                <td width="25" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                                    <input type="radio" name="AdresSecimi" value="<?php echo DonusumleriGeriDondur($AdresSatirlari["id"]); ?>">
                                                </td>
                                                <td width="775" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                                    <?php echo DonusumleriGeriDondur($AdresSatirlari["AdiSoyadi"]); ?> - <?php echo DonusumleriGeriDondur($AdresSatirlari["Adres"]); ?> <?php echo DonusumleriGeriDondur($AdresSatirlari["Ilce"]); ?> / 
                                                    <?php echo DonusumleriGeriDondur($AdresSatirlari["Sehir"]); ?> - <?php echo DonusumleriGeriDondur($AdresSatirlari["TelefonNumarasi"]); ?>
                                                </td> 
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr height="50">
                                <td align="left">Sisteme Kayıtlı Adresiniz Bulunmamaktadır. Lütfen Öncelikle "Hesabım" Alanından Adres Ekleyiniz. Adres Eklemek İçin Lütfen <a href="index.php?SK=70" 
                                style="color: #646464; text-decoration: none; font-weight: bold;">Buraya Tıklayınız</a>.</td>
                            </tr>
                            <?php
                        }
                    ?>
                    <tr height="50">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40">
                        <td align="left" style="background: #CCCCCC; font-weight: bold;">Kargo Firması Seçimi</td>
                    </tr>
                    <tr height="50">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40">
                        <td align="left">
                            <table width="800" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <?php
                                $KargoSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM kargofirmalari");
                                $KargoSorgusu->execute();
                                $KargoSayisi = $KargoSorgusu->rowCount();
                                $KargoKayitlari = $KargoSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                $DonguSayisi = 1;
                                $SutunAdetSayisi = 3;

                                foreach($KargoKayitlari as $KargoKaydi) {
                                    ?>
                                    <td width="260">
                                        <table width="260" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                            <tr height="40">
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr height="40">
                                                <td align="center"><img src="Resimler/<?php echo DonusumleriGeriDondur($KargoKaydi['KargoFirmasiLogosu']); ?>" border="0"></td>
                                            </tr>
                                            <tr>
                                                <td align="center"><input type="radio" name="KargoSecimi" value="<?php echo DonusumleriGeriDondur($KargoKaydi['id']); ?>"></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    if($DonguSayisi < $SutunAdetSayisi) {
                                        ?>
                                        <td width="10">&nbsp;</td>
                                        <?php
                                    }
                                    $DonguSayisi++;
                                    if($DonguSayisi > $SutunAdetSayisi) {
                                        echo "<tr></tr>";
                                        $DonguSayisi = 1;
                                    }
                                }
                                ?>
                            </table>
                        </td>
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
                            <tr>
                                <td align="right">
                                    <input type="submit" value="ÖDEME İŞLEMİ" class="AlisverisiTamamlaButonu">
                                </td>
                            </tr>
                        </table>
                    </td>
        </tr>
    </table>
</form>
<?php
} else {
    header("Location: index.php");
    exit();
}
?>
