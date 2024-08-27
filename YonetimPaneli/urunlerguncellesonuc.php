<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                  = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                  = "";
    }
    if(isset($_POST["UrunMenusu"])){
        $GelenUrunMenusu                    = Guvenlik($_POST["UrunMenusu"]);
    }else{
        $GelenUrunMenusu                    = "";
    }
    if(isset($_POST["UrunAdi"])){
        $GelenUrunAdi                       = Guvenlik($_POST["UrunAdi"]);
    }else{
        $GelenUrunAdi                       = "";
    }
    if(isset($_POST["UrunFiyati"])){
        $GelenUrunFiyati                    = Guvenlik($_POST["UrunFiyati"]);
    }else{
        $GelenUrunFiyati                    = "";
    }
    if(isset($_POST["ParaBirimi"])){
        $GelenParaBirimi                    = Guvenlik($_POST["ParaBirimi"]);
    }else{
        $GelenParaBirimi                    = "";
    }
    if(isset($_POST["KargoUcreti"])){
        $GelenKargoUcreti                   = Guvenlik($_POST["KargoUcreti"]);
    }else{
        $GelenKargoUcreti                   = "";
    }
    if(isset($_POST["KdvOrani"])){
        $GelenKdvOrani                      = Guvenlik($_POST["KdvOrani"]);
    }else{
        $GelenKdvOrani                      = "";
    }
    if(isset($_POST["UrunAciklamasi"])){
        $GelenUrunAciklamasi                = Guvenlik($_POST["UrunAciklamasi"]);
    }else{
        $GelenUrunAciklamasi                = "";
    }
    if(isset($_POST["VaryantBasligi"])){
        $GelenVaryantBasligi                = Guvenlik($_POST["VaryantBasligi"]);
    }else{
        $GelenVaryantBasligi                = "";
    }
    if(isset($_POST["VaryantAdi1"])){
        $GelenVaryantAdi1                   = Guvenlik($_POST["VaryantAdi1"]);
    }else{
        $GelenVaryantAdi1                   = "";
    }
    if(isset($_POST["StokAdedi1"])){
        $GelenStokAdedi1                    = Guvenlik($_POST["StokAdedi1"]);
    }else{
        $GelenStokAdedi1                    = "";
    }
    if(isset($_POST["VaryantAdi2"])){
        $GelenVaryantAdi2                   = Guvenlik($_POST["VaryantAdi2"]);
    }else{
        $GelenVaryantAdi2                   = "";
    }
    if(isset($_POST["StokAdedi2"])){
        $GelenStokAdedi2                    = Guvenlik($_POST["StokAdedi2"]);
    }else{
        $GelenStokAdedi2                    = "";
    }
    if(isset($_POST["VaryantAdi3"])){
        $GelenVaryantAdi3                   = Guvenlik($_POST["VaryantAdi3"]);
    }else{
        $GelenVaryantAdi3                   = "";
    }
    if(isset($_POST["StokAdedi3"])){
        $GelenStokAdedi3                    = Guvenlik($_POST["StokAdedi3"]);
    }else{
        $GelenStokAdedi3                    = "";
    }
    if(isset($_POST["VaryantAdi4"])){
        $GelenVaryantAdi4                   = Guvenlik($_POST["VaryantAdi4"]);
    }else{
        $GelenVaryantAdi4                   = "";
    }
    if(isset($_POST["StokAdedi4"])){
        $GelenStokAdedi4                    = Guvenlik($_POST["StokAdedi4"]);
    }else{
        $GelenStokAdedi4                    = "";
    }
    if(isset($_POST["VaryantAdi5"])){
        $GelenVaryantAdi5                   = Guvenlik($_POST["VaryantAdi5"]);
    }else{
        $GelenVaryantAdi5                   = "";
    }
    if(isset($_POST["StokAdedi5"])){
        $GelenStokAdedi5                    = Guvenlik($_POST["StokAdedi5"]);
    }else{
        $GelenStokAdedi5                    = "";
    }
    if(isset($_POST["VaryantAdi6"])){
        $GelenVaryantAdi6                   = Guvenlik($_POST["VaryantAdi6"]);
    }else{
        $GelenVaryantAdi6                   = "";
    }
    if(isset($_POST["StokAdedi6"])){
        $GelenStokAdedi6                    = Guvenlik($_POST["StokAdedi6"]);
    }else{
        $GelenStokAdedi6                    = "";
    }
    if(isset($_POST["VaryantAdi7"])){
        $GelenVaryantAdi7                   = Guvenlik($_POST["VaryantAdi7"]);
    }else{
        $GelenVaryantAdi7                   = "";
    }
    if(isset($_POST["StokAdedi7"])){
        $GelenStokAdedi7                    = Guvenlik($_POST["StokAdedi7"]);
    }else{
        $GelenStokAdedi7                    = "";
    }
    if(isset($_POST["VaryantAdi8"])){
        $GelenVaryantAdi8                   = Guvenlik($_POST["VaryantAdi8"]);
    }else{
        $GelenVaryantAdi8                   = "";
    }
    if(isset($_POST["StokAdedi8"])){
        $GelenStokAdedi8                    = Guvenlik($_POST["StokAdedi8"]);
    }else{
        $GelenStokAdedi8                    = "";
    }
    if(isset($_POST["VaryantAdi9"])){
        $GelenVaryantAdi9                   = Guvenlik($_POST["VaryantAdi9"]);
    }else{
        $GelenVaryantAdi9                   = "";
    }
    if(isset($_POST["StokAdedi9"])){
        $GelenStokAdedi9                    = Guvenlik($_POST["StokAdedi9"]);
    }else{
        $GelenStokAdedi9                    = "";
    }
    if(isset($_POST["VaryantAdi10"])){
        $GelenVaryantAdi10                  = Guvenlik($_POST["VaryantAdi10"]);
    }else{
        $GelenVaryantAdi10                  = "";
    }
    if(isset($_POST["StokAdedi10"])){
        $GelenStokAdedi10                   = Guvenlik($_POST["StokAdedi10"]);
    }else{
        $GelenStokAdedi10                   = "";
    }
    $GelenUrunResmiBir                      = $_FILES["UrunResmiBir"];
    $GelenUrunResmiIki                      = $_FILES["UrunResmiIki"];
    $GelenUrunResmiUc                       = $_FILES["UrunResmiUc"];
    $GelenUrunResmiDort                     = $_FILES["UrunResmiDort"];
    
    if( ($GelenUrunMenusu!="") && ($GelenUrunAdi!="") && ($GelenUrunFiyati!="") && ($GelenParaBirimi!="") && ($GelenKargoUcreti!="") && ($GelenKdvOrani!="") && 
        ($GelenUrunAciklamasi!="") && ($GelenVaryantBasligi!="") && ($GelenVaryantAdi1!="") && ($GelenStokAdedi1!="") ){

            $UrunSorgusu          =   $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id=? LIMIT 1");
            $UrunSorgusu->execute([$GelenID]);
            $UrunKontrol               =   $UrunSorgusu->rowCount();
            $UrunBilgisi               =   $UrunSorgusu->fetch(PDO::FETCH_ASSOC);

            if($UrunKontrol>0){

            $MenuTuruSorgusu            =   $VeriTabaniBaglantisi->prepare("SELECT * FROM menuler WHERE id=? LIMIT 1 ");
            $MenuTuruSorgusu->execute([$GelenUrunMenusu]);
            $MenuTuruKontrol            =   $MenuTuruSorgusu->rowCount();
            $MenuTuruKaydi              =   $MenuTuruSorgusu->fetch(PDO::FETCH_ASSOC);

            if($MenuTuruKaydi["UrunTuru"]=="Erkek Ayakkabısı"){
                $ResimKlasoru   =   "UrunResimleri/Erkek/";
            }elseif($MenuTuruKaydi["UrunTuru"]=="Kadın Ayakkabısı"){
                $ResimKlasoru   =   "UrunResimleri/Kadin/";
            }elseif($MenuTuruKaydi["UrunTuru"]=="Çocuk Ayakkabısı"){
                $ResimKlasoru   =   "UrunResimleri/Cocuk/";
            }

            if($MenuTuruKontrol>0){

                $UrunGuncellemeSorgusu             =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET MenuId=? , UrunAdi=? , UrunFiyati=? , ParaBirimi=? , KdvOrani=? , 
                UrunAciklamasi=? , VaryantBasligi=? , KargoUcreti=? WHERE id=? LIMIT 1");
                $UrunGuncellemeSorgusu->execute([$GelenUrunMenusu,$GelenUrunAdi,$GelenUrunFiyati,$GelenParaBirimi,$GelenKdvOrani,$GelenUrunAciklamasi,$GelenVaryantBasligi,
                $GelenKargoUcreti,$GelenID]);
                $UrunGuncellemeKontrol             =   $UrunGuncellemeSorgusu->rowCount();

                        if( ($GelenUrunResmiBir["name"]!="") && ($GelenUrunResmiBir["type"]!="") && ($GelenUrunResmiBir["tmp_name"]!="") && 
                            ($GelenUrunResmiBir["error"]==0) && ($GelenUrunResmiBir["size"]>0) ){

                            $BirinciResimIcinDosyaAdi       =   ResimAdiOlustur();
                            $GelenBirinciResminUzantisi     =   substr($GelenUrunResmiBir["name"], -4);
                            if($GelenBirinciResminUzantisi=="jpeg"){
                                $GelenBirinciResminUzantisi        =   "." . $GelenBirinciResminUzantisi;
                            }
                            $BirinciResimIcinYeniDosyaAdi          =   $BirinciResimIcinDosyaAdi.$GelenBirinciResminUzantisi;

                            $BirinciResimYukle      =   new \Verot\Upload\Upload($GelenUrunResmiBir, "tr-TR");
                                if ($BirinciResimYukle->uploaded) {
                                    $BirinciResimYukle->mime_magic_check              = true;
                                    $BirinciResimYukle->allowed                       = array("image/*");
                                    $BirinciResimYukle->file_new_name_body            = $BirinciResimIcinDosyaAdi;
                                    $BirinciResimYukle->file_overwrite                = true;
                                    // $BirinciResimYukle->image_convert                 = "png";
                                    $BirinciResimYukle->image_quality                 = 100;
                                    $BirinciResimYukle->image_background_color        = "#FFFFFF";
                                    $BirinciResimYukle->image_resize                  = true;
                                    $BirinciResimYukle->image_x                       = 600;
                                    $BirinciResimYukle->image_y                       = 800;
                                    
                                    $BirinciResimYukle->process($VerotIcinKlasorYolu.$ResimKlasoru);

                                    if ($BirinciResimYukle->processed) {
                                        $SilinecekBirinciResimYolu         =   "../Resimler/".$ResimKlasoru.$UrunBilgisi["UrunResmiBir"];
                                        unlink($SilinecekBirinciResimYolu);

                                        $BirinciResimGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET UrunResmiBir=? WHERE id=? LIMIT 1");
                                        $BirinciResimGuncellemeSorgusu->execute([$BirinciResimIcinYeniDosyaAdi,$GelenID]);
                                        $BirinciResimGuncellemeKontrol              =   $BirinciResimGuncellemeSorgusu->rowCount();

                                        if($BirinciResimGuncellemeKontrol<1){
                                            header("Location: index.php?SKD=0&SKI=102");
                                            exit();
                                        }
                                        $BirinciResimYukle->clean();
                                        } else {
                                        header("Location: index.php?SKD=0&SKI=102");
                                        exit();
                                    }
                                }
            
                        }

                        if( ($GelenUrunResmiIki["name"]!="") && ($GelenUrunResmiIki["type"]!="") && ($GelenUrunResmiIki["tmp_name"]!="") && 
                            ($GelenUrunResmiIki["error"]==0) && ($GelenUrunResmiIki["size"]>0) ){

                            $IkinciResimIcinDosyaAdi       =   ResimAdiOlustur();
                            $GelenIkinciResminUzantisi     =   substr($GelenUrunResmiIki["name"], -4);
                            if($GelenIkinciResminUzantisi=="jpeg"){
                                $GelenIkinciResminUzantisi        =   "." . $GelenIkinciResminUzantisi;
                            }
                            $IkinciResimIcinYeniDosyaAdi          =   $IkinciResimIcinDosyaAdi.$GelenIkinciResminUzantisi;

                                $IkinciResimYukle      =   new \Verot\Upload\Upload($GelenUrunResmiIki, "tr-TR");
                                    if ($IkinciResimYukle->uploaded) {
                                        $IkinciResimYukle->mime_magic_check              = true;
                                        $IkinciResimYukle->allowed                       = array("image/*");
                                        $IkinciResimYukle->file_new_name_body            = $IkinciResimIcinDosyaAdi;
                                        $IkinciResimYukle->file_overwrite                = true;
                                        // $IkinciResimYukle->image_convert                 = "png";
                                        $IkinciResimYukle->image_quality                 = 100;
                                        $IkinciResimYukle->image_background_color        = "#FFFFFF";
                                        $IkinciResimYukle->image_resize                  = true;
                                        $IkinciResimYukle->image_x                       = 600;
                                        $IkinciResimYukle->image_y                       = 800;
                                        
                                        $IkinciResimYukle->process($VerotIcinKlasorYolu.$ResimKlasoru);

                                        if ($IkinciResimYukle->processed) {
                                            $SilinecekIkinciResimYolu         =   "../Resimler/".$ResimKlasoru.$UrunBilgisi["UrunResmiIki"];
                                            unlink($SilinecekIkinciResimYolu);

                                            $IkinciResimGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET UrunResmiIki=? WHERE id=? LIMIT 1");
                                            $IkinciResimGuncellemeSorgusu->execute([$IkinciResimIcinYeniDosyaAdi,$GelenID]);
                                            $IkinciResimGuncellemeKontrol              =   $IkinciResimGuncellemeSorgusu->rowCount();

                                            if($IkinciResimGuncellemeKontrol<1){
                                                header("Location: index.php?SKD=0&SKI=102");
                                                exit();
                                            }
                                            $IkinciResimYukle->clean();
                                            } else {
                                            header("Location: index.php?SKD=0&SKI=102");
                                            exit();
                                        }
                                    }
                                    
                        }

                        if( ($GelenUrunResmiUc["name"]!="") && ($GelenUrunResmiUc["type"]!="") && ($GelenUrunResmiUc["tmp_name"]!="") && 
                            ($GelenUrunResmiUc["error"]==0) && ($GelenUrunResmiUc["size"]>0) ){

                            $UcuncuResimIcinDosyaAdi       =   ResimAdiOlustur();
                            $GelenUcuncuResminUzantisi     =   substr($GelenUrunResmiUc["name"], -4);
                            if($GelenUcuncuResminUzantisi=="jpeg"){
                                $GelenUcuncuResminUzantisi        =   "." . $GelenUcuncuResminUzantisi;
                            }
                            $UcuncuResimIcinYeniDosyaAdi          =   $UcuncuResimIcinDosyaAdi.$GelenUcuncuResminUzantisi;

                                $UcuncuResimYukle      =   new \Verot\Upload\Upload($GelenUrunResmiUc, "tr-TR");
                                    if ($UcuncuResimYukle->uploaded) {
                                        $UcuncuResimYukle->mime_magic_check              = true;
                                        $UcuncuResimYukle->allowed                       = array("image/*");
                                        $UcuncuResimYukle->file_new_name_body            = $UcuncuResimIcinDosyaAdi;
                                        $UcuncuResimYukle->file_overwrite                = true;
                                        // $UcuncuResimYukle->image_convert                 = "png";
                                        $UcuncuResimYukle->image_quality                 = 100;
                                        $UcuncuResimYukle->image_background_color        = "#FFFFFF";
                                        $UcuncuResimYukle->image_resize                  = true;
                                        $UcuncuResimYukle->image_x                       = 600;
                                        $UcuncuResimYukle->image_y                       = 800;
                                        
                                        $UcuncuResimYukle->process($VerotIcinKlasorYolu.$ResimKlasoru);

                                        if ($UcuncuResimYukle->processed) {
                                            $SilinecekUcuncuResimYolu         =   "../Resimler/".$ResimKlasoru.$UrunBilgisi["UrunResmiUc"];
                                            unlink($SilinecekUcuncuResimYolu);

                                            $UcuncuResimGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET UrunResmiUc=? WHERE id=? LIMIT 1");
                                            $UcuncuResimGuncellemeSorgusu->execute([$UcuncuResimIcinYeniDosyaAdi,$GelenID]);
                                            $UcuncuResimGuncellemeKontrol              =   $UcuncuResimGuncellemeSorgusu->rowCount();

                                            if($UcuncuResimGuncellemeKontrol<1){
                                                header("Location: index.php?SKD=0&SKI=102");
                                                exit();
                                            }
                                            $UcuncuResimYukle->clean();
                                            } else {
                                            header("Location: index.php?SKD=0&SKI=102");
                                            exit();
                                        }
                                    }
                                    
                        }

                        if( ($GelenUrunResmiDort["name"]!="") && ($GelenUrunResmiDort["type"]!="") && ($GelenUrunResmiDort["tmp_name"]!="") && 
                            ($GelenUrunResmiDort["error"]==0) && ($GelenUrunResmiDort["size"]>0) ){

                            $DorduncuResimIcinDosyaAdi       =   ResimAdiOlustur();
                            $GelenDorduncuResminUzantisi     =   substr($GelenUrunResmiDort["name"], -4);
                            if($GelenDorduncuResminUzantisi=="jpeg"){
                                $GelenDorduncuResminUzantisi        =   "." . $GelenDorduncuResminUzantisi;
                            }
                            $DorduncuResimIcinYeniDosyaAdi          =   $DorduncuResimIcinDosyaAdi.$GelenDorduncuResminUzantisi;

                                $DorduncuResimYukle      =   new \Verot\Upload\Upload($GelenUrunResmiDort, "tr-TR");
                                    if ($DorduncuResimYukle->uploaded) {
                                        $DorduncuResimYukle->mime_magic_check              = true;
                                        $DorduncuResimYukle->allowed                       = array("image/*");
                                        $DorduncuResimYukle->file_new_name_body            = $DorduncuResimIcinDosyaAdi;
                                        $DorduncuResimYukle->file_overwrite                = true;
                                        // $DorduncuResimYukle->image_convert                 = "png";
                                        $DorduncuResimYukle->image_quality                 = 100;
                                        $DorduncuResimYukle->image_background_color        = "#FFFFFF";
                                        $DorduncuResimYukle->image_resize                  = true;
                                        $DorduncuResimYukle->image_x                       = 600;
                                        $DorduncuResimYukle->image_y                       = 800;
                                        
                                        $DorduncuResimYukle->process($VerotIcinKlasorYolu.$ResimKlasoru);

                                        if ($DorduncuResimYukle->processed) {
                                            $SilinecekDorduncuResimYolu         =   "../Resimler/".$ResimKlasoru.$UrunBilgisi["UrunResmiDort"];
                                            unlink($SilinecekDorduncuResimYolu);

                                            $DorduncuResimGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET UrunResmiDort=? WHERE id=? LIMIT 1");
                                            $DorduncuResimGuncellemeSorgusu->execute([$DorduncuResimIcinYeniDosyaAdi,$GelenID]);
                                            $DorduncuResimGuncellemeKontrol              =   $DorduncuResimGuncellemeSorgusu->rowCount();

                                            if($DorduncuResimGuncellemeKontrol<1){
                                                header("Location: index.php?SKD=0&SKI=102");
                                                exit();
                                            }
                                            $DorduncuResimYukle->clean();
                                            } else {
                                            header("Location: index.php?SKD=0&SKI=102");
                                            exit();
                                        }
                                    }
                                    
                        }

                        $VaryantlarSorgusu          = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE UrunId=?");
                        $VaryantlarSorgusu->execute([$GelenID]);
                        $VaryantlarSayisi           = $VaryantlarSorgusu->rowCount();
                        $VaryantlarBilgisi          = $VaryantlarSorgusu->fetchAll(PDO::FETCH_ASSOC);

                        $VaryantIsimDizisi          = array();
                        $VaryantStokDizisi          = array();

                        foreach($VaryantlarBilgisi as $Varyant){
                            $VaryantIsimDizisi[]          = $Varyant["VaryantAdi"];
                        }

                        if(array_key_exists(0,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi1!="") && ($GelenStokAdedi1!="") ){

                                $BirinciVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $BirinciVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi1,$GelenStokAdedi1,$GelenID,$VaryantIsimDizisi[0]]);
                                $BirinciVaryantGuncellemeKontrol              =   $BirinciVaryantGuncellemeSorgusu->rowCount();
                            }
                        }

                        if(array_key_exists(1,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi2!="") && ($GelenStokAdedi2!="") ){

                                $IkinciVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $IkinciVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi2,$GelenStokAdedi2,$GelenID,$VaryantIsimDizisi[1]]);
                                $IkinciVaryantGuncellemeKontrol              =   $IkinciVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $IkinciVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $IkinciVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[1]]);
                                $IkinciVaryantSilmeKontrol              =   $IkinciVaryantSilmeSorgusu->rowCount();
                                if($IkinciVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi2!="") && ($GelenStokAdedi2!="") ){

                                $IkinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $IkinciVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi2,$GelenStokAdedi2]);
                                $IkinciVaryantEklemeKontrol              =   $IkinciVaryantEklemeSorgusu->rowCount();
                                if($IkinciVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                        if(array_key_exists(2,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi3!="") && ($GelenStokAdedi3!="") ){
                        
                                $UcuncuVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $UcuncuVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi3,$GelenStokAdedi3,$GelenID,$VaryantIsimDizisi[2]]);
                                $UcuncuVaryantGuncellemeKontrol              =   $UcuncuVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $UcuncuVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $UcuncuVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[2]]);
                                $UcuncuVaryantSilmeKontrol              =   $UcuncuVaryantSilmeSorgusu->rowCount();
                                if($UcuncuVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi3!="") && ($GelenStokAdedi3!="") ){
                        
                                $UcuncuVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $UcuncuVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi3,$GelenStokAdedi3]);
                                $UcuncuVaryantEklemeKontrol              =   $UcuncuVaryantEklemeSorgusu->rowCount();
                                if($UcuncuVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                        if(array_key_exists(3,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi4!="") && ($GelenStokAdedi4!="") ){
                        
                                $DorduncuVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $DorduncuVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi4,$GelenStokAdedi4,$GelenID,$VaryantIsimDizisi[3]]);
                                $DorduncuVaryantGuncellemeKontrol              =   $DorduncuVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $DorduncuVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $DorduncuVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[3]]);
                                $DorduncuVaryantSilmeKontrol              =   $DorduncuVaryantSilmeSorgusu->rowCount();
                                if($DorduncuVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi4!="") && ($GelenStokAdedi4!="") ){
                        
                                $DorduncuVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $DorduncuVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi4,$GelenStokAdedi4]);
                                $DorduncuVaryantEklemeKontrol              =   $DorduncuVaryantEklemeSorgusu->rowCount();
                                if($DorduncuVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                        if(array_key_exists(4,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi5!="") && ($GelenStokAdedi5!="") ){
                        
                                $BesinciVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $BesinciVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi5,$GelenStokAdedi5,$GelenID,$VaryantIsimDizisi[4]]);
                                $BesinciVaryantGuncellemeKontrol              =   $BesinciVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $BesinciVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $BesinciVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[4]]);
                                $BesinciVaryantSilmeKontrol              =   $BesinciVaryantSilmeSorgusu->rowCount();
                                if($BesinciVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi5!="") && ($GelenStokAdedi5!="") ){
                        
                                $BesinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $BesinciVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi5,$GelenStokAdedi5]);
                                $BesinciVaryantEklemeKontrol              =   $BesinciVaryantEklemeSorgusu->rowCount();
                                if($BesinciVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                        if(array_key_exists(5,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi6!="") && ($GelenStokAdedi6!="") ){
                        
                                $AltinciVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $AltinciVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi6,$GelenStokAdedi6,$GelenID,$VaryantIsimDizisi[5]]);
                                $AltinciVaryantGuncellemeKontrol              =   $AltinciVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $AltinciVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $AltinciVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[5]]);
                                $AltinciVaryantSilmeKontrol              =   $AltinciVaryantSilmeSorgusu->rowCount();
                                if($AltinciVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi6!="") && ($GelenStokAdedi6!="") ){
                        
                                $AltinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $AltinciVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi6,$GelenStokAdedi6]);
                                $AltinciVaryantEklemeKontrol              =   $AltinciVaryantEklemeSorgusu->rowCount();
                                if($AltinciVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                        if(array_key_exists(6,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi7!="") && ($GelenStokAdedi7!="") ){
                        
                                $YedinciVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $YedinciVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi7,$GelenStokAdedi7,$GelenID,$VaryantIsimDizisi[6]]);
                                $YedinciVaryantGuncellemeKontrol              =   $YedinciVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $YedinciVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $YedinciVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[6]]);
                                $YedinciVaryantSilmeKontrol              =   $YedinciVaryantSilmeSorgusu->rowCount();
                                if($YedinciVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi7!="") && ($GelenStokAdedi7!="") ){
                        
                                $YedinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $YedinciVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi7,$GelenStokAdedi7]);
                                $YedinciVaryantEklemeKontrol              =   $YedinciVaryantEklemeSorgusu->rowCount();
                                if($YedinciVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                        if(array_key_exists(7,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi8!="") && ($GelenStokAdedi8!="") ){
                        
                                $SekizinciVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $SekizinciVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi8,$GelenStokAdedi8,$GelenID,$VaryantIsimDizisi[7]]);
                                $SekizinciVaryantGuncellemeKontrol              =   $SekizinciVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $SekizinciVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $SekizinciVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[7]]);
                                $SekizinciVaryantSilmeKontrol              =   $SekizinciVaryantSilmeSorgusu->rowCount();
                                if($SekizinciVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi8!="") && ($GelenStokAdedi8!="") ){
                        
                                $SekizinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $SekizinciVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi8,$GelenStokAdedi8]);
                                $SekizinciVaryantEklemeKontrol              =   $SekizinciVaryantEklemeSorgusu->rowCount();
                                if($SekizinciVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                        if(array_key_exists(8,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi9!="") && ($GelenStokAdedi9!="") ){
                        
                                $DokuzuncuVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $DokuzuncuVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi9,$GelenStokAdedi9,$GelenID,$VaryantIsimDizisi[8]]);
                                $DokuzuncuVaryantGuncellemeKontrol              =   $DokuzuncuVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $DokuzuncuVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $DokuzuncuVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[8]]);
                                $DokuzuncuVaryantSilmeKontrol              =   $DokuzuncuVaryantSilmeSorgusu->rowCount();
                                if($DokuzuncuVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi9!="") && ($GelenStokAdedi9!="") ){
                        
                                $DokuzuncuVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $DokuzuncuVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi9,$GelenStokAdedi9]);
                                $DokuzuncuVaryantEklemeKontrol              =   $DokuzuncuVaryantEklemeSorgusu->rowCount();
                                if($DokuzuncuVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                        if(array_key_exists(9,$VaryantIsimDizisi)){
                            if( ($GelenVaryantAdi10!="") && ($GelenStokAdedi10!="") ){
                        
                                $OnuncuVaryantGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunvaryantlari SET VaryantAdi=? , StokAdedi=? 
                                WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $OnuncuVaryantGuncellemeSorgusu->execute([$GelenVaryantAdi10,$GelenStokAdedi10,$GelenID,$VaryantIsimDizisi[9]]);
                                $OnuncuVaryantGuncellemeKontrol              =   $OnuncuVaryantGuncellemeSorgusu->rowCount();
                            }else{
                                $OnuncuVaryantSilmeSorgusu              =   $VeriTabaniBaglantisi->prepare("DELETE FROM  urunvaryantlari WHERE UrunId=? AND VaryantAdi=? LIMIT 1");
                                $OnuncuVaryantSilmeSorgusu->execute([$GelenID,$VaryantIsimDizisi[9]]);
                                $OnuncuVaryantSilmeKontrol              =   $OnuncuVaryantSilmeSorgusu->rowCount();
                                if($OnuncuVaryantSilmeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }else{
                            if( ($GelenVaryantAdi10!="") && ($GelenStokAdedi10!="") ){
                        
                                $OnuncuVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES (?,?,?) ");
                                $OnuncuVaryantEklemeSorgusu->execute([$GelenID,$GelenVaryantAdi10,$GelenStokAdedi10]);
                                $OnuncuVaryantEklemeKontrol              =   $OnuncuVaryantEklemeSorgusu->rowCount();
                                if($OnuncuVaryantEklemeKontrol<1){
                                    header("Location: index.php?SKD=0&SKI=102");
                                    exit();
                                }
                            }
                        }

                header("Location: index.php?SKD=0&SKI=101");
                exit();
            }else{
                header("Location: index.php?SKD=0&SKI=102");
                exit();
            }
        }else{
            header("Location: index.php?SKD=0&SKI=102");
            exit();
        }
    }else{
        header("Location: index.php?SKD=0&SKI=102");
        exit();
    }
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>


