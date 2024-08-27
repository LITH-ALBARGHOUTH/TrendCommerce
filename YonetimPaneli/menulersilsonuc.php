<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                      = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                      = "";
    }

    if( ($GelenID !="") ){

        $MenuSilmeSorgusu      =   $VeriTabaniBaglantisi->prepare("DELETE FROM menuler WHERE id=? LIMIT 1");
        $MenuSilmeSorgusu->execute([$GelenID]);
        $MenuSilmeKontrol      =   $MenuSilmeSorgusu->rowCount();

            if($MenuSilmeKontrol > 0){

                $UrunlerSorgusu             =   $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE MenuId=? ");
                $UrunlerSorgusu->execute([$GelenID]);
                $UrunlerKontrolSorgusu      =   $UrunlerSorgusu->rowCount();
                $UrunlerKayitlari           =   $UrunlerSorgusu->fetchAll(PDO::FETCH_ASSOC);

                    if($UrunlerKontrolSorgusu>0){
                        foreach($UrunlerKayitlari as $UrunKaydi){
                            $SilinecekUrununIDsi    =   $UrunKaydi["id"];
                        $UrunlerGuncellemeSorgusu             =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET Durumu=? WHERE id=? AND MenuId=?");
                        $UrunlerGuncellemeSorgusu->execute([0,$SilinecekUrununIDsi,$GelenID]);

                        $SepetSilmeSorgusu          =   $VeriTabaniBaglantisi->prepare("DELETE FROM sepet WHERE UrunId=?");
                        $SepetSilmeSorgusu->execute([$SilinecekUrununIDsi]);

                        $FavorilerSilmeSorgusu      =   $VeriTabaniBaglantisi->prepare("DELETE FROM favoriler WHERE UrunId=?");
                        $FavorilerSilmeSorgusu->execute([$SilinecekUrununIDsi]);
                        }
                    }

                header("Location: index.php?SKD=0&SKI=67");
                exit();
            }else{
                header("Location: index.php?SKD=0&SKI=68");
                exit();
            }
    }else{
        header("Location: index.php?SKD=0&SKI=68");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
