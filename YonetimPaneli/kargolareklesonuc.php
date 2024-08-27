<?php


if(isset($_SESSION["Yonetici"])){

    $GelenKargoFirmasiLogosu                   = $_FILES["KargoFirmasiLogosu"];

    if(isset($_POST["KargoFirmasiAdi"])){
        $GelenKargoFirmasiAdi                  = Guvenlik($_POST["KargoFirmasiAdi"]);
    }else{
        $GelenKargoFirmasiAdi                  = "";
    }


    if( ($GelenKargoFirmasiLogosu["name"]!="") && ($GelenKargoFirmasiLogosu["type"]!="") && ($GelenKargoFirmasiLogosu["tmp_name"]!="") && ($GelenKargoFirmasiLogosu["error"]==0) && ($GelenKargoFirmasiLogosu["size"]>0) && 
    ($GelenKargoFirmasiAdi !="")  ){

            

        $ResimIcinDosyaAdi      =   ResimAdiOlustur();
        $GelenResminUzantisi    =   substr($GelenKargoFirmasiLogosu["name"], -4);
        if($GelenResminUzantisi=="jpeg"){
            $GelenResminUzantisi    =   "." . $GelenResminUzantisi;
        }
        $ResimIcinYeniDosyaAdi          =   $ResimIcinDosyaAdi.$GelenResminUzantisi;

        $KargoEklemeSorgusu             =   $VeriTabaniBaglantisi->prepare("INSERT INTO kargofirmalari (KargoFirmasiLogosu, KargoFirmasiAdi) values(?,?) ");
        $KargoEklemeSorgusu->execute([$ResimIcinYeniDosyaAdi,$GelenKargoFirmasiAdi]);
        $KargoEklemeKontrol             =   $KargoEklemeSorgusu->rowCount();
            if($KargoEklemeKontrol>0){

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

                        print_r($KargoFirmasiLogosuYukle);

                        if ($KargoFirmasiLogosuYukle->processed) {
                            $KargoFirmasiLogosuYukle->clean();
                            header("Location: index.php?SKD=0&SKI=24");
                            exit();
                            } else {
                            header("Location: index.php?SKD=0&SKI=25");
                            exit();
                        } 
                    }

            }else{
                header("Location: index.php?SKD=0&SKI=25");
                exit();
            }
                   

    }else{
        header("Location: index.php?SKD=0&SKI=25");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
