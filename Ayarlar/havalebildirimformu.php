<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="500" valign="top">
          <form action="index.php?SK=10"  method="post">
          <table width="500" align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td style="color: #FF9900"><h3>Havale Bildirim Formu</h3></td>
             </tr>

             <tr height="30">
               <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Tamamlanmış Olan Ödeme İşleminizi Aşağıdaki Formdan İletiniz. </td>
             </tr>


             <tr height="30">
               <td valign="bottom" align="left">Isim Soyisim (*)</td>
             </tr>
             <tr height="30">
               <td valign="top" align="left"><input type="text" name="IsimSoyisim" class="InputAlanlari"></td>
             </tr>

             <tr height="30">
               <td valign="bottom" align="left">E-mail Adresi (*)</td>
             </tr>
             <tr height="30">
               <td valign="top" align="left"><input type="mail" name="EmailAdresi" class="InputAlanlari"></td>
             </tr>

             <tr height="30">
               <td valign="bottom" align="left">Telefon Numarası (*)</td>
             </tr>
             <tr height="30">
               <td valign="top" align="left"><input type="text" name="TelefonNumarasi" maxlength="11" class="InputAlanlari"></td>
             </tr>

             <tr height="30">
               <td valign="bottom" align="left">Ödeme Yapılan Banka (*)</td>
             </tr>
             <tr height="30">
               <td valign="top" align="left">
                <select name="BankaSecimi" class="SelectAlanlari">
                  <?php

                  $BankalarSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM bankahesaplari order by BankaAdi ASC");
                  $BankalarSorgusu->execute();
                  $BankalarSayisi = $BankalarSorgusu->rowCount();
                  $BankaKayitlari = $BankalarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                  foreach($BankaKayitlari as $Bankalar) {
                    ?>
                  

                    <option value="<?php echo DonusumleriGeriDondur($Bankalar["id"]);  ?>"><?php echo DonusumleriGeriDondur($Bankalar["BankaAdi"]); ?></option>

                    <?php
                    }
                    ?>
                </select>
               </td>
             </tr>

             <tr height="30">
               <td valign="bottom" align="left">Açıklama</td>
             </tr>
             <tr height="30">
               <td valign="top" align="left" class="TextAreaAlanlari"><textarea name="Aciklama"></textarea></td>
             </tr>

             <tr height="40">
               <td align="center"><input type="submit" value="Bildirimi Gönder" class="YesilButon"></td>
             </tr>

          </table>
          </form>
        </td>





           <td width="20">&nbsp;</td>





        <td width="545" valign="top">
          <table width="545" align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td colspan="2" style="color: #FF9900"><h3>İşleyiş</h3></td>
             </tr>

             <tr height="30">
               <td colspan="2" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Havale / EFT İşlemlerinin Kontrolü</td>
             </tr>

             <tr height="30">
               <td colspan="2" height="5" style="font-size: 5px;">&nbsp;</td>
             </tr>

             <tr height="30">
               <td align="left" width="30"><img src="" border="0" style="margin-top: 3px;"></td>
               <td align="left"><b>Havale / EFT İşlemi</b></td>
             </tr>

             <tr height="30">
               <td colspan="2" align="left">Müşteri Tarafından Öncelikle Banka Hesaplarımız Sayfasında Bulunan Herhangi Bir Hesap Ödeme İşlemi Gerçekleştirilir. </td>
             </tr>

             <td colspan="2" height="10">&nbsp;</td>

             <tr height="30">
               <td align="left" width="30"><img src="" border="0" style="margin-top: 3px;"></td>
               <td align="left"><b>Bildirim İşlemi</b></td>
             </tr>

             <tr height="30">
               <td colspan="2" align="left">Ödeme İşlemini Tamamladıktan Sonra "Havale Bildirim Formu" Sayfasından Müşterinin Yapmış Olduğu Ödeme İçin
                Bildirim Formunu Doldurarak On-Line Olarak Gönderir. </td>
             </tr>

             <td colspan="2" height="10">&nbsp;</td>

             <tr height="30">
               <td align="left" width="30"><img src="" border="0" style="margin-top: 3px;"></td>
               <td align="left"><b>Kontroller</b></td>
             </tr>

             <tr height="30">
               <td colspan="2" align="left">"Havale Bildirim Formu" 'nuz Tarafımıza Ulaştığı Anda İlgili Departman Tarafından Yapmış Olduğunuz Havale / EFT 
                İşlemi İle İlgili Banka Üzerinden Kontrol Edilir. </td>
             </tr>

             <td colspan="2" height="10">&nbsp;</td>

             <tr height="30">
               <td align="left" width="30"><img src="" border="0" style="margin-top: 3px;"></td>
               <td align="left"><b>Onay / Red</b></td>
             </tr>

             <tr height="30">
               <td colspan="2" align="left">Havale Bildirimi Geçerli ise, Yönetici İlgili Ödeme Onayını Vererek, Siparişinizi Teslimat Birimine İletilir.</td>
             </tr>

             <td colspan="2" height="10">&nbsp;</td>

             <tr height="30">
               <td align="left" width="30"><img src="" border="0" style="margin-top: 3px;"></td>
               <td align="left"><b>Sipariş Hazırlama & Teslimat</b></td>
             </tr>

             <tr height="30">
               <td colspan="2" align="left">Yönetici Ödeme Onayından Sonra Sayfamız Üzerinden Vermiş Olduğunuz Sipariş En Kısa Sürede Hazırlanarak Kargoya
                Teslim Edilir Ve Tarafınıza Ulaştırılır.</td>
             </tr>
          </table>
        </td>
    </tr>
</table>