<?php
function getlastitemid()
{
    global $conn;
    $Sql = "SELECT `id` FROM `items` ORDER BY `items`.`id` DESC LIMIT 1";
    $check = mysqli_query($conn, $Sql);
    $row = mysqli_fetch_array($check);
    $rowdata = $row['id'];
    return ($rowdata);
}

function getitemidfromname($name)
{
    global $conn;
    $Sql = "SELECT `id`FROM `items` WHERE  `itemname` = '$name' or `itemcode` = '$name' ";
    $check = mysqli_query($conn, $Sql);
    $row = mysqli_fetch_array($check);
    $rowdata = $row['id'];
    return ($rowdata);
}
function getitemnamefromid($id)
{
    global $conn;
    $Sql = "SELECT `itemname` ,`itemcode` FROM `items` WHERE `id` = '$id' ";
    $check = mysqli_query($conn, $Sql);
    $row = mysqli_fetch_array($check);
    $rowdata = $row['itemname'] . " - " . $row['itemcode'];
    return ($rowdata);
}

function getitemprice($id)
{
    global $conn;
    //`id`, `item_id`, `bought`, `sold`, `active`, `whenwasit`, `whodidit`
    $Sql2 = "SELECT  `sold` FROM `item_price` WHERE `active` = '1' and  `id`= '$id' ";
    $check2 = mysqli_query($conn, $Sql2);
    $row2 = mysqli_fetch_array($check2);
    $drugprice = $row2['sold'];
    return ($drugprice);
}
function getitempriceid($idofdrug)
{
    global $conn;
    $Sql2 = "SELECT `id` FROM `item_price` WHERE  `item_id`= '$idofdrug' and active = 1  ";
    $check2 = mysqli_query($conn, $Sql2);
    $row2 = mysqli_fetch_array($check2);

    $idprice = $row2['id'];
    return ($idprice);
}
function getitemquantity($idofdrug)
{
    global $conn;
    $fullamount = 0;
    $Sql = "SELECT `amount` FROM `item_quantity` WHERE `item_id`= '$idofdrug' order by `expiredate` ASC ";
    $check = mysqli_query($conn, $Sql);
    while ($row = mysqli_fetch_array($check)) {
        $amount = $row['amount'];
        $fullamount += $amount;
    }

    return ($fullamount);
}
function ordercountplus()
{
    global $conn;
    $Sql2 = "SELECT  `orderno` FROM `ordercount` ";
    $check2 = mysqli_query($conn, $Sql2);
    $row2 = mysqli_fetch_array($check2);
    $orderno = $row2['orderno'] + 1;
    $Sql2 = "UPDATE `ordercount` SET `orderno`='$orderno' ";
    mysqli_query($conn, $Sql2);
}
function itemquantitykilling($Drugid, $amountmius)
{
    global $conn;
    $Sql = "SELECT `id`,`amount` FROM `item_quantity` WHERE `item_id`= '$Drugid' order by `expiredate` ASC ";
    $check = mysqli_query($conn, $Sql);
    while ($row = mysqli_fetch_array($check)) {
        $rowid = $row['id'];
        if ($amountmius != 0) {

            if ($amountmius >= $row['amount']) {
                $amountmius -= $row['amount'];
                $amount = 0;
            } else        
        if ($amountmius < $row['amount']) {

                $amount = $row['amount'] - $amountmius;
                $amountmius = 0;
            }
            $Sql2 = "UPDATE `item_quantity` SET `amount`='$amount' where `id` = '$rowid'  ";
            mysqli_query($conn, $Sql2);
        }
    }
}

function itemquantityadd($Drugid, $amountplus)
{
    global $conn, $today;
    if ($amountplus <= 0) return;
    $Sql = "SELECT `id`,`amount` FROM `item_quantity` WHERE `item_id`= '$Drugid' and `active` = 1 order by `expiredate` ASC limit 1";
    $check = mysqli_query($conn, $Sql);
    if ($row = mysqli_fetch_array($check)) {
        $rowid = $row['id'];
        $newAmount = ((int)$row['amount']) + (int)$amountplus;
        $Sql2 = "UPDATE `item_quantity` SET `amount`='$newAmount' where `id` = '$rowid'  ";
        mysqli_query($conn, $Sql2);
    } else {
        // No active quantity rows; create one minimal record
        $Drugid = (int)$Drugid;
        $amountplus = (int)$amountplus;
        $when = $today ?: date('Y-m-d');
        $Sql3 = "INSERT INTO `item_quantity`(`item_id`, `amount`, `expiredate`, `active`, `whenwasit`, `whodidit`) VALUES ('$Drugid','$amountplus','0000-00-00',1,'$when','admin')";
        mysqli_query($conn, $Sql3);
    }
}
