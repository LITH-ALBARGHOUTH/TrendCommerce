<?php


if(isset($_SESSION["Yonetici"])){

    $GelenBannerResmi                       = $_FILES["BannerResmi"];

    if(isset($_POST["BannerAlani"])){
        $GelenBannerAlani                   = Guvenlik($_POST["BannerAlani"]);
    }else{
        $GelenBannerAlani                   = "";
    }
    if(isset($_POST["BannerAdi"])){
        $GelenBannerAdi                     = Guvenlik($_POST["BannerAdi"]);
    }else{
        $GelenBannerAdi                     = "";
    }


    if( ($GelenBannerResmi["name"]!="") && ($GelenBannerResmi["type"]!="") && ($GelenBannerResmi["tmp_name"]!="") && ($GelenBannerResmi["error"]==0) && ($GelenBannerResmi["size"]>0) && 
        ($GelenBannerAlani !="") && ($GelenBannerAdi !="")  ){

            

        $ResimIcinDosyaAdi      =   ResimAdiOlustur();
        $GelenResminUzantisi    =   substr($GelenBannerResmi["name"], -4);
        if($GelenResminUzantisi=="jpeg"){
            $GelenResminUzantisi    =   "." . $GelenResminUzantisi;
        }
        $ResimIcinYeniDosyaAdi           =   $ResimIcinDosyaAdi.$GelenResminUzantisi;

        $BannerEklemeSorgusu             =   $VeriTabaniBaglantisi->prepare("INSERT INTO bannerlar (BannerResmi, BannerAlani, BannerAdi, GosterimSayisi) values(?,?,?,?) ");
        $BannerEklemeSorgusu->execute([$ResimIcinYeniDosyaAdi,$GelenBannerAlani,$GelenBannerAdi,0]);
        $BannerEklemeKontrol             =   $BannerEklemeSorgusu->rowCount();
            if($BannerEklemeKontrol>0){
                if($GelenBannerAlani=="Ana Sayfa"){
                    $ResimGenislikOlcusu        =   1065;
                    $ResimYukseklikOlcusu       =   186;
                }elseif($GelenBannerAlani=="Menü Altı"){
                    $ResimGenislikOlcusu        =   250;
                    $ResimYukseklikOlcusu       =   186;
                }elseif($GelenBannerAlani=="Ürün Detay"){
                    $ResimGenislikOlcusu        =   350;
                    $ResimYukseklikOlcusu       =   350;
                }

                $BannerResmiYukle    =   new \Verot\Upload\Upload($GelenBannerResmi, "tr-TR");
                    if ($BannerResmiYukle->uploaded) {
                        $BannerResmiYukle->mime_magic_check              = true;
                        $BannerResmiYukle->allowed                       = array("image/*");
                        $BannerResmiYukle->file_new_name_body            = $ResimIcinDosyaAdi;
                        $BannerResmiYukle->file_overwrite                = true;
                        // $BannerResmiYukle->image_convert                 = "png";
                        $BannerResmiYukle->image_quality                 = 100;
                        $BannerResmiYukle->image_background_color        = "#FFFFFF";
                        $BannerResmiYukle->image_resize                  = true;
                        $BannerResmiYukle->image_x                       = $ResimGenislikOlcusu;
                        $BannerResmiYukle->image_y                       = $ResimYukseklikOlcusu;
                        
                        $BannerResmiYukle->process($VerotIcinKlasorYolu);


                        if ($BannerResmiYukle->processed) {
                            $BannerResmiYukle->clean();
                            header("Location: index.php?SKD=0&SKI=36");
                            exit();
                            } else {
                            header("Location: index.php?SKD=0&SKI=37");
                            exit();
                        } 
                    }

            }else{
                header("Location: index.php?SKD=0&SKI=37");
                exit();
            }
                   

    }else{
        header("Location: index.php?SKD=0&SKI=37");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
