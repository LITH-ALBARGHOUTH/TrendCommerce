<?php
if(isset($_SESSION["Yonetici"])){

if(isset($_REQUEST["AramaIcerigi"])){
    $GeleAramaIcerigi       =    Guvenlik($_REQUEST["AramaIcerigi"]);
    $AramaKosulu            =    " AND ( UrunAdi LIKE'%" . $GeleAramaIcerigi . "%') ";
    $SayfalamaKosulu        =   "&AramaIcerigi=". $GeleAramaIcerigi;
}else{
    $GeleAramaIcerigi       =    "";
    $AramaKosulu            =    "";
    $SayfalamaKosulu        =    "";
}

$SayfalamaIcınSolVeSagButonSayisi       = 2;
$SayfaBasinaGosterilecekKayitSayisi     = 5;

$ToplamKayitSayisiSorgusu               =  $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE Durumu= ? $AramaKosulu ORDER BY id DESC");
$ToplamKayitSayisiSorgusu->execute([1]);
$ToplamKayitSayisiSorgusu               =  $ToplamKayitSayisiSorgusu->rowCount();
$SayfalamayaBaslanacakKayitSayisi       =  ($Sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
$BulunanSayfaSayisi                     =  ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);


?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;ÜRÜNLER</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=95" style="color: #FFFFFF; text-decoration: none;">+ Yeni Ürün Ekle&nbsp;</a></td>
        </tr>

        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <tr>
            <td colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <div class="AramaAlani">
                                <form action="index.php?SKD=0&SKI=94" method="post" class="search-form">
                                    <div class="AramaAlaniButonKapsamaAlani"><input type="submit" value="" class="AramaAlaniButonu">

                                    </div>

                                    <div class="AramaAlaniInputKapsamaAlani"><input type="text" name="AramaIcerigi" class="AramaAlaniInputu">

                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php

        $UrunlerSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE Durumu= ? $AramaKosulu ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi,
        $SayfaBasinaGosterilecekKayitSayisi");
        $UrunlerSorgusu->execute([1]);
        $UrunlerSayisi         = $UrunlerSorgusu->rowCount();
        $UrunlerKayitlari      = $UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($UrunlerSayisi>0){
                foreach($UrunlerKayitlari as $Urunler){
                    $UrununMenuSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM menuler WHERE id=? LIMIT 1");
                    $UrununMenuSorgusu->execute([DonusumleriGeriDondur($Urunler["MenuId"])]);
                    $UrununMenuKayitlari      = $UrununMenuSorgusu->fetch(PDO::FETCH_ASSOC);

                    if($Urunler["UrunTuru"]=="Erkek Ayakkabısı"){
                        $ResimKlasoru   =   "Erkek";
                    }elseif($Urunler["UrunTuru"]=="Kadın Ayakkabısı"){
                        $ResimKlasoru   =   "Kadin";
                    }elseif($Urunler["UrunTuru"]=="Çocuk Ayakkabısı"){
                        $ResimKlasoru   =   "Cocuk";
                    }
        ?>
        

        <tr height="80">
            <td style="border-bottom: 1px dashed #CCCCCC;" valign="top" colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="60" valign="top">
                            <img src="../Resimler/UrunResimleri/<?php echo $ResimKlasoru; ?>/<?php echo DonusumleriGeriDondur($Urunler["UrunResmiBir"]); ?>" 
                            border="0" width="60" height="80">
                        </td>
                        <td width="10">&nbsp;</td>
                        <td width="680" valign="top">
                            <table width="680" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr height="25">
                                    <td colspan="2">
                                        <?php echo DonusumleriGeriDondur($Urunler["UrunTuru"]); ?> -> <?php echo DonusumleriGeriDondur($UrununMenuKayitlari["MenuAdi"]); ?> 
                                    </td>
                                </tr>
                                <tr height="25">
                                    <td width="580">
                                        <?php echo DonusumleriGeriDondur($Urunler["UrunAdi"]); ?>
                                    </td>
                                    <td width="100" align="right">
                                        <?php echo FiyatBicimlendir(DonusumleriGeriDondur($Urunler["UrunFiyati"])); ?> <?php echo DonusumleriGeriDondur($Urunler["ParaBirimi"]); ?>
                                    </td>
                                </tr>
                                <tr height="25">
                                    <td width="540">
                                        <?php echo DonusumleriGeriDondur($Urunler["ToplamSatisSayisi"]); ?> Adet Satıldı.
                                        <?php echo DonusumleriGeriDondur($Urunler["YorumSayisi"]); ?> Adet Yorumda.
                                        <?php echo DonusumleriGeriDondur($Urunler["ToplamYorumPuani"]); ?> Puan Aldı.
                                        <?php echo DonusumleriGeriDondur($Urunler["GoruntulenmeSayisi"]); ?> Defa Görüntülendi.
                                    </td>
                                    <td width="140">
                                        <table width="140" align="right" border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="25" valign="top"><a href="index.php?SKD=0&SKI=99&ID=<?php echo DonusumleriGeriDondur($Urunler["id"]) ?>">
                                                <img src="../Resimler/" border="0"></a></td>
                                                <td width="70" valign="top"><a href="index.php?SKD=0&SKI=99&ID=<?php echo DonusumleriGeriDondur($Urunler["id"]) ?>" 
                                                style="color: #0000FF; text-decoration: none;">Güncelle</a></td>
                                                <td width="25" valign="top"><a href="index.php?SKD=0&SKI=103&ID=<?php echo DonusumleriGeriDondur($Urunler["id"]) ?>">
                                                <img src="../Resimler/carpi.jpg" border="0"></a></td>
                                                <td width="20" valign="top"><a href="index.php?SKD=0&SKI=103&ID=<?php echo DonusumleriGeriDondur($Urunler["id"]) ?>" 
                                                style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php
            }
        if($BulunanSayfaSayisi>1){
        ?>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr height="50">
            <td colspan="2" align="center">

                <div class="SayfalamaAlaniKapsayicisi">
                    <div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
                        Toplam <?php echo $BulunanSayfaSayisi; ?> Sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> Adet Kayıt Bulunmaktadır.
                    </div>
                    <div class="SayfalamaAlaniIciNumaraAlaniKapsayicisi">
                        <?php
                        if($Sayfalama>1){
                            echo "<span class='SayfalamaAktif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&SYF=1'><<</a></span>";
                            $SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama-1;
                            echo "<span class='SayfalamaAktif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
                        }
                        for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama-$SayfalamaIcınSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= 
                        $Sayfalama+$SayfalamaIcınSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++) {

                            if(($SayfalamaIcinSayfaIndexDegeri>0) && ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)){
                                if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
                                    echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
                                }else{
                                    echo "<span class='SayfalamaPasif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'>" . 
                                    $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
                                }
                            }
                        }
                        if($Sayfalama != $BulunanSayfaSayisi){
                            $SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama+1;
                            echo "<span class='SayfalamaAktif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
                            echo "<span class='SayfalamaAktif'><a href='index.php?SKD=0&SKI=94" . $SayfalamaKosulu . "&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
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

        <tr>
            <td colspan="2">
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="750">Kayıtlı Ürün Bulunmamaktadır.</td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php

        }

        ?>

    </table>
<?php
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
