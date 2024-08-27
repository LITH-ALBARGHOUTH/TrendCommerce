<?php
if(isset($_SESSION["Yonetici"])){
    if(isset($_GET["SiparisNo"])){
        $GelenSiparisNo                    = Guvenlik($_GET["SiparisNo"]);
    }else{
        $GelenSiparisNo                    = "";
    }
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;SİPARİŞ DETAY</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=106" style="color: #FFFFFF; text-decoration: none;">Tamamlanan Siparişlere Dön&nbsp;</a></td>
        </tr>

        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php

        $SiparislerSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM siparisler WHERE SiparisNumarasi= ? ");
        $SiparislerSorgusu->execute([$GelenSiparisNo]);
        $SiparislerSayisi         = $SiparislerSorgusu->rowCount();
        $SiparislerKayitlari      = $SiparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($SiparislerSayisi>0){
                $DonguSayisi    =   0;
                foreach($SiparislerKayitlari as $Siparisler){
                    if($Siparisler["UrunTuru"]=="Erkek Ayakkabısı"){
                        $ResimKlasoru   =   "Erkek";
                    }elseif($Siparisler["UrunTuru"]=="Kadın Ayakkabısı"){
                        $ResimKlasoru   =   "Kadin";
                    }elseif($Siparisler["UrunTuru"]=="Çocuk Ayakkabısı"){
                        $ResimKlasoru   =   "Cocuk";
                    }
        ?>
        <tr>
            <td style="border-bottom: 1px dashed #CCCCCC;" valign="top" colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <?php
                    if($DonguSayisi==0){
                    ?>
                    <tr>
                        <td colspan="3">
                            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="100"><b>Adı Soyadı</b></td>
                                    <td width="10"><b>:</b></td>
                                    <td width="540"><?php echo DonusumleriGeriDondur($Siparisler["AdresAdiSoyadi"]); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="100"><b>Telefon</b></td>
                                    <td width="10"><b>:</b></td>
                                    <td width="540"><?php echo DonusumleriGeriDondur($Siparisler["AdresTelefon"]); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="100"><b>Adres</b></td>
                                    <td width="10"><b>:</b></td>
                                    <td width="540"><?php echo DonusumleriGeriDondur($Siparisler["AdresDetay"]); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="100"><b>Gönderi Kodu</b></td>
                                    <td width="10"><b>:</b></td>
                                    <td width="540"><?php echo DonusumleriGeriDondur($Siparisler["KargoGonderiKodu"]); ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td width="60" valign="top">
                            <img src="../Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($Siparisler["UrunResmiBir"]); ?>" 
                            border="0" width="60" height="80">
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="680" valign="top">
                            <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr height="25">
                                    <td width="680">
                                        <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="450" align="left">
                                                    <?php echo DonusumleriGeriDondur($Siparisler["UrunAdi"]); ?>
                                                </td>
                                                <td width="230" align="right">
                                                    <?php echo DonusumleriGeriDondur($Siparisler["VaryantBasligi"]); ?> :<?php echo DonusumleriGeriDondur($Siparisler["VaryantSecimi"]); ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="25">
                                    <td width="680">
                                        <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="50"><b>Fiyat</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="135"><?php echo FiyatBicimlendir(DonusumleriGeriDondur($Siparisler["UrunFiyati"])); ?></td>
                                                <td width="85"><b>Satış Adedi</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="50"><?php echo DonusumleriGeriDondur($Siparisler["UrunAdedi"]); ?></td>
                                                <td width="115"><b>Toplam Fiyat</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="125"><?php echo FiyatBicimlendir(DonusumleriGeriDondur($Siparisler["ToplamUrunFiyati"])); ?></td>
                                                <td width="50"><b>KDV</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="30">%<?php echo DonusumleriGeriDondur($Siparisler["KdvOrani"]); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr height="25">
                                    <td width="680">
                                        <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="50"><b>Ödeme</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="130"><?php echo DonusumleriGeriDondur($Siparisler["OdemeSecimi"]); ?></td>
                                                <td width="50"><b>Taksit</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="50"><?php echo DonusumleriGeriDondur($Siparisler["TaksitSecimi"]); ?></td>
                                                <td width="65"><b>Kargo</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="125"><?php echo DonusumleriGeriDondur($Siparisler["KargoFirmasiSecimi"]); ?></td>
                                                <td width="105"><b>Kargo Ücreti</b></td>
                                                <td width="10"><b>:</b></td>
                                                <td width="65"><?php echo FiyatBicimlendir(DonusumleriGeriDondur($Siparisler["KargoUcreti"])); ?> TL</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr> 
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php
            $DonguSayisi++;
        }
        ?>

        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">
                <form action="index.php?SKD=0&SKI=110&SiparisNo=<?php echo DonusumleriGeriDondur($GelenSiparisNo); ?>" method="post">
                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td colspan="3">
                                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="100"><b>Gönderi Kodu</b></td>
                                            <td width="10"><b>:</b></td>
                                            <td width="540"><input type="text" name="GonderiKodu" class="InputAlanlari"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr height="40">
                                <td colspan="3">
                                    <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="100">&nbsp;</td>
                                            <td width="10">&nbsp;</td>
                                            <td width="540"><input type="submit" value="Göderi Kodunu İşle Ve Siparişi Tamamla" class="YesilButon"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                    </table>
                </form>
            </td>
        </tr>

        <?php
        }else{
            header("Location: index.php?SKD=0&SKI=0");
            exit();
        }
        ?>
    </table>
<?php
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
