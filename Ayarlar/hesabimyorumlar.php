<?php

if(isset($_SESSION["Kullanici"])){

    $SayfalamaIcınSolVeSagButonSayisi    = 2;
    $SayfaBasinaGosterilecekKayitSayisi  = 10;

        $ToplamKayitSayisiSorgusu           =  $VeriTabaniBaglantisi->prepare("SELECT * FROM yorumlar  WHERE UyeId=? ORDER BY YorumTarihi DESC");
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
    <td><hr /></td>
  </tr>
  

    <tr>
        <td width="1065" valign="top">
          <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
             <tr height="40">
               <td colspan="2" style="color: #FF9900"><h3>Hesabım > Yorumlar</h3></td>
             </tr>

             <tr height="30">
               <td colspan="2" valign="top" style="border-bottom: 1px dashed #CCCCCC;">Tüm Yorumlarınızı Bu Alandan Görüntüleyebilirsiniz.</td>
             </tr>

             <tr height="50">
                <td width="125" style="background: #f8ffa7; color: black;" align="left">&nbsp;Puan</td>
                <td width="75" style="background: #f8ffa7; color: black;" align="left">Yorum&nbsp;</td>
             </tr>

             <?php
                 $YorumlarSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM yorumlar WHERE UyeId=? ORDER BY YorumTarihi DESC LIMIT 
                 $SayfalamayaBaslanacakKayitSayisi,$SayfaBasinaGosterilecekKayitSayisi");
                 $YorumlarSorgusu->execute([$KullaniciID]);
                 $YorumlarSayisi     = $YorumlarSorgusu->rowCount();
                 $YorumlarKayitlari  = $YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);


                 if($YorumlarSayisi>0){
                    foreach($YorumlarKayitlari as $Satirlar) {
                        $VerilenPuan    =   $Satirlar["Puan"];
                        if($VerilenPuan==1){
                            $ResimDosyai    =   "";
                        }elseif($VerilenPuan==2){
                            $ResimDosyai    =   "";
                        }elseif($VerilenPuan==3){
                            $ResimDosyai    =   "";
                        }elseif($VerilenPuan==4){
                            $ResimDosyai    =   "";
                        }elseif($VerilenPuan==5){
                            $ResimDosyai    =   "";
                        }
            ?>

            <tr height="40">
                <td width="85" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 15px 0px;" valing="top">
                <img src="Resimler/<?php echo $ResimDosyai; ?>" border="0"></td>
                <td width="980" align="left" style="border-bottom: 1px dashed #CCCCCC; padding: 15px 0px;;" valing="top">
                <?php echo DonusumleriGeriDondur($Satirlar["YorumMetni"]); ?></td>
             </tr>

            <?php
                  }
            ?>

            <?php
                if($BulunanSayfaSayisi>1){
            ?>

            <tr height="50">
                <td colspan="2" align="center">
                    <div class="SayfalamaAlaniKapsayicisi">
                        <div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
                            Toplam <?php echo $BulunanSayfaSayisi; ?> Sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> Adet Kayıt Bulunmaktadır.
                        </div>
                        <div class="SayfalamaAlaniIciNumaraAlaniKapsayicisi">
                            <?php
                            if($Sayfalama>1){
                                echo "<span class='SayfalamaAktif'><a href='index.php?SK=60&SYF=1'><<</a></span>";
                                $SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama-1;
                                echo "<span class='SayfalamaAktif'><a href='index.php?SK=60&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
                            }

                            for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama-$SayfalamaIcınSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= 
                            $Sayfalama+$SayfalamaIcınSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++) {

                                if(($SayfalamaIcinSayfaIndexDegeri>0) && ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)){
                                    if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
                                        echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
                                    }else{
                                        echo "<span class='SayfalamaPasif'><a href='index.php?SK=60&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'>" . 
                                        $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
                                    }
                                }
                            }

                            if($Sayfalama != $BulunanSayfaSayisi){
                                $SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama+1;
                                echo "<span class='SayfalamaAktif'><a href='index.php?SK=60&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
                                echo "<span class='SayfalamaAktif'><a href='index.php?SK=60&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
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
                <td colspan="2" align="left"> Sisteme Kayıtlı Yorumunuz Bulunmamakadır. </td>
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