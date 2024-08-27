
<?php
session_start(); ob_start();
require_once("Ayarlar/ayar.php");
require_once("Ayarlar/fonksiyonlar.php");
require_once("Ayarlar/sitesayfalari.php");

if(isset($_REQUEST["SK"])) {
    $SayfaKoduDegeri = SayiliIcerikleriFiltrele($_REQUEST["SK"]);
} else {
    $SayfaKoduDegeri = 0;
}
if(isset($_REQUEST["SYF"])) {
    $Sayfalama       = SayiliIcerikleriFiltrele($_REQUEST["SYF"]);
} else {
    $Sayfalama       = 1;
}



?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-language" content="tr">
    <meta charset="utf-8">
    <meta name="Robots" content="index,follow">
    <meta name="googlebot" content="index,follow">
    <meta name="revisit-after" content="7 Days">
    <title><?php echo DonusumleriGeriDondur($SiteTitle); ?></title>
    <base href="/TrendCommerce/">
    <link type="image/png" rel="icon" href="Resimler/logo.png">
    <meta name="description" content="<?php echo DonusumleriGeriDondur($SiteDescription); ?>">
    <meta name="Keywords" content="<?php echo DonusumleriGeriDondur($SiteKeywords); ?>">
    <script type="text/javascript" src="FrameWorks/JQuery/jquery-3.7.1.js"></script>
    <link type="text/css" rel="stylesheet" href="Ayarlar/style.css">
    <script type="text/javascript" src="Ayarlar/fonksiyonlar.js"></script>
</head>

<body>
    <table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="40" bgcolor="#353745">
            <td><img src="" ></td>
        </tr>

        <tr height="110">
            <td>
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr bgcolor="#0088CC">
                        <td>&nbsp;</td>
                        <?php
                        if(isset($_SESSION["Kullanici"])) {
                        ?>
                        <td width="20"><a href="index.php?SK=50"><img src="" border="0" style="margin-top: 5px;"></a></td>
                        <td width="70" class="MaviAlanMenusu"><a href="index.php?SK=50">Hesabım</a></td>
                        <td width="20"><a href="index.php?SK=49"><img src="" border="0" style="margin-top: 5px;"></a></td>
                        <td width="85" class="MaviAlanMenusu"><a href="index.php?SK=49">Çıkış Yap</a></td>
                        <?php
                        }else{
                        ?>
                        <td width="20"><a href="index.php?SK=31"><img src="" border="0" style="margin-top: 5px;"></a></td>
                        <td width="70" class="MaviAlanMenusu"><a href="index.php?SK=31">Giriş Yap</a></td>
                        <td width="20"><a href="index.php?SK=22"><img src="" border="0" style="margin-top: 5px;"></a></td>
                        <td width="85" class="MaviAlanMenusu"><a href="index.php?SK=22">Yeni Üye Ol</a></td>

                        <?php
                        }
                        ?>
                        <td width="20">
                            <?php if(isset($_SESSION["Kullanici"])){ ?><a href="index.php?SK=93"><img src="" border="0" style="margin-top: 5px;"></a><?php }else{ ?><img src="" border="0" style="margin-top: 5px;"><?php } ?>
                        </td>
                        <td width="103" class="MaviAlanMenusu"><?php if(isset($_SESSION["Kullanici"])){ ?><a href="index.php?SK=93">Alışveriş Sepeti</a><?php }else{ ?>Alışveriş Sepeti<?php } ?></td>
                    </tr>
                </table>
                <table width="1065" height="80" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="192"><img src="Resimler/<?php DonusumleriGeriDondur($SiteLogosu); ?>" border="0"></td>
                        <td>
                            <table width="873" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="306">&nbsp;</td>
                                    <td width="107" class="AnaMenu"><a href="index.php"><b>Ana Sayfa</b></a></td>
                                    <td width="160" class="AnaMenu"><a href="index.php?SK=84"><b>Kadın Ayakkabıları</b></a></td>
                                    <td width="160" class="AnaMenu"><a href="index.php?SK=83"><b>Erkek Ayakkabıları</b></a></td>
                                    <td width="140" class="AnaMenu"><a href="index.php?SK=85"><b>Çocuk Ayakkabıları</b></a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>




        <tr>
            <td valign="top">
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="30">
                        <td align="center">

                         <?php
                        
                        if((!$SayfaKoduDegeri) || ($SayfaKoduDegeri=="") || ($SayfaKoduDegeri==0)) {
                            include($Sayfa[0]);
                        }else {
                            include("Ayarlar/" . $Sayfa[$SayfaKoduDegeri]);
                        }
                        
                        ?> 
                        <br />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>



        <tr height="210" >
            <td>
                <table width="1065" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#F9F9F9">
                    <tr height="30">
                        <td width="250" style="border-bottom: 1px dashed #CCCCCC">&nbsp;Kurumsal</td>
                        <td width="22">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCCCCC">Üyelik & Hizmetler</td>
                        <td width="22">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCCCCC">Sözleşmeler</td>
                        <td width="21">&nbsp;</td>
                        <td width="250" style="border-bottom: 1px dashed #CCCCCC">Bizi Takip Edin</td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?SK=1">&nbsp;Hakkımızda</a></td>
                        <td>&nbsp;</td>
                        <?php
                        if(isset($_SESSION["Kullanici"])) {
                        ?>
                        <td class="AltMenu"><a href="index.php?SK=50">Hesabım</a></td>
                        <?php
                        }else{
                        ?>
                        <td class="AltMenu"><a href="index.php?SK=31">Giriş Yap</a></td>
                        <?php
                        }
                        ?>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?SK=2">Üyelik Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                        <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20">
                                        <a href="<?php echo DonusumleriGeriDondur($SosyalLinkFacebook); ?>" target="_blank"><img src="" border="0" style="margin-top: 5px;"></a>
                                    </td>
                                    <td width="230" class="AltMenu"><a href="<?php echo DonusumleriGeriDondur($SosyalLinkFacebook); ?>" target="_blank">Facebook</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?SK=8">&nbsp;Banka Hesaplarımız</a></td>
                        <td>&nbsp;</td>
                        <?php
                        if(isset($_SESSION["Kullanici"])) {
                        ?>
                        <td class="AltMenu"><a href="index.php?SK=49">Çıkış Yap</a></td>
                        <?php
                        }else{
                        ?>
                        <td class="AltMenu"><a href="index.php?SK=22">Yeni Üye Ol</a></td>
                        <?php
                        }
                        ?>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?SK=3">Kullanım Koşulları</a></td>
                        <td>&nbsp;</td>
                        <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20">
                                        <a href="<?php echo DonusumleriGeriDondur($SosyalLinkX); ?>" target="_blank"><img src="" border="0" style="margin-top: 5px;"></a>
                                    </td>
                                    <td width="230" class="AltMenu"><a href="<?php echo DonusumleriGeriDondur($SosyalLinkX); ?>" target="_blank">X</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?SK=9">&nbsp;Havale Bildirim Formu</a></td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?SK=21">Sık Sorulan Sorular</a></td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?SK=4">Gizlilik Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                        <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20">
                                        <a href="<?php echo DonusumleriGeriDondur($SosyalLinkLinkedin); ?>" target="_blank"><img src="" border="0" style="margin-top: 5px;"></a>
                                    </td>
                                    <td width="230" class="AltMenu"><a href="<?php echo DonusumleriGeriDondur($SosyalLinkLinkedin); ?>" target="_blank">LinkedIn</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?SK=14">&nbsp;Kargom Nerede?</a></td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="xxxxx">&nbsp;</a></td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?SK=5">Mesafeli Satış Sözleşmesi</a></td>
                        <td>&nbsp;</td>
                        <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20">
                                        <a href="<?php echo DonusumleriGeriDondur($SosyalLinkInstagram); ?>" target="_blank"><img src="" border="0" style="margin-top: 5px;"></a>
                                    </td>
                                    <td width="230" class="AltMenu"><a href="<?php echo DonusumleriGeriDondur($SosyalLinkInstagram); ?>" target="_blank">İnstagram</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td class="AltMenu"><a href="index.php?SK=16">&nbsp;İletişim</a></td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="xxxxx">&nbsp;</a></td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?SK=6">Teslimat</a></td>
                        <td>&nbsp;</td>
                        <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20">
                                        <a href="<?php echo DonusumleriGeriDondur($SosyalLinkPinterest); ?>" target="_blank"><img src="" border="0" style="margin-top: 5px;"></a>
                                    </td>
                                    <td width="230" class="AltMenu"><a href="<?php echo DonusumleriGeriDondur($SosyalLinkPinterest); ?>" target="_blank">Pinterest</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr height="30">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="AltMenu"><a href="index.php?SK=7">İptal & İade & Değişim</a></td>
                        <td>&nbsp;</td>
                        <td>
                        <table width="250" align="center" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="20">
                                        <a href="<?php echo DonusumleriGeriDondur($SosyalLinkYoutube); ?>" target="_blank"><img src="" border="0" style="margin-top: 5px;"></a>
                                    </td>
                                    <td width="230" class="AltMenu"><a href="<?php echo DonusumleriGeriDondur($SosyalLinkYoutube); ?>" target="_blank">Youtube</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>



        <tr>
            <td>
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="30">
                        <td align="center"> <?php echo DonusumleriGeriDondur($SiteCopyrightMetni); ?> </td>
                    </tr>
                </table>
            </td>
        </tr>


        <tr>
            <td>
                <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr height="30">
                        <td align="center">
                             <img src="" border="0" style="margin-right: 5px;">
                             <img src="" border="0" style="margin-right: 5px;">
                             <img src="" border="0" style="margin-right: 5px;">
                             <img src="" border="0" style="margin-right: 5px;">
                             <img src="" border="0" style="margin-right: 5px;">
                             <img src="" border="0" style="margin-right: 5px;">
                             <img src="" border="0" style="margin-right: 5px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>




    </table>
</body>
</html>

<?php
$VeriTabaniBaglantisi = null;
ob_end_flush();
?>