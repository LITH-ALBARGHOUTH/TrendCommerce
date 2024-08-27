<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                  = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                  = "";
    }

    $YoneticilerSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM yoneticiler WHERE id=? LIMIT 1");
    $YoneticilerSorgusu->execute([$GelenID]);
    $YoneticilerSayisi         = $YoneticilerSorgusu->rowCount();
    $YoneticilerBilgisi        = $YoneticilerSorgusu->fetch(PDO::FETCH_ASSOC);

        if($YoneticilerSayisi>0){
?>

<form action="index.php?SKD=0&SKI=75&ID=<?php echo DonusumleriGeriDondur($GelenID); ?>" method="post">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;YÖNETİCİLER</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=70" style="color: #FFFFFF; text-decoration: none;">+ Yeni Yönetici Ekle&nbsp;</a></td>
        </tr>

        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">

                    <tr height="40">
                        <td width="230">Kullanıcı Adı</td>
                        <td width="20">:</td>
                        <td width="500"><?php echo DonusumleriGeriDondur($YoneticilerBilgisi["KullaniciAdi"]); ?></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Şifre</td>
                        <td width="20">:</td>
                        <td width="500"><input type="password" name="Sifre" class="InputAlanlari" ><b style="color:red;">Eğer Şifrenizi Değiştirmeyecekseniz Bu Alanı Boş Bırakınız</b></td>
                    </tr>
                    <tr height="40">
                        <td width="230">İsim Soyisim</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="IsimSoyisim" value="<?php echo DonusumleriGeriDondur($YoneticilerBilgisi["IsimSoyisim"]); ?>" class="InputAlanlari" ></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Email Adresi</td>
                        <td width="20">:</td>
                        <td width="500"><input type="mail" name="EmailAdresi" value="<?php echo DonusumleriGeriDondur($YoneticilerBilgisi["EmailAdresi"]); ?>" class="InputAlanlari" ></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Telefon Numarası</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="TelefonNumarasi" maxlength="11" value="<?php echo DonusumleriGeriDondur($YoneticilerBilgisi["TelefonNumarasi"]); ?>" class="InputAlanlari" ></td>
                    </tr>

                    <tr height="40">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Yönetici Bilgileri Güncelle" class="YesilButon" ></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</from>
<?php

    } else {
        header("Location: index.php?SKD=0&SKI=77");
        exit();
    } 
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
