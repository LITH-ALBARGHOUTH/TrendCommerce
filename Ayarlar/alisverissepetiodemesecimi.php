<?php

if(isset($_SESSION["Kullanici"])) {

    if(isset($_POST["AdresSecimi"])){
        $GelenAdresSecimi            = Guvenlik($_POST["AdresSecimi"]);
    }else{
        $GelenAdresSecimi            = "";
    }
    if(isset($_POST["KargoSecimi"])){
        $GelenKargoSecimi            = Guvenlik($_POST["KargoSecimi"]);
    }else{
        $GelenKargoSecimi            = "";
    }
    if(($GelenAdresSecimi!="") && ($GelenKargoSecimi!="")){

        $SepetiGuncellemeSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE sepet SET KargoId=? , AdresId=? WHERE UyeId=?");
        $SepetiGuncellemeSorgusu->execute([$GelenKargoSecimi,$GelenAdresSecimi,$KullaniciID]);
        $SepetiGuncellemeKontrol = $SepetiGuncellemeSorgusu->rowCount();

        $StokIcinSepettekiUrunlerSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?");
        $StokIcinSepettekiUrunlerSorgusu->execute([$KullaniciID]);
        $StokIcinSepettekiUrunSayisi = $StokIcinSepettekiUrunlerSorgusu->rowCount();
        $StokIcinSepettekiUrunKayitlari = $StokIcinSepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

        if($StokIcinSepettekiUrunSayisi > 0) {
            foreach($StokIcinSepettekiUrunKayitlari as $StokIcinSepettekiSatirlar) {
                $StokIcinSepetId = $StokIcinSepettekiSatirlar["id"];
                $StokIcinSepettekiVaryantId = $StokIcinSepettekiSatirlar["VaryantId"];
                $StokIcinSepettekiUrunAdedi = $StokIcinSepettekiSatirlar["UrunAdedi"];

                $StokIcinUrunVaryantBilgileriSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
                $StokIcinUrunVaryantBilgileriSorgusu->execute([$StokIcinSepettekiVaryantId]);
                $StokIcinUrunVaryantBilgileriKayitlari = $StokIcinUrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                    
                    $StokIcinUrununStokAdedi = $StokIcinUrunVaryantBilgileriKayitlari["StokAdedi"];
                    if($StokIcinUrununStokAdedi == 0) {
                        $SepetSilSorgusu = $VeriTabaniBaglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
                        $SepetSilSorgusu->execute([$StokIcinSepetId, $KullaniciID]);
                    } elseif($StokIcinSepettekiUrunAdedi > $StokIcinUrununStokAdedi) {
                        $SepetGuncellemeSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE sepet SET UrunAdedi = ? WHERE id = ? AND UyeId = ? LIMIT 1");
                        $SepetGuncellemeSorgusu->execute([$StokIcinUrununStokAdedi, $StokIcinSepetId, $KullaniciID]);
                    }
            }
        }



    $SepettekiUrunlerSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ? ORDER BY id DESC");
    $SepettekiUrunlerSorgusu->execute([$KullaniciID]);
    $SepettekiUrunSayisi        = $SepettekiUrunlerSorgusu->rowCount();
    $SepettekiUrunKayitlari     = $SepettekiUrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

    if($SepettekiUrunSayisi > 0) {
        $SepettekiToplamUrunSayisi          = 0;
        $SepettekiToplamFiyat               = 0;
        $SepettekiToplamKargoFiyatiHesapla  = 0;
        $OdenecekToplamTutariHesapla        = 0;

        foreach($SepettekiUrunKayitlari as $SepetSatirlari) {
            $SepetId            = $SepetSatirlari["id"];
            $SepettekiUrunId    = $SepetSatirlari["UrunId"];
            $SepettekiVaryantId = $SepetSatirlari["VaryantId"];
            $SepettekiUrunAdedi = $SepetSatirlari["UrunAdedi"];

            $UrunBilgileriSorgusu   = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
            $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
            $UrunBilgileriKayitlari = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                $UrununFiyati       = $UrunBilgileriKayitlari["UrunFiyati"];
                $UrununParaBirimi   = $UrunBilgileriKayitlari["ParaBirimi"];
                $UrununKargoUcreti  = $UrunBilgileriKayitlari["KargoUcreti"];



                if($UrununParaBirimi=="USD"){
                    $UrunFiyatiHesapla      =  $UrununFiyati*$DolarKuru;
                    $UrunFiyatiBicimlendir  =  FiyatBicimlendir($UrunFiyatiHesapla);
                }elseif($UrununParaBirimi=="EUR"){
                    $UrunFiyatiHesapla      =  $UrununFiyati*$EuroKuru;
                    $UrunFiyatiBicimlendir  =  FiyatBicimlendir($UrunFiyatiHesapla);
                }else{
                    $UrunFiyatiHesapla      =  $UrununFiyati;
                    $UrunFiyatiBicimlendir  =  FiyatBicimlendir($UrunFiyatiHesapla);
                }
                $UrununToplamFiyatiHesapla     = ($UrunFiyatiHesapla * $SepettekiUrunAdedi);
                $UrununToplamFiyatiBicimlendir = FiyatBicimlendir($UrununToplamFiyatiHesapla);

                $SepettekiToplamUrunSayisi              += $SepettekiUrunAdedi;
                $SepettekiToplamFiyat                   += ($UrunFiyatiHesapla * $SepettekiUrunAdedi);

                $SepettekiToplamKargoFiyatiHesapla      += ($UrununKargoUcreti*$SepettekiUrunAdedi);
                $SepettekiToplamKargoFiyatiBicimlendir   = FiyatBicimlendir($SepettekiToplamKargoFiyatiHesapla);

        }          
                if($SepettekiToplamFiyat>=$UcretsizKargoBaraji){
                    $SepettekiToplamKargoFiyatiHesapla       = 0;
                    $SepettekiToplamKargoFiyatiBicimlendir   = FiyatBicimlendir($SepettekiToplamKargoFiyatiHesapla);
                    $OdenecekToplamTutariBicimlendir         = FiyatBicimlendir($SepettekiToplamFiyat);
                }else{
                    $OdenecekToplamTutariHesapla             = ($SepettekiToplamFiyat+$SepettekiToplamKargoFiyatiHesapla);
                    $OdenecekToplamTutariBicimlendir         = FiyatBicimlendir($OdenecekToplamTutariHesapla);
                }

                $IkiTaksitAylikOdemeTutari        =   number_format(($SepettekiToplamFiyat/2), "2" , "," , ".");
                $UcTaksitAylikOdemeTutari         =   number_format(($SepettekiToplamFiyat/3), "2" , "," , ".");
                $DortTaksitAylikOdemeTutari       =   number_format(($SepettekiToplamFiyat/4), "2" , "," , ".");
                $BesTaksitAylikOdemeTutari        =   number_format(($SepettekiToplamFiyat/5), "2" , "," , ".");
                $AltiTaksitAylikOdemeTutari       =   number_format(($SepettekiToplamFiyat/6), "2" , "," , ".");
                $YediTaksitAylikOdemeTutari       =   number_format(($SepettekiToplamFiyat/7), "2" , "," , ".");
                $SekizTaksitAylikOdemeTutari      =   number_format(($SepettekiToplamFiyat/8), "2" , "," , ".");
                $DokuzTaksitAylikOdemeTutari      =   number_format(($SepettekiToplamFiyat/9), "2" , "," , ".");
    }    

?>
<form action="index.php?SK=99" method="post">
    <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="800" valign="top">
                <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td style="color: #FF9900"><h3>Alışveriş Sepeti</h3></td>
                    </tr>
                    <tr height="30">
                        <td valign="top" style="border-bottom: 1px dashed #CCCCCC;">Ödeme Türü Seçimini Aşağıdan Yapabilirsiniz.</td>
                    </tr>
                    <tr height="50">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40">
                        <td align="left" style="background: #CCCCCC; font-weight: bold;">&nbsp;Ödeme Türü Seçimi</td>
                    </tr>

                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>


                            <tr height="100">
                                <td align="left">
                                    <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="390" align="left">
                                                <table width="400" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><img src="Resimler/KrediKarti92x75.png" border="0"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><input type="radio" name="OdemeTuruSecimi" value="Kredi Kartı" checked="checked" onClick="$.KrediKartiSecildi();"></td>
                                                    </tr>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td width="20">&nbsp;</td>

                                            <td width="390" align="left">
                                                <table width="400" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><img src="Resimler/BankaHavalesi80x75.png" border="0"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center"><input type="radio" name="OdemeTuruSecimi" value="Banka Havalesi" onClick="$.BankaHavalesiSecildi();"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                </table>
                                            </td> 
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                    <tr height="10">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>




                    <tr height="40" class="KKAlanlari">
                        <td width="800" height="40" align="left" bgcolor="#CCCCCC"><b>&nbsp;Kredi Kartı İle Ödeme</b></td>
                    </tr >
                    <tr height="10" class="KKAlanlari">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40" class="KKAlanlari">
                        <td width="800" height="40" align="left">&nbsp;Ödeme İşlemini Bütün Kredi Kartları ile Veya Banka Kartları İle Yapabilirsiniz</td>
                    </tr>
                    <tr height="10" class="KKAlanlari">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr class="KKAlanlari">
                        <td>
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="192">

                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><img src="Resimler/" border="0"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>

                                    </td>
                                    <td width="11">&nbsp;</td>
                                    <td width="192">

                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><img src="Resimler/" border="0"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>

                                    </td>
                                    <td width="11">&nbsp;</td>
                                    <td width="192">

                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><img src="Resimler/" border="0"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>

                                    </td>
                                    <td width="10">&nbsp;</td>
                                    <td width="192">

                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><img src="Resimler/" border="0"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>

                                    </td>
                                </tr>

                                <tr>
                                    <td width="192">

                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><img src="Resimler/" border="0"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>

                                    </td>
                                    <td width="11">&nbsp;</td>
                                    <td width="192">

                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><img src="Resimler/" border="0"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>

                                    </td>
                                    <td width="11">&nbsp;</td>
                                    <td width="192">

                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><img src="Resimler/" border="0"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>

                                    </td>
                                    <td width="10">&nbsp;</td>
                                    <td width="192">

                                    <table width="192" align="center" border="0" cellpadding="0" cellspacing="0" style="border: 1px solid #CCCCCC; margin-bottom: 10px;">
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td align="center"><img src="Resimler/" border="0"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                                    
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>





                    <tr height="40" class="KKAlanlari">
                        <td width="800" height="40" align="left" bgcolor="#CCCCCC"><b>&nbsp;Taksit Seçimi</b></td>
                    </tr>
                    <tr height="10" class="KKAlanlari">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40" class="KKAlanlari">
                        <td width="800" height="40" align="left">&nbsp;Lütfen Kullanmak İstediğiniz Taksit İşlemini Seçiniz</td>
                    </tr>
                    <tr height="10" class="KKAlanlari">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="1" checked="checked" ></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">Tek Çekim</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">1 x <?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30" class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="2"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">2 Taksit</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">2 x <?php echo $IkiTaksitAylikOdemeTutari; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr height="30" class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="3"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">3 Taksit</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">3 x <?php echo $UcTaksitAylikOdemeTutari; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr height="30" class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="4"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">4 Taksit</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">4 x <?php echo $DortTaksitAylikOdemeTutari; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr height="30" class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="5"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">5 Taksit</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">5 x <?php echo $BesTaksitAylikOdemeTutari; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr height="30" class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="6"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">6 Taksit</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">6 x <?php echo $AltiTaksitAylikOdemeTutari; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr height="30" class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="7"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">7 Taksit</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">7 x <?php echo $YediTaksitAylikOdemeTutari; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr height="30" class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="8"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">8 Taksit</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">8 x <?php echo $SekizTaksitAylikOdemeTutari; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <tr height="30" class="KKAlanlari">
                        <td align="left">
                            <table width="800" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr height="30">
                                    <td width="25" align="left" style="border-bottom: 1px dashed #CCCCCC;"><input type="radio" name="TaksitSecimi" value="9"></td>
                                    <td width="375" align="left" style="border-bottom: 1px dashed #CCCCCC;">9 Taksit</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;">9 x <?php echo $DokuzTaksitAylikOdemeTutari; ?> TL</td>
                                    <td width="200" align="right" style="border-bottom: 1px dashed #CCCCCC;"><?php echo $OdenecekToplamTutariBicimlendir; ?> TL</td>
                                </tr>

                            </table>
                        </td>
                    </tr>


                    <tr height="40" class="BHAlanlari" style="display: none;">
                        <td width="800" height="40" align="left" bgcolor="#CCCCCC"><b>&nbsp;Banka Havalesi / EFT İle Ödeme</b></td>
                    </tr>
                    <tr height="10" class="BHAlanlari" style="display: none;">
                        <td style="font-size: 10px;">&nbsp;</td>
                    </tr>
                    <tr height="40" class="BHAlanlari" style="display: none;">
                        <td width="800" height="40" align="left">&nbsp;Banka Havalesi / EFT İle ürün satın alabilmek için öncelikle alışveriş sepeti tutarını "Banka Hesaplarımız" sayfasında bulunan herhangi bir hesaba ödeme yaptıktan sonra
                            "Havale Bildirim Formu" aracılığı ile lütfen tarafımıza bilgi veriniz.
                        </td>
                    </tr>
                    
    
                </table>
            </td>

                    <td width="15">&nbsp;</td>
                    <td width="250" valign="top">
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tr height="40">
                                <td style="color: #FF9900" align="right"><h3>Sipariş Özeti</h3></td>
                            </tr>
                            <tr height="30">
                                <td valign="top" style="border-bottom: 1px dashed #CCCCCC;" align="right">Toplam <b style="color: red;"><?php echo $SepettekiToplamUrunSayisi; ?></b> Adet Ürün</td>
                            </tr>
                            <tr height="5">
                                <td height="5" style="font-size: 5px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right">Ödenecek Tutar (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $OdenecekToplamTutariBicimlendir; ?></td>
                            </tr>
                            <tr height="5">
                                <td height="5" style="font-size: 5px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right">Ürünlerin Toplam Tutarı (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo FiyatBicimlendir($SepettekiToplamFiyat); ?></td>
                            </tr>
                            <tr height="10">
                                <td style="font-size: 10px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right">Toplam Kargo Ücreti (KDV Dahil)</td>
                            </tr>
                            <tr>
                                <td align="right" style="font-size: 25px; font-weight: bold;"><?php echo $SepettekiToplamKargoFiyatiBicimlendir; ?> TL</td>
                            </tr>
                            <tr height="10">
                                <td style="font-size: 10px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <input type="submit" value="ALIŞVERİŞİ TAMAMLA" class="AlisverisiTamamlaButonu">
                                </td>
                            </tr>
                        </table>
                    </td>
        </tr>
    </table>
</form>
<?php
}else{
    header("Location: index.php");
    exit();
}
} else {
    header("Location: index.php");
    exit();
}
?>
