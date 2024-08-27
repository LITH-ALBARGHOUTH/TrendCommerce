<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_GET["ID"])){
        $GelenID                  = Guvenlik($_GET["ID"]);
    }else{
        $GelenID                  = "";
    }
    if(isset($_POST["Soru"])){
        $GelenSoru               = Guvenlik($_POST["Soru"]);
    }else{
        $GelenSoru               = "";
    }
    if(isset($_POST["Cevap"])){
        $GelenCevap              = Guvenlik($_POST["Cevap"]);
    }else{
        $GelenCevap              = "";
    }


    if( ($GelenID !="") && ($GelenSoru !="") && ($GelenCevap !="") ){

        $DestekGuncellemeSorgusu                =   $VeriTabaniBaglantisi->prepare("UPDATE sorular SET Soru=? , Cevap=? WHERE id=? LIMIT 1");
        $DestekGuncellemeSorgusu->execute([$GelenSoru,$GelenCevap,$GelenID]);
        $DestekGuncellemeKontrol            =   $DestekGuncellemeSorgusu->rowCount();

            if($DestekGuncellemeKontrol>0){
                header("Location: index.php?SKD=0&SKI=52");
                exit();
            }else{
                header("Location: index.php?SKD=0&SKI=53");
                exit();
            }
    }else{
        header("Location: index.php?SKD=0&SKI=53");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>


