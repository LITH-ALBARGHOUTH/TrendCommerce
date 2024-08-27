<?php

if (isset($_SESSION["Kullanici"])) {

    if (isset($_GET["ID"])) {
        $GelenID = Guvenlik($_GET["ID"]);
    } else {
        $GelenID = "";
    }
    if (isset($_POST["Varyant"])) {
        $GelenVaryant = Guvenlik($_POST["Varyant"]);
    } else {
        $GelenVaryant = "";
    }

    if (($GelenID != "") && ($GelenVaryant != "")) {

        if ($KullaniciSepetSayisi > 0) {
           
            $UrunSepetKontrolSorgusu = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId=? AND UrunId=? AND VaryantId=? LIMIT 1");
            $UrunSepetKontrolSorgusu->execute([$KullaniciID, $GelenID, $GelenVaryant]);
            $UrunSepetSayisi = $UrunSepetKontrolSorgusu->rowCount();
            $UrunSepetKaydi = $UrunSepetKontrolSorgusu->fetch(PDO::FETCH_ASSOC);
          

            if ($UrunSepetSayisi > 0) {
                                
                $UrununIDsi = $UrunSepetKaydi["id"];
                $UrununSepettekiMevcutAdedi = $UrunSepetKaydi["UrunAdedi"];
                $UrununYeniAdedi = $UrununSepettekiMevcutAdedi + 1;

                $UrunGuncelleSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE sepet SET UrunAdedi=? WHERE id=? AND UyeId=? AND UrunId=? LIMIT 1 ");
                $UrunGuncelleSorgusu->execute([$UrununYeniAdedi, $UrununIDsi, $KullaniciID, $GelenID]);
                $UrunGuncelleSayisi = $UrunGuncelleSorgusu->rowCount();

                if ($UrunGuncelleSayisi > 0) {
                    header("Location: index.php?SK=94");
                    exit();
                } else {
                    header("Location: index.php?SK=91");
                    exit();
                }

            } else {

                $UrunEklemeSorgusu = $VeriTabaniBaglantisi->prepare("INSERT INTO sepet (UyeId, UrunId, VaryantId, UrunAdedi, SepetNumarasi, KargoFirmasiSecimi, AdresId, OdemeSecimi, TaksitSecimi) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $UrunEklemeSorgusu->execute([$KullaniciID, $GelenID, $GelenVaryant, 1, 1, 1, 1, 1, 1]);
                $UrunEklemeSayisi = $UrunEklemeSorgusu->rowCount();
                $SonIdDegeri = $VeriTabaniBaglantisi->lastInsertId();

                if ($UrunEklemeSayisi > 0) {
                    $SiparisNumarasiniGuncelleSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE sepet SET SepetNumarasi=? WHERE UyeId=?");
                    $SiparisNumarasiniGuncelleSorgusu->execute([$SonIdDegeri, $KullaniciID]);
                    $SiparisNumarasiniGuncelleSayisi = $SiparisNumarasiniGuncelleSorgusu->rowCount();

                    if ($SiparisNumarasiniGuncelleSayisi > 0) {
                        header("Location: index.php?SK=93");
                        exit();
                    } else {
                        header("Location: index.php?SK=91");
                        exit();
                    }
                } else {
                    header("Location: index.php?SK=91");
                    exit();
                }

            }

        } else {

            $UrunEklemeSorgusu = $VeriTabaniBaglantisi->prepare("INSERT INTO sepet (UyeId, UrunId, VaryantId, UrunAdedi, SepetNumarasi, KargoId, AdresId, OdemeSecimi, TaksitSecimi) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $UrunEklemeSorgusu->execute([$KullaniciID, $GelenID, $GelenVaryant, 1, 1, 1, 1, 1, 1]);
            $UrunEklemeSayisi = $UrunEklemeSorgusu->rowCount();
            $SonIdDegeri = $VeriTabaniBaglantisi->lastInsertId();

            if ($UrunEklemeSayisi > 0) {
                $SiparisNumarasiniGuncelleSorgusu = $VeriTabaniBaglantisi->prepare("UPDATE sepet SET SepetNumarasi=? WHERE UyeId=?");
                $SiparisNumarasiniGuncelleSorgusu->execute([$SonIdDegeri, $KullaniciID]);
                $SiparisNumarasiniGuncelleSayisi = $SiparisNumarasiniGuncelleSorgusu->rowCount();

                if ($SiparisNumarasiniGuncelleSayisi > 0) {
                    header("Location: index.php?SK=93");
                    exit();
                } else {
                    header("Location: index.php?SK=91");
                    exit();
                }
            } else {
                header("Location: index.php?SK=91");
                exit();
            }
        }

    } else {
        header("Location: index.php");
        exit();
    }

} else {
    header("Location: index.php?SK=92");
    exit();
}
?>
