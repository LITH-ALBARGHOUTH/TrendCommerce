<?php
if(isset($_SESSION["Yonetici"])){

$SayfalamaIcınSolVeSagButonSayisi       = 2;
$SayfaBasinaGosterilecekKayitSayisi     = 10;

$ToplamKayitSayisiSorgusu               =  $VeriTabaniBaglantisi->prepare("SELECT * FROM yorumlar ORDER BY id DESC");
$ToplamKayitSayisiSorgusu->execute();
$ToplamKayitSayisiSorgusu               =  $ToplamKayitSayisiSorgusu->rowCount();
$SayfalamayaBaslanacakKayitSayisi       =  ($Sayfalama*$SayfaBasinaGosterilecekKayitSayisi)-$SayfaBasinaGosterilecekKayitSayisi;
$BulunanSayfaSayisi                     =  ceil($ToplamKayitSayisiSorgusu/$SayfaBasinaGosterilecekKayitSayisi);
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;YORUMLAR</h3></td>
        </tr>
        <tr height="10">
            <td style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php
        $YorumlarSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM yorumlar ORDER BY id DESC LIMIT $SayfalamayaBaslanacakKayitSayisi,$SayfaBasinaGosterilecekKayitSayisi");
        $YorumlarSorgusu->execute();
        $YorumlarSayisi         = $YorumlarSorgusu->rowCount();
        $YorumlarKayitlari      = $YorumlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($YorumlarSayisi>0){
                foreach($YorumlarKayitlari as $Yorumlar){
                    if(DonusumleriGeriDondur($Yorumlar["Puan"]) == "1"){
                        $PuanResmi      =   "";
                    }elseif(DonusumleriGeriDondur($Yorumlar["Puan"]) == "2"){
                        $PuanResmi      =   "";
                    }elseif(DonusumleriGeriDondur($Yorumlar["Puan"]) == "3"){
                        $PuanResmi      =   "";
                    }elseif(DonusumleriGeriDondur($Yorumlar["Puan"]) == "4"){
                        $PuanResmi      =   "";
                    }elseif(DonusumleriGeriDondur($Yorumlar["Puan"]) == "5"){
                        $PuanResmi      =   "";
                    }

        ?>
        

        <tr height="105">
            <td style="border-bottom: 1px dashed #CCCCCC;" valign="top" >
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="685"><img src="../Resimler/<?php echo $PuanResmi; ?>" border="0"></td>
                        <td width="10"><b>&nbsp;</b></td>
                        <td width="55">
                            <table width="55" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="40">&nbsp;</td>
                                    <td width="25" valign="top" align="left"><a href="index.php?SKD=0&SKI=91&ID=<?php echo DonusumleriGeriDondur($Yorumlar["id"]) ?>">
                                    <img src="../Resimler/carpi.jpg" border="0" style="margin-top: 5px;"></a></td>
                                    <td width="30"  align="left"><a href="index.php?SKD=0&SKI=91&ID=<?php echo DonusumleriGeriDondur($Yorumlar["id"]) ?>" 
                                    style="color: #FF0000; text-decoration: none;">Sil</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><?php echo DonusumleriGeriDondur($Yorumlar["YorumMetni"]); ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php
            }
        if($BulunanSayfaSayisi>1){
        ?>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr height="50">
            <td align="center">

                <div class="SayfalamaAlaniKapsayicisi">
                    <div class="SayfalamaAlaniIciMetinAlaniKapsayicisi">
                        Toplam <?php echo $BulunanSayfaSayisi; ?> Sayfada, <?php echo $ToplamKayitSayisiSorgusu; ?> Adet Kayıt Bulunmaktadır.
                    </div>
                    <div class="SayfalamaAlaniIciNumaraAlaniKapsayicisi">
                        <?php
                        if($Sayfalama>1){
                            echo "<span class='SayfalamaAktif'><a href='index.php?SKD=0&SKI=90&SYF=1'><<</a></span>";
                            $SayfalamaIcinSayfaDegeriniBirGeriAl = $Sayfalama-1;
                            echo "<span class='SayfalamaAktif'><a href='index.php?SKD=0&SKI=90&SYF=" . $SayfalamaIcinSayfaDegeriniBirGeriAl . "'><</a></span>";
                        }
                        for($SayfalamaIcinSayfaIndexDegeri = $Sayfalama-$SayfalamaIcınSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri <= 
                        $Sayfalama+$SayfalamaIcınSolVeSagButonSayisi; $SayfalamaIcinSayfaIndexDegeri++) {

                            if(($SayfalamaIcinSayfaIndexDegeri>0) && ($SayfalamaIcinSayfaIndexDegeri <= $BulunanSayfaSayisi)){
                                if($Sayfalama==$SayfalamaIcinSayfaIndexDegeri){
                                    echo "<span class='SayfalamaAktif'>" . $SayfalamaIcinSayfaIndexDegeri . "</span>";
                                }else{
                                    echo "<span class='SayfalamaPasif'><a href='index.php?SKD=0&SKI=90&SYF=" . $SayfalamaIcinSayfaIndexDegeri . "'>" . 
                                    $SayfalamaIcinSayfaIndexDegeri . "</a></span>";
                                }
                            }
                        }
                        if($Sayfalama != $BulunanSayfaSayisi){
                            $SayfalamaIcinSayfaDegeriniBirIleriAl = $Sayfalama+1;
                            echo "<span class='SayfalamaAktif'><a href='index.php?SKD=0&SKI=90&SYF=" . $SayfalamaIcinSayfaDegeriniBirIleriAl . "'>></a></span>";
                            echo "<span class='SayfalamaAktif'><a href='index.php?SKD=0&SKI=90&SYF=" . $BulunanSayfaSayisi . "'>>></a></span>";
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
            <td>
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="750">Kayıtlı Yorum Bulunmamaktadır.</td>
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
