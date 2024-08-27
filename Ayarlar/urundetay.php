<?php


if (isset($_GET["ID"])) {
    $GelenID = SayiliIcerikleriFiltrele(Guvenlik($_GET["ID"]));

    $HitGuncellemeSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE urunler SET GoruntulenmeSayisi=GoruntulenmeSayisi+1 WHERE id=? AND Durumu=? LIMIT 1");
    $HitGuncellemeSorgusu->execute([$GelenID, 1]);

    
    $UrunSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id=? AND Durumu=? LIMIT 1");
    $UrunSorgusu->execute([$GelenID, 1]);
    $UrunSayisi = $UrunSorgusu->rowCount();
    $UrunSorguKaydi = $UrunSorgusu->fetch(PDO::FETCH_ASSOC);

    if ($UrunSayisi > 0) {
        $UrunTuru = $UrunSorguKaydi["UrunTuru"];
        if ($UrunTuru == "Erkek Ayakkabısı") {
            $ResimKlasoru = "Erkek";
        } elseif ($UrunTuru == "Kadın Ayakkabısı") {
            $ResimKlasoru = "Kadin";
        } elseif ($UrunTuru == "Çocuk Ayakkabısı") {
            $ResimKlasoru = "Cocuk";
        }

        $UrununFiyati = DonusumleriGeriDondur($UrunSorguKaydi["UrunFiyati"]);
        $UrununParaBirimi = DonusumleriGeriDondur($UrunSorguKaydi["ParaBirimi"]);
        if ($UrununParaBirimi == "USD") {
            $UrunFiyatiHesapla = $UrununFiyati * $DolarKuru;
        } elseif ($UrununParaBirimi == "EUR") {
            $UrunFiyatiHesapla = $UrununFiyati * $EuroKuru;
        } else {
            $UrunFiyatiHesapla = $UrununFiyati;
        }
?>
<table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="350" valign="top">
            <table width="350" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="border: 1px solid #CCCCCC;" align="center">
                        <img id="BuyukResim" src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorguKaydi["UrunResmiBir"]); ?>" width="330" height="440" border="0">
                    </td>
                </tr>
                <tr>
                    <td style="font-size:5px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="350" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="border: 1px solid #CCCCCC;" width="78">
                                    <img src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo $UrunSorguKaydi['UrunResmiBir']; ?>" width="78" height="104" border="0" 
                                    onClick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>','<?php echo DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiBir']); ?>');">
                                </td>
                                <td width="10">&nbsp;</td>
                                <?php if (DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiIki']) != "") { ?>
                                    <td style="border: 1px solid #CCCCCC;" width="78">
                                        <img src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiIki']); ?>" width="78" height="104" border="0" 
                                        onClick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>','<?php echo DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiIki']); ?>');">
                                    </td>
                                <?php } else { ?>
                                    <td width="78">&nbsp;</td>
                                <?php } ?>
                                <td width="10">&nbsp;</td>
                                <?php if (DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiUc']) != "") { ?>
                                    <td style="border: 1px solid #CCCCCC;" width="78">
                                        <img src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiUc']); ?>" width="78" height="104" border="0" 
                                        onClick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>','<?php echo DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiUc']); ?>');">
                                    </td>
                                <?php } else { ?>
                                    <td width="78">&nbsp;</td>
                                <?php } ?>
                                <td width="10">&nbsp;</td>
                                <?php if (DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiDort']) != "") { ?>
                                    <td style="border: 1px solid #CCCCCC;" width="78">
                                        <img src="Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiDort']); ?>" width="78" height="104" border="0" 
                                        onClick="$.UrunDetayResmiDegistir('<?php echo $ResimKlasoru; ?>','<?php echo DonusumleriGeriDondur($UrunSorguKaydi['UrunResmiDort']); ?>');">
                                    </td>
                                <?php } else { ?>
                                    <td width="78">&nbsp;</td>
                                <?php } ?>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="350" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="50">
                                <td bgcolor="#F1F1F1">&nbsp;<b>REKLAMLAR</b></td>
                            </tr>
                            <?php
                            $BannerSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM bannerlar WHERE BannerAlani ='Ürün Detay' ORDER BY GosterimSayisi ASC LIMIT 1");
                            $BannerSorgusu->execute();
                            $BannerSayisi = $BannerSorgusu->rowCount();
                            $BannerKaydi = $BannerSorgusu->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <tr height="350">
                                <td><img src="Resimler/<?php echo DonusumleriGeriDondur($BannerKaydi["BannerResmi"]); ?>" border= "0"></td>
                            </tr>
                            <?php
                            $BannerGuncelle = $VeriTabaniBaglantisi->prepare("UPDATE bannerlar SET GosterimSayisi = GosterimSayisi + 1 WHERE id = ? LIMIT 1");
                            $BannerGuncelle->execute([DonusumleriGeriDondur($BannerKaydi["id"])]);
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
        </td>

        <td width="10" valign="top">&nbsp;</td>

        <td width="705" valign="top">
            <table width="705" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr height="50" bgcolor="#F1F1F1">
                    <td style="text-align: left; font-size: 18px; font-weight: bold;"><?php echo DonusumleriGeriDondur($UrunSorguKaydi["UrunAdi"]); ?></td>
                </tr>
                <tr>
                    <td>
                        <form action="index.php?SK=90&ID=<?php echo DonusumleriGeriDondur($UrunSorguKaydi["id"]); ?>" method="post">
                            <table width="705" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="45">
                                    <td width="30">
                                        <a href="<?php echo DonusumleriGeriDondur($SosyalLinkFacebook); ?>" target="_blank">
                                            <img src="Resimler/facebook24x24.png" border="0" style="margin-top: 5px;">
                                        </a>
                                    </td>
                                    <td width="30">
                                        <a href="<?php echo DonusumleriGeriDondur($SosyalLinkX); ?>" target="_blank">
                                            <img src="Resimler/x24x24.png" border="0" style="margin-top: 5px;">
                                        </a>
                                    </td>
                                    <?php if (isset($_SESSION["Kullanici"])) { ?>
                                    <td width="30">
                                        <a href="index.php?SK=86&ID=<?php echo DonusumleriGeriDondur($UrunSorguKaydi["id"]); ?>" target="_blank">
                                            <img src="Resimler/favori24x24.png" border="0" style="margin-top: 5px;">
                                        </a>
                                    </td>
                                    <?php } else { ?>
                                    <img src="Resimler/favori24x24.png" border="0" style="margin-top: 5px;">
                                    <?php } ?>
                                    <td width="10">&nbsp;</td>
                                    <td width="605">
                                        <input type="submit" value="SEPETE EKLE" class="SepeteEkleButonu">
                                    </td>
                                </tr>
                                <tr height="45">
                                    <td colspan="5">
                                        <table width="705" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="45">
                                                <td align="left" width="500">
                                                    <select name="Varyant" class="SelectAlanlari">
                                                        <option value="">Lütfen <?php echo DonusumleriGeriDondur($UrunSorguKaydi["VaryantBasligi"]); ?> Seçiniz</option>
                                                        <?php
                                                        $VaryantSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE UrunId = ? AND StokAdedi > ? ORDER BY VaryantAdi ASC");
                                                        $VaryantSorgusu->execute([DonusumleriGeriDondur($UrunSorguKaydi["id"]), 0]);
                                                        $VaryantSayisi = $VaryantSorgusu->rowCount();
                                                        $VaryantKayitlari = $VaryantSorgusu->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($VaryantKayitlari as $VaryantSecimi) {
                                                        ?>
                                                        <option value="<?php echo DonusumleriGeriDondur($VaryantSecimi["id"]); ?>"><?php echo DonusumleriGeriDondur($VaryantSecimi["VaryantAdi"]); ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td align="right" width="255" style="font-size: 25px; color: black; font-weight: bold;"><?php echo FiyatBicimlendir($UrunFiyatiHesapla); ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td><hr /></td>
                </tr>
                <tr>
                    <td>
                        <table width="705" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="30">
                                <td><img src="Resimler/saat20x20.png" border="0" style="margin-top: 5px;"></td>
                                <td>Siparişiniz <?php echo UcGunIleriTarihBul(); ?> Tarihine Kadar Kargoya Verilecektir.</td>
                            </tr>
                            <tr height="30">
                                <td><img src="Resimler/saat20x20.png" border="0" style="margin-top: 5px;"></td>
                                <td>İlgili Ürün Süper Hızlı Gönderi Kapsamındadır. Aynı Gün Teslimat Yapılabilir.</td>
                            </tr>
                            <tr height="30">
                                <td><img src="Resimler/saat20x20.png" border="0" style="margin-top: 5px;"></td>
                                <td>Tüm Bankaların Kredi Kartı İle Peşin veya Taksitli Ödeme Seçeneği.</td>
                            </tr>
                            <tr height="30">
                                <td><img src="Resimler/saat20x20.png" border="0" style="margin-top: 5px;"></td>
                                <td>Tüm Bankalardan Havale Veya EFT İle Ödeme Seçeneği.</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><hr /></td>
                </tr>
                <tr height="30">
                    <td style="background: #FF9900; color: white;">&nbsp;Ürün Açıklaması</td>
                </tr>
                <tr>
                    <td><?php echo DonusumleriGeriDondur($UrunSorguKaydi["UrunAciklamasi"]) ?></td>
                </tr>
                <tr>
                    <td><hr /></td>
                </tr>
                <tr height="30">
                    <td style="background: #FF9900; color: white;">&nbsp;Ürün Yorumları</td>
                </tr>
                <tr>
                    <td>
                        <div style="width: 705px; max-width: 705px; height: 300px; max-height: 300px; overflow-y: scroll;"><table width="685" align="left" border="0" 
                        cellpadding="0" cellspacing="0">
                        <?php
                            $YorumlarSorgusu      = $VeriTabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE UrunId = ? ORDER BY YorumTarihi DESC");
                            $YorumlarSorgusu->execute([DonusumleriGeriDondur($UrunSorguKaydi["id"])]);
                            $YorumlarSayisi       = $YorumlarSorgusu->rowCount();
                            $YorumKayitlari       = $YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                            if($YorumlarSayisi>0){
                                foreach($YorumKayitlari as $YorumSatirlari){
                                    $YorumPuani   = DonusumleriGeriDondur($YorumSatirlari["Puan"]);

                                    if($YorumPuani==1){
                                        $YorumPuanResmi =   "";
                                    }elseif($YorumPuani==2){
                                        $YorumPuanResmi =   "";
                                    }elseif($YorumPuani==3){
                                        $YorumPuanResmi =   "";
                                    }elseif($YorumPuani==4){
                                        $YorumPuanResmi =   "";
                                    }elseif($YorumPuani==5){
                                        $YorumPuanResmi =   "";
                                    }

                                    $YorumIcinUyeSorgusu      = $VeriTabaniBaglantisi->prepare("SELECT * FROM uyeler WHERE Id = ? LIMIT 1");
                                    $YorumIcinUyeSorgusu->execute([DonusumleriGeriDondur($YorumSatirlari["UyeId"])]);
                                    $YorumIcinUyeKaydi        = $YorumIcinUyeSorgusu->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr height="30">
                            <td width="64"><img src="Resimler/<?php echo $YorumPuanResmi; ?>" border="0"></td>
                            <td width="10">&nbsp;</td>
                            <td width="451"><?php echo DonusumleriGeriDondur($YorumIcinUyeKaydi["IsimSoyisim"]) ?></td>
                            <td width="10">&nbsp;</td>
                            <td width="150" align="right"><?php echo TarihBul(DonusumleriGeriDondur($YorumSatirlari["YorumTarihi"])) ?></td>
                        </tr>
                        <tr>
                            <td colspan="5" style="border-bottom: 1px dashed #CCCCCC;"><?php echo DonusumleriGeriDondur($YorumSatirlari["YorumMetni"]) ?></td>
                        </tr>
                        <?php
                            }
                        }else{
                        ?>
                        <tr height="30">
                            <td>Ürün İçin Henüz Yorum Eklenmemiştir.</td>
                        </tr>
                        <?php
                        }
                        ?>
                        </table></div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>