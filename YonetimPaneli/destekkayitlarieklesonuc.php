<?php


if(isset($_SESSION["Yonetici"])){

    if(isset($_POST["Soru"])){
        $GelenSoru                   = Guvenlik($_POST["Soru"]);
    }else{
        $GelenSoru                   = "";
    }
    if(isset($_POST["Cevap"])){
        $GelenCevap                  = Guvenlik($_POST["Cevap"]);
    }else{
        $GelenCevap                  = "";
    }


    if( ($GelenSoru!="") && ($GelenCevap!="") ){

        $DestekEklemeSorgusu             =   $VeriTabaniBaglantisi->prepare("INSERT INTO sorular (Soru, Cevap) values(?,?) ");
        $DestekEklemeSorgusu->execute([$GelenSoru,$GelenCevap]);
        $DestekEklemeKontrol             =   $DestekEklemeSorgusu->rowCount();

        if($DestekEklemeKontrol>0){
            header("Location: index.php?SKD=0&SKI=48");
            exit();
        }else{
            header("Location: index.php?SKD=0&SKI=49");
            exit();
        }

    }else{
        header("Location: index.php?SKD=0&SKI=49");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
