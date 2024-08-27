<form action="index.php?SK=15" method="post">
    <table width="1065" height="30" align="center" border="0" cellpadding="0" cellspacing="0">
        <tr height="100" bgcolor="#FF9900">
            <td align="left"><h2 style="color: white">&nbsp;SIK SORULAN SORULAR</h2></td>
        </tr>
        <tr height="50">
            <td align="left" style="border-bottom: 1px dashed #CCCCCC">&nbsp;Aklınıza Takılabileceğini Düşündüğümüz Soruların Cevaplarını Bu Sayfada Cevapladık. 
        Fakat Farklı Bir Sorunuz Varsa İletişim Alanından Bizlere İletiniz.</td>
        </tr>
        



        <tr>
            <td>
                    <?php
                        $SoruSorgusu     = $VeriTabaniBaglantisi->prepare("SELECT * FROM sorular");
                        $SoruSorgusu->execute();
                        $SoruSayisi      = $SoruSorgusu->rowCount();
                        $SoruKayitlari   = $SoruSorgusu->fetchAll(PDO::FETCH_ASSOC);

                        foreach($SoruKayitlari as $Kayitlar){
                    ?>
                <div>
                    <div id="<?php echo  $Kayitlar["id"];?>" class="SorununBaslikAlani" onClick="$.SoruIcerigiGoster(<?php echo  $Kayitlar["id"];?>)">
                    <?php echo  $Kayitlar["Soru"];?></div>
                    <div class="SorununCevapAlani" style="display: none;"><?php echo  $Kayitlar["Cevap"];?></div>
                </div>
                <?php
                }
                ?>
            </td>
        </tr>
        
    </table>
</form>