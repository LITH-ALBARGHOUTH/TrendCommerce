<?php
if(isset($_SESSION["Yonetici"])){
?>
    <table width="760" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="70">
            <td width="560" bgcolor="#FF9900" style="color: #FFFFFF" align="left"><h3>&nbsp;SİPARİŞLER (BEKLEYEN)</h3></td>
            <td width="200" bgcolor="#FF9900" align="right"><a href="index.php?SKD=0&SKI=108" style="color: #FFFFFF; text-decoration: none;">Tamamlanan Siparişler&nbsp;</a></td>
        </tr>
        <tr height="10">
            <td colspan="2" style="font-size: 10px;">&nbsp;</td>
        </tr>

        <?php

        $SiparisNumaralariSorgusu    = $VeriTabaniBaglantisi->prepare("SELECT DISTINCT SiparisNumarasi FROM siparisler WHERE OnayDurumu=? AND KargoDurumu=? ORDER BY id ASC");
        $SiparisNumaralariSorgusu->execute([0,0]);
        $SiparisNumaralariSayisi     = $SiparisNumaralariSorgusu->rowCount();
        $SiparisNumaralariKayitlari  = $SiparisNumaralariSorgusu->fetchAll(PDO::FETCH_ASSOC);


        if($SiparisNumaralariSayisi>0){
        foreach($SiparisNumaralariKayitlari as $SiparisNumaralariSatirlar) {

        $SiparislerSorgusu         = $VeriTabaniBaglantisi->prepare("SELECT * FROM siparisler WHERE SiparisNumarasi=? AND OnayDurumu=? AND KargoDurumu=?");
        $SiparislerSorgusu->execute([$SiparisNumaralariSatirlar["SiparisNumarasi"],0,0]);
        $SiparislerSayisi          = $SiparislerSorgusu->rowCount();
        $SiparislerKayitlari       = $SiparislerSorgusu->fetchAll(PDO::FETCH_ASSOC);

            if($SiparislerSayisi>0){
                $ToplamFiyat    =   0;
                foreach($SiparislerKayitlari as $Siparis){
                    $UrunToplamFiyati   =   $Siparis["ToplamUrunFiyati"];
                    $SiparisTarihi      =   TarihBul($Siparis["SiparisTarihi"]);
                    $ToplamFiyat       +=   $UrunToplamFiyati;
                }

        ?>
        

        <tr>
            <td style="border-bottom: 1px dashed #CCCCCC;" valign="top" colspan="2">
                <table width="750" align="right" border="0" cellpadding="0" cellspacing="0">
                    <tr height="30">
                        <td align="left" width="130"><b>Sipariş Tarihi</b></td>
                        <td align="left" width="20"><b>:</b></td>
                        <td align="left" width="220"><?php echo $SiparisTarihi; ?></td>
                        <td align="left" width="130"><b>Sipariş Tutarı</b></td>
                        <td align="left" width="20"><b>:</b></td>
                        <td align="left" width="150"><?php echo FiyatBicimlendir($ToplamFiyat); ?> TL</td>
                        <td align="left" width="80">
                            <table width="80" align="right" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="30"><a href="index.php?SKD=0&SKI=113&SiparisNo=<?php echo DonusumleriGeriDondur($SiparisNumaralariSatirlar['SiparisNumarasi']); ?>" 
                                    style="color: red; text-decoration: none;">Sil</a></td>
                                    <td width="50"><a href="index.php?SKD=0&SKI=107&SiparisNo=<?php echo DonusumleriGeriDondur($SiparisNumaralariSatirlar['SiparisNumarasi']); ?>" 
                                    style="color: #0000FF; text-decoration: none;">Detay</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <?php
                }else{
                    header("Location: index.php?SKD=0&SKI=0");
                    exit();
                }
            }
        }else{
        ?>

        <tr>
            <td colspan="2">
                <table width="750" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="40">
                        <td width="750">Kayıtlı Yeni Sipariş Bulunmamaktadır.</td>
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