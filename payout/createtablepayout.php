<?php
    $NameOfUser = $_POST["id"];
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);

   echo"<table>
        <tr>
            <th>Item Number</th>
            <th>Name of seller</th>
            <th>Name of buyer</th>
            <th>Starting Bid</th>
            <th>Selling Price</th>
            <th>For Charity</th>
            <th>Fees</th>
            <th>Total</th> 
        </tr>";
        //Gets the table data where base on the name selected.
        $querytabledata = "SELECT `ItemNumber`, `sellerNumber`, `BuyerNumber`, `StartingBid`, `SellingPrice`, `Charity` FROM `iteminformation` where sellerNumber = :nameofuser";
        $tablestatement = $dbh->prepare($querytabledata);
        $tablestatement->bindparam(':nameofuser',$NameOfUser);
        $tablestatement->execute();
        //Gets the name of the seller
        $NameQuery = "SELECT `FirstName`,`LastName` FROM `registration` where `Seller ID` = :nameofuser";
        $statement = $dbh->prepare($NameQuery);
        $statement->bindparam(':nameofuser',$NameOfUser);
        $statement->execute();
        $namerowseller = $statement->fetch();
        $RunningTotal = 0;
        $itemcounter = 0;
        $feetotal = 0.0;
        $feerunningtotal = 0.0;
        while($row = $tablestatement->fetch()):
             $fee = 0;
             $itemTotal = 0;
            if(!($row[5]) && ($row[4] != "0"))
            {
            $itemcounter++;
            $RunningTotal += $row[4];
            $itemTotal += $row[4];
            if($itemcounter >= 6 && $itemcounter <= 15)
                {
                $feetotal = $feetotal + .25;
                $fee = .25;
                }
            elseif($itemcounter >= 16 && $itemcounter <= 25)
                {
                    $feetotal = $feetotal + .50;
                    $fee = .50;
                }
            }
            // gets the buyers name
             $buyernamequery = "SELECT `FirstName`,`LastName` FROM `registration` where `Seller ID` = :buyernumber";
             $buyernamestatement = $dbh->prepare($buyernamequery);
             $buyernamestatement->bindparam(':buyernumber',$row[2]);
             $buyernamestatement->execute();
             $namerowbuyer = $buyernamestatement->fetch();
   
             if($row[5] == true)
             $paid = "Yes"; 
             else
             $paid = "No";
        echo "<tr><td>".$row[0]."</td><td>".$namerowseller[0] . " " . "$namerowseller[1]"."</td><td>"."$namerowbuyer[0]"." ". "$namerowbuyer[1]"."</td><td>"."$".$row[3]."</td><td>"."$".$row[4]."</td><td>".$paid."</td><td>"."$".$fee."</td><td>"."$".$itemTotal."</td></tr>";
        endwhile;
        $overallTotal = ($RunningTotal - $feetotal);
    echo "<tfoot>
        <tr>
            <th id = \"total\" colspan=\"6\">Totals:</th>
            <td>$$feetotal</td>
            <td>$$RunningTotal</td>
        </tr>
        <tr>
            <th id = \"total\" colspan=\"7\">Total Amount Owed:</th>
            <td>$$overallTotal</td>
        </tr>
        </tfoot>
    </table>";

    echo "<div class = \"confirmpayment\"><button id = \"payoutconfirmbutton\" type=\"button\" name = \"confirmbutton\"> Confirm Payment</button></div>"
    ?>