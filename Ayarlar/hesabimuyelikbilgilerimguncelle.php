<?php

if($_SESSION["Kullanici"]){
?> 

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500" valign="top">
          <form action="index.php?SK=52"  method="post">
          <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td  style="color: #FF9900"><h3>Hesabım > Üyelik Bilgileri</h3></td>
             </tr>

             <tr height="30">
               <td  valign="top" style="border-bottom: 1px dashed #CCCCCC;">Aşağıdan Üyelik Bilgilerinizi Görüntüleyebilir Veya Güncelleyebilirsiniz.</td>
             </tr>

             <tr height="30">
                <td  valign="bottom" align="left">E-mail Adresi (*)</td>
            </tr>
            <tr height="30">
                <td  valign="top" align="left"><input type="mail" name="EmailAdresi" class="InputAlanlari" value="<?php echo $EmailAdresi; ?>"></td>
            </tr>

            <tr height="30">
                <td  valign="bottom" align="left">Şifre (*)</td>
            </tr>
            <tr height="30">
                <td  valign="top" align="left"><input type="password" name="Sifre" class="InputAlanlari" value="EskiSifre"></td>
            </tr>

            <tr height="30">
                <td  valign="bottom" align="left">Şifre Tekrarla (*)</td>
            </tr>
            <tr height="30">
                <td  valign="top" align="left"><input type="password" name="SifreTekrar" class="InputAlanlari" value="EskiSifre"></td>
            </tr>

             <tr height="30">
               <td  valign="bottom" align="left">Isim Soyisim (*)</td>
             </tr>
             <tr height="30">
               <td  valign="top" align="left"><input type="text" name="IsimSoyisim" class="InputAlanlari" value="<?php echo $IsimSoyisim; ?>"></td>
             </tr>

             <tr height="30">
               <td  valign="bottom" align="left">Telefon Numarası (*)</td>
             </tr>
             <tr height="30">
               <td  valign="top" align="left"><input type="text" name="TelefonNumarasi" maxlength="11" class="InputAlanlari" value="<?php echo $TelefonNumarasi; ?>"></td>
             </tr>

             <tr height="30">
               <td  valign="bottom" align="left">Cinsiyet (*)</td>
             </tr>
             <tr height="30">
               <td  valign="top" align="left"><select name="Cinsiyet" class="SelectAlanlari">
                <option value="Erkek" <?php if($Cinsiyet=="Erkek") { ?>selected="selected"<?php }?>>Erkek</option>
                <option value="Kadin" <?php if($Cinsiyet=="Kadın") { ?>selected="selected"<?php }?>>Kadın</option>
               </select></td>
             </tr>

             <tr height="40">
               <td colspan="2" align="center"><input type="submit" value="Bilgileri Güncelle" class="YesilButon"></td>
             </tr>
          </table>
          </form>
        </td>



           <td width="20">&nbsp;</td>



     <td width="545" valign="top">
        <table width="545"  align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td  style="color: #FF9900"><h3>Reklam</h3></td>
             </tr>

             <tr height="30">
               <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">TrendCommerce.net Reklamları</td>
             </tr>

             <tr height="30">
               <td height="5" style="font-size: 5px;">&nbsp;</td>
             </tr>

             <tr>
               <td><b>REKLAM ALANI<br />545x340</b></td>
             </tr>
          </table></td>
    </tr>
</table>

    
<?php
}else{
    header("Location: index.php");
    exit();
}
?>