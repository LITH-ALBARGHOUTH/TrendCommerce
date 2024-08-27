<?php

if(isset($_SESSION["Kullanici"])){

if(isset($_GET["ID"])){
        $GelenID          = Guvenlik($_GET["ID"]);
}else{
        $GelenID          = "";
}

if($GelenID!=""){
    $SepetSilSorgusu = $VeriTabaniBaglantisi->prepare("DELETE FROM sepet WHERE id = ? AND UyeId = ? LIMIT 1");
    $SepetSilSorgusu->execute([$GelenID,$KullaniciID]);
    $SepetSilSayisi = $SepetSilSorgusu->rowCount();

    if($SepetSilSayisi>0){
        header("Location: index.php?SK=93");
        exit();
    }else{
        header("Location: index.php?SK=93");
        exit();
    }

}else{
    header("Location: index.php?SK=93");
    exit();
}


}else{
    header("Location: index.php");
    exit();
}

?>