
<?php

if(isset($_SESSION["Kullanici"])){

    if(isset($_POST["OdemeTuruSecimi"])){
        $GelenOdemeTuruSecimi        = Guvenlik($_POST["OdemeTuruSecimi"]);
    }else{
        $GelenOdemeTuruSecimi        = "";
    }
    if(isset($_POST["TaksitSecimi"])){
        $GelenTaksitSecimi           = Guvenlik($_POST["TaksitSecimi"]);
    }else{
        $GelenTaksitSecimi           = "";
    }

    if(($GelenOdemeTuruSecimi!="")){
        if($GelenOdemeTuruSecimi=="Banka Havalesi"){


            $AlisveriSepetiSorgusu      = $VeriTabaniBaglantisi->prepare("SELECT * FROM sepet WHERE UyeId = ?");
            $AlisveriSepetiSorgusu->execute([$KullaniciID]);
            $AlisveriSepetiSayisi       = $AlisveriSepetiSorgusu->rowCount();
            $AlisveriSepetiUrunleri     = $AlisveriSepetiSorgusu->fetchAll(PDO::FETCH_ASSOC);


            if($AlisveriSepetiSayisi>0){

                $UrununToplamFiyati                   = 0;
                $UrununToplamKargoFiyati              = 0;


                foreach($AlisveriSepetiUrunleri as $SepetSatirlari){
                        $SepetId                      = $SepetSatirlari["id"];
                        $SepetNumarasi                = $SepetSatirlari["SepetNumarasi"];
                        $SepettekiUyeId               = $SepetSatirlari["UyeId"];
                        $SepettekiUrunId              = $SepetSatirlari["UrunId"];
                        $SepettekiAdresId             = $SepetSatirlari["AdresId"];
                        $SepettekiVaryantId           = $SepetSatirlari["VaryantId"];
                        $SepettekiKargoId             = $SepetSatirlari["KargoId"];
                        $SepettekiUrunAdedi           = $SepetSatirlari["UrunAdedi"];
                        $SepettekiOdemeSecimi         = $SepetSatirlari["OdemeSecimi"];
                        $SepettekiTaksitSecimi        = $SepetSatirlari["TaksitSecimi"];
                        
                        $UrunBilgileriSorgusu         = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunler WHERE id = ? LIMIT 1");
                        $UrunBilgileriSorgusu->execute([$SepettekiUrunId]);
                        $UrunBilgileriKayitlari       = $UrunBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);

                            $UrununTuru               = $UrunBilgileriKayitlari["UrunTuru"];
                            $UrununAdi                = $UrunBilgileriKayitlari["UrunAdi"];
                            $UrununFiyati             = $UrunBilgileriKayitlari["UrunFiyati"];
                            $UrununParaBirimi         = $UrunBilgileriKayitlari["ParaBirimi"];
                            $UrununKdvOrani           = $UrunBilgileriKayitlari["KdvOrani"];
                            $UrununKargoUcreti        = $UrunBilgileriKayitlari["KargoUcreti"];
                            $UrununResmi              = $UrunBilgileriKayitlari["UrunResmiBir"];
                            $UrununVaryantBasligi     = $UrunBilgileriKayitlari["VaryantBasligi"];
                            

                        $UrunVaryantBilgileriSorgusu        = $VeriTabaniBaglantisi->prepare("SELECT * FROM urunvaryantlari WHERE id = ? LIMIT 1");
                        $UrunVaryantBilgileriSorgusu->execute([$SepettekiVaryantId]);
                        $VaryantKaydi                       = $UrunVaryantBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                            $VaryantAdi                     = $VaryantKaydi["VaryantAdi"];

                        $KargoBilgileriSorgusu              = $VeriTabaniBaglantisi->prepare("SELECT * FROM kargofirmalari WHERE id = ? LIMIT 1");
                        $KargoBilgileriSorgusu->execute([$SepettekiKargoId]);
                        $KargoKaydi                         = $KargoBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                            $KargonunAdi                    = $KargoKaydi["KargoFirmasiAdi"];

                        $AdresBilgileriSorgusu              = $VeriTabaniBaglantisi->prepare("SELECT * FROM adresler WHERE id = ? LIMIT 1");
                        $AdresBilgileriSorgusu->execute([$SepettekiAdresId]);
                        $AdresKaydi                         = $AdresBilgileriSorgusu->fetch(PDO::FETCH_ASSOC);
                            $AdresAdiSoyadi                 = $AdresKaydi["AdiSoyadi"];
                            $Adres                          = $AdresKaydi["Adres"];
                            $AdresIlce                      = $AdresKaydi["Ilce"];
                            $AdresSehir                     = $AdresKaydi["Sehir"];
                            $AdresToparla                   = $Adres . " " . $AdresIlce . "/" . $AdresSehir;
                            $AdresTelefonNumarasi           = $AdresKaydi["TelefonNumarasi"];
                    

                        if($UrununParaBirimi=="USD"){
                            $UrunFiyatiHesapla          = $UrununFiyati*$DolarKuru;
                        }elseif($UrununParaBirimi=="EUR"){
                            $UrunFiyatiHesapla          = $UrununFiyati*$EuroKuru;
                        }else{
                            $UrunFiyatiHesapla          = $UrununFiyati;
                        }

                        $UrununToplamFiyati                   = ($UrunFiyatiHesapla*$SepettekiUrunAdedi);
                        $UrununToplamKargoFiyati              = ($UrununKargoUcreti*$SepettekiUrunAdedi);  


                        $SiparisEkle    =   $VeriTabaniBaglantisi->prepare("INSERT INTO siparisler(UyeId,SiparisNumarasi,UrunId,UrunTuru,UrunAdi,UrunFiyati,KdvOrani,UrunAdedi,ToplamUrunFiyati,KargoFirmasiSecimi,KargoUcreti,UrunResmiBir,VaryantBasligi,
                        VaryantSecimi,AdresAdiSoyadi,AdresDetay,AdresTelefon,OdemeSecimi,TaksitSecimi,SiparisTarihi,SiparisIPAdresi,OnayDurumu,KargoDurumu,KargoGonderiKodu) 
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                        $SiparisEkle->execute([$SepettekiUyeId,$SepetNumarasi,$SepettekiUrunId,$UrununTuru,$UrununAdi,$UrunFiyatiHesapla,$UrununKdvOrani,$SepettekiUrunAdedi,$UrununToplamFiyati,$KargonunAdi,$UrununToplamKargoFiyati,$UrununResmi,
                        $UrununVaryantBasligi,$VaryantAdi,$AdresAdiSoyadi,$AdresToparla,$AdresTelefonNumarasi,$GelenOdemeTuruSecimi,0,$ZamanDamgasi,$IPAdresi,0,0,0]);
                        $EklemeKontrol  =   $SiparisEkle->rowCount();

                        if($EklemeKontrol>0){

                            $SepettenSilmeSorgusu    =   $VeriTabaniBaglantisi->prepare("DELETE FROM sepet WHERE id=? AND UyeId=? LIMIT 1 ");
                            $SepettenSilmeSorgusu->execute([$SepetId,$SepettekiUyeId]);

                            $UrunSatisArttirmaSorgusu   =   $VeriTabaniBaglantisi->prepare(" UPDATE urunler SET ToplamSatisSayisi=ToplamSatisSayisi+? WHERE id=? ");
                            $UrunSatisArttirmaSorgusu->execute([$SepettekiUrunAdedi,$SepettekiUrunId]);

                            $StokGuncellemeSorgusu   =   $VeriTabaniBaglantisi->prepare(" UPDATE urunvaryantlari SET StokAdedi=StokAdedi-? WHERE id=? LIMIT 1 ");
                            $StokGuncellemeSorgusu->execute([$SepettekiUrunAdedi,$SepettekiVaryantId]);
                        }else{
                            header("Location:index.php?SK=101"); 
                            exit();
                        }


                    }

                    $KargoFiyatiIcinSiparislerSorgusu      = $VeriTabaniBaglantisi->prepare("SELECT SUM(ToplamUrunFiyati) AS ToplamUcret FROM siparisler WHERE UyeId = ? AND SiparisNumarasi=?");
                    $KargoFiyatiIcinSiparislerSorgusu->execute([$KullaniciID,$SepetNumarasi]);
                    $KargoFiyatiKaydi                      = $KargoFiyatiIcinSiparislerSorgusu->fetch(PDO::FETCH_ASSOC);
                        $AlisverisToplamUcreti             = $KargoFiyatiKaydi["ToplamUcret"];

                        if($AlisverisToplamUcreti>=$UcretsizKargoBaraji){
                            $SiparisiGuncelle       =   $VeriTabaniBaglantisi->prepare("UPDATE siparisler SET KargoUcreti=? WHERE UyeId=? AND SiparisNumarasi=? ");
                            $SiparisiGuncelle->execute([0,$SepettekiUyeId,$SepetNumarasi]);
                        }


                    header("Location:index.php?SK=100"); 
                    exit();
            }else{
                header("Location:index.php"); 
                exit();
            }

        }else{
            if($GelenTaksitSecimi!=""){

                $SepetiGuncelle    =   $VeriTabaniBaglantisi->prepare("UPDATE sepet SET OdemeSecimi=? , TaksitSecimi=? WHERE UyeId=?");
                $SepetiGuncelle->execute([$GelenOdemeTuruSecimi,$GelenTaksitSecimi,$KullaniciID]);
                $SepetKontrol           = $SepetiGuncelle->rowCount();

                if($SepetKontrol>0){
                    header("Location:index.php?SK=102"); 
                    exit();
                }else{
                    header("Location:index.php"); 
                    exit();
                }

            echo "Kredi kartı ile ilgili işlemler";


            }else{
                header("Location:index.php"); 
                exit();
            }
        }

    }else{
        header("Location:index.php"); 
        exit();

    }
}else{
    header("Location: index.php");
    exit();
}

?>