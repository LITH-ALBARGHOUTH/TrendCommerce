<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                  = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                  = "";
    }

    $GelenBannerResmi                   = $_FILES["BannerResmi"];

    if(isset($_POST["BannerAlani"])){
        $GelenBannerAlani               = Guvenlik($_POST["BannerAlani"]);
    }else{
        $GelenBannerAlani               = "";
    }
    if(isset($_POST["BannerAdi"])){
        $GelenBannerAdi                 = Guvenlik($_POST["BannerAdi"]);
    }else{
        $GelenBannerAdi                 = "";
    }


    if( ($GelenID !="") && ($GelenBannerAlani !="") && ($GelenBannerAdi !="") ){
        $BannerResmiSorgusu         =   $VeriTabaniBaglantisi->prepare("SELECT * FROM bannerlar WHERE id=? LIMIT 1");
        $BannerResmiSorgusu->execute([$GelenID]);
        $BannerKontrol               =   $BannerResmiSorgusu->rowCount();
        $BannerBilgisi               =   $BannerResmiSorgusu->fetch(PDO::FETCH_ASSOC);

        if($GelenBannerAlani==$BannerBilgisi["BannerAlani"]){


                $BannerGuncellemeSorgusu                =   $VeriTabaniBaglantisi->prepare("UPDATE bannerlar SET BannerAlani=? , BannerAdi=? WHERE id=? LIMIT 1");
                $BannerGuncellemeSorgusu->execute([$GelenBannerAlani,$GelenBannerAdi,$GelenID]);
                $BannerGuncellemeKontrol            =   $BannerGuncellemeSorgusu->rowCount();



                        $SilinecekDosyaYolu         =   "../Resimler/".$BannerBilgisi["BannerResmi"];
                        unlink($SilinecekDosyaYolu);

                        $ResimIcinDosyaAdi          =   ResimAdiOlustur();
                        $GelenResminUzantisi        =   substr($GelenBannerResmi["name"], -4);
                        if($GelenResminUzantisi=="jpeg"){
                            $GelenResminUzantisi    =   "." . $GelenResminUzantisi;
                        }
                        $ResimIcinYeniDosyaAdi      =   $GelenResminUzantisi.$GelenResminUzantisi;

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
                                    $BannerResimGuncellemeSorgusu                 =   $VeriTabaniBaglantisi->prepare("UPDATE bannerlar SET BannerResmi=? WHERE id=? LIMIT 1 ");
                                    $BannerResimGuncellemeSorgusu->execute([$ResimIcinYeniDosyaAdi,$GelenID]);
                                    $BannerResimGuncellemeKontrol                 =   $BannerResimGuncellemeSorgusu->rowCount();
                                        if($BannerResimGuncellemeKontrol<1){
                                            header("Location: index.php?SKD=0&SKI=41");
                                            exit();
                                        }
                                    $BannerResmiYukle->clean();
                                    } else {
                                    header("Location: index.php?SKD=0&SKI=41");
                                    exit();
                                } 
                            }


                    if(($BannerGuncellemeKontrol>0) || ($BannerResimGuncellemeKontrol>0)){
                        header("Location: index.php?SKD=0&SKI=40");
                        exit();
                    }else{
                        header("Location: index.php?SKD=0&SKI=41");
                        exit();
                    }

        }else{

            if( ($GelenBannerResmi["name"]!="") && ($GelenBannerResmi["type"]!="") && ($GelenBannerResmi["tmp_name"]!="") && ($GelenBannerResmi["error"]==0) && ($GelenBannerResmi["size"]>0) ){

                        $SilinecekDosyaYolu         =   "../Resimler/".$BannerBilgisi["BannerResmi"];
                        unlink($SilinecekDosyaYolu);

                        $ResimIcinDosyaAdi          =   ResimAdiOlustur();
                        $GelenResminUzantisi        =   substr($GelenBannerResmi["name"], -4);
                        if($GelenResminUzantisi=="jpeg"){
                            $GelenResminUzantisi    =   "." . $GelenResminUzantisi;
                        }
                        $ResimIcinYeniDosyaAdi      =   $GelenResminUzantisi.$GelenResminUzantisi;

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
                                    $BannerResimGuncellemeSorgusu                 =   $VeriTabaniBaglantisi->prepare("UPDATE bannerlar SET BannerAlani=? , BannerAdi=? , BannerResmi=? WHERE id=? LIMIT 1 ");
                                    $BannerResimGuncellemeSorgusu->execute([$GelenBannerAlani,$GelenBannerAdi,$ResimIcinYeniDosyaAdi,$GelenID]);
                                    $BannerResimGuncellemeKontrol                 =   $BannerResimGuncellemeSorgusu->rowCount();
                                        if($BannerResimGuncellemeKontrol<1){
                                            header("Location: index.php?SKD=0&SKI=40");
                                            exit();
                                        }
                                    $BannerResmiYukle->clean();
                                    } else {
                                    header("Location: index.php?SKD=0&SKI=41");
                                    exit();
                                } 
                            }

            }else{
                header("Location: index.php?SKD=0&SKI=41");
                exit();
            }
        }
    }else{
        header("Location: index.php?SKD=0&SKI=41");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>


