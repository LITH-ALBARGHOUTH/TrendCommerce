<?php
if(isset($_SESSION["Yonetici"])){

    if(isset($_POST["HakkimizdaMetni"])){
        $GelenHakkimizdaMetni                               = Guvenlik($_POST["HakkimizdaMetni"]);
    }else{
        $GelenHakkimizdaMetni                               = "";
    }
    if(isset($_POST["UyelikSozlesmeMetni"])){
        $GelenUyelikSozlesmeMetni                           = Guvenlik($_POST["UyelikSozlesmeMetni"]);
    }else{
        $GelenUyelikSozlesmeMetni                           = "";
    }
    if(isset($_POST["KullanimKosullariMetni"])){
        $GelenKullanimKosullariMetni                        = Guvenlik($_POST["KullanimKosullariMetni"]);
    }else{
        $GelenKullanimKosullariMetni                        = "";
    }
    if(isset($_POST["GizlilikSozlesmesiMetni"])){
        $GelenGizlilikSozlesmesiMetni                       = Guvenlik($_POST["GizlilikSozlesmesiMetni"]);
    }else{
        $GelenGizlilikSozlesmesiMetni                       = "";
    }
    if(isset($_POST["MesafeliSatisSozlesmesiMetni"])){
        $GelenMesafeliSatisSozlesmesiMetni                  = Guvenlik($_POST["MesafeliSatisSozlesmesiMetni"]);
    }else{
        $GelenMesafeliSatisSozlesmesiMetni                  = "";
    }
    if(isset($_POST["TeslimatMetni"])){
        $GelenTeslimatMetni                                 = Guvenlik($_POST["TeslimatMetni"]);
    }else{
        $GelenTeslimatMetni                                 = "";
    }
    if(isset($_POST["IptalIadeDegisimMetni"])){
        $GelenIptalIadeDegisimMetni                         = Guvenlik($_POST["IptalIadeDegisimMetni"]);
    }else{
        $GelenIptalIadeDegisimMetni                         = "";
    }


    if( ($GelenHakkimizdaMetni !="") && ($GelenUyelikSozlesmeMetni !="") && ($GelenKullanimKosullariMetni !="") && ($GelenGizlilikSozlesmesiMetni !="") && ($GelenMesafeliSatisSozlesmesiMetni !="") && ($GelenTeslimatMetni !="") && 
    ($GelenIptalIadeDegisimMetni !="")){

        $MetinleriGuncelle           = $VeriTabaniBaglantisi->prepare("UPDATE sozlesmelervemetinler SET HakkimizdaMetni=? , UyelikSozlesmeMetni=? , KullanimKosullariMetni=? , GizlilikSozlesmesiMetni=? , MesafeliSatisSozlesmesiMetni=? , 
        TeslimatMetni=? , IptalIadeDegisimMetni=? ");
        $MetinleriGuncelle->execute([$GelenHakkimizdaMetni,$GelenUyelikSozlesmeMetni,$GelenKullanimKosullariMetni,$GelenGizlilikSozlesmesiMetni,$GelenMesafeliSatisSozlesmesiMetni,$GelenTeslimatMetni,$GelenIptalIadeDegisimMetni]);



            header("Location: index.php?SKD=0&SKI=7");
            exit();

    }else{
        header("Location: index.php?SKD=0&SKI=8");
        exit();
    }

}else{
    header("Location: index.php?SKD=1");
    exit();
}
?>
