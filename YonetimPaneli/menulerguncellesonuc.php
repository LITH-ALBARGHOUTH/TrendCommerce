<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                  = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                  = "";
    }
    if(isset($_POST["UrunTuru"])){
        $GelenUrunTuru            = Guvenlik($_POST["UrunTuru"]);
    }else{
        $GelenUrunTuru            = "";
    }
    if(isset($_POST["MenuAdi"])){
        $GelenMenuAdi             = Guvenlik($_POST["MenuAdi"]);
    }else{
        $GelenMenuAdi             = "";
    }


    if( ($GelenID !="") && ($GelenUrunTuru !="") && ($GelenMenuAdi !="") ){

        $MenuGuncellemeSorgusu                =   $VeriTabaniBaglantisi->prepare("UPDATE menuler SET UrunTuru=? , MenuAdi=? WHERE id=? LIMIT 1");
        $MenuGuncellemeSorgusu->execute([$GelenUrunTuru,$GelenMenuAdi,$GelenID]);
        $MenuGuncellemeKontrol            =   $MenuGuncellemeSorgusu->rowCount();

            if($MenuGuncellemeKontrol>0){
                header("Location: index.php?SKD=0&SKI=64");
                exit();
            }else{
                header("Location: index.php?SKD=0&SKI=65");
                exit();
            }
    }else{
        header("Location: index.php?SKD=0&SKI=65");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>


