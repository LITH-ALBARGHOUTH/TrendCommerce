<! DOCTYPE HTML>
<html lang="tr-TR">
    <head>
        <meat http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meat http-equiv="Content-Language" content="tr">>
        <meat charset="utf-8">
        <title>Alışveriş Sitesi</title>
    </head>

    <body>
        <?php
        $clientId       =   "xxxxxxx";
        $amount         =   "xxxxxxx";
        $oid            =   "xxxxxxx";
        $okUrl          =   "http://www.siteadiniz.com/odemetamam.php";
        $failUrl        =   "http://www.siteadiniz.com/odemehata.php";
        $rnd            =   @microtime();
        $storekey       =   "xxxxxxx";
        $storetype      =   "3d";
        $hashstr        =   $clientId.$oid.$amount.$okUrl.$failUrl.$rnd.$storekey;
        $hash           =   @base64_encode(@pack("H*",@sha1($hashstr)));
        $description    =   "xxxxxxx";
        $xid            =   "";
        $lang           =   "";
        $email          =   "xxxxxxx";
        $userid         =   "xxxxxxx";   
        ?>
        <center>
            <form method="post" action="https://<sunucu_adresi>/<3dgate_path>">
                <input type="hidden" name="clientId" value="<?=$clientId?>" />
                <input type="hidden" name="amount" value="<?=$amount?>" />
                <input type="hidden" name="oid" value="<?=$oid?>" />
                <input type="hidden" name="okUrl" value="<?=$okUrl?>" />
                <input type="hidden" name="failUrl" value="<?=$failUrl?>" />
                <input type="hidden" name="rnd" value="<?=$rnd?>" />
                <input type="hidden" name="hash" value="<?=$hash?>" />
                <input type="hidden" name="storetype" value="3d" />
                <input type="hidden" name="lang" value="tr" />
                <table>
                    <tr>
                        <td width="140">Kredi Kartı Numarası</td>
                        <td width="198"><input type="text" name="pan" size="20" /></td>
                    </tr>
                    <tr>
                        <td>Son Kullanım Tarihi</td>
                        <td><select name="Ecom_Payment_Card_ExpDate_Month">
                            <option value=""></option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>-<select name="Ecom_Payment_Card_ExpDate_Year">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Kart Türü</td>
                        <td><input type="radio" value="1" name="cardType"> Visa <input type="radio" value="2" name="cardType"> MasterCard </td>
                    </tr>
                    <tr>
                        <td>Güvenlik Kodu</td>
                        <td><input type="text" name="cv2" size="4" value="" /></td>
                    </tr>
                    <tr>
                        <td align="center">&nbsp;</td>
                        <td align="left"><input type="submit" value="Ödeme Yap" /></td>
                    </tr>
                </table>
            </form>
        </center>
    </body>
</html>