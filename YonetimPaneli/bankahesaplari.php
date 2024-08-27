<?php
if(isset($_SESSION["Yonetici"])){
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;BANKA HESAP AYARLARI</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=10" style="color: #FFFFFF; text-decoration: none;">+Yeni Banka Hesabı Ekle&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php

        $HesaplarSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM bankahesaplari ORDER BY BankaAdi ASC");
        $HesaplarSorgusu->execute();
        $HesaplarSayisi         = $HesaplarSorgusu->rowCount();
        $HesaplarKayitlari      = $HesaplarSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($HesaplarSayisi>0){
                foreach($HesaplarKayitlari as $Hesaplar){

        ?>
        

        <tr height="105">
            <td style="border-bottom: 1px dashed #CCCCCC;" valign="top" colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="275">
                            <table width="275" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr height="75">
                                    <td>
                                        <img src="../Resimler/<?php echo DonusumleriGeriDondur($Hesaplar["BankaLogosu"]) ?>" border="0">
                                    </td>
                                </tr>
                                <tr height="30">
                                    <td align="center">
                                        <table width="275" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="35" valign="top"><a href="index.php?SKD=0&SKI=14&ID=<?php echo DonusumleriGeriDondur($Hesaplar["id"]) ?>"><img src="../Resimler/" border="0"></a></td>
                                                <td width="105" valign="top"><a href="index.php?SKD=0&SKI=14&ID=<?php echo DonusumleriGeriDondur($Hesaplar["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                                <td width="35" valign="top"><a href="index.php?SKD=0&SKI=18&ID=<?php echo DonusumleriGeriDondur($Hesaplar["id"]) ?>"><img src="../Resimler/carpi.jpg" border="0"></a></td>
                                                <td width="100" valign="top"><a href="index.php?SKD=0&SKI=18&ID=<?php echo DonusumleriGeriDondur($Hesaplar["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                            </table>
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="465">
                            <table width="465" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr height="105">
                                    <td>
                                        <table width="465" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr height="35">
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td width="85"><b>Banka Adı</b></td>
                                                            <td width="10"><b>:</b></td>
                                                            <td width="125"><?php echo DonusumleriGeriDondur($Hesaplar["BankaAdi"]) ?></td>

                                                            <td width="100"><b>Hesap Sahibi</b></td>
                                                            <td width="10"><b>:</b></td>
                                                            <td width="135"><?php echo DonusumleriGeriDondur($Hesaplar["HesapSahibi"]) ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr height="35">
                                                <td>
                                                    <table width="465" align="right" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="200"><b>Şube Ve Konum Bilgileri</b></td>
                                                            <td width="20"><b>:</b></td>
                                                            <td width="245"><?php echo DonusumleriGeriDondur($Hesaplar["SubeAdi"]) ?> (<?php echo DonusumleriGeriDondur($Hesaplar["SubeKodu"]) ?>) - <?php echo DonusumleriGeriDondur($Hesaplar["KonumSehir"]) ?> / 
                                                            <?php echo DonusumleriGeriDondur($Hesaplar["KonumUlke"]) ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr height="35">
                                                <td width="465">
                                                    <table width="465" align="right" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="200"><b>Hesap Bilgileri</b></td>
                                                            <td width="20"><b>:</b></td>
                                                            <td width="245"><?php echo DonusumleriGeriDondur($Hesaplar["ParaBirimi"]) ?> / <?php echo DonusumleriGeriDondur($Hesaplar["HesapNumarasi"]) ?> / <?php echo DonusumleriGeriDondur($Hesaplar["IbanNumarasi"]) ?></td>
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
                </table>
            </td>
        </tr>

        <?php
                }
            }else{
        
        ?>

        <tr>
            <td colspan="2">
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="750">Kayıtlı Banka Hesabı Bulunmamaktadır.</td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php

        }

        ?>

    </table>
<?php
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
