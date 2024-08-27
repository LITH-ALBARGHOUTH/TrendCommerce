<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                      = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                      = "";
    }

    if( ($GelenID !="") ){

        $BildirimSilmeSorgusu      =   $VeriTabaniBaglantisi->prepare("DELETE FROM havalebildirimleri WHERE id=? LIMIT 1");
        $BildirimSilmeSorgusu->execute([$GelenID]);
        $BildirimSilmeKontrol      =   $BildirimSilmeSorgusu->rowCount();

            if($BildirimSilmeKontrol > 0){

                header("Location: index.php?SKD=0&SKI=118");
                exit();

            }else{
                header("Location: index.php?SKD=0&SKI=119");
                exit();
            }
    }else{
        header("Location: index.php?SKD=0&SKI=119");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
