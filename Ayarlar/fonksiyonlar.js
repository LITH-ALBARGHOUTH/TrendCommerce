$(document).ready(function(){

    $.SoruIcerigiGoster         = function(ElemanIDsi) {
        var SoruIDsi            = ElemanIDsi;
        var IslenecekAlan = "#" + ElemanIDsi;
        $(".SorununCevapAlani").not($(IslenecekAlan).parent().find(".SorununCevapAlani")).slideUp();
        $(IslenecekAlan).parent().find(".SorununCevapAlani").slideToggle();
    }
    $.UrunDetayResmiDegistir    = function(Klasor,ResimDegeri){
        var ResimIcinDosyaYolu  = "Resimler/UrunResimleri/" + Klasor + "/" + ResimDegeri;
        $("#BuyukResim").attr("src",ResimIcinDosyaYolu);
    }
    $.KrediKartiSecildi     = function(){
        $(".KKAlanlari").css("display","block");
        $(".BHAlanlari").css("display","none");
    }
    $.BankaHavalesiSecildi  = function(){
        $(".KKAlanlari").css("display","none");
        $(".BHAlanlari").css("display","block");
    }
    
});