<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                  = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                  = "";
    }

    $DestekKaydiSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM sorular WHERE id=? LIMIT 1");
    $DestekKaydiSorgusu->execute([$GelenID]);
    $DestekKaydiSayisi         = $DestekKaydiSorgusu->rowCount();
    $DestekKaydiBilgisi        = $DestekKaydiSorgusu->fetch(PDO::FETCH_ASSOC);

        if($DestekKaydiSayisi>0){
?>

<form action="index.php?SKD=0&SKI=51&ID=<?php echo DonusumleriGeriDondur($GelenID); ?>" method="post">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;DESTEK İÇERİKLERİ</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=34" style="color: #FFFFFF; text-decoration: none;">+ Yeni Destek Kaydı Ekle&nbsp;</a></td>
        </tr>

        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">

                    <tr height="40">
                        <td width="230">Soru</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="Soru" value="<?php echo DonusumleriGeriDondur($DestekKaydiBilgisi["Soru"]); ?>" class="InputAlanlari" ></td>
                    </tr>
                    <tr height="40">
                        <td width="230" valign="top">Cevap</td>
                        <td width="20" valign="top">:</td>
                        <td width="500"><textarea name="Cevap" class="TextAreaAlanlari" ><?php echo DonusumleriGeriDondur($DestekKaydiBilgisi["Cevap"]); ?></textarea></td>
                    </tr>
                    <tr height="40">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Destek Kaydı Güncelle" class="YesilButon" ></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</from>
<?php

    } else {
        header("Location: index.php?SKD=0&SKI=53");
        exit();
    } 
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
