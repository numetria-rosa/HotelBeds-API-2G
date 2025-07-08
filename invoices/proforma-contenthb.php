
<?php

$CONTENT = '<style type="text/css">
<!--

th { vertical-align: middle; padding: 5px 0; }
/*td    {  }*/
th    { border-bottom: 1px thin #2d3e52; background-color: white; color: black; }
-->
</style><page
backcolor="#FEFEFE"  backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="0" style="font-size: 12pt
>

<div
  id="content-wrapper"
  class="container_proforma"
  style="
    margin: 0;
    padding: 0;
    margin-left: auto;
    margin-right: auto;
    width: 760px;
    text-align: left;
    background: #fff;
  "
>
  <div
    class="grid_11"
    id="content-proforma"
    style="
    
      display: inline;
      float: left;
      position: relative;
      margin-left: 5px;
      margin-right: 5px;
      background: #fff;
    "
  >
    <h3
      style="
        padding: 10px;
        font-size: 1.2em;
        font-weight: bold;
      
      "
    >
      Pro-forma N° ' . $BOOK_REF . '
    </h3>
    <p
      class="date"
      style="
   
        font-size: 1.1em;
        text-align: right;
        margin: -40px 0 10px 0;
      "
    >
      ' . $BOOK_STT . '
    </p>
    <hr
      style="
        clear: both;
        display: block;
        color: #fff;
        background-color: #fff;
        height: 1px;
        border: none;
      "
    />
    <table style="border-collapse: collapse; border-spacing: 0">
        <tr>
          <td
            class="mod-content-proforma client_data"
            style="
              border-bottom: 1px solid #bcc7c4;
              border-left: 1px solid #bcc7c4;
              border-right: 1px solid #bcc7c4;
              margin: 0 0 10px 0;
              padding: 10px;
              position: relative;
              width: 50%;
              border: 1px solid #bcc7c4;
              vertical-align: top;
            "
      
            valign="top"
          >
            <p
              class="client_name"
              style="
                text-transform: uppercase;
                font-size: 1.1em;
                margin: 15px 0 0 0;
                margin-bottom: 5px;
                padding: 0;
              "
            >
              <strong style="font-style: normal; font-weight: bold"
                >EMNA VOYAGES</strong
              >
            </p>
            <p style="margin: 0; margin-bottom: 5px; padding: 0">
              26, RUE MOHAMED ALI
            </p>
            <p style="margin: 0; margin-bottom: 5px; padding: 0">3000</p>
            <p style="margin: 0; margin-bottom: 5px; padding: 0">Tunisie</p>
          </td>
         <td style="
 
         border-right: 1px solid #bcc7c4;
         width: 1%;
      
      
     
       "></td>
          <td
            class="mod-content-proforma company_data"
            style="
              border-bottom: 1px solid #bcc7c4;
              border-left: 1px solid #bcc7c4;
              border-right: 1px solid #bcc7c4;
              width: 49%;
              border: 1px solid #bcc7c4;
             
          
            "
      
            valign="top"
          >
            <p style="margin-bottom: 5px">
           <!--<img
                src="https://static.hotelbeds.com/static/custom/hotelbeds/images/logo/logo_main.png"
                width="205"
                alt=""
                style="border: 0; margin-bottom: 10px"
              />-->
            </p>
          </td>
        </tr>
    </table>
    <hr
      style="
        clear: both;
        display: block;
        color: #fff;
        background-color: #fff;
        height: 1px;
        border: none;
      "
    />

    <div
      style="
        background: #0077a3;
        margin: 5px 0 0;
        padding: 2px 2px 2px 5px;
      "
    >
    <h2 style="
        font-weight: normal;
        font-size: 18px;
        font: bold 1.3em arial;
        color: #ffffff;"> Détails de la réservation </h2>
    </div>
    <table style="border-collapse: collapse; border-spacing: 0;width:100%">
    <tr style="width:100%">
      <td
        class="mod-content-proforma client_data"
        style="

          margin: 0 0 10px 0;
          padding: 10px;
    
          width: 50%;
          border: 1px solid #bcc7c4;
          vertical-align: top;
        "
      >
      <p style="margin: 0; margin-bottom: 5px; padding: 0">
        <div style="font-style: normal; font-weight: bold"
          >Référence:</div
        >
        <div id="reference-number">' . $BOOK_REFHB . '</div>
      </p>
      <p style="margin: 0; margin-bottom: 5px; padding: 0">
        <div style="font-style: normal; font-weight: bold"
          >Nom Client:</div
        >
        <div id="holder-name"> ' . $ROOMS_TAN . '</div>
      </p>
      <p style="margin: 0; margin-bottom: 5px; padding: 0">
        <div style="font-style: normal; font-weight: bold"
          >Ref. Agence:</div
        >
        <div id="agency-reference">' . $BOOK_REF . '</div>
      </p>

      </td>
      <td
      class="mod-content-proforma client_data"
      style="
        margin: 0px ;
        padding: 10px;
        width: 50%;
        border: 1px solid #bcc7c4;
        vertical-align: top;
      "
    >
    <p style="margin: 0; margin-bottom: 5px; padding: 0">
    <div style="font-style: normal; font-weight: bold"
      >Date de réservation:</div
    >
    <div id="agency-reference">' . $BOOK_STT . '</div>
    </p>
      <p style="margin: 0; margin-bottom: 5px; padding: 0">
      <div style="font-style: normal; font-weight: bold"
        >Supplier:</div
      >
      <div id="agency-reference">Hotelbeds</div>
      </p>
    </td>
   
    </tr>
</table>
    <div
      class="mod-content-proforma booking_info"
      style="
        border-bottom: 1px solid #bcc7c4;
        border-left: 1px solid #bcc7c4;
        border-right: 1px solid #bcc7c4;
        width:100%;
      "
    >

  
    </div>

    <div
    style="
      background: #0077a3;
      margin: 5px 0 0;
      padding: 2px 2px 2px 5px;
    "
  >
  <h2 style="
      font-weight: normal;
      font-size: 18px;
      font: bold 1.3em arial;
      color: #ffffff;"> Services </h2>
  </div>
    <div
      class="mod-content-proforma services"
      style="
        border-bottom: 1px solid #bcc7c4;
        border-left: 1px solid #bcc7c4;
        border-right: 1px solid #bcc7c4;
        margin: 0 0 10px 0;
        padding: 10px;
        width:100%;
      
      "
    >
      <div
        class="mod-content-scart clearfix"
        style="width:100%"
      >
        <p
          class="service_type"
          style="
            margin-bottom: 5px;
            background: #f3f5f5;
            padding: 1px 0 1px 7px;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 0.9em;
            width:100%;
          "
        >
          Hébergement
        </p>
        <h3
          style="
            font-size: 100%;
            font-weight: normal;
            font: bold 1.3em arial;
            color: #272726;
        
            margin: 0 0 -3px 0;
          
          "
        >
          <div id="hotelName"
            >' . $BOOK_HN . '</div
          >
        </h3>
        <h3
        style="
          font-size: 70%;
          font-weight: normal;
          font: bold 1.3em arial;
          color: #272726;
          margin: 0 0 -3px 0;
          width:650px;
          margin:0;
        "
      >
        <div 
          >' . $BOOK_HA . '</div
        >
      </h3>
     <p
          class="servicedates"
          style="margin-bottom: 1px; padding: 0;margin:0px;"
        >
          Arrivée :
          <strong style="font-style: normal; font-weight: bold"
            ><span id="date_from">' . $BOOK_CID . '</span></strong
          >
          Départ :
          <strong style="font-style: normal; font-weight: bold"
            ><div id="date_to">' . $BOOK_COD . '</div></strong
          >
      </p>
  
      </div>
      <table style="width=100%">
                <tbody>
                <tr>
                <th style="width:50px;">Unité
                </th>
                    <th style="width:220px;">Type de chambre
                    </th>
                    <th style="width:220px;">Pension
                    </th>
                    <th style="width:230px;">Occupation
                    </th>
                
                </tr>
                ' . $BOOK_RR . '
                  
            </tbody>
          </table>

          <table width="100%">
                        <tbody>
                    
                    <tr>                                              
                    <td style="width:200px;"></td>
                    <td style="width:200px;">
                        
                    </td>
                    <td style="width:320px;"> <p style="font-size:20px;text-align: left;margin:0"><b>Montant total net :  ' . $BOOK_PRICE_CLIENT . ' ' . $BOOK_DEVISE . '</b></p></td>
                </tr>
                    </tbody>
          </table>
    </div>
    <div
    style="
      background: #0077a3;
      margin: 5px 0 0;
      padding: 2px 2px 2px 5px;
    "
  >
  <h2 style="
      font-weight: normal;
      font-size: 18px;
      font: bold 1.3em arial;
      color: #ffffff;"> Frais annulation </h2>
  </div>
  <div class="mod-content-proforma clearfix services" style="border-bottom: 1px solid #bcc7c4;
  border-left: 1px solid #bcc7c4;
  border-right: 1px solid #bcc7c4;
  margin: 0 0 10px 0;
  padding: 10px;
  width:100%;">
        <table style="width=100%;">
            <tbody><tr>
                <th style="width=50%;">Concept
                </th>
                <th style="width=25%;">à partir de
                </th>
                <th style="width=12%;">Numéro
                </th>
                <th style="width=12%;" class="price">Évaluation
                </th>
            </tr>
	                                    ' . $BOOKCPP . '
                                       
                <tr>
                    <td colspan="4"><br>La date et lheure sont calculées par rapport à lheure du pays de destination.
                    </td>
                </tr>
            </tbody></table>
        </div>
    <div
      class="mod-content-proforma clearfix infomessage"
      style="
        display: block;
        border-bottom: 1px solid #bcc7c4;
        border-left: 1px solid #bcc7c4;
        border-right: 1px solid #bcc7c4;
        margin: 0 0 10px 0;
        padding: 10px;
        position: relative;
        background-color: #f3f5f5;
        border-top: 1px solid #bcc7c4;
      "
    >
      <p style="margin-bottom: 5px; margin: 0 0 3px 0; padding: 3px 0">
        ' . $ROOMS_RATE_Comments . '
      </p>
    </div>
  </div>
</div>
</page>
';

?>