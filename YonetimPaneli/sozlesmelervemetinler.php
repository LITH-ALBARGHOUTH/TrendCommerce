<?php
if(isset($_SESSION["Yonetici"])){
?>
<form action="index.php?SKD=0&SKI=6" method="post">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td bgcolor="#FF9900" style="color: #FFFFFF"><h3>&nbsp;SÖZLEŞME VE METİNLER</h3></td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td valign="top" width="230">Hakkımızda Metni</td>
                        <td valign="top" width="20">:</td>
                        <td valign="top" width="500"><textarea name="HakkimizdaMetni" class="TextAreaAlanlari"><?php echo DonusumleriGeriDondur($HakkimizdaMetni); ?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top" width="230">Üyelik Sözleşmesi Metni</td>
                        <td valign="top" width="20">:</td>
                        <td valign="top" width="500"><textarea name="UyelikSozlesmeMetni" class="TextAreaAlanlari"><?php echo DonusumleriGeriDondur($UyelikSozlesmeMetni); ?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top" width="230">Kullanım Koşulları Metni</td>
                        <td valign="top" width="20">:</td>
                        <td valign="top" width="500"><textarea name="KullanimKosullariMetni" class="TextAreaAlanlari"><?php echo DonusumleriGeriDondur($KullanimKosullariMetni); ?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top" width="230">Gizlilik Sözleşmesi Metni</td>
                        <td valign="top" width="20">:</td>
                        <td valign="top" width="500"><textarea name="GizlilikSozlesmesiMetni" class="TextAreaAlanlari"><?php echo DonusumleriGeriDondur($GizlilikSozlesmesiMetni); ?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top" width="230">Mesafeli Satış Sözleşmesi Metni</td>
                        <td valign="top" width="20">:</td>
                        <td valign="top" width="500"><textarea name="MesafeliSatisSozlesmesiMetni" class="TextAreaAlanlari"><?php echo DonusumleriGeriDondur($MesafeliSatisSozlesmesiMetni); ?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top" width="230">Teslimat Metni</td>
                        <td valign="top" width="20">:</td>
                        <td valign="top" width="500"><textarea name="TeslimatMetni" class="TextAreaAlanlari"><?php echo DonusumleriGeriDondur($TeslimatMetni); ?></textarea></td>
                    </tr>
                    <tr>
                        <td valign="top" width="230">Iptal & Iade & Değişim Metni</td>
                        <td valign="top" width="20">:</td>
                        <td valign="top" width="500"><textarea name="IptalIadeDegisimMetni" class="TextAreaAlanlari"><?php echo DonusumleriGeriDondur($IptalIadeDegisimMetni); ?></textarea></td>
                    </tr>

                    <tr height="40">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Değişiklikleri Kaydet" class="YesilButon" ></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</from>
<?php
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
