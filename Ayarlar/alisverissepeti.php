<?php

if($_SESSION["Kullanici"]){

    $StokIcinSepettekiUrunlerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?");
    $StokIcinSepettekiUrunlerSorgusu->execute([$KullaniciID]);
    $StokIcinSepettekiUrunSayisi        = $StokIcinSepettekiUrunlerSorgusu->rowCount();
    $StokIcinSepettekiUrunKayitlari     = $StokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);


    if($StokIcinSepettekiUrunSayisi>0){
        foreach($StokIcinSepettekiUrunKayitlari as $StokIcinSepettekiSatirlar){
        $StokIcinSepetId                      = $StokIcinSepettekiSatirlar["id"];
        $StokIcinSepettekiVaryantId           = $StokIcinSepettekiSatirlar["VaryantId"];
        $StokIcinSepettekiUrunAdedi           = $StokIcinSepettekiSatirlar["UrunAdedi"];

        $StokIcinUrunVaryantBilgileriSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
        $StokIcinUrunVaryantBilgileriSorgusu->execute([$StokIcinSepettekiVaryantId]);
        $StokIcinUrunVaryantBilgileriKayitlari      = $StokIcinUrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
            $StokIcinUrununStokAdedi                = $StokIcinUrunVaryantBilgileriKayitlari["StokAdedi"];
            if($StokIcinUrununStokAdedi==0){

                $SepetSilSorgusu = $VeriTabaniBaglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
                $SepetSilSorgusu->execute([$StokIcinSepetId,$KullaniciID]);

            }elseif($StokIcinSepettekiUrunAdedi>$StokIcinUrununStokAdedi){

                $SepetGuncellemeSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE sepet SET UrunAdedi=? WHERE id = ? AND UyeId = ? LIMIT 1");
                $SepetGuncellemeSorgusu->execute([$StokIcinUrununStokAdedi,$StokIcinSepetId,$KullaniciID]);
            }
        }
    }

    $SepetSifirlamaSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE sepet SET AdresId=? , KargoId=? , OdemeSecimi=? , TaksitSecimi=? WHERE UyeId=? LIMIT 1");
    $SepetSifirlamaSorgusu->execute([0,0,"",0,$KullaniciID]);
?> 

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
  

    <tr>
        <td width="800" valign="top">
          <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td  style="color: #FF9900"><h3>Alışveriş Sepeti</h3></td>
             </tr>

             <tr height="30">
               <td  valign="top" style="border-bottom: 1px dashed #CCCCCC;">Alışveriş Sepetinize Eklemiş Olduğunuz Ürünler Aşağıdadır.</td>
             </tr>

             <?php

                $SepettekiUrunlerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC");
                $SepettekiUrunlerSorgusu->execute([$KullaniciID]);
                $SepettekiUrunSayisi        = $SepettekiUrunlerSorgusu->rowCount();
                $SepettekiUrunKayitlari     = $SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                if($SepettekiUrunSayisi>0){
                    $SepettekiToplamUrunSayisi        = 0;
                    $SepettekiToplamFiyat             = 0;
                    foreach($SepettekiUrunKayitlari as $SepetSatirlari){

                        $SepetId                      = $SepetSatirlari["id"];
                        $SepettekiUrunId              = $SepetSatirlari["UrunId"];
                        $SepettekiVaryantId           = $SepetSatirlari["VaryantId"];
                        $SepettekiUrunAdedi           = $SepetSatirlari["UrunAdedi"];

                        $UrunBilgileriSorgusu         = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                        $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
                        $UrunBilgileriKayitlari       = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                            $UrununTuru               = $UrunBilgileriKayitlari["UrunTuru"];
                            $UrununResmi              = $UrunBilgileriKayitlari["UrunResmiBir"];
                            $UrununAdi                = $UrunBilgileriKayitlari["UrunAdi"];
                            $UrununFiyati             = $UrunBilgileriKayitlari["UrunFiyati"];
                            $UrununParaBirimi         = $UrunBilgileriKayitlari["ParaBirimi"];
                            $UrununVaryantBasligi     = $UrunBilgileriKayitlari["VaryantBasligi"];

                        $UrunVaryantBilgileriSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE UrunId = ? AND id = ? LIMIT 1");
                        $UrunVaryantBilgileriSorgusu->execute([$SepettekiUrunId , $SepettekiVaryantId]);
                        $UrunVaryantBilgileriKayitlari      = $UrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                      
                            $UrununVaryantAdi           = $UrunVaryantBilgileriKayitlari["VaryantAdi"];
                            $UrununStokAdedi            = $UrunVaryantBilgileriKayitlari["StokAdedi"];

                            if($UrununTuru=="Erkek Ayakkabısı"){
                                $UrunResimleriKlasoru   =  "Erkek";
                            }elseif($UrununTuru=="Kadın Ayakkabısı"){
                                $UrunResimleriKlasoru   =  "Kadin";
                            }elseif($UrununTuru=="Çocuk Ayakkabısı"){
                                $UrunResimleriKlasoru   =  "Cocuk";
                            }

                            if($UrununParaBirimi=="USD"){
                                $UrunFiyatiHesapla              = $UrununFiyati*$DolarKuru;
                                $UrunFiyatiBicimlendir          = FiyatBicimlendir($UrunFiyatiHesapla);
                                $UrununToplamFiyatiHesapla      = $UrunFiyatiHesapla*$SepettekiUrunAdedi;
                                $UrununToplamFiyatiBicimlendir  = FiyatBicimlendir($UrununToplamFiyatiHesapla);
                            }elseif($UrununParaBirimi=="EUR"){
                                $UrunFiyatiHesapla      = $UrununFiyati*$EuroKuru;
                                $UrunFiyatiBicimlendir      = FiyatBicimlendir($UrunFiyatiHesapla);
                                $UrununToplamFiyatiHesapla  = $UrunFiyatiHesapla*$SepettekiUrunAdedi;
                                $UrununToplamFiyatiBicimlendir  = FiyatBicimlendir($UrununToplamFiyatiHesapla);
                            }else{
                                $UrunFiyatiHesapla          = $UrununFiyati;
                                $UrunFiyatiBicimlendir      = FiyatBicimlendir($UrunFiyatiHesapla);
                                $UrununToplamFiyatiHesapla  = $UrunFiyatiHesapla*$SepettekiUrunAdedi;
                                $UrununToplamFiyatiBicimlendir  = FiyatBicimlendir($UrununToplamFiyatiHesapla);
                            }

                            $SepettekiToplamUrunSayisi += $SepettekiUrunAdedi;
                            $SepettekiToplamFiyat      += ($UrunFiyatiHesapla*$SepettekiUrunAdedi);
                ?>

                <tr height="100">
                    <td  valign="bottom" align="left"><table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                        
                        <tr>
                            <td width="80" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                <img src="Resimler/UrunResimleri/<?php echo $UrunResimleriKlasoru; ?>/<?php echo DonusumleriGeriDondur($UrununResmi); ?>" border="0" width="60" height="80">
                            </td>
                            <td width="40" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                <a href="index.php?SK=94&ID=<?php echo DonusumleriGeriDondur($SepetId); ?>"><img src="Resimler/carpi.jpg" border="0"></a>
                            </td>
                            <td width="530" style="border-bottom: 1px dashed #CCCCCC;" align="left">
                                <?php echo DonusumleriGeriDondur($UrununAdi); ?><br /> <?php echo DonusumleriGeriDondur($UrununVaryantBasligi); ?> : 
                                <?php echo DonusumleriGeriDondur($UrununVaryantAdi); ?>
                            </td>
                            <td width="90" style="border-bottom: 1px dashed #CCCCCC;" align="left"><table width="90" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="30" align="center">
                                        
                                        <?php
                                        if($SepettekiUrunAdedi>1){
                                        ?>
                                        <a href="index.php?SK=95&ID=<?php echo DonusumleriGeriDondur($SepetId); ?>" style="text-decoration: none; color: #646464;"><img src="Resimler/eksi.jpg" border="0" style="margin-top: 5px;"></a>
                                        <?php
                                        }else{
                                        ?>
                                        &nbsp;
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td width="30" align="center"><?php echo DonusumleriGeriDondur($SepettekiUrunAdedi); ?></td>
                                    <td width="30" align="center"><a href="index.php?SK=96&ID=<?php echo DonusumleriGeriDondur($SepetId); ?>"><img src="Resimler/arti.jpg" border="0" style="margin-top: 5px;"></a></td>
                                </tr>
                            </table></td>
                            <td width="150" style="border-bottom: 1px dashed #CCCCCC;" align="right">
                                <?php echo $UrunFiyatiBicimlendir; ?> TL<br />
                                <?php echo $UrununToplamFiyatiBicimlendir; ?> TL
                            </td>
                        </tr>
                        
                    </table></td>
                </tr>


                <?php
                    }
                }else{
                    $SepettekiToplamUrunSayisi  =0;
                    $SepettekiToplamFiyat       =0;
                ?>

                <tr height="30">
                    <td  valign="bottom" align="left">Alışveriş Sepetinizde Herhangi Bir Ürün Bulunmamaktadır.</td>
                </tr>

                <?php
                }
                ?>
            
          </table>
        </td>



           <td width="15">&nbsp;</td>



     <td width="250" valign="top">
        <table width="250"  align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td  style="color: #FF9900" align="right"><h3>Sipariş Özeti</h3></td>
             </tr>

             <tr height="30">
               <td valign="top" style="border-bottom: 1px dashed #CCCCCC;" align="right">Toplam <b style="color: red;"><?php echo $SepettekiToplamUrunSayisi; ?></b> Adet Ürün</td>
             </tr>

             <tr height="30">
               <td height="5" style="font-size: 5px;">&nbsp;</td>
             </tr>

             <tr>
               <td align="right">Ödenecek Tutar (KDV Dahil)</td>
             </tr>
             <tr>
               <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo FiyatBicimlendir($SepettekiToplamFiyat); ?></td>
             </tr>
             <tr height="10">
               <td height="5" style="font-size: 5px;">&nbsp;</td>
             </tr>
             <tr>
                <td align="right">
                    <a href="index.php?SK=97" class="SepetIciDevamEtVeAlisverisiTamamlaButonu"> DEVAM ET </a>
                </td>
             </tr>
          </table>
        </td>
    </tr>
</table>

    
<?php
}else{
    header("Location: index.php");
    exit();
}

?>