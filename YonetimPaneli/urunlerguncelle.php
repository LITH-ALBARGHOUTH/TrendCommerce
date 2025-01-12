<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                  = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                  = "";
    }

    $UrunlerSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
    $UrunlerSorgusu->execute([$GelenID]);
    $UrunlerSayisi         = $UrunlerSorgusu->rowCount();
    $UrunlerBilgisi        = $UrunlerSorgusu->fetch(PDO::FETCH_ASSOC);

        if($UrunlerSayisi>0){


?>

<form action="index.php?SKD=0&SKI=100&ID=<?php echo DonusumleriGeriDondur($GelenID) ?>" method="post" enctype="multipart/form-data">
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;ÜRÜNLER</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=95" style="color: #FFFFFF; text-decoration: none;">+Yeni Ürün Ekle&nbsp;</a></td>
        </tr>

        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">

                    <tr height="40">
                        <td>Ürün Menüsü</td>
                        <td>:</td>
                        <td><select name="UrunMenusu" class="SelectAlanlari">
                            <?php
                            $MenulerSorgusu             =   $VeriTabaniBaglantisi->prepare("SELECT * FROM menuler WHERE UrunTuru=? ORDER BY UrunTuru ASC, MenuAdi ASC");
                            $MenulerSorgusu->execute([DonusumleriGeriDondur($UrunlerBilgisi["UrunTuru"])]);
                            $MenulerSayisi              =   $MenulerSorgusu->rowCount();
                            $MenulerKayitlari           =   $MenulerSorgusu->fetchAll(PDO::FETCH_ASSOC);
                            foreach($MenulerKayitlari as $MenuKaydi){
                            ?>
                                <option value="<?php echo DonusumleriGeriDondur($MenuKaydi["id"]); ?>" <?php if( DonusumleriGeriDondur($UrunlerBilgisi["MenuId"]) == 
                                DonusumleriGeriDondur($MenuKaydi["id"])){ ?>selected="selected"<?php } ?>><?php echo DonusumleriGeriDondur($MenuKaydi["MenuAdi"]); ?>
                                (<?php echo DonusumleriGeriDondur($MenuKaydi["UrunTuru"]); ?>)</option>
                            <?php
                            }
                            ?> 
                        </select></td>
                    </tr>
                    <tr height="40">
                        <td width="230">Ürün Adı</td>
                        <td width="20">:</td>
                        <td width="500"><input type="text" name="UrunAdi" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($UrunlerBilgisi["UrunAdi"]); ?>" ></td>
                    </tr>
                    <tr height="40">
                        <td>Ürün Fiyatı</td>
                        <td>:</td>
                        <td><input type="text" name="UrunFiyati" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($UrunlerBilgisi["UrunFiyati"]); ?>" ></td>
                    </tr>
                    <tr height="40">
                        <td>Para Birimi</td>
                        <td>:</td>
                        <td><select name="ParaBirimi" class="SelectAlanlari">
                            <option value="">Lütfen Seçiniz...</option>
                            <option value="TRY" <?php if( DonusumleriGeriDondur($UrunlerBilgisi["ParaBirimi"]) == "TRY"){ ?>selected="selected"<?php } ?> >Türk Lirası</option>
                            <option value="USD" <?php if( DonusumleriGeriDondur($UrunlerBilgisi["ParaBirimi"]) == "USD"){ ?>selected="selected"<?php } ?>>Amerikan Doları</option>
                            <option value="EUR" <?php if( DonusumleriGeriDondur($UrunlerBilgisi["ParaBirimi"]) == "EUR"){ ?>selected="selected"<?php } ?>>Euro</option>
                        </select></td>
                    </tr>
                    <tr height="40">
                        <td>Kargo Ücreti</td>
                        <td>:</td>
                        <td><input type="text" name="KargoUcreti" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($UrunlerBilgisi["KargoUcreti"]); ?>" ></td>
                    </tr>
                    <tr height="40">
                        <td>KDV Oranı</td>
                        <td>:</td>
                        <td><input type="text" name="KdvOrani" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($UrunlerBilgisi["KdvOrani"]); ?>" ></td>
                    </tr>
                    <tr height="40">
                        <td valign="top">Ürün Açıklaması</td>
                        <td valign="top">:</td>
                        <td><textarea name="UrunAciklamasi" class="TextAreaAlanlari" ><?php echo DonusumleriGeriDondur($UrunlerBilgisi["UrunAciklamasi"]); ?></textarea></td>
                    </tr>
                    <tr height="40">
                        <td>Ürün Resmi 1</td>
                        <td>:</td>
                        <td><input type="file" name="UrunResmiBir" ></td>
                    </tr>
                    <tr height="40">
                        <td>Ürün Resmi 2</td>
                        <td>:</td>
                        <td><input type="file" name="UrunResmiIki"></td>
                    </tr>
                    <tr height="40">
                        <td>Ürün Resmi 3</td>
                        <td>:</td>
                        <td><input type="file" name="UrunResmiUc"></td>
                    </tr>
                    <tr height="40">
                        <td>Ürün Resmi 4</td>
                        <td>:</td>
                        <td><input type="file" name="UrunResmiDort"></td>
                    </tr>
                    <tr height="40">
                        <td>Varyant Başlığı</td>
                        <td>:</td>
                        <td><input type="text" name="VaryantBasligi" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($UrunlerBilgisi["VaryantBasligi"]); ?>" ></td>
                    </tr>

                    <?php

                    $VaryantlarSorgusu          = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE UrunId=?");
                    $VaryantlarSorgusu->execute([$GelenID]);
                    $VaryantlarSayisi           = $VaryantlarSorgusu->rowCount();
                    $VaryantlarBilgisi          = $VaryantlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    $VaryantIsimDizisi          = array();
                    $VaryantStokDizisi          = array();

                    foreach($VaryantlarBilgisi as $Varyant){
                        $VaryantIsimDizisi[]          = $Varyant["VaryantAdi"];
                        $VaryantStokDizisi[]          = $Varyant["StokAdedi"];
                    }

                    if(array_key_exists(1,$VaryantIsimDizisi)){
                        $IkinciVaryantAdi       =   DonusumleriGeriDondur($VaryantIsimDizisi[1]);
                        $IkinciVaryantStok      =   DonusumleriGeriDondur($VaryantStokDizisi[1]);
                    }else{
                        $IkinciVaryantAdi       =   "";
                        $IkinciVaryantStok      =   "";
                    }
                    if(array_key_exists(2,$VaryantIsimDizisi)){
                        $UcuncuVaryantAdi       =   DonusumleriGeriDondur($VaryantIsimDizisi[2]);
                        $UcuncuVaryantStok      =   DonusumleriGeriDondur($VaryantStokDizisi[2]);
                    }else{
                        $UcuncuVaryantAdi       =   "";
                        $UcuncuVaryantStok      =   "";
                    }
                    if(array_key_exists(3,$VaryantIsimDizisi)){
                        $DorduncuVaryantAdi     =   DonusumleriGeriDondur($VaryantIsimDizisi[3]);
                        $DorduncuVaryantStok    =   DonusumleriGeriDondur($VaryantStokDizisi[3]);
                    }else{
                        $DorduncuVaryantAdi     =   "";
                        $DorduncuVaryantStok    =   "";
                    }
                    if(array_key_exists(4,$VaryantIsimDizisi)){
                        $BesinciVaryantAdi      =   DonusumleriGeriDondur($VaryantIsimDizisi[4]);
                        $BesinciVaryantStok     =   DonusumleriGeriDondur($VaryantStokDizisi[4]);
                    }else{
                        $BesinciVaryantAdi      =   "";
                        $BesinciVaryantStok     =   "";
                    }
                    if(array_key_exists(5,$VaryantIsimDizisi)){
                        $AltinciVaryantAdi      =   DonusumleriGeriDondur($VaryantIsimDizisi[5]);
                        $AltinciVaryantStok     =   DonusumleriGeriDondur($VaryantStokDizisi[5]);
                    }else{
                        $AltinciVaryantAdi      =   "";
                        $AltinciVaryantStok     =   "";
                    }
                    if(array_key_exists(6,$VaryantIsimDizisi)){
                        $YedinciVaryantAdi      =   DonusumleriGeriDondur($VaryantIsimDizisi[6]);
                        $YedinciVaryantStok     =   DonusumleriGeriDondur($VaryantStokDizisi[6]);
                    }else{
                        $YedinciVaryantAdi      =   "";
                        $YedinciVaryantStok     =   "";
                    }
                    if(array_key_exists(7,$VaryantIsimDizisi)){
                        $SekizinciVaryantAdi    =   DonusumleriGeriDondur($VaryantIsimDizisi[7]);
                        $SekizinciVaryantStok   =   DonusumleriGeriDondur($VaryantStokDizisi[7]);
                    }else{
                        $SekizinciVaryantAdi    =   "";
                        $SekizinciVaryantStok   =   "";
                    }
                    if(array_key_exists(8,$VaryantIsimDizisi)){
                        $DokuzuncuVaryantAdi    =   DonusumleriGeriDondur($VaryantIsimDizisi[8]);
                        $DokuzuncuVaryantStok   =   DonusumleriGeriDondur($VaryantStokDizisi[8]);
                    }else{
                        $DokuzuncuVaryantAdi    =   "";
                        $DokuzuncuVaryantStok   =   "";
                    }
                    if(array_key_exists(9,$VaryantIsimDizisi)){
                        $OnuncuVaryantAdi       =   DonusumleriGeriDondur($VaryantIsimDizisi[9]);
                        $OnuncuVaryantStok      =   DonusumleriGeriDondur($VaryantStokDizisi[9]);
                    }else{
                        $OnuncuVaryantAdi       =   "";
                        $OnuncuVaryantStok      =   "";
                    }


                    ?>


                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">1. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi1" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($VaryantIsimDizisi[0]); ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">1. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi1" class="InputAlanlari" value="<?php echo DonusumleriGeriDondur($VaryantStokDizisi[0]); ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">2. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi2" class="InputAlanlari" value="<?php echo $IkinciVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">2. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi2" class="InputAlanlari" value="<?php echo $IkinciVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">3. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi3" class="InputAlanlari" value="<?php echo $UcuncuVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">3. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi3" class="InputAlanlari" value="<?php echo $UcuncuVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">4. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi4" class="InputAlanlari" value="<?php echo $DorduncuVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">4. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi4" class="InputAlanlari" value="<?php echo $DorduncuVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">5. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi5" class="InputAlanlari" value="<?php echo $BesinciVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">5. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi5" class="InputAlanlari" value="<?php echo $BesinciVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">6. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi6" class="InputAlanlari" value="<?php echo $AltinciVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">6. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi6" class="InputAlanlari" value="<?php echo $AltinciVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">7. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi7" class="InputAlanlari" value="<?php echo $YedinciVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">7. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi7" class="InputAlanlari" value="<?php echo $YedinciVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">8. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi8" class="InputAlanlari" value="<?php echo $SekizinciVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">8. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi8" class="InputAlanlari" value="<?php echo $SekizinciVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">9. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi9" class="InputAlanlari" value="<?php echo $DokuzuncuVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">9. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi9" class="InputAlanlari" value="<?php echo $DokuzuncuVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td colspan="3" align="left">
                            <table width="728" align="left" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="230">10. Varyant Adı</td>
                                    <td width="20">:</td>
                                    <td width="200"><input type="text" name="VaryantAdi10" class="InputAlanlari" value="<?php echo $OnuncuVaryantAdi; ?>" ></td>
                                    <td width="20">&nbsp;</td>
                                    <td width="178">10. Varyant Stok Adedi</td>
                                    <td width="20">:</td>
                                    <td width="60"><input type="text" name="StokAdedi10" class="InputAlanlari" value="<?php echo $OnuncuVaryantStok; ?>" ></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="40">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Ürün Bilgileri Kaydet" class="YesilButon" ></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</from>
<?php
    }else{
        header("Location: index.php?SKD=0&SKI=102");
        exit();
    }
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
