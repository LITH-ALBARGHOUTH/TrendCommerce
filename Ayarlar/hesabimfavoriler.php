<?php

if(isset($_SESSION["Kullanici"])){

    $SayfalamaIcınSolVeSagButonSayisi    = 2;
    $SayfaBasinaGosterilecekKayitSayisi  = 10;

        $ToplamKayitSayisiSorgusu           =  $VeriTabaniBaglantisi->prepare("SELECT * FROM favoriler WHERE UyeId=? ORDER BY id DESC");
        $ToplamKayitSayisiSorgusu->execute([$KullaniciID]);
        $ToplamKayitSayisiSorgusu           =  $ToplamKayitSayisiSorgusu->rowCount();

        $SayfalamayaBaslanacakKayitSayisi   =  ($Sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
        $BulunanSayfaSayisi                 =  ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
?> 

<table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">


  <tr>
    <td colspan="3"><hr /></td>
  </tr>

  <tr>
    <td colspan="3">
      <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=50" 
          style="text-decoration: none; color: black;">Üyelik Bilgileri</a></td>
          <td width="10">&nbsp;</td>
          <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=58" 
          style="text-decoration: none; color: black;">Adresler</a></td>
          <td width="10">&nbsp;</td>
          <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=59" 
          style="text-decoration: none; color: black;">Favoriler</a></td>
          <td width="10">&nbsp;</td>
          <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=60" 
          style="text-decoration: none; color: black;">Yorumlar</a></td>
          <td width="10">&nbsp;</td>
          <td width="203" style="border: 1px solid black; text-align: center; padding: 10px 0; font-weight: bold;"><a href="index.php?SK=61" 
          style="text-decoration: none; color: black;">Siparişler</a></td>
        </tr>
      </table>
    </td>
  </tr>

  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  

    <tr>
        <td width="1065" valign="top">
          <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td colspan="4" style="color: #FF9900"><h3>Hesabım > Favoriler</h3></td>
             </tr>

             <tr height="30">
               <td colspan="4" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Tüm Favori İlanlarınızı Buradan Görüntüleyebilirsiniz.</td>
             </tr>

             <tr height="50">
                <td width="75" style="background: #f8ffa7; color: black;" align="left">Ürün Resmi</td>
                <td width="25" style="background: #f8ffa7; color: black;" align="left">SİL</td>
                <td width="865" style="background: #f8ffa7; color: black;" align="center">Adı</td>
                <td width="100" style="background: #f8ffa7; color: black;" align="left">Fiyatı</td>
             </tr>

             <?php
                 $FavorilerSorgusu          = $VeriTabaniBaglantisi->prepare("SELECT * FROM favoriler WHERE UyeId=? ORDER BY id DESC LIMIT 
                 $SayfalamayaBaslanacakKayitSayisi,$SayfaBasinaGosterilecekKayitSayisi");
                 $FavorilerSorgusu->execute([$KullaniciID]);
                 $FavorilerSayisi           = $FavorilerSorgusu->rowCount();
                 $FavorilerKayitlari        = $FavorilerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                 if($FavorilerSayisi>0){
                    foreach($FavorilerKayitlari as $FavoriSatirlar) {

                        $UrunlerSorgusu     = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
                        $UrunlerSorgusu->execute([$FavoriSatirlar["UrunId"]]);
                        $UrunKaydi          = $UrunlerSorgusu->fetch(PDO::FETCH_ASSOC);

                        $UrununAdi          =   $UrunKaydi["UrunAdi"];
                        $UrununUrunTuru     =   $UrunKaydi["UrunTuru"];
                        $UrununResmi     =   $UrunKaydi["UrunResmiBir"];
                        $UrununUrunFiyati   =   $UrunKaydi["UrunFiyati"];
                        $UrununParaBirimi   =   $UrunKaydi["ParaBirimi"];

                    if($UrununUrunTuru == "Erkek Ayakkabısı"){
                        $ResimKlasoruAdi    =  "Erkek";
                    }elseif($UrununUrunTuru == "Kadın Ayakkabısı"){
                        $ResimKlasoruAdi    =  "Kadin";
                    }else{
                        $ResimKlasoruAdi    =  "Cocuk";
                    }


            ?>

            <tr height="30">
                <td width="75" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur(
                $UrunKaydi["id"]); ?>" style="color: #646464; text-decoration: none;"><img src="Resimler/UrunResimleri/<?php echo $ResimKlasoruAdi; ?>/
                <?php echo DonusumleriGeriDondur($UrununResmi);?>"border="0" width="60" height="80"></a></td>
                <td width="50" align="left" style="border-bottom: 1px dashed #CCCCCC;">
                <a href="index.php?SK=80&ID=<?php echo DonusumleriGeriDondur($FavoriSatirlar["id"]); ?>" style="color: #646464; text-decoration: none;">
                    <img src="Resimler/Sil.png" border="0"></a></td>
                <td width="415" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur(
                $UrunKaydi["id"]);?>" style="color: #646464; text-decoration: none;"><?php echo DonusumleriGeriDondur($UrununAdi);?></a></td>
                <td width="100" align="left" style="border-bottom: 1px dashed #CCCCCC;"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur(
                $UrunKaydi["id"]);?>" style="color: #646464; text-decoration: none;"><?php echo FiyatBicimlendir(DonusumleriGeriDondur($UrununUrunFiyati)); ?>
                <?php echo DonusumleriGeriDondur($UrununParaBirimi); ?></a></td>
             </tr>


            <?php
                  }
            ?>


            <?php
                if($BulunanSayfaSayisi>1){
            ?>

            <tr height="50">
                <td colspan="4" align="center">


                    <div class="SayfalamaAlaniKapsayicisi">
                        <div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
                            Toplam <?php echo $BulunanSayfaSayisi; ?> Sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> Adet Kayıt Bulunmaktadır.
                        </div>
                        <div class="SayfalamaAlaniIciNumaraAlaniKapsayicisi">
                            <?php
                            if($Sayfalama>1){
                                echo "<span class='SayfalamaAktif'><a href='index.php?SK=59&SYF=1'><<</a></span>";
                                $SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama-1;
                                echo "<span class='SayfalamaAktif'><a href='index.php?SK=59&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
                            }

                            for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama-$SayfalamaIcınSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= 
                            $Sayfalama+$SayfalamaIcınSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++) {

                                if(($SayfalamaIcinSayfaIndexDegeri>0) && ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)){
                                    if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
                                        echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
                                    }else{
                                        echo "<span class='SayfalamaPasif'><a href='index.php?SK=59&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'>" . 
                                        $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
                                    }
                                }
                            }

                            if($Sayfalama != $BulunanSayfaSayisi){
                                $SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama+1;
                                echo "<span class='SayfalamaAktif'><a href='index.php?SK=59&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
                                echo "<span class='SayfalamaAktif'><a href='index.php?SK=59&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
                            }
                            
                            ?>
                        </div>

                    </div>



                </td>
            </tr>


            <?php
            }
            }else{
            ?>
             
             <tr height="50">
                <td colspan="4" align="left"> Sisteme Kayıtlı Favori Ürününüz Bulunmamakadır. </td>
             </tr>

             <?php
             }
             ?>


             
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