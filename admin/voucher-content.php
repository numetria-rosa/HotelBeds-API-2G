<?php
$CONTENT = '
<style type="text/css">
<!--
table { vertical-align: top; margin: 10px 0; }
tr    { vertical-align: top; }
td,th { vertical-align: middle; padding: 5px 0; border: 1px thin #2d3e52; }
/*td    {  }*/
th    { border-bottom: 1px thin #2d3e52; background-color: #2d3e52; color: #fff; }
-->
</style>
<page backcolor="#FEFEFE"  backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="0" style="font-size: 12pt">
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 14px; margin-top: 0;">
        <tr>
            <td style="width: 30%; border: none;vertical-align:top; ">
                <img src="' . $WORKPATH . 'images/logo/' . $AGN_LOGO . '" style="width: 100%;text-align: left" alt="Logo">
            </td>
            <td style="width: 70%; border: none; text-align:right; vertical-align: top;">
                <img src="' . $WORKPATH . 'images/' . $EMV_LOGO . '" style="width: 20%" alt="Logo">
                <p style="font-size:12px;">
                ' . $VHPF_ADDRESS3 . '
                </p>
            </td>
        </tr>
    </table>
    <table cellspacing="0" style="width: 100%; text-align: center; font-size: 16pt; margin-top: 20px;">
        <tr>
            <th style="width:100%; background: #ffffff; border: #ffffff !important; color: #000000;">Voucher N&deg; ' . $BOOK_REF . '</th>
        </tr>
    </table>
    <table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 12px; margin-top: 20px; border: 1px thin #cd015a; background-color: #cd015a;">
        <tr>
            <th style="width:100%; padding: 8px 15px; border: 1px thin #cd015a; background-color: #cd015a;">D&Eacute;TAILS DE VOTRE R&Eacute;SERVATION</th>
        </tr>
    </table>

    <table cellspacing="0" cellpadding="0" style="width: 100%; text-align: left; font-size: 12px; margin-top: 20px;">
        <tr>
            <td style="width:30%; text-align:right; padding-right:5px;">Agency Booking Number</td>
            <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $BOOK_REF . '</td>
        </tr>
        ' . $HBBOOK_REF . '
        <tr>
            <td style="width:30%; text-align:right; padding-right:5px;">Distributeur</td>
            <td style="width:70%; text-align:left; font-weight:bold; padding-left:5px;">' . $SITE_NAME . '</td>
        </tr>
        ' . $BOOK_CLIENTPRINCIPAL . '
    </table>

    ' . $BOOK_DET . '

    ' . $BOOK_RR . '

    ' . $BOOK_MSG . '

    ' . $BOOK_MSG2 . '
    
    ' . $BOOK_CHK . '
    
    ' . $SITE_NAME3 . '
    
    ' . $BOOK_CHK2 . '

</page>';
?>