<?php
if(isset($_SESSION["Yonetici"])){
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;YÖNETİCİLER</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=70" style="color: #FFFFFF; text-decoration: none;">+ Yeni Yönetici Ekle&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php

        $YoneticiSorgusu         = $VeriTabaniBaglantisi->prepare("SELECT * FROM yoneticiler ORDER BY IsimSoyisim ASC");
        $YoneticiSorgusu->execute();
        $YoneticiSayisi          = $YoneticiSorgusu->rowCount();
        $YoneticiKayitlari       = $YoneticiSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($YoneticiSayisi>0){
                foreach($YoneticiKayitlari as $Yonetici){

        ?>
        

        <tr>
            <td style="border-bottom: 1px dashed #CCCCCC;" valign="top" colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="30">
                        <td align="left" width="100"><?php echo $Yonetici["KullaniciAdi"]; ?></td>
                        <td align="left" width="175"><?php echo $Yonetici["IsimSoyisim"]; ?></td>  
                        <td align="left" width="225"><?php echo $Yonetici["EmailAdresi"]; ?></td>  
                        <td align="left" width="100"><?php echo $Yonetici["TelefonNumarasi"]; ?></td>

                        <td align="right" width="150">
                            <table width="150" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="25" valign="top" align="left"><a href="index.php?SKD=0&SKI=74&ID=<?php echo DonusumleriGeriDondur($Yonetici["id"]) ?>"><img src="../Resimler/" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="70"  align="left"><a href="index.php?SKD=0&SKI=74&ID=<?php echo DonusumleriGeriDondur($Yonetici["id"]) ?>" style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                    <td width="25" valign="top" align="left"><a href="index.php?SKD=0&SKI=78&ID=<?php echo DonusumleriGeriDondur($Yonetici["id"]) ?>"><img src="../Resimler/carpi.jpg" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="30"  align="left"><a href="index.php?SKD=0&SKI=78&ID=<?php echo DonusumleriGeriDondur($Yonetici["id"]) ?>" style="color: #FF0000; text-decoration: none;">Sil</a></td>
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
                        <td width="750">Kayıtlı Yönetici Bulunmamaktadır.</td>
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