
<?php

if(isset($_SESSION["Kullanici"])){

if(isset($_GET["UrunID"])){
    $GelenUrunID            = Guvenlik($_GET["UrunID"]);
}else{
    $GelenUrunID            = "";
}
if(isset($_POST["Puan"])){
    $GelenPuan              = Guvenlik($_POST["Puan"]);
}else{
    $GelenPuan              = "";
}
if(isset($_POST["Yorum"])){
    $GelenYorum             = Guvenlik($_POST["Yorum"]);
}else{
    $GelenYorum             = "";
}
if( ($GelenUrunID!="") && ($GelenPuan!="") && ($GelenYorum!="")){

        $YorumKayitSorgusu = $VeriTabaniBaglantisi->prepare("INSERT INTO yorumlar(UrunId, UyeId, Puan, YorumMetni, YorumTarihi, YorumIpAdresi) 
        VALUES(?, ?, ?, ?, ?, ?)");
        $YorumKayitSorgusu->execute([$GelenUrunID, $KullaniciID, $GelenPuan, $GelenYorum, $ZamanDamgasi , $IPAdresi]);
        $YorumKayitKontrol  = $YorumKayitSorgusu->rowCount();

        if($YorumKayitKontrol>0){

        $UrunGucellemeSorgusu = $VeriTabaniBaglantisi->prepare(" UPDATE urunler SET YorumSayisi=YorumSayisi+1, ToplamYorumPuani=ToplamYorumPuani+$GelenPuan 
        WHERE id=$GelenUrunID LIMIT 1");
        $UrunGucellemeSorgusu->execute();
        $YorumKayitKontrol  = $UrunGucellemeSorgusu->rowCount();
        if($UrunGucellemeSorgusu){
            header("Location:index.php?SK=77");
            exit();
        }else{
            header("Location:index.php?SK=78");
            exit();
        }
        }else{
            header("Location:index.php?SK=78");
            exit();
        }
}else{
    header("Location:index.php?SK=79");
    exit();

}


}else{
    header("Location: index.php");
    exit();
}

?>