<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                      = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                      = "";
    }

    if( ($GelenID !="") ){

        $UrunlerSorgusu             =   $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id=?");
        $UrunlerSorgusu->execute([$GelenID]);
        $UrunlerKontrolSorgusu      =   $UrunlerSorgusu->rowCount();
        $UrunlerkayitSorgusu        =   $UrunlerSorgusu->fetch(PDO::FETCH_ASSOC);

        if($UrunlerKontrolSorgusu>0){
            $SilinecekUrununMenuIdsi    =   $UrunlerkayitSorgusu["MenuId"];

        $UrunSilmeSorgusu      =   $VeriTabaniBaglantisi->prepare("UPDATE urunler SET Durumu=? WHERE id=? LIMIT 1");
        $UrunSilmeSorgusu->execute([0,$GelenID]);
        $UrunSilmeKontrol      =   $UrunSilmeSorgusu->rowCount();

        if($UrunSilmeKontrol>0){
            $SepetSilmeSorgusu          =   $VeriTabaniBaglantisi->prepare("DELETE FROM sepet WHERE UrunId=?");
            $SepetSilmeSorgusu->execute([$GelenID]);

            $FavorilerSilmeSorgusu      =   $VeriTabaniBaglantisi->prepare("DELETE FROM favoriler WHERE UrunId=?");
            $FavorilerSilmeSorgusu->execute([$GelenID]);

            $MenuGuncellemeSorgusu      =   $VeriTabaniBaglantisi->prepare("UPDATE menuler SET UrunSayisi=UrunSayisi-1 WHERE id=?");
            $MenuGuncellemeSorgusu->execute([$SilinecekUrununMenuIdsi]);

            header("Location: index.php?SKD=0&SKI=104");
            exit();
        }else{
            header("Location: index.php?SKD=0&SKI=105");
            exit();
        }
        }else{
            header("Location: index.php?SKD=0&SKI=105");
            exit();
        }
    }else{
        header("Location: index.php?SKD=0&SKI=105");
        exit();
    }
}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
