<table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">

    <tr>
        <td>
            <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                <?php
                $BannerSorgusu      = $VeriTabaniBaglantisi->prepare("SELECT * FROM bannerlar WHERE BannerAlani ='Ana Sayfa' ORDER BY GosterimSayisi 
                ASC LIMIT 1");
                $BannerSorgusu->execute();
                $BannerSayisi       = $BannerSorgusu->rowCount();
                $BannerKaydi       = $BannerSorgusu->fetch(PDO::FETCH_ASSOC);
                ?>

                <tr height="186">
                    <td><img src="Resimler/<?php echo $BannerKaydi["BannerResmi"]; ?>" border= "0"  ></td>
                </tr>

                <?php
                $BannerGuncelle      = $VeriTabaniBaglantisi->prepare("UPDATE bannerlar SET GosterimSayisi =GosterimSayisi+1 WHERE id=? LIMIT 1");
                $BannerGuncelle->execute([$BannerKaydi["id"]]);
                ?>
                
            </table>
        </td>
    </tr>

    <tr height="35">
        <td bgcolor="#FF9900" style="color: white; font-weight: bold;">&nbsp;En Yeni Ürünler</td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>




    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <?php
                    $EnYeniUrunlerSorgusu     = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE Durumu= '1' ORDER BY id DESC LIMIT 5"); 
                    $EnYeniUrunlerSorgusu->execute();
                    $EnYeniUrunSayisi         = $EnYeniUrunlerSorgusu->rowCount();
                    $EnYeniUrunKayitlari      = $EnYeniUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $EnYeniDonguSayisi        = 1;

                    foreach($EnYeniUrunKayitlari as $EnYeniUrunSatirlari) {
                        $EnYeniUrununTuru                 =   DonusumleriGeriDondur($EnYeniUrunSatirlari["UrunTuru"]);
                        $EnYeniUrununFiyati               =   DonusumleriGeriDondur($EnYeniUrunSatirlari["UrunFiyati"]);
                        $EnYeniUrununParaBirimi           =   DonusumleriGeriDondur($EnYeniUrunSatirlari["ParaBirimi"]);
                        if($EnYeniUrununParaBirimi=="USD"){
                            $EnYeniUrunFiyatiHesapla      =   $EnYeniUrununFiyati*$DolarKuru;
                        }elseif($EnYeniUrununParaBirimi=="EUR"){
                            $EnYeniUrunFiyatiHesapla      =   $EnYeniUrununFiyati*$EuroKuru;
                        }else{
                            $EnYeniUrunFiyatiHesapla      =   $EnYeniUrununFiyati;
                        }

                        if($EnYeniUrununTuru=="Erkek Ayakkabısı"){
                            $EnYeniUrunResimKlasoru      =   "Erkek";
                        }elseif($EnYeniUrununTuru=="Kadın Ayakkabısı"){
                            $EnYeniUrunResimKlasoru      =   "Kadin";
                        }elseif($EnYeniUrununTuru=="Çocuk Ayakkabısı"){
                            $EnYeniUrunResimKlasoru      =   "Cocuk";
                        }



                        $EnYeniUrununToplamYorumSayisi    =   DonusumleriGeriDondur($EnYeniUrunSatirlari["YorumSayisi"]);
                        $EnYeniUrununToplamYorumPuani     =   DonusumleriGeriDondur($EnYeniUrunSatirlari["ToplamYorumPuani"]);
                        if($EnYeniUrununToplamYorumSayisi>0){
                            $EnYeniPuanHesapla            =   number_format($EnYeniUrununToplamYorumPuani/$EnYeniUrununToplamYorumSayisi, 2, ".", "");
                        }else{
                            $EnYeniPuanHesapla            =   0;
                        }
                        if($EnYeniPuanHesapla==0){
                            $EnYeniPuanResmi= "";
                        }elseif(($EnYeniPuanHesapla>0) && ($EnYeniPuanHesapla<=1)){
                            $EnYeniPuanResmi= "";
                        }elseif(($EnYeniPuanHesapla>1) && ($EnYeniPuanHesapla<=2)){
                            $EnYeniPuanResmi= "";
                        }elseif(($EnYeniPuanHesapla>2) && ($EnYeniPuanHesapla<=3)){
                            $EnYeniPuanResmi= "";
                        }elseif(($EnYeniPuanHesapla>3) && ($EnYeniPuanHesapla<=4)){
                            $EnYeniPuanResmi= "";
                        }elseif($EnYeniPuanHesapla>4){
                            $EnYeniPuanResmi= "";
                        }

                    ?>
                    <td width="205" valign="top">
                        <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
                            <tr height="40">
                                <td align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnYeniUrunSatirlari["id"]); ?>"><img src="Resimler/UrunResimleri/<?php echo $EnYeniUrunResimKlasoru;?>/<?php 
                                echo DonusumleriGeriDondur($EnYeniUrunSatirlari['UrunResmiBir']); ?>" border="0" width="205" height="273"></a></td>
                            </tr>

                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnYeniUrunSatirlari["id"]); ?>" style='color: #FF9900; font-weight: bold; 
                                text-decoration: none;'><?php echo DonusumleriGeriDondur($EnYeniUrununTuru);?></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnYeniUrunSatirlari["id"]); ?>" style='color: #646464; font-weight: bold; 
                                text-decoration: none;'><div style=" width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo DonusumleriGeriDondur(
                                $EnYeniUrunSatirlari['UrunAdi']); ?></div></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnYeniUrunSatirlari["id"]); ?>"><img src="Resimler/<?php echo $EnYeniPuanResmi; ?>" border="0">
                                </a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnYeniUrunSatirlari["id"]); ?>" style='color: #0000FF; font-weight: bold; 
                                text-decoration: none;' ><?php echo FiyatBicimlendir($EnYeniUrunFiyatiHesapla); ?> TL</a></td>
                            </tr>

                        </table>
                    </td>

                    <?php
                        if($EnYeniDonguSayisi < 4) {
                    ?>
                    <td width="10">&nbsp;</td>
                    <?php
                        }
                        $EnYeniDonguSayisi++;
                    }
                    ?>

                </tr>
            </table>
        </td>
    </tr>






    <tr height="35">
        <td bgcolor="#FF9900" style="color: white; font-weight: bold;">&nbsp;En Popüler Ürünler</td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>


    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <?php
                    $EnPopulerUrunlerSorgusu     = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE Durumu= '1' ORDER BY GoruntulenmeSayisi DESC LIMIT 5");
                    $EnPopulerUrunlerSorgusu->execute();
                    $EnPopulerUrunSayisi         = $EnPopulerUrunlerSorgusu->rowCount();
                    $EnPopulerUrunKayitlari      = $EnPopulerUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $EnPopulerDonguSayisi        = 1;

                    foreach($EnPopulerUrunKayitlari as $EnPopulerUrunSatirlari) {
                        $EnPopulerUrununTuru                 =   DonusumleriGeriDondur($EnPopulerUrunSatirlari["UrunTuru"]);
                        $EnPopulerUrununFiyati               =   DonusumleriGeriDondur($EnPopulerUrunSatirlari["UrunFiyati"]);
                        $EnPopulerUrununParaBirimi           =   DonusumleriGeriDondur($EnPopulerUrunSatirlari["ParaBirimi"]);
                        if($EnPopulerUrununParaBirimi=="USD"){
                            $EnPopulerUrunFiyatiHesapla      =   $EnPopulerUrununFiyati*$DolarKuru;
                        }elseif($EnPopulerUrununParaBirimi=="EUR"){
                            $EnPopulerUrunFiyatiHesapla      =   $EnPopulerUrununFiyati*$EuroKuru;
                        }else{
                            $EnPopulerUrunFiyatiHesapla      =   $EnPopulerUrununFiyati;
                        }

                        if($EnPopulerUrununTuru=="Erkek Ayakkabısı"){
                            $EnPopulerUrunResimKlasoru      =   "Erkek";
                        }elseif($EnPopulerUrununTuru=="Kadın Ayakkabısı"){
                            $EnPopulerUrunResimKlasoru      =   "Kadin";
                        }elseif($EnPopulerUrununTuru=="Çocuk Ayakkabısı"){
                            $EnPopulerUrunResimKlasoru      =   "Cocuk";
                        }



                        $EnPopulerUrununToplamYorumSayisi    =   DonusumleriGeriDondur($EnPopulerUrunSatirlari["YorumSayisi"]);
                        $EnPopulerUrununToplamYorumPuani     =   DonusumleriGeriDondur($EnPopulerUrunSatirlari["ToplamYorumPuani"]);
                        if($EnPopulerUrununToplamYorumSayisi>0){
                            $EnPopulerPuanHesapla            =   number_format($EnPopulerUrununToplamYorumPuani/$EnPopulerUrununToplamYorumSayisi, 2, ".", "");
                        }else{
                            $EnPopulerPuanHesapla            =   0;
                        }
                        if($EnPopulerPuanHesapla==0){
                            $EnPopulerPuanResmi= "";
                        }elseif(($EnPopulerPuanHesapla>0) && ($EnPopulerPuanHesapla<=1)){
                            $EnPopulerPuanResmi= "";
                        }elseif(($EnPopulerPuanHesapla>1) && ($EnPopulerPuanHesapla<=2)){
                            $EnPopulerPuanResmi= "";
                        }elseif(($EnPopulerPuanHesapla>2) && ($EnPopulerPuanHesapla<=3)){
                            $EnPopulerPuanResmi= "";
                        }elseif(($EnPopulerPuanHesapla>3) && ($EnPopulerPuanHesapla<=4)){
                            $EnPopulerPuanResmi= "";
                        }elseif($EnPopulerPuanHesapla>4){
                            $EnPopulerPuanResmi= "";
                        }

                    ?>
                    <td width="205" valign="top">
                        <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
                            <tr height="40">
                                <td align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnPopulerUrunSatirlari["id"]); ?>"><img src="Resimler/UrunResimleri/<?php echo $EnPopulerUrunResimKlasoru;?>/<?php 
                                echo DonusumleriGeriDondur($EnPopulerUrunSatirlari['UrunResmiBir']); ?>" border="0" width="205" height="273"></a></td>
                            </tr>

                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnPopulerUrunSatirlari["id"]); ?>" style='color: #FF9900; font-weight: bold; 
                                text-decoration: none;'><?php echo DonusumleriGeriDondur($EnPopulerUrununTuru);?></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnPopulerUrunSatirlari["id"]); ?>" style='color: #646464; font-weight: bold; 
                                text-decoration: none;'><div style=" width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo DonusumleriGeriDondur(
                                $EnPopulerUrunSatirlari['UrunAdi']); ?></div></a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnPopulerUrunSatirlari["id"]); ?>"><img src="Resimler/<?php echo $EnPopulerPuanResmi; ?>" border="0">
                                </a></td>
                            </tr>
                            <tr height="25">
                                <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnPopulerUrunSatirlari["id"]); ?>" style='color: #0000FF; font-weight: bold; 
                                text-decoration: none;' ><?php echo FiyatBicimlendir($EnPopulerUrunFiyatiHesapla); ?> TL</a></td>
                            </tr>

                        </table>
                    </td>

                    <?php
                        if($EnPopulerDonguSayisi < 4) {
                    ?>
                    <td width="10">&nbsp;</td>
                    <?php
                        }
                        $EnPopulerDonguSayisi++;
                    }
                    ?>

                </tr>
            </table>
        </td>
    </tr>






    <tr height="35">
    <td bgcolor="#FF9900" style="color: white; font-weight: bold;">&nbsp;En Çok Satan Ürünler</td>
    </tr>

    <tr>
    <td>&nbsp;</td>
    </tr>


    <tr>
    <td>
        <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <?php
                $EnSatilanUrunlerSorgusu     = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE Durumu= '1' ORDER BY ToplamSatisSayisi DESC LIMIT 5");
                $EnSatilanUrunlerSorgusu->execute();
                $EnSatilanUrunSayisi         = $EnSatilanUrunlerSorgusu->rowCount();
                $EnSatilanUrunKayitlari      = $EnSatilanUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                $EnSatilanDonguSayisi        = 1;

                foreach($EnSatilanUrunKayitlari as $EnSatilanUrunSatirlari) {
                    $EnSatilanUrununTuru                 =   DonusumleriGeriDondur($EnSatilanUrunSatirlari["UrunTuru"]);
                    $EnSatilanUrununFiyati               =   DonusumleriGeriDondur($EnSatilanUrunSatirlari["UrunFiyati"]);
                    $EnSatilanUrununParaBirimi           =   DonusumleriGeriDondur($EnSatilanUrunSatirlari["ParaBirimi"]);
                    if($EnSatilanUrununParaBirimi=="USD"){
                        $EnSatilanUrunFiyatiHesapla      =   $EnSatilanUrununFiyati*$DolarKuru;
                    }elseif($EnSatilanUrununParaBirimi=="EUR"){
                        $EnSatilanUrunFiyatiHesapla      =   $EnSatilanUrununFiyati*$EuroKuru;
                    }else{
                        $EnSatilanUrunFiyatiHesapla      =   $EnSatilanUrununFiyati;
                    }

                    if($EnSatilanUrununTuru=="Erkek Ayakkabısı"){
                        $EnSatilanUrunResimKlasoru      =   "Erkek";
                    }elseif($EnSatilanUrununTuru=="Kadın Ayakkabısı"){
                        $EnSatilanUrunResimKlasoru      =   "Kadin";
                    }elseif($EnSatilanUrununTuru=="Çocuk Ayakkabısı"){
                        $EnSatilanUrunResimKlasoru      =   "Cocuk";
                    }



                    $EnSatilanUrununToplamYorumSayisi    =   DonusumleriGeriDondur($EnSatilanUrunSatirlari["YorumSayisi"]);
                    $EnSatilanUrununToplamYorumPuani     =   DonusumleriGeriDondur($EnSatilanUrunSatirlari["ToplamYorumPuani"]);
                    if($EnSatilanUrununToplamYorumSayisi>0){
                        $EnSatilanPuanHesapla            =   number_format($EnSatilanUrununToplamYorumPuani/$EnSatilanUrununToplamYorumSayisi, 2, ".", "");
                    }else{
                        $EnSatilanPuanHesapla            =   0;
                    }
                    if($EnSatilanPuanHesapla==0){
                        $EnSatilanPuanResmi= "";
                    }elseif(($EnSatilanPuanHesapla>0) && ($EnSatilanPuanHesapla<=1)){
                        $EnSatilanPuanResmi= "";
                    }elseif(($EnSatilanPuanHesapla>1) && ($EnSatilanPuanHesapla<=2)){
                        $EnSatilanPuanResmi= "";
                    }elseif(($EnSatilanPuanHesapla>2) && ($EnSatilanPuanHesapla<=3)){
                        $EnSatilanPuanResmi= "";
                    }elseif(($EnSatilanPuanHesapla>3) && ($EnSatilanPuanHesapla<=4)){
                        $EnSatilanPuanResmi= "";
                    }elseif($EnSatilanPuanHesapla>4){
                        $EnSatilanPuanResmi= "";
                    }

                ?>
                <td width="205" valign="top">
                    <table width="205" align="left" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 10px;">
                        <tr height="40">
                            <td align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnSatilanUrunSatirlari["id"]); ?>"><img src="Resimler/UrunResimleri/<?php echo $EnSatilanUrunResimKlasoru;?>/<?php 
                            echo DonusumleriGeriDondur($EnSatilanUrunSatirlari['UrunResmiBir']); ?>" border="0" width="205" height="273"></a></td>
                        </tr>

                        <tr height="25">
                            <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnSatilanUrunSatirlari["id"]); ?>" style='color: #FF9900; font-weight: bold; 
                            text-decoration: none;'><?php echo DonusumleriGeriDondur($EnSatilanUrununTuru);?></a></td>
                        </tr>
                        <tr height="25">
                            <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnSatilanUrunSatirlari["id"]); ?>" style='color: #646464; font-weight: bold; 
                            text-decoration: none;'><div style=" width: 205px; max-width: 205px; height: 20px; overflow: hidden; line-height: 20px;"><?php echo DonusumleriGeriDondur(
                            $EnSatilanUrunSatirlari['UrunAdi']); ?></div></a></td>
                        </tr>
                        <tr height="25">
                            <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnSatilanUrunSatirlari["id"]); ?>"><img src="Resimler/<?php echo $EnSatilanPuanResmi; ?>" border="0">
                            </a></td>
                        </tr>
                        <tr height="25">
                            <td width="205" align="center"><a href="index.php?SK=82&ID=<?php echo DonusumleriGeriDondur($EnSatilanUrunSatirlari["id"]); ?>" style='color: #0000FF; font-weight: bold; 
                            text-decoration: none;' ><?php echo FiyatBicimlendir($EnSatilanUrunFiyatiHesapla); ?> TL</a></td>
                        </tr>

                    </table>
                </td>

                <?php
                    if($EnSatilanDonguSayisi < 4) {
                ?>
                <td width="10">&nbsp;</td>
                <?php
                    }
                    $EnSatilanDonguSayisi++;
                }
                ?>

            </tr>
        </table>
    </td>
    </tr>

    <tr>
        <td>&nbsp;</td>
    </tr>


    <tr>
        <td>
            <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="258">
                    <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center"><img src="Resimler/" border="0"></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Bugün Teslimat</b></td>
                        </tr>
                        <tr>
                            <td align="center">Saat 14:00'a vereceğiniz tüm siparişler aynı gün kapınızda.</td>
                        </tr>
                    </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                    <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center"><img src="Resimler/" border="0"></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Tek Tıkla Güvenli Alışveriş</b></td>
                        </tr>
                        <tr>
                            <td align="center">Ödeme ve adres bilgilerinizi kaydedin, güvenli alışveriş yapın.</td>
                        </tr>
                    </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                    <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center"><img src="Resimler/" border="0"></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Mobil Erişim</b></td>
                        </tr>
                        <tr>
                            <td align="center">Dilediğiniz her cihazdan sitemize erişebilir ve alışveriş yapabilirsiniz.</td>
                        </tr>
                    </table>
                    </td>
                    <td width="11">&nbsp;</td>
                    <td width="258">
                    <table width="258" align="center" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center"><img src="Resimler/" border="0"></td>
                        </tr>
                        <tr>
                            <td align="center"><b>Kolay İade</b></td>
                        </tr>
                        <tr>
                            <td align="center">Aldığınız herhangi bir ürün 14 gün içerisinde kolaylıkla iade edebilirsiniz.</td>
                        </tr>
                    </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>



</table>