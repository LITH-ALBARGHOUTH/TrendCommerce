<?php

// if(isset($_SESSION["Kullanici"])){
?> 

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500" valign="top">
          <form action="index.php?SK=71"  method="post">
          <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td  style="color: #FF9900"><h3>Hesabım > Adresler</h3></td>
             </tr>

             <tr height="30">
               <td  valign="top" style="border-bottom: 1px dashed #CCCCCC;">Tüm Adreslerinizi Görüntüleyebilir Veya Güncelleyebilirsiniz.</td>
             </tr>

             <tr height="30">
               <td  valign="bottom" align="left">Isim Soyisim (*)</td>
             </tr>
             <tr height="30">
               <td  valign="top" align="left"><input type="text" name="IsimSoyisim" class="InputAlanlari"></td>
             </tr>

             <tr height="30">
                <td  valign="bottom" align="left">Adres (*)</td>
            </tr>
            <tr height="30">
                <td  valign="top" align="left"><input type="text" name="Adres" class="InputAlanlari"></td>
            </tr>

            <tr height="30">
                <td  valign="bottom" align="left">İlçe (*)</td>
            </tr>
            <tr height="30">
                <td  valign="top" align="left"><input type="text" name="Ilce" class="InputAlanlari"></td>
            </tr>

            <tr height="30">
                <td  valign="bottom" align="left">Şehir (*)</td>
            </tr>
            <tr height="30">
                <td  valign="top" align="left"><input type="text" name="Sehir" class="InputAlanlari"></td>
            </tr>

            <tr height="30">
                <td  valign="bottom" align="left">Telefon Numarası (*)</td>
            </tr>
            <tr height="30">
                <td  valign="top" align="left"><input type="text" name="TelefonNumarasi" class="InputAlanlari"></td>
            </tr>


             <tr height="40">
               <td colspan="2" align="center"><input type="submit" value="Adresi Kaydet" class="YesilButon"></td>
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
// }else{
//     header("Location: index.php");
//     exit();
// }

?>