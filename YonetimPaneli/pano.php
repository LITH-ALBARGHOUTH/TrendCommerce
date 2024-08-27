<?php
if(isset($_SESSION["Yonetici"])){

    $BekleyenSiparisSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=?");
    $BekleyenSiparisSorgusu->execute([0,0]);
    $BekleyenSiparisSayisi     = $BekleyenSiparisSorgusu->rowCount();

    $TamamlananSiparisSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=?");
    $TamamlananSiparisSorgusu->execute([1,1]);
    $TamamlananSiparisSayisi     = $TamamlananSiparisSorgusu->rowCount();

    $TumSiparisSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler");
    $TumSiparisSorgusu->execute();
    $TumSiparisSayisi     = $TumSiparisSorgusu->rowCount();

    $HavaleBildirimSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM havalebildirimleri ");
    $HavaleBildirimSorgusu->execute();
    $HavaleBildirimSayisi     = $HavaleBildirimSorgusu->rowCount();

    $BankaHesaplariSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM bankahesaplari ");
    $BankaHesaplariSorgusu->execute();
    $BankaHesaplariSayisi     = $BankaHesaplariSorgusu->rowCount();

    $MenuSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM menuler ");
    $MenuSorgusu->execute();
    $MenuSayisi     = $MenuSorgusu->rowCount();

    $UrunlerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler ");
    $UrunlerSorgusu->execute();
    $UrunlerSayisi     = $UrunlerSorgusu->rowCount();

    $UyelerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM uyeler ");
    $UyelerSorgusu->execute();
    $UyelerSayisi     = $UyelerSorgusu->rowCount();

    $YoneticilerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM yoneticiler ");
    $YoneticilerSorgusu->execute();
    $YoneticilerSayisi     = $YoneticilerSorgusu->rowCount();

    $KargolarSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM kargofirmalari ");
    $KargolarSorgusu->execute();
    $KargolarSayisi     = $KargolarSorgusu->rowCount();

    $BannerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM bannerlar ");
    $BannerSorgusu->execute();
    $BannerSayisi     = $BannerSorgusu->rowCount();

    $YorumlarSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM yorumlar ");
    $YorumlarSorgusu->execute();
    $YorumlarSayisi     = $YorumlarSorgusu->rowCount();

    $DestekSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM sorular ");
    $DestekSorgusu->execute();
    $DestekSayisi     = $DestekSorgusu->rowCount();


?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;PANO</h3></td>
        </tr>
        <tr height="70">
            <td>&nbsp;</td>
        </tr>

        <tr height="70">
            <td colspan="2">
                <table width="749" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Bekleyen Siparişler</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $BekleyenSiparisSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Tamamlanan Siparişler</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $TamamlananSiparisSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Tüm Siparişler</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $TumSiparisSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr height="70">
            <td colspan="2">
                <table width="749" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Havale Bildirimleri</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $HavaleBildirimSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Banka Hesapları</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $BankaHesaplariSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Menü Sayısı</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $MenuSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr height="70">
            <td colspan="2">
                <table width="749" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Ürünler</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $UrunlerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Üyeler</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $UyelerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Yöneticiler</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $YoneticilerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr height="70">
            <td colspan="2">
                <table width="749" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Kargolar</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $KargolarSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Bannerlar</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $BannerSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Yorumlar</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $YorumlarSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr height="70">
            <td colspan="2">
                <table width="749" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="243" style="border: 1px solid #CCCCCC;">
                            <table width="243" align="right" border="0" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td align="center" style="font-size: 18px;" >Destek İçerikleri</td>
                                </tr>
                                <tr height="30">
                                    <td align="center" style="font-size: 25px; font-weight: bold;" ><?php echo $DestekSayisi; ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="243">&nbsp;</td>
                        <td width="10">&nbsp;</td>
                        <td width="243">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>


    </table>

    
<?php
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
