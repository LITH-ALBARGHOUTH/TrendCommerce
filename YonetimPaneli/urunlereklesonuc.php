<?php


if(isset($_SESSION["Yonetici"])){

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
        ($GelenUrunAciklamasi!="") && ($GelenVaryantBasligi!="") && ($GelenVaryantAdi1!="") && ($GelenStokAdedi1!="") && ($GelenUrunResmiBir["name"]!="") && 
        ($GelenUrunResmiBir["type"]!="") && ($GelenUrunResmiBir["tmp_name"]!="") && ($GelenUrunResmiBir["error"]==0) && ($GelenUrunResmiBir["size"]>0) ){


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
            
            $BirinciResimIcinDosyaAdi       =   ResimAdiOlustur();
            $GelenBirinciResminUzantisi     =   substr($GelenUrunResmiBir["name"], -4);
            if($GelenBirinciResminUzantisi=="jpeg"){
                $GelenBirinciResminUzantisi        =   "." . $GelenBirinciResminUzantisi;
            }
            $BirinciResimIcinYeniDosyaAdi          =   $BirinciResimIcinDosyaAdi.$GelenBirinciResminUzantisi;

            $UrunEklemeSorgusu             =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunler (MenuId, UrunTuru, UrunAdi, UrunFiyati, ParaBirimi, KdvOrani, UrunAciklamasi, 
            UrunResmiBir, VaryantBasligi, KargoUcreti, Durumu, ToplamSatisSayisi, YorumSayisi, ToplamYorumPuani, GoruntulenmeSayisi) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");
            $UrunEklemeSorgusu->execute([$GelenUrunMenusu,$MenuTuruKaydi["UrunTuru"],$GelenUrunAdi,$GelenUrunFiyati,$GelenParaBirimi,$GelenKdvOrani,$GelenUrunAciklamasi,
            $BirinciResimIcinYeniDosyaAdi,$GelenVaryantBasligi,$GelenKargoUcreti,1,0,0,0,0]);
            $UrunEklemeKontrol             =   $UrunEklemeSorgusu->rowCount();
                if($UrunEklemeKontrol>0){
                    $SonEklenenUrunIDsi     =   $VeriTabaniBaglantisi->lastInsertId();

                    $BirinciResimYukle       =   new \Verot\Upload\Upload($GelenUrunResmiBir, "tr-TR");
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
                                $BirinciResimYukle->clean();
                                } else {
                                header("Location: index.php?SKD=0&SKI=98");
                                exit();
                            } 
                        }
                    

                    $MenuUrunSayisiGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE menuler SET UrunSayisi=UrunSayisi+1 WHERE id=? LIMIT 1");
                    $MenuUrunSayisiGuncellemeSorgusu->execute([$GelenUrunMenusu]);
                    $MenuUrunSayisiGuncellemeKontrol              =   $MenuUrunSayisiGuncellemeSorgusu->rowCount();
                    if($MenuUrunSayisiGuncellemeKontrol>0){
                        $BirinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                        $BirinciVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi1,$GelenStokAdedi1]);
                        $BirinciVaryantEklemeKontrol              =   $BirinciVaryantEklemeSorgusu->rowCount();
                        if($BirinciVaryantEklemeKontrol>0){
                            if( ($GelenVaryantAdi2!="") && ($GelenStokAdedi2!="") ){
                                $IkinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $IkinciVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi2,$GelenStokAdedi2]);
                            }
                            if( ($GelenVaryantAdi3!="") && ($GelenStokAdedi3!="") ){
                                $UcuncuVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $UcuncuVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi3,$GelenStokAdedi3]);
                            }
                            if( ($GelenVaryantAdi4!="") && ($GelenStokAdedi4!="") ){
                                $DorduncuVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $DorduncuVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi4,$GelenStokAdedi4]);
                            }
                            if( ($GelenVaryantAdi5!="") && ($GelenStokAdedi5!="") ){
                                $BesinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $BesinciVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi5,$GelenStokAdedi5]);
                            }
                            if( ($GelenVaryantAdi6!="") && ($GelenStokAdedi6!="") ){
                                $AltinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $AltinciVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi6,$GelenStokAdedi6]);
                            }
                            if( ($GelenVaryantAdi7!="") && ($GelenStokAdedi7!="") ){
                                $YedinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $YedinciVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi7,$GelenStokAdedi7]);
                            }
                            if( ($GelenVaryantAdi8!="") && ($GelenStokAdedi8!="") ){
                                $SekizinciVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $SekizinciVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi8,$GelenStokAdedi8]);
                            }
                            if( ($GelenVaryantAdi9!="") && ($GelenStokAdedi9!="") ){
                                $DokuzuncuVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $DokuzuncuVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi9,$GelenStokAdedi9]);
                            }
                            if( ($GelenVaryantAdi10!="") && ($GelenStokAdedi10!="") ){
                                $OnuncuVaryantEklemeSorgusu              =   $VeriTabaniBaglantisi->prepare("INSERT INTO urunvaryantlari (UrunId,VaryantAdi,StokAdedi) VALUES(?,?,?)");
                                $OnuncuVaryantEklemeSorgusu->execute([$SonEklenenUrunIDsi,$GelenVaryantAdi10,$GelenStokAdedi10]);
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

                                                $IkinciResimGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET UrunResmiIki=? WHERE id=? LIMIT 1");
                                                $IkinciResimGuncellemeSorgusu->execute([$IkinciResimIcinYeniDosyaAdi,$SonEklenenUrunIDsi]);
                                                $IkinciResimGuncellemeKontrol              =   $IkinciResimGuncellemeSorgusu->rowCount();

                                                if($IkinciResimGuncellemeKontrol<1){
                                                    header("Location: index.php?SKD=0&SKI=98");
                                                    exit();
                                                }
                                                $IkinciResimYukle->clean();
                                                } else {
                                                header("Location: index.php?SKD=0&SKI=98");
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

                                                $UcuncuResimGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET UrunResmiUc=? WHERE id=? LIMIT 1");
                                                $UcuncuResimGuncellemeSorgusu->execute([$UcuncuResimIcinYeniDosyaAdi,$SonEklenenUrunIDsi]);
                                                $UcuncuResimGuncellemeKontrol              =   $UcuncuResimGuncellemeSorgusu->rowCount();

                                                if($UcuncuResimGuncellemeKontrol<1){
                                                    header("Location: index.php?SKD=0&SKI=98");
                                                    exit();
                                                }
                                                $UcuncuResimYukle->clean();
                                                } else {
                                                header("Location: index.php?SKD=0&SKI=98");
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

                                                $DorduncuResimGuncellemeSorgusu              =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET UrunResmiDort=? WHERE id=? LIMIT 1");
                                                $DorduncuResimGuncellemeSorgusu->execute([$DorduncuResimIcinYeniDosyaAdi,$SonEklenenUrunIDsi]);
                                                $DorduncuResimGuncellemeKontrol              =   $DorduncuResimGuncellemeSorgusu->rowCount();

                                                if($DorduncuResimGuncellemeKontrol<1){
                                                    header("Location: index.php?SKD=0&SKI=98");
                                                    exit();
                                                }
                                                $DorduncuResimYukle->clean();
                                                } else {
                                                header("Location: index.php?SKD=0&SKI=98");
                                                exit();
                                            }
                                        }
                                        
                            }
                            header("Location: index.php?SKD=0&SKI=97");
                            exit();
                        }else{
                            header("Location: index.php?SKD=0&SKI=98");
                            exit();
                        }
                    }else{
                        header("Location: index.php?SKD=0&SKI=98");
                        exit();
                    }
            }else{
                header("Location: index.php?SKD=0&SKI=98");
                exit();
            }
        }else{
            header("Location: index.php?SKD=0&SKI=98");
            exit();
        }
    }else{
        header("Location: index.php?SKD=0&SKI=98");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>