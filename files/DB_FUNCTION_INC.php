<?php
if (isset($_SESSION['SE_END'])) {
    $now = time();
    if ($now > $_SESSION['SE_END']) {
    }
}
date_default_timezone_set("Africa/Tunis");
setlocale(LC_TIME, "fr_FR");
include("env-local.php");
include("DB_INC.php");
include("STRINGS.php");
include("OTHER_FUNC.php");
include("xmlFunc.php");

if ($WHEREAMIURL != $WORKPATH . "agn/login/" && $WHEREAMIURL != $WORKPATH . "agn/register/") {
    if (!isset($_SESSION['isSuperAdmin'])) {
    }
}

class SITE
{

    function SelectFromTable($table)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableDistinct($table, $distinct)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT DISTINCT `" . $distinct . "` FROM `" . $table . "`  ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableDistinctWC($table, $distinct, $condition, $value)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT DISTINCT `" . $distinct . "` FROM `" . $table . "` where `" . $condition . "`='" . $value . "'  ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableOR($table, $ord)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` ORDER BY `" . $ord . "` ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableOR2($table,$ord,$champ,$query)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT code,name,countryCode FROM " . $table . " WHERE " . $champ . " LIKE '" . $query . "%' ORDER BY " . $ord . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }
    function SelectFromTableORzone($table,$ord,$champ,$query)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM " . $table . " WHERE " . $champ . " LIKE '" . $query . "%' ORDER BY " . $ord . " LIMIT 6 ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }
     /*new
     function SelectFromTableOR3($table, $query) {
        $db = new Db();
        $db->connect();
        // Use a parameterized query to prevent SQL injection and support partial matches
        $sqlSelect = "SELECT code, description FROM `" . $table . "` WHERE description LIKE ? ORDER BY description";
        $stmt = $db->prepare($sqlSelect);
        $likeQuery = "%$query%";
        $stmt->bind_param("s", $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $db->disconnect();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    */

    /*original*/
    function SelectFromTableOR3($table, $code)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT description FROM `" . $table . "` where isoCode='".$code."' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }
 
    function SelectFromTableORD($table, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableWC($table, $champ, $value, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' ORDER BY `" . $ord . "` " . $dir . " ";

        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableWCLimit($table, $champ, $value, $limit, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' ORDER BY `" . $ord . "` " . $dir . " LIMIT " . $limit . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableW2CLimit($table, $champ, $value, $champ2, $value2, $limit, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE ( `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`='" . $value2 . "' ) ORDER BY `" . $ord . "` " . $dir . " LIMIT " . $limit . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableW3CLimit($table, $champ, $value, $champ2, $value2, $champ3, $value3, $limit, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE ( `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`>='" . $value2 . "' AND `" . $champ3 . "`='" . $value3 . "' ) ORDER BY `" . $ord . "` " . $dir . " LIMIT " . $limit . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function selectW1CLIMIT($table, $champ, $valeur, $ord, $dir, $limit_start, $limit_end)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "select * from `" . $table . "` WHERE " . $champ . " = '" . $valeur . "'  ORDER BY " . $ord . " " . $dir . " limit " . $limit_start . " , " . $limit_end;
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function selectW1CLIMITDATE($table, $champ, $valeur, $ord, $dir, $limit_start, $limit_end, $Du, $Au, $nbreserv)
    {
        $date = new DateTime($Au);
        $date->modify('+1 day');
        $Au=$date->format('Y-m-d');
        $db = new Db();
        $db->connect();
        if ($nbreserv != "") {
            $sqlSelect = "select * from `" . $table . "` WHERE " . $champ . " = '" . $valeur . "'  and starttime between '" . $Du . "' and '" . $Au . "' and bookingreference='" . $nbreserv . "'  ORDER BY " . $ord . " " . $dir . " limit " . $limit_start . " , " . $limit_end;
        } else {

            $sqlSelect = "select * from `" . $table . "` WHERE " . $champ . " = '" . $valeur . "'  and starttime between '" . $Du . "' and '" . $Au . "' ORDER BY " . $ord . " " . $dir . " limit " . $limit_start . " , " . $limit_end;
        }

        $reqSelect = $db->query($sqlSelect);

        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectReservations($Du, $Au, $nbreserv)
    {
        $db = new Db();
        $db->connect();
        if ($nbreserv != "") {
            $sqlSelect = "SELECT * FROM booking WHERE starttime between '" . $Du . "' and '" . $Au . "' and bookingreference='" . $nbreserv . "'";
        } else {
            $sqlSelect = "SELECT * FROM booking WHERE starttime  between '" . $Du . "' and '" . $Au . "'";
        }
        $reqSelect = $db->query($sqlSelect);
        $result = $db->fetchArray();

        return $result;
        $db->disconnect();
    }

    function selectW2CLIMIT($table, $champ, $valeur, $champ2, $value2, $ord, $dir, $limit_start, $limit_end)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "select * from `" . $table . "` WHERE " . $champ . " = '" . $valeur . "' AND " . $champ2 . " = '" . $value2 . "' ORDER BY " . $ord . " " . $dir . " limit " . $limit_start . " , " . $limit_end;
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function selectW1CLIMITFilter($table, $champ, $value, $Filter, $ord, $dir, $limit_start, $limit_end)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "select * from `" . $table . "` WHERE " . $champ . " = '" . $value . "'  " . $Filter . " ORDER BY " . $ord . " " . $dir . " limit " . $limit_start . " , " . $limit_end;
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function selectW2CLIMITFilter($table, $champ, $value, $champ2, $value2, $Filter, $ord, $dir, $limit_start, $limit_end)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "select * from `" . $table . "` WHERE " . $champ . " = '" . $value . "' AND " . $champ2 . " = '" . $value2 . "' " . $Filter . " ORDER BY " . $ord . " " . $dir . " limit " . $limit_start . " , " . $limit_end;
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromGroupByWC($table, $group, $champ, $value, $champ2)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' OR `" . $champ2 . "`='" . $value . "' GROUP BY `" . $group . "` ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromGroupBy($table, $group, $champ, $value)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' GROUP BY `" . $group . "` ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableW2C($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function HotelsRequestSQL($selCountryHB, $selCityHB, $limit_start, $limit_end)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelbeds` WHERE `countryCode`='" . $selCountryHB . "' AND `destinationCode`='" . $selCityHB . "' LIMIT " . $limit_start . " , " . $limit_end;
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function HotelsRequestSQL2($selCountryHB, $limit_start, $limit_end)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelbeds` WHERE `countryCode`='" . $selCountryHB . "' LIMIT " . $limit_start . " , " . $limit_end;
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableW2CNOT($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`!='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableW2COR($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' OR `" . $champ2 . "`='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectNormalTableW2CS($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`<='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableW3CNOT($table, $condition, $valeur, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $condition . "`='" . $valeur . "'  ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableW3CNOTLIMIT($table, $condition, $valeur, $champ, $value, $champ2, $value2, $ord, $dir, $LIMIT)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $condition . "`='" . $valeur . "'  ORDER BY `" . $ord . "` " . $dir . " LIMIT " . $LIMIT . ",1 ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromTableW3CSNOTLIMIT($table, $champ, $value, $champ2, $value2, $ord, $dir, $LIMIT)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`<='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " LIMIT " . $LIMIT . ",1 ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectFromObjectW3CNOT($table, $condition, $valeur, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $condition . "`='" . $valeur . "'  ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function PeriodContract($CheckDate, $NbDays, $Retro, $pidCountry)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelcontractperiod` WHERE `minstay`<='" . $NbDays . "' AND ( `pidCountry`='" . $pidCountry . "' ) AND ( `retrocession`<='" . $Retro . "' ) AND (`PeriodStart`<='" . $CheckDate . "' AND `PeriodEnd`>='" . $CheckDate . "') AND `Status`=1  ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function PeriodContractCity($CheckDate, $selCity, $NbDays, $Retro, $pidCountry)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelcontractperiod` WHERE `minstay`<='" . $NbDays . "' AND ( `pidCountry`='" . $pidCountry . "' ) AND ( `retrocession`<='" . $Retro . "' ) AND (`PeriodStart`<='" . $CheckDate . "' AND `PeriodEnd`>='" . $CheckDate . "') AND `Status`=1 AND `pidCity`='" . $selCity . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function PeriodContractCityHotelObj($CheckDate, $selCity, $NbDays, $Retro, $pidCountry, $selHotel)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelcontractperiod` WHERE `minstay`<='" . $NbDays . "' AND ( `pidCountry`='" . $pidCountry . "' ) AND ( `retrocession`<='" . $Retro . "' ) AND (`PeriodStart`<='" . $CheckDate . "' AND `PeriodEnd`>='" . $CheckDate . "') AND ( `Status`=1 AND `pidCity`='" . $selCity . "' ) AND `pidHotel`='" . $selHotel . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function PeriodContractCityHotelO($CheckDate, $selCity, $NbDays, $Retro, $pidCountry, $selHotel)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelcontractperiod` WHERE `minstay`<='" . $NbDays . "' AND ( `pidCountry`='" . $pidCountry . "' ) AND ( `retrocession`<='" . $Retro . "' ) AND (`PeriodStart`<='" . $CheckDate . "' AND `PeriodEnd`>='" . $CheckDate . "') AND `Status`=1 AND `pidCity`='" . $selCity . "' AND `pidHotel`='" . $selHotel . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function PeriodContractCityHotel($CheckDate, $selCity, $pidHotel, $NbDays, $Retro, $pidCountry)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelcontractperiod` WHERE ( `pidCountry`='" . $pidCountry . "' ) AND (`PeriodStart`<='" . $CheckDate . "' AND `PeriodEnd`>='" . $CheckDate . "') AND ( `Status`=1 AND `pidHotel`='" . $pidHotel . "' ) AND `pidCity`='" . $selCity . "' ORDER BY PeriodStart ASC";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function PeriodContractHotel($CheckDate, $pidHotel, $NbDays, $Retro, $pidCountry)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelcontractperiod` WHERE  ( `pidCountry`='" . $pidCountry . "' ) AND  (`PeriodStart`<='" . $CheckDate . "' AND `PeriodEnd`>='" . $CheckDate . "') AND `Status`=1 AND `pidHotel`='" . $pidHotel . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function CountPeriodContractHotel($CheckDate, $pidHotel, $NbDays, $Retro, $pidCountry)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelcontractperiod` WHERE  ( `pidCountry`='" . $pidCountry . "' ) AND (`PeriodStart`<='" . $CheckDate . "' AND `PeriodEnd`>='" . $CheckDate . "') AND `Status`=1 AND `pidHotel`='" . $pidHotel . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function CountPeriodContractCityHotel($CheckDate, $selCity, $pidHotel, $NbDays, $Retro, $pidCountry)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelcontractperiod` WHERE  ( `pidCountry`='" . $pidCountry . "' ) AND (`PeriodStart`<='" . $CheckDate . "' AND `PeriodEnd`>='" . $CheckDate . "') AND ( `Status`=1 AND `pidHotel`='" . $pidHotel . "' ) AND `pidCity`='" . $selCity . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function SelectLastObjectTable($table, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function SelectObjectTableWC($table, $champ, $value, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }
    function SelectObjectTableHBCP($table, $champ, $value, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }
    function SelectObjectTableWCB($table, $Condition)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE " . $Condition . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function CountObjectTableWCB($table, $Condition)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE " . $Condition . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function SelectArrayTableW2CS($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`<='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        //$sqlSelect = " SELECT * FROM `".$table."` WHERE `".$champ."`='".$value."' AND `".$champ2."`='".$value2."' ORDER BY `".$ord."` ".$dir." ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectObjectTableW2CS($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`<='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function SelectObjectTableW2C($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function SelectObjectTableW3C($table, $champ, $value, $champ2, $value2, $champ3, $value3, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`='" . $value2 . "' AND `" . $champ3 . "`='" . $value3 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function SelectObjectTableW4C($table, $champ, $value, $champ2, $value2, $champ3, $value3, $champ4, $value4)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' AND `" . $champ2 . "`='" . $value2 . "' AND `" . $champ3 . "`='" . $value3 . "' AND `" . $champ4 . "`='" . $value4 . "'  ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function SelectObjectTableW2CNOT($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` = '" . $value . "' AND `" . $champ2 . "` != '" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function SelectObjectTableW2COR($table, $champ, $value, $champ2, $value2, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' OR `" . $champ2 . "`='" . $value2 . "' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function SelectObjectTableLike($table, $champ, $value, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function CountArrayTableLikeCD($table, $champ, $value, $country, $city, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' AND (`HotelCountry` = '" . $country . "' AND `HotelCity` = '" . $city . "') ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function CountArrayTableLike2CD($table, $champ, $value, $country, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' AND (`HotelCountry` = '" . $country . "') ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function SelectArrayTableLikeCD($table, $champ, $value, $country, $city, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' AND (`HotelCountry` = '" . $country . "' AND `HotelCity` = '" . $city . "') ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectArrayTableLike2CD($table, $champ, $value, $country, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' AND (`HotelCountry` = '" . $country . "') ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function CountArrayTableLike($table, $champ, $value, $country, $city, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' AND (`countryCode` = '" . $country . "' AND `destinationCode` = '" . $city . "') ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function CountArrayTableLike2($table, $champ, $value, $country, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' AND (`countryCode` = '" . $country . "') ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function SelectArrayTableLike($table, $champ, $value, $country, $city, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' AND (`countryCode` = '" . $country . "' AND `destinationCode` = '" . $city . "') ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectSumBooking($Cond, $Cond2)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT SUM(`" . $Cond . "`) as SOMM FROM `booking` WHERE `currentstatus`='vouchered' AND `pidagence`='$Cond2' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchObject();
        $db->disconnect();
    }

    function SelectArrayTableLike2($table, $champ, $value, $country, $ord, $dir)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `" . $table . "` WHERE `" . $champ . "` LIKE '%" . $value . "%' AND (`countryCode` = '" . $country . "') ORDER BY `" . $ord . "` " . $dir . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function DelFrom($table, $champ, $value)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " DELETE FROM `" . $table . "` WHERE `" . $champ . "`='" . $value . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function countTableWC($table, $condition, $value)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "'";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function countTableWCOR($table, $condition, $value, $condition2, $value2)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "' OR `" . $condition2 . "` = '" . $value2 . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function countTableW2C($table, $condition, $value, $condition2, $value2)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "' AND `" . $condition2 . "` = '" . $value2 . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }
    function countTableW2C2($table, $condition, $value, $condition2, $value2)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "' AND `" . $condition2 . "` = '" . $value2 . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetcharray();
        $db->disconnect();
    }
    function countTableW2CNOT($table, $condition, $value, $condition2, $value2)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "' AND `" . $condition2 . "` != '" . $value2 . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function countTableW1CFilter($table, $condition, $value, $Filter)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "'  " . $Filter . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function countTableW2CFilter($table, $condition, $value, $condition2, $value2, $Filter)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "' AND `" . $condition2 . "` = '" . $value2 . "' " . $Filter . " ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function countTableW3C($table, $condition, $value, $condition2, $value2, $condition3, $value3)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "' AND `" . $condition2 . "` = '" . $value2 . "' AND `" . $condition3 . "` = '" . $value3 . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function countTableW4C($table, $condition, $value, $condition2, $value2, $condition3, $value3, $condition4, $value4)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "' AND `" . $condition2 . "` = '" . $value2 . "' AND `" . $condition3 . "` = '" . $value3 . "' AND `" . $condition4 . "` = '" . $value4 . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function countTableExp($table, $condition, $value, $condition2, $value2)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "SELECT * FROM `" . $table . "` WHERE `" . $condition . "` = '" . $value . "' AND `" . $condition2 . "` >= '" . $value2 . "' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function connect($login, $password)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT * FROM `users` WHERE `role` !='Eleve' AND `email` = '%s' AND `password` = '%s' ", mysqli_real_escape_string($db->connId,$login), mysqli_real_escape_string($db->connId,$password));
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function profile($login, $password)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT * FROM `users` WHERE `role` !='Eleve' AND `email` = '%s' AND `password` = '%s' ", mysqli_real_escape_string($db->connId,$login), mysqli_real_escape_string($db->connId,$password));
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function AgnAdd($agn_name, $pays, $ville, $localite, $adresse, $zipcode, $iata, $telephone, $fax, $email, $rc, $if, $licence, $last_name, $first_name, $username, $password, $langue, $devise, $verif, $verified, $etat, $created_on)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `agence` (`nom_agence`,`code_pays`,`code_ville`,`ville`,`adresse`,`code_postal`,`code_iata`,`tel`,`fax`,`email`,`reg_commerce`,`num_fiscal`,`num_licence`,`nom`,`prenom`,`login`,`password`,`code_langue`,`code_devise`,`verification`,`verified`,`etat`,`created_on`,`last_update`,`email_client`,`tel_client`) VALUES ('" . $agn_name . "','" . $pays . "','" . $ville . "','" . $localite . "','" . $adresse . "','" . $zipcode . "','" . $iata . "','" . $telephone . "','" . $fax . "','" . $email . "','" . $rc . "','" . $if . "','" . $licence . "','" . $last_name . "','" . $first_name . "','" . $username . "','" . $password . "','" . $langue . "','" . $devise . "','" . $verif . "','" . $verified . "','" . $etat . "','" . $created_on . "','" . $created_on . "','" . $email . "','" . $telephone . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function HotelRegister($HotelName, $HotelStars, $HotelAddress, $HotelZipCode, $HotelCountry, $HotelCity, $HotelPhone, $HotelFax, $HotelDevise, $HotelLanguage, $HotelEmail, $HotelPassword, $HotelVerification, $HotelCreated, $HotelVerified, $HotelEtat, $HotelUrl)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `hotels` (`HotelName`,`HotelStars`,`HotelAddress`,`HotelZipCode`,`HotelCountry`,`HotelCity`,`HotelPhone`,`HotelFax`,`HotelDevise`,`HotelLanguage`,`HotelEmail`,`HotelPassword`,`HotelVerification`,`HotelVerif`,`HotelStatus`,`HotelCreatedOn`,`HotelLastLogin`,`HotelUrl`) VALUES ('" . $HotelName . "','" . $HotelStars . "','" . $HotelAddress . "','" . $HotelZipCode . "','" . $HotelCountry . "','" . $HotelCity . "','" . $HotelPhone . "','" . $HotelFax . "','" . $HotelDevise . "','" . $HotelLanguage . "','" . $HotelEmail . "','" . $HotelPassword . "','" . $HotelVerification . "','" . $HotelVerified . "','" . $HotelEtat . "','" . $HotelCreated . "','" . $HotelCreated . "','" . $HotelUrl . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }
/**/ 
function UserRegister($username, $UserEmail, $telephone, $UserPassword, $UserCreated, $Verified, $Etat, $role, $markup, $codedevise, $roles)
{
    $db = new Db();
    $db->connect();

    // Prepare the SQL statement
    $sqlSelect = "INSERT INTO `user` (firstname, lastname, email, password, CreatedAt, Verified, Etat, canal, markup, code_devise, roles) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $db->prepare($sqlSelect);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($db->error));
    }

    // Bind parameters
    $stmt->bind_param("ssssiiissss", $username, $UserEmail, $telephone, $UserPassword, $UserCreated, $Verified, $Etat, $role, $markup, $codedevise, $roles);

    // Execute the statement
    if (!$stmt->execute()) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    // Get the last inserted ID
    $inserted_id = $db->insert_id();

    // Close the statement and connection
    $stmt->close();
    $db->disconnect();

    return $inserted_id;
}




/**/ 

    function InsertNewsletter($email)
    {
        $createdat=new DateTime();
        $time=$createdat->format('Y-m-d H:i:s');
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `newsletter` (email,createdat) VALUES ('" . $email . "','" . $time . "') ";
        $reqSelect = $db->query($sqlSelect);
        return $db->insert_id();
        $db->disconnect();
    }

    function UserLogin($email, $password)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT id,username,email,telephone,verified,etat,firstname,lastname,code_ville,code_pays,adresse,canal,credit,logo,markup,code_devise,Etat,markup_personne,roles FROM `user` WHERE email = '%s' AND password = '%s' ", mysqli_real_escape_string($db->connId,$email), mysqli_real_escape_string($db->connId,$password));
        $req = $db->query($sqlSelect);
        $result = $db->fetchArray();
        if (empty($result)) {
            return $result;
        } else {
            return $result[0];
        }

        $db->disconnect();
    }

    function UserUpdate( $telephone, $firstname, $lastname,$address,$code_ville,$code_pays, $id)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `user` SET
			`firstname`='" . $firstname . "',
			`lastname`='" . $lastname . "',
			`telephone`='" . $telephone . "',
            `adresse`='" . $address . "',
			`code_ville`='" . $code_ville . "',
			`code_pays`='" . $code_pays . "'
			 WHERE `id`='" . $id . "' ";

        $reqSelect = $db->query($sqlSelect);

        $result = $this->SelectFromTableWC('user','id',$id,'id','DESC');
        if (empty($result)) {
            return $result;
        } else {
            return $result[0];
        }
        $db->disconnect();
    }

    function Checkpassword($password, $id)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT id FROM `user` WHERE id = '%s' AND password = '%s' ", mysqli_real_escape_string($db->connId,$id), mysqli_real_escape_string($db->connId,$password));
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }

    function UpdatePassword($password, $id)
    {
        $db = new Db();
        $db->connect();

        $sqlSelect = " UPDATE `user` SET
			password='" . $password . "'
			 WHERE `id`='" . $id . "' ";

        $reqSelect = $db->query($sqlSelect);

        return 1;

        $db->disconnect();
    }

    function UserNameCheck($login)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT * FROM `user` WHERE username = '%s'", mysqli_real_escape_string($db->connId,$login));
        $reqSelect = $db->query($sqlSelect);
        return $db->numRows();
        $db->disconnect();
    }
    function EmailCheckletter($email)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT id FROM `newsletter` WHERE email = '%s'", mysqli_real_escape_string($db->connId,$email));
        $reqSelect = $db->query($sqlSelect);
        $result = $db->fetchArray();
        if (empty($result)) {
            return 0;
        } else {
            return $result[0]['id'];
        }
        $db->disconnect();
    }
    function EmailCheck($email)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = sprintf(" SELECT id FROM `user` WHERE email = '%s'", mysqli_real_escape_string($db->connId,$email));
        $reqSelect = $db->query($sqlSelect);
        $result = $db->fetchArray();

        if (empty($result)) {
            return 0;
        } else {
            return $result[0]['id'];
        }

        $db->disconnect();
    }

    function ResaBooking($Id, $AgentId, $BookingReference, $AgentRefNo, $TotalCharges, $TotalMarkup, $LeaderTitle, $LeaderFirstName, $LeaderLastName, $CurrencyCode, $LocalHotelId, $HotelName, $CountryName, $CityName, $CityId, $HotelAddress1, $CurrentStatus, $TotalAdults, $TotalChildren, $TotalRooms, $CheckInDate, $CheckOutDate, $GrossAmount, $HotelPhone, $SelectedNights, $StartTime, $EndTime, $BookingServiceType, $PidAgence, $PidAgent, $ContactEmail, $ContactMobile, $ContactMessage, $CP)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `booking` (`id`,`agentid`,`bookingreference`,`agentrefno`,`totalcharges`,`totalmarkup`,`leadertitle`,`leaderfirstname`,`leaderlastname`,`currencycode`,`localhotelid`,`hotelname`,`countryname`,`cityname`,`cityid`,`hoteladdress`,`currentstatus`,`totaladults`,`totalchildren`,`totalrooms`,`checkindate`,`checkoutdate`,`grossamount`,`hotelphone`,`selectednights`,`starttime`,`endtime`,`bookingservicetype`,`pidagence`,`pidagent`,`contactemail`,`contactmobile`,`contactmessage`,`cp`) VALUES ('" . $Id . "','" . $AgentId . "','" . $BookingReference . "','" . $AgentRefNo . "','" . $TotalCharges . "','" . $TotalMarkup . "','" . $LeaderTitle . "','" . $LeaderFirstName . "','" . $LeaderLastName . "','" . $CurrencyCode . "','" . $LocalHotelId . "','" . $HotelName . "','" . $CountryName . "','" . $CityName . "','" . $CityId . "','" . $HotelAddress1 . "','" . $CurrentStatus . "','" . $TotalAdults . "','" . $TotalChildren . "','" . $TotalRooms . "','" . $CheckInDate . "','" . $CheckOutDate . "','" . $GrossAmount . "','" . $HotelPhone . "','" . $SelectedNights . "','" . $StartTime . "','" . $EndTime . "','" . $BookingServiceType . "','" . $PidAgence . "','" . $PidAgent . "','" . $ContactEmail . "','" . $ContactMobile . "','" . $ContactMessage . "','" . $CP . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingCD($Id, $AgentId, $BookingReference, $AgentRefNo, $TotalCharges, $TotalMarkup, $LeaderTitle, $LeaderFirstName, $LeaderLastName, $CurrencyCode, $LocalHotelId, $HotelName, $CountryName, $CityName, $CityId, $HotelAddress1, $CurrentStatus, $TotalAdults, $TotalChildren, $TotalBabies, $TotalRooms, $CheckInDate, $CheckOutDate, $GrossAmount, $HotelPhone, $SelectedNights, $StartTime, $EndTime, $BookingServiceType, $PidAgence, $PidAgent, $ContactEmail, $ContactMobile, $ContactMessage, $CP, $Quota)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `booking` (`id`,`agentid`,`bookingreference`,`agentrefno`,`totalcharges`,`totalmarkup`,`leadertitle`,`leaderfirstname`,`leaderlastname`,`currencycode`,`localhotelid`,`hotelname`,`countryname`,`cityname`,`cityid`,`hoteladdress`,`currentstatus`,`totaladults`,`totalchildren`,`totalkids`,`totalrooms`,`checkindate`,`checkoutdate`,`grossamount`,`hotelphone`,`selectednights`,`starttime`,`endtime`,`bookingservicetype`,`pidagence`,`pidagent`,`contactemail`,`contactmobile`,`contactmessage`,`cp`,`quota`) VALUES ('" . $Id . "','" . $AgentId . "','" . $BookingReference . "','" . $AgentRefNo . "','" . $TotalCharges . "','" . $TotalMarkup . "','" . $LeaderTitle . "','" . $LeaderFirstName . "','" . $LeaderLastName . "','" . $CurrencyCode . "','" . $LocalHotelId . "','" . $HotelName . "','" . $CountryName . "','" . $CityName . "','" . $CityId . "','" . $HotelAddress1 . "','" . $CurrentStatus . "','" . $TotalAdults . "','" . $TotalChildren . "','" . $TotalBabies . "','" . $TotalRooms . "','" . $CheckInDate . "','" . $CheckOutDate . "','" . $GrossAmount . "','" . $HotelPhone . "','" . $SelectedNights . "','" . $StartTime . "','" . $EndTime . "','" . $BookingServiceType . "','" . $PidAgence . "','" . $PidAgent . "','" . $ContactEmail . "','" . $ContactMobile . "','" . $ContactMessage . "','" . $CP . "','" . $Quota . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingHB($Id,$BookingReference,$TotalCharges,$TotalMarkup,$Convertion,$LeaderTitle,$LeaderFirstName,$LeaderLastName,$CurrencyCode,$LocalHotelId,$HotelName,$CountryName,$CityName,$CityId,$CategoryCode,$CategoryName,$DestinationCode,$Latitude,$Longitude,$Address,$hotelPhone,$CurrentStatus,$TotalAdults,$TotalChildren,$TotalRooms,$CheckInDate,$CheckOutDate,$GrossAmount,$SelectedNights,$StartTime,$EndTime,$BookingServiceType,$PidAgence,$PidAgent,$CreationUser,$PendingAmount,$Cancellation,$Modification,$SupplierName,$SupplierVatNumber,$Remark)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `booking` (`id`,`bookingreference`,`totalcharges`,`totalmarkup`,`convertion`,`leadertitle`,`leaderfirstname`,`leaderlastname`,`currencycode`,`localhotelid`,`hotelname`,`countryname`,`cityname`,`cityid`,`categoryCode`,`categoryName`,`destinationCode`,`latitude`,`longitude`,`hoteladdress`,`hotelphone`,`currentstatus`,`totaladults`,`totalchildren`,`totalrooms`,`checkindate`,`checkoutdate`,`grossamount`,`selectednights`,`starttime`,`endtime`,`bookingservicetype`,`pidagence`,`pidagent`,`creationUser`,`pendingAmount`,`cancellation`,`modification`,`SupplierName`,`SupplierVatNumber`,`contactmessage`,`agentid`) VALUES ('".$Id."','".$BookingReference."','".$TotalCharges."','".$TotalMarkup."','".$Convertion."','".$LeaderTitle."','".$LeaderFirstName."','".$LeaderLastName."','".$CurrencyCode."','".$LocalHotelId."','".$HotelName."','".$CountryName."','".$CityName."','".$CityId."','".$CategoryCode."','".$CategoryName."','".$DestinationCode."','".$Latitude."','".$Longitude."','".$Address."','".$hotelPhone."','".$CurrentStatus."','".$TotalAdults."','".$TotalChildren."','".$TotalRooms."','".$CheckInDate."','".$CheckOutDate."','".$GrossAmount."','".$SelectedNights."','".$StartTime."','".$EndTime."','".$BookingServiceType."','".$PidAgence."','".$PidAgent."','".$CreationUser."','".$PendingAmount."','".$Cancellation."','".$Modification."','".$SupplierName."','".$SupplierVatNumber."','".$Remark."','".$PidAgence."') ";
        $reqSelect = $db->query($sqlSelect);
        if($reqSelect)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        $db->disconnect();
    }

    function UpdateMouradiLeader($LeaderTitle, $LeaderFirstName, $LeaderLastName, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `booking` SET
			`leadertitle`='" . $LeaderTitle . "',
			`leaderfirstname`='" . $LeaderFirstName . "',
			`leaderlastname`='" . $LeaderLastName . "'

			WHERE `pid`='" . $PidBooking . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function UpdateCteLeader($LeaderTitle, $LeaderFirstName, $LeaderLastName, $PidBooking, $contactemail, $telnumber)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `booking` SET
			`leadertitle`='" . $LeaderTitle . "',
			`leaderfirstname`='" . $LeaderFirstName . "',
			`leaderlastname`='" . $LeaderLastName . "',
			`contactemail`='" . $contactemail . "',
			`contactmobile`='" . $telnumber . "'
			WHERE `pid`='" . $PidBooking . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingRooms($RoomTypeDescription, $NumberOfRoom, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingrooms` (`roomtypedescription`, `numberofroom`, `pidbooking`) VALUES ('" . $RoomTypeDescription . "', '" . $NumberOfRoom . "', '" . $PidBooking . "')";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingRoomsHB($RoomName, $RoomCode, $Roomstatus, $PidBooking, $RoomId)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingrooms` (`roomtypedescription`, `code`, `status`, `pidbooking`, `id`, `numberofroom`) VALUES ('" . $RoomName . "','" . $RoomCode . "','" . $Roomstatus . "','" . $PidBooking . "','" . $RoomId . "','1')";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingRoom($Salutation, $FirstName, $LastName, $PassengerType, $Age, $PidRoom)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingroomdetails` (`salutation`, `firstname`, `lastname`,`passengertype`, `age`, `pidroom`) VALUES ('" . $Salutation . "','" . $FirstName . "','" . $LastName . "','" . $PassengerType . "', '" . $Age . "', '" . $PidRoom . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingRoomHB($RoomFirstName, $RoomLastName, $RoomType, $RoomAge, $PidRoom, $Roomid)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingroomdetails` (`firstname`, `lastname`,`passengertype`, `age`, `pidroom`, `roomId`) VALUES ('" . $RoomFirstName . "','" . $RoomLastName . "','" . $RoomType . "','" . $RoomAge . "', '" . $PidRoom . "', '" . $Roomid . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingRoomRatesHB($rateClass, $rateNet, $rateSelling, $rateHotel, $rateComments, $ratePaymentType, $ratePackaging, $rateBoardCode, $rateBoardName, $rateRooms, $rateAdults, $rateChildren, $pidRoom)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingroomrates` (`rateClass`, `rateNet`,`rateSelling`, `rateHotel`, `rateComments`, `ratePaymentType`, `ratePackaging`, `rateBoardCode`,`rateBoardName`, `rateRooms`, `rateAdults`, `rateChildren`, `pidRoom`) VALUES ('" . $rateClass . "','" . $rateNet . "','" . $rateSelling . "','" . $rateHotel . "', '" . $rateComments . "', '" . $ratePaymentType . "', '" . $ratePackaging . "','" . $rateBoardCode . "','" . $rateBoardName . "','" . $rateRooms . "', '" . $rateAdults . "', '" . $rateChildren . "', '" . $pidRoom . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingRoomCancelPolicyHB($cancellationAmount, $cancellationFrom, $PidRates, $PidBooking ,$cancellationAmountDevise,$DEVISE)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingroomcp` (`cancellationAmount`, `cancellationFrom`,`pidRates`,`pidBooking`,`cancellationfeesDevise`,`Devise`) VALUES ('" . $cancellationAmount . "', '" . $cancellationFrom . "', '" . $PidRates . "', '" . $PidBooking . "', '" . $cancellationAmountDevise . "', '" . $DEVISE . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingRoomTaxesHB($RoomTaxesIncluded, $RoomTaxIncluded, $RoomTaxAmount, $RoomTaxCurrency, $PidRates)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingroomtaxes` (`RoomTaxesIncluded`, `RoomTaxIncluded`,`RoomTaxAmount`,`RoomTaxCurrency`,`PidRates`) VALUES ('" . $RoomTaxesIncluded . "', '" . $RoomTaxIncluded . "', '" . $RoomTaxAmount . "', '" . $RoomTaxCurrency . "', '" . $PidRates . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingRoomDiscountsHB($rateSupplementCode, $rateSupplementName, $rateSupplementFrom, $rateSupplementTo, $rateSupplementAmount, $rateDiscountNights, $rateDiscountPax, $rateDiscountCode, $rateDiscountName, $rateDiscountAmount, $PidRates)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingroomratebreakdown` (`rateSupplementCode`, `rateSupplementName`,`rateSupplementFrom`, `rateSupplementTo`, `rateSupplementAmount`, `rateDiscountNights`, `rateDiscountPax`, `rateDiscountCode`,`rateDiscountName`, `rateDiscountAmount`, `PidRates`) VALUES ('" . $rateSupplementCode . "','" . $rateSupplementName . "','" . $rateSupplementFrom . "','" . $rateSupplementTo . "', '" . $rateSupplementAmount . "', '" . $rateDiscountNights . "', '" . $rateDiscountPax . "','" . $rateDiscountCode . "','" . $rateDiscountName . "','" . $rateDiscountAmount . "', '" . $PidRates . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingHBA($Id, $ClientReference, $TotalCharges, $TotalMarkup, $GrossAmount, $HolderTitle, $HolderSurname, $HolderName, $HolderEmail, $HolderTelephones, $Currency, $Status, $TotalAdults, $TotalChildren, $CheckInDate, $CheckOutDate, $SelectedNights, $StartTime, $EndTime, $BookingServiceType, $PidAgence, $PidAgent, $CreationUser, $PendingAmount, $SupplierName, $SupplierVatNumber, $country, $destination, $Convertion)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `booking` (`id`,`bookingreference`,`totalcharges`,`totalmarkup`,`grossamount`,`leadertitle`,`leaderfirstname`,`leaderlastname`,`contactemail`,`contactmobile`,`currencycode`,`currentstatus`,`totaladults`,`totalchildren`,`checkindate`,`checkoutdate`,`selectednights`,`starttime`,`endtime`,`bookingservicetype`,`pidagence`,`pidagent`,`creationUser`,`pendingAmount`,`SupplierName`,`SupplierVatNumber`,`countryname`,`cityname`,`convertion`) VALUES ('" . $Id . "','" . $ClientReference . "','" . $TotalCharges . "','" . $TotalMarkup . "','" . $GrossAmount . "','" . $HolderTitle . "','" . $HolderSurname . "','" . $HolderName . "','" . $HolderEmail . "','" . $HolderTelephones . "','" . $Currency . "','" . $Status . "','" . $TotalAdults . "','" . $TotalChildren . "','" . $CheckInDate . "','" . $CheckOutDate . "','" . $SelectedNights . "','" . $StartTime . "','" . $EndTime . "','" . $BookingServiceType . "','" . $PidAgence . "','" . $PidAgent . "','" . $CreationUser . "','" . $PendingAmount . "','" . $SupplierName . "','" . $SupplierVatNumber . "','" . $country . "','" . $destination . "','" . $Convertion . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function updateResaBookingHBA($activityDateFrom, $activityDateTo, $SelectedNights, $activitySupplierName, $activitySupplierVatNumber, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `booking` SET
			`checkindate`='" . $activityDateFrom . "',
			`checkoutdate`='" . $activityDateTo . "',
			`selectednights`='" . $SelectedNights . "',
			`SupplierName`='" . $activitySupplierName . "',
			`SupplierVatNumber`='" . $activitySupplierVatNumber . "'

			WHERE `pid`='" . $PidBooking . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ActivityDetailBookingHBA($activityCode, $activityName, $activityStatus, $activitySupplierName, $activitySupplierVatNumber, $activityCommentType, $activityCommentText, $activityType, $activityReference, $activityModalityCode, $activityModalityName, $activityModalityAmountUnitType, $activityDateFrom, $activityDateTo, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `activityDetail` (`activityCode`,`activityName`,`activityStatus`,`activitySupplierName`,`activitySupplierVatNumber`,`activityCommentType`,`activityCommentText`,`activityType`,`activityReference`,`activityModalityCode`,`activityModalityName`,`activityModalityAmountUnitType`,`activityDateFrom`,`activityDateTo`,`pidBooking`) VALUES ('" . $activityCode . "','" . $activityName . "','" . $activityStatus . "','" . $activitySupplierName . "','" . $activitySupplierVatNumber . "','" . $activityCommentType . "','" . $activityCommentText . "','" . $activityType . "','" . $activityReference . "','" . $activityModalityCode . "','" . $activityModalityName . "','" . $activityModalityAmountUnitType . "','" . $activityDateFrom . "','" . $activityDateTo . "','" . $PidBooking . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function activityRatesBookingHBA($rateType, $rateCode, $rateName, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `activityRates` (`rateType`,`rateCode`,`rateName`,`pidBooking`) VALUES ('" . $rateType . "','" . $rateCode . "','" . $rateName . "','" . $PidBooking . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ActivityDetailBookingVoucherHBA($VoucherCode, $VoucherLanguage, $VoucherUrl, $VoucherMimeType, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `activityVouchers` (`VoucherCode`,`VoucherLanguage`,`VoucherUrl`,`VoucherMimeType`,`pidBooking`) VALUES ('" . $VoucherCode . "','" . $VoucherLanguage . "','" . $VoucherUrl . "','" . $VoucherMimeType . "','" . $PidBooking . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function activityCancellationBookingHBA($cancellationDateFrom, $cancellationAmount, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `activityCancellation` (`cancellationDateFrom`,`cancellationAmount`,`pidBooking`) VALUES ('" . $cancellationDateFrom . "','" . $cancellationAmount . "','" . $PidBooking . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function activityQuestionBookingHBA($questionCode, $questionRequired, $questionText, $questionAnswer, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `activityQuestion` (`questionCode`,`questionRequired`,`questionText`,`questionAnswer`,`pidBooking`) VALUES ('" . $questionCode . "','" . $questionRequired . "','" . $questionText . "','" . $questionAnswer . "','" . $PidBooking . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function activityPaxesBookingHBA($paxId, $paxName, $paxSurname, $paxAge, $paxType, $paxConfirmationCode, $paxConfirmationUnitType, $seatEntranceDoor, $seatGate, $seatRow, $seatSeat, $PidBooking)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `activityPaxes` (`paxId`,`paxName`,`paxSurname`,`paxAge`,`paxType`,`paxConfirmationCode`,`paxConfirmationUnitType`,`seatEntranceDoor`,`seatGate`,`seatRow`,`seatSeat`,`pidBooking`) VALUES ('" . $paxId . "','" . $paxName . "','" . $paxSurname . "','" . $paxAge . "','" . $paxType . "','" . $paxConfirmationCode . "','" . $paxConfirmationUnitType . "','" . $seatEntranceDoor . "','" . $seatGate . "','" . $seatRow . "','" . $seatSeat . "','" . $PidBooking . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function BookingUpdateQuota($PidPeriod, $NewQuota)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `hotelcontractperiod` SET
			`quota`='" . $NewQuota . "'

			WHERE `pid`='" . $PidPeriod . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function BookingUpdateStatus($Id)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `booking` SET
			`currentstatus`='cancelled'

			WHERE `id`='" . $Id . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function BookingUpdateStatusHB($Id)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `booking` SET
			`currentstatus`='cancelled',
			`cancellation`='false'

			WHERE `id`='" . $Id . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function BookingCancelHB($Id, $dateCancel)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `booking` SET
			`options`='" . $dateCancel . "'

			WHERE `id`='" . $Id . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingUpdate($idbook, $dateConf)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `bookingtotal` SET
			`etat`='1',
			`date_confirmation`='" . $dateConf . "'

			WHERE `id_booking_total`='" . $idbook . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function ResaBookingCancel($idbook)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `bookingtotal` SET
			`etat`='2'

			WHERE `id_booking_total`='" . $idbook . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function aProfilEdit($agn_nom, $agn_prenom, $agn_email_client, $agn_telephone, $username, $password, $percent, $PID)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `agence` SET
			`nom`='" . $agn_nom . "' ,
			`prenom`='" . $agn_prenom . "' ,
			`email_client`='" . $agn_email_client . "' ,
			`tel_client`='" . $agn_telephone . "' ,
			`login`='" . $username . "' ,
			`password`='" . $password . "' ,
			`percent`='" . $percent . "'

			WHERE `pid`='" . $PID . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function wProfilEdit($agn_nom, $agn_prenom, $agn_email_client, $agn_telephone, $username, $password, $PID)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `workers` SET
			`nom`='" . $agn_nom . "' ,
			`prenom`='" . $agn_prenom . "' ,
			`email`='" . $agn_email_client . "' ,
			`tel`='" . $agn_telephone . "' ,
			`login`='" . $username . "' ,
			`password`='" . $password . "'

			WHERE `pid`='" . $PID . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function editAgence($agence_nom, $agence_email, $pays, $ville, $agence_zip, $agence_iata, $agence_adresse, $agence_licence, $agence_fiscal, $agence_registre, $user_nom, $user_prenom, $user_phone, $user_fax, $PID)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `agence` SET
			`nom_agence`='" . $agence_nom . "' ,
			`email`='" . $agence_email . "' ,
			`code_pays`='" . $pays . "' ,
			`code_ville`='" . $ville . "' ,
			`code_postal`='" . $agence_zip . "' ,
			`code_iata`='" . $agence_iata . "' ,
			`adresse`='" . $agence_adresse . "' ,
			`num_licence`='" . $agence_licence . "' ,
			`num_fiscal`='" . $agence_fiscal . "' ,
			`reg_commerce`='" . $agence_registre . "' ,
			`nom`='" . $user_nom . "' ,
			`prenom`='" . $user_prenom . "' ,
			`tel_client`='" . $user_phone . "' ,
			`fax`='" . $user_fax . "'

			WHERE `pid`='" . $PID . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function updateAgenceLogo($agence, $Logo)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `user` SET
			`logo`='" . $Logo . "'

			WHERE `id`='" . $agence . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function updateAgenceCredit($agence, $CREDIT)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `user` SET
			`credit`='" . $CREDIT . "'

			WHERE `id`='" . $agence . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function addWorker($worker_nom, $worker_prenom, $worker_phone, $worker_email, $worker_login, $worker_password, $worker_etat, $roles, $role, $created_on, $PID)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `workers` (`nom`,`prenom`,`tel`,`email`,`login`,`password`,`etat`,`roles`,`role`,`created_on`,`last_login`,`agence`) VALUES ('" . $worker_nom . "','" . $worker_prenom . "','" . $worker_phone . "','" . $worker_email . "','" . $worker_login . "','" . $worker_password . "','" . $worker_etat . "','" . $roles . "','" . $role . "','" . $created_on . "','" . $created_on . "','" . $PID . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function editWorker($worker_tel, $worker_email, $worker_password, $roles, $role, $pid)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `workers` SET
			`tel`='" . $worker_tel . "' ,
			`email`='" . $worker_email . "' ,
			`password`='" . $worker_password . "' ,
			`roles`='" . $roles . "' ,
			`role`='" . $role . "'

			WHERE `pid`='" . $pid . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function Verif($pid)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `agence` SET
			`verified`='1'

			WHERE `pid`='" . $pid . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function editWorkerEtat($E, $pid, $PID)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `workers` SET
			`etat`='" . $E . "'

			WHERE (`pid`='" . $pid . "' AND `agence`='" . $PID . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function lastLogin($table, $champ, $last_login, $pid)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `" . $table . "` SET
			`" . $champ . "`='" . $last_login . "'

			WHERE `pid`='" . $pid . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function InsertOnlineActivityIp($workerpid, $agencypid, $last_activity, $userIp, $userSIp)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `loginip` (`workerpid`,`agencypid`,`last_activity`,`workerip`,`workersip`) VALUES ('" . $workerpid . "','" . $agencypid . "','" . $last_activity . "','" . $userIp . "','" . $userSIp . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function InsertOnlineActivity($workerpid, $agencypid, $last_activity)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `online` (`workerpid`,`agencypid`,`last_activity`) VALUES ('" . $workerpid . "','" . $agencypid . "','" . $last_activity . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function UpdateOnlineActivity($workerpid, $last_activity)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `online` SET
			`last_activity`='" . $last_activity . "'

			WHERE `workerpid`='" . $workerpid . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function InsertTour($BookingReference, $TotalCharges, $GrossAmount, $TotalMarkup, $LeaderTitle, $LeaderFirstName, $LeaderLastName, $HotelName, $CountryName, $TotalAdults, $TotalChildren, $CheckInDate, $CheckOutDate, $SelectedNights, $PidAgence, $PidAgent, $BookingServiceType, $ContactEmail, $ContactMobile, $ContactVol, $OO)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `booking` (`bookingreference`,`totalcharges`,`totalmarkup`,`leadertitle`,`leaderfirstname`,`leaderlastname`,`hotelname`,`countryname`,`cityname`,`totaladults`,`totalchildren`,`checkindate`,`checkoutdate`,`grossamount`,`selectednights`,`bookingservicetype`,`pidagence`,`pidagent`,`contactemail`,`contactmobile`,`contactvol`,`options`,`starttime`,`currentstatus`) VALUES ('" . $BookingReference . "','" . $TotalCharges . "','" . $TotalMarkup . "','" . $LeaderTitle . "','" . $LeaderFirstName . "','" . $LeaderLastName . "','" . $HotelName . "','" . $CountryName . "','" . $CountryName . "','" . $TotalAdults . "','" . $TotalChildren . "','" . $CheckInDate . "','" . $CheckOutDate . "','" . $GrossAmount . "','" . $SelectedNights . "','" . $BookingServiceType . "','" . $PidAgence . "','" . $PidAgent . "','" . $ContactEmail . "','" . $ContactMobile . "','" . $ContactVol . "','" . $OO . "','" . date('Y-m-d H:i:s') . "','vouchered') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function InsertTourRoom($PidBooking, $RoomDescription, $NbRoom)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingrooms` (`roomtypedescription`,`numberofroom`,`pidbooking`) VALUES ('" . $RoomDescription . "','" . $NbRoom . "','" . $PidBooking . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function InsertTourRoomDetail($PassengerTitle, $PassengerFName, $PassengerLName, $PassengerType, $PassengerAge, $PidRoom)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `bookingroomdetails` (`salutation`,`firstname`,`lastname`,`passengertype`,`age`,`pidroom`) VALUES ('" . $PassengerTitle . "','" . $PassengerFName . "','" . $PassengerLName . "','" . $PassengerType . "','" . $PassengerAge . "','" . $PidRoom . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function insertBooking($pnrNum, $BookingReference, $totalCharges, $grossAmount, $totalMarkup, $convertion, $leadertitle, $leaderFirstName, $leaderLastName, $currencyCode, $currentStatus, $totalAdult, $totalChild, $totalInfant, $pidAgence, $pidAgent, $CreationDate, $BookingServiceType, $contactEmail, $contactMobile, $contactVol, $contactMessage)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `booking` (`id`, `bookingreference`, `totalcharges`, `grossamount`, `totalmarkup`, `convertion`, `leadertitle`, `leaderfirstname`, `leaderlastname`, `currencycode`, `currentstatus`, `totaladults`, `totalchildren`,`totalrooms`,`pidagence`,`pidagent`,`starttime`,`endtime`,`bookingservicetype`,`contactemail`,`contactmobile`,`contactvol`,`contactmessage`) VALUES ('" . $pnrNum . "', '" . $BookingReference . "', '" . $totalCharges . "', '" . $grossAmount . "', '" . $totalMarkup . "', '" . $convertion . "', '" . $leadertitle . "', '" . $leaderFirstName . "', '" . $leaderLastName . "', '" . $currencyCode . "', '" . $currentStatus . "', '" . $totalAdult . "', '" . $totalChild . "', '" . $totalInfant . "', '" . $pidAgence . "', '" . $pidAgent . "', '" . $CreationDate . "', '" . $CreationDate . "', '" . $BookingServiceType . "', '" . $contactEmail . "', '" . $contactMobile . "', '" . $contactVol . "', '" . $contactMessage . "') ";
        $reqSelect = $db->query($sqlSelect);
        return $db->insert_id();
        $db->disconnect();
    }

    function insertTraveller($Surname, $FirstName, $Type, $newDateOfBirth, $BookingId, $CreationDate)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `flightTraveller` (`Surname`,`FirstName`,`Type`,`DateOfBirth`,`BookingId`,`CreationDate`) VALUES ('" . $Surname . "','" . $FirstName . "','" . $Type . "','" . $newDateOfBirth . "','" . $BookingId . "', '" . $CreationDate . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function insertItinerary($DepartureLocation, $ArrivalLocation, $newDepartureDateTime, $newArrivalDateTime, $DepartureTerminal, $ArrivalTerminal, $Company, $FlightId, $CabinClass, $FlightEquipment, $pnrCompany, $pnrNum, $BookingId, $CreationDate)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `flightItinerary` (`DepartureLocation`, `ArrivalLocation`, `DepartureDateTime`, `ArrivalDateTime`, `DepartureTerminal`, `ArrivalTerminal`, `Company`, `FlightId`, `CabinClass`, `FlightEquipment`, `pnrCompany`, `pnrNum`, `BookingId`,`CreationDate`) VALUES ('" . $DepartureLocation . "', '" . $ArrivalLocation . "', '" . $newDepartureDateTime . "', '" . $newArrivalDateTime . "', '" . $DepartureTerminal . "', '" . $ArrivalTerminal . "', '" . $Company . "', '" . $FlightId . "', '" . $CabinClass . "', '" . $FlightEquipment . "', '" . $pnrCompany . "', '" . $pnrNum . "', '" . $BookingId . "', '" . $CreationDate . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function insertTicket($passengerSurname, $passengerFirstname, $passengerType, $documentNumber, $freeAllowance, $quantityCode, $documentStatus, $pnrNum, $BookingId, $CreationDate)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `flightTicket` (`passengerSurname`, `passengerFirstname`, `passengerType`, `documentNumber`, `freeAllowance`, `quantityCode`, `documentStatus`, `pnrNum`, `BookingId`, `CreationDate`) VALUES ('" . $passengerSurname . "', '" . $passengerFirstname . "', '" . $passengerType . "', '" . $documentNumber . "', '" . $freeAllowance . "', '" . $quantityCode . "', '" . $documentStatus . "', '" . $pnrNum . "', '" . $BookingId . "', '" . $CreationDate . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function CancelTicket($documentStatus, $UpdateDate, $ticketpid)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " UPDATE `flightTicket` SET
			`documentStatus`='" . $documentStatus . "',
			`UpdateDate`='" . $UpdateDate . "'

			WHERE `pid`='" . $ticketpid . "' ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function EmptyStaticData()
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "TRUNCATE TABLE citystaticdata";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function insertStaticData($Title, $pid, $country, $type)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `citystaticdata` (`Title`, `pid`, `country`, `type`) VALUES ('" . $Title . "', '" . $pid . "', '" . $country . "', '" . $type . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function EmptyHotelStaticData()
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = "TRUNCATE TABLE hotelstaticdata";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function insertHotelStaticData($pid, $title, $IdCity, $type)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `hotelstaticdata` (`pid`, `Title`, `IdCity`, `type`) VALUES ('" . $pid . "', '" . $title . "', '" . $IdCity . "', '" . $type . "') ";
        $reqSelect = $db->query($sqlSelect);
        if ($reqSelect) {
            return 1;
        } else {
            return 0;
        }
        $db->disconnect();
    }

    function GetHotelsStaticData($idcity)
    {
        $res = '';
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT pid from hotelstaticdata where idcity='" . $idcity . "'";
        $reqSelect = $db->query($sqlSelect);
        $result = $db->fetchArray();
        foreach ($result as $k => $v) {
            $res .= $v['pid'] . ';';
        }
        return substr($res, 0, -1);
        $db->disconnect();
    }

     function SelectMarkup(){
         $db = new Db();
         $db->connect();
         $sqlSelect = " SELECT * from markup";
         $reqSelect = $db->query($sqlSelect);
         $result = $db->fetchArray();
         return $result[0];
         $db->disconnect();
     }

    function  InsertCity($id,$code,$countryCode,$cityName)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " INSERT INTO `destinations` (`id`,`code`,`countryCode`,`name`) VALUES ('".$id."','".$code."','".$countryCode."','".$cityName."') ";
        $reqSelect = $db->query(sprintf($sqlSelect));
        if($reqSelect)
        {
            return 1;
        }
        else
        {
            return 0;
        }
        $db->disconnect();
    }

    function SelectCountryName($table, $code)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT description FROM `" . $table . "` where isoCode='".$code."' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }

    function SelectCityName($table, $code)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT name FROM `" . $table . "` where code='".$code."' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();
    }
    function SelectHotelsList($code)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT id,slug,name,address,city,categoryCode,images FROM `hotelsdump` where destinationCode='".$code."' ";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();

    }

    function SelectHotelData($hotelSlug)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT * FROM `hotelsdump` where `slug`='".$hotelSlug."'";
        $reqSelect = $db->query($sqlSelect);
        return $db->fetchArray();
        $db->disconnect();

    }

    function SelectFacilities($code ,$groupCode)
    {
        $db = new Db();
        $db->connect();
        $sqlSelect = " SELECT description FROM `facilities` where code=".$code." and groupCode=".$groupCode."";
        $reqSelect = $db->query($sqlSelect);
        $result = $db->fetchArray();
        return $result[0];
        $db->disconnect();

    }


}


