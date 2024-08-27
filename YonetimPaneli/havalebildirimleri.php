<?php
if(isset($_SESSION["Yonetici"])){
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;HAVALE BİLDİRİMLERİ</h3></td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php

        $BildirimSorgusu         = $VeriTabaniBaglantisi->prepare("SELECT * FROM havalebildirimleri ORDER BY IslemTarihi ASC");
        $BildirimSorgusu->execute();
        $BildirimSayisi          = $BildirimSorgusu->rowCount();
        $BildirimKayitlari       = $BildirimSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($BildirimSayisi>0){
                foreach($BildirimKayitlari as $Bildirim){
                    $BankaSorgusu         = $VeriTabaniBaglantisi->prepare("SELECT * FROM bankahesaplari WHERE id=? LIMIT 1");
                    $BankaSorgusu->execute([$Bildirim["BankaId"]]);
                    $BankaKayitlari       = $BankaSorgusu->fetch(PDO::FETCH_ASSOC);

        ?>
        

        <tr>
            <td style="border-bottom: 1px dashed #CCCCCC;" valign="top" colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="30">
                        <td colspan="2" width="500" align="left"><b><?php echo DonusumleriGeriDondur($Bildirim["AdiSoyadi"]); ?></b></td>
                        <td width="250" align="right"><?php echo TarihBul($Bildirim["IslemTarihi"]); ?></td>  
                    </tr>
                    <tr>
                        <td width="250" align="left">Banka : <?php echo DonusumleriGeriDondur($BankaKayitlari["BankaAdi"]); ?></td>
                        <td width="250" align="left">Telefon : <?php echo DonusumleriGeriDondur($Bildirim["TelefonNumarasi"]); ?></td>  
                        <td width="250" align="left">E-Mail : <?php echo DonusumleriGeriDondur($Bildirim["EmailAdresi"]); ?></td>  
                    </tr>
                    <tr>
                        <td colspan="3" align="left">Açıklama Notu : <?php echo DonusumleriGeriDondur($Bildirim["Aciklama"]); ?></td>  
                    </tr>

                    <tr height="20">
                        <td colspan="3" align="right">
                            <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr height="20">
                                    <td width="695">&nbsp;</td>
                                    <td width="25" valign="top" align="left"><a href="index.php?SKD=0&SKI=117&ID=<?php echo DonusumleriGeriDondur($Bildirim["id"]) ?>">
                                    <img src="../Resimler/carpi.jpg" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="30"  align="left"><a href="index.php?SKD=0&SKI=117&ID=<?php echo DonusumleriGeriDondur($Bildirim["id"]) ?>" 
                                    style="color: #FF0000; text-decoration: none;">Sil</a></td>
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
            <td>
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="750">Kayıtlı Havale Bildirimi Bulunmamaktadır.</td>
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