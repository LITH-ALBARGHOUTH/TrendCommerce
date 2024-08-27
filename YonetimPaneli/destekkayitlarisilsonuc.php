<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                      = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                      = "";
    }

    if( ($GelenID !="") ){

        $DestekSilmeSorgusu      =   $VeriTabaniBaglantisi->prepare("DELETE FROM sorular WHERE id=? LIMIT 1");
        $DestekSilmeSorgusu->execute([$GelenID]);
        $DestekSilmeKontrol      =   $DestekSilmeSorgusu->rowCount();

            if($DestekSilmeKontrol > 0){

                header("Location: index.php?SKD=0&SKI=55");
                exit();

            }else{
                header("Location: index.php?SKD=0&SKI=56");
                exit();
            }


    }else{
        header("Location: index.php?SKD=0&SKI=56");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
