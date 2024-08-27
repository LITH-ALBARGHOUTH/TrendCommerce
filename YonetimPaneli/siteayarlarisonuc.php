<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_POST["SiteAdi"])){
        $GelenSiteAdi                      = Guvenlik($_POST["SiteAdi"]);
    }else{
        $GelenSiteAdi                      = "";
    }
    if(isset($_POST["SiteTitle"])){
        $GelenSiteTitle                    = Guvenlik($_POST["SiteTitle"]);
    }else{
        $GelenSiteTitle                    = "";
    }
    if(isset($_POST["SiteDescription"])){
        $GelenSiteDescription              = Guvenlik($_POST["SiteDescription"]);
    }else{
        $GelenSiteDescription              = "";
    }
    if(isset($_POST["SiteKeywords"])){
        $GelenSiteKeywords                 = Guvenlik($_POST["SiteKeywords"]);
    }else{
        $GelenSiteKeywords                 = "";
    }
    if(isset($_POST["SiteCopyrightMetni"])){
        $GelenSiteCopyrightMetni           = Guvenlik($_POST["SiteCopyrightMetni"]);
    }else{
        $GelenSiteCopyrightMetni           = "";
    }
    if(isset($_POST["SiteLinki"])){
        $GelenSiteLinki                    = Guvenlik($_POST["SiteLinki"]);
    }else{
        $GelenSiteLinki                    = "";
    }
    if(isset($_POST["SiteEmailAdresi"])){
        $GelenSiteEmailAdresi              = Guvenlik($_POST["SiteEmailAdresi"]);
    }else{
        $GelenSiteEmailAdresi              = "";
    }
    if(isset($_POST["SiteEmailSifresi"])){
        $GelenSiteEmailSifresi             = Guvenlik($_POST["SiteEmailSifresi"]);
    }else{
        $GelenSiteEmailSifresi             = "";
    }
    if(isset($_POST["SiteEmailHostAdresi"])){
        $GelenSiteEmailHostAdresi          = Guvenlik($_POST["SiteEmailHostAdresi"]);
    }else{
        $GelenSiteEmailHostAdresi          = "";
    }
    if(isset($_POST["SosyalLinkFacebook"])){
        $GelenSosyalLinkFacebook           = Guvenlik($_POST["SosyalLinkFacebook"]);
    }else{
        $GelenSosyalLinkFacebook           = "";
    }
    if(isset($_POST["SosyalLinkX"])){
        $GelenSosyalLinkX                  = Guvenlik($_POST["SosyalLinkX"]);
    }else{
        $GelenSosyalLinkX                  = "";
    }
    if(isset($_POST["SosyalLinkLinkedin"])){
        $GelenSosyalLinkLinkedin           = Guvenlik($_POST["SosyalLinkLinkedin"]);
    }else{
        $GelenSosyalLinkLinkedin           = "";
    }
    if(isset($_POST["SosyalLinkInstagram"])){
        $GelenSosyalLinkInstagram          = Guvenlik($_POST["SosyalLinkInstagram"]);
    }else{
        $GelenSosyalLinkInstagram          = "";
    }
    if(isset($_POST["SosyalLinkPinterest"])){
        $GelenSosyalLinkPinterest          = Guvenlik($_POST["SosyalLinkPinterest"]);
    }else{
        $GelenSosyalLinkPinterest          = "";
    }
    if(isset($_POST["SosyalLinkYoutube"])){
        $GelenSosyalLinkYoutube            = Guvenlik($_POST["SosyalLinkYoutube"]);
    }else{
        $GelenSosyalLinkYoutube            = "";
    }

    if(isset($_POST["DolarKuru"])){
        $GelenDolarKuru                    = Guvenlik($_POST["DolarKuru"]);
    }else{
        $GelenDolarKuru                    = "";
    }
    if(isset($_POST["EuroKuru"])){
        $GelenEuroKuru                     = Guvenlik($_POST["EuroKuru"]);
    }else{
        $GelenEuroKuru                     = "";
    }
    if(isset($_POST["UcretsizKargoBaraji"])){
        $GelenUcretsizKargoBaraji          = Guvenlik($_POST["UcretsizKargoBaraji"]);
    }else{
        $GelenUcretsizKargoBaraji          = "";
    }
    if(isset($_POST["ClientID"])){
        $GelenClientID                     = Guvenlik($_POST["ClientID"]);
    }else{
        $GelenClientID                     = "";
    }
    if(isset($_POST["StoreKey"])){
        $GelenStoreKey                     = Guvenlik($_POST["StoreKey"]);
    }else{
        $GelenStoreKey                     = "";
    }
    if(isset($_POST["ApiKullanicisi"])){
        $GelenApiKullanicisi               = Guvenlik($_POST["ApiKullanicisi"]);
    }else{
        $GelenApiKullanicisi               = "";
    }
    if(isset($_POST["ApiSifresi"])){
        $GelenApiSifresi                   = Guvenlik($_POST["ApiSifresi"]);
    }else{
        $GelenApiSifresi                   = "";
    }

    $GelenSiteLogosu                   = $_FILES["SiteLogosu"];

    if( ($GelenSiteAdi !="") && ($GelenSiteTitle !="") && ($GelenSiteDescription !="") && ($GelenSiteKeywords !="") && ($GelenSiteCopyrightMetni !="") && ($GelenSiteLinki !="") && ($GelenSiteEmailAdresi !="") && ($GelenSiteEmailSifresi !="") && 
    ($GelenSiteEmailHostAdresi !="") && ($GelenSosyalLinkFacebook !="") && ($GelenSosyalLinkX !="") && ($GelenSosyalLinkLinkedin !="") && ($GelenSosyalLinkInstagram !="") && ($GelenSosyalLinkPinterest !="") && ($GelenSosyalLinkYoutube !="") && 
    ($GelenDolarKuru !="") && ($GelenEuroKuru !="") && ($GelenUcretsizKargoBaraji !="") && ($GelenClientID !="") && ($GelenStoreKey !="") && ($GelenApiKullanicisi !="") && ($GelenApiSifresi !="") ){

        $AyarlariGuncelle           = $VeriTabaniBaglantisi->prepare("UPDATE Ayarlar SET SiteAdi=? , SiteTitle=? , SiteDescription=? , SiteKeywords=? , SiteCopyrightMetni=? , SiteLinki=? , SiteEmailAdresi=? , SiteEmailSifresi=? , 
        SiteEmailHostAdresi=? , SosyalLinkFacebook=? , SosyalLinkX=? , SosyalLinkLinkedin=? , SosyalLinkInstagram=? , SosyalLinkPinterest=? , SosyalLinkYoutube=? , DolarKuru=? , EuroKuru=? , UcretsizKargoBaraji=? , ClientID=? , StoreKey=? ,
        ApiKullanicisi=? , ApiSifresi=? ");
        $AyarlariGuncelle->execute([$GelenSiteAdi,$GelenSiteTitle,$GelenSiteDescription,$GelenSiteKeywords,$GelenSiteCopyrightMetni,$GelenSiteLinki,$GelenSiteEmailAdresi,$GelenSiteEmailSifresi,$GelenSiteEmailHostAdresi,$GelenSosyalLinkFacebook,
        $GelenSosyalLinkX,$GelenSosyalLinkLinkedin,$GelenSosyalLinkInstagram,$GelenSosyalLinkPinterest,$GelenSosyalLinkYoutube,$GelenDolarKuru,$GelenEuroKuru,$GelenUcretsizKargoBaraji,$GelenClientID,$GelenStoreKey,$GelenApiKullanicisi,$GelenApiSifresi]);

            if(($GelenSiteLogosu["name"]!="") && ($GelenSiteLogosu["type"]!="") && ($GelenSiteLogosu["tmp_name"]!="") && ($GelenSiteLogosu["error"]==0) && ($GelenSiteLogosu["size"]>0)){
                $SiteLogosuYukle    =   new Upload($GelenSiteLogosu, "tr-TR");
                if ($SiteLogosuYukle->uploaded) {
                    $SiteLogosuYukle->mime_magic_check              = true;
                    $SiteLogosuYukle->allowed                       = array("image/*");
                    $SiteLogosuYukle->file_new_name_body            = 'logo';
                    $SiteLogosuYukle->file_overwrite                = true;
                    $SiteLogosuYukle->image_convert                = "png";
                    $SiteLogosuYukle->image_quality                = 100;
                    $SiteLogosuYukle->image_background_color        = null;
                    $SiteLogosuYukle->image_resize                  = true;
                    $SiteLogosuYukle->image_y                       = 35;
                    $SiteLogosuYukle->image_x                       = 192;
                    
                    $SiteLogosuYukle->process($VerotIcinKlasorYolu);

                    if ($SiteLogosuYukle->processed) {
                        $SiteLogosuYukle->clean();
                      } else {
                        header("Location: index.php?SKD=0&SKI=4");
                        exit();
                      } 
                }
                   
            }

            header("Location: index.php?SKD=0&SKI=3");
            exit();

    }else{
        header("Location: index.php?SKD=0&SKI=4");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
