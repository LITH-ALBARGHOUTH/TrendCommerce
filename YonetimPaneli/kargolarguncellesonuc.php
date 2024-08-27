<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                  = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                  = "";
    }

    $GelenKargoFirmasiLogosu                   = $_FILES["KargoFirmasiLogosu"];

    if(isset($_POST["KargoFirmasiAdi"])){
        $GelenKargoFirmasiAdi                  = Guvenlik($_POST["KargoFirmasiAdi"]);
    }else{
        $GelenKargoFirmasiAdi                  = "";
    }


    if( ($GelenKargoFirmasiAdi !="") ){


        $KargoGuncellemeSorgusu             =   $VeriTabaniBaglantisi->prepare("UPDATE kargofirmalari SET KargoFirmasiAdi=? WHERE id=? LIMIT 1");
        $KargoGuncellemeSorgusu->execute([$GelenKargoFirmasiAdi,$GelenID]);
        $KargoGuncellemeKontrol             =   $KargoGuncellemeSorgusu->rowCount();

            if( ($GelenKargoFirmasiLogosu["name"]!="") && ($GelenKargoFirmasiLogosu["type"]!="") && ($GelenKargoFirmasiLogosu["tmp_name"]!="") && ($GelenKargoFirmasiLogosu["error"]==0) && ($GelenKargoFirmasiLogosu["size"]>0) ){

                $KargoResmiSorgusu          =   $VeriTabaniBaglantisi->prepare("SELECT * FROM kargofirmalari WHERE id=? LIMIT 1");
                $KargoResmiSorgusu->execute([$GelenID]);
                $ResimKontrol               =   $KargoResmiSorgusu->rowCount();
                $ResimBilgisi               =   $KargoResmiSorgusu->fetch(PDO::FETCH_ASSOC);

                $SilinecekDosyaYolu         =   "../Resimler/".$ResimBilgisi["KargoFirmasiLogosu"];
                unlink($SilinecekDosyaYolu);

                $ResimIcinDosyaAdi          =   ResimAdiOlustur();
                $GelenResminUzantisi        =   substr($GelenKargoFirmasiLogosu["name"], -4);
                if($GelenResminUzantisi=="jpeg"){
                    $GelenResminUzantisi    =   "." . $GelenResminUzantisi;
                }
                $ResimIcinYeniDosyaAdi      =   $GelenResminUzantisi.$GelenResminUzantisi;


                $KargoFirmasiLogosuYukle    =   new \Verot\Upload\Upload($GelenKargoFirmasiLogosu, "tr-TR");
                    if ($KargoFirmasiLogosuYukle->uploaded) {
                        $KargoFirmasiLogosuYukle->mime_magic_check              = true;
                        $KargoFirmasiLogosuYukle->allowed                       = array("image/*");
                        $KargoFirmasiLogosuYukle->file_new_name_body            = $ResimIcinDosyaAdi;
                        $KargoFirmasiLogosuYukle->file_overwrite                = true;
                        // $KargoFirmasiLogosuYukle->image_convert                 = "png";
                        $KargoFirmasiLogosuYukle->image_quality                 = 100;
                        $KargoFirmasiLogosuYukle->image_background_color        = "#FFFFFF";
                        $KargoFirmasiLogosuYukle->image_resize                  = true;
                        $KargoFirmasiLogosuYukle->image_ratio                   = true;
                        $KargoFirmasiLogosuYukle->image_y                       = 30;
                        
                        $KargoFirmasiLogosuYukle->process($VerotIcinKlasorYolu);

                        if ($KargoFirmasiLogosuYukle->processed) {
                            $KargoResimGuncellemeSorgusu                 =   $VeriTabaniBaglantisi->prepare("UPDATE kargofirmalari SET KargoFirmasiLogosu=? WHERE id=? LIMIT 1 ");
                            $KargoResimGuncellemeSorgusu->execute([$ResimIcinYeniDosyaAdi,$GelenID]);
                            $KargoResimGuncellemeKontrol                 =   $KargoResimGuncellemeSorgusu->rowCount();
                                if($KargoResimGuncellemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=29");
                                    exit();
                                }
                            $KargoFirmasiLogosuYukle->clean();
                            } else {
                            header("Location: index.php?SKD=0&SKI=29");
                            exit();
                        } 
                    }
            }


            if(($KargoGuncellemeKontrol>0) || ($KargoResimGuncellemeKontrol>0)){
                header("Location: index.php?SKD=0&SKI=28");
                exit();
            }else{
                header("Location: index.php?SKD=0&SKI=29");
                exit();
            }
                   
    }else{
        header("Location: index.php?SKD=0&SKI=29");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>


