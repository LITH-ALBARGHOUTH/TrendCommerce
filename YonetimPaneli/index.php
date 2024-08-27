
<?php
session_start(); ob_start();
require_once("../Ayarlar/ayar.php");
require_once("../Ayarlar/fonksiyonlar.php");
require_once("../FrameWorks/Verot/src/class.upload.php");
require_once("../Ayarlar/yonetimsitesayfalariic.php");
require_once("../Ayarlar/yonetimsitesayfalaridis.php");

if(isset($_REQUEST["SKI"])) {
    $IcSayfaKoduDegeri  = SayiliIcerikleriFiltrele($_REQUEST["SKI"]);
} else {
    $IcSayfaKoduDegeri  = 0;
}
if(isset($_REQUEST["SKD"])) {
    $DisSayfaKoduDegeri = SayiliIcerikleriFiltrele($_REQUEST["SKD"]);
} else {
    $DisSayfaKoduDegeri = 0;
}
if(isset($_REQUEST["SYF"])) {
    $Sayfalama          = SayiliIcerikleriFiltrele($_REQUEST["SYF"]);
} else {
    $Sayfalama          = 1;
}



?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="content-language" content="tr">
    <meta charset="utf-8">
    <meta name="Robots" content="noindex,nofollow,noarchive">
    <meta name="googlebot" content="noindex,nofollow,noarchive">
    <title><?php echo DonusumleriGeriDondur($SiteTitle); ?></title>
    <link type="image/png" rel="icon" href="../Resimler/">
    <script type="text/javascript" src="../FrameWorks/JQuery/jquery-3.7.1.js"></script>
    <link type="text/css" rel="stylesheet" href="../Ayarlar/yonetim.css">
    <script type="text/javascript" src="../Ayarlar/fonksiyonlar.js"></script>
</head>

<body>
    <table width="1065" height="100%" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="100%">
            <td align="center">
                <?php
                if(empty($_SESSION["Yonetici"])){

                    if((!$DisSayfaKoduDegeri) || ($DisSayfaKoduDegeri=="") || ($DisSayfaKoduDegeri==0)) {
                        include($SayfaDis[1]);
                    }else {
                        include($SayfaDis[$DisSayfaKoduDegeri]);
                    }

                }else{

                    if((!$DisSayfaKoduDegeri) || ($DisSayfaKoduDegeri=="") || ($DisSayfaKoduDegeri==0)) {
                        include($SayfaDis[0]);
                    }else {
                        include($SayfaDis[$DisSayfaKoduDegeri]);
                    }

                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>

<?php
$VeriTabaniBaglantisi = null;
ob_end_flush();
?>