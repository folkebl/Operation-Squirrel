<?php
    $user = "root";
    $pass = "";
    $dbh = new PDO('mysql:host=localhost;dbname=capstone', $user,$pass);
    //gets the data for number of buyers
    $user_query = "SELECT COUNT(*) FROM registration WHERE `user_delete` = false;";
    $user_query = $dbh->prepare($user_query);
    $user_query->execute();
    $user_count = $user_query->fetch();
    //gets the data for number of items
    $item_query = "SELECT COUNT(*) FROM registration WHERE `user_delete` = false;";
    $item_query = $dbh->prepare($item_query);
    $item_query->execute();
    $item_count = $item_query->fetch();
    // gets the data for average sale price
    $average_price_query = "SELECT `iteminformation`.`SellingPrice`
                            FROM `capstone`.`iteminformation`
                            Where `item_delete` = false AND `SellingPrice` != 0;";
    $average_price_query = $dbh->prepare($average_price_query);
    $average_price_query->execute();
    $count = 0;
    $average_price_total = 0;
    while($average_price = $average_price_query->fetch())
        {
            $count++;
            $average_price_total = $average_price[0] + $average_price_total;
        }
        $average_price_total = ($average_price_total / $count);
    // gets the data and does calculation for money made
    $all_user_count_query = "SELECT COUNT(*) FROM registration";
    $all_user_count_query = $dbh->prepare($all_user_count_query);
    $all_user_count_query->execute();
    $all_user_count = $all_user_count_query->fetch();
        //Gets the table data where base on the name selected.
        $feegrandtotal = 0.0;
        for($i = 0; $i < $all_user_count[0]; $i++)
        {
            $querytabledata = "SELECT `ItemNumber`, `sellerNumber`, `BuyerNumber`, `StartingBid`, `SellingPrice`, `Charity`,`Description` FROM `iteminformation` where sellerNumber = :nameofuser AND item_delete = 0;";
            $tablestatement = $dbh->prepare($querytabledata);
            $tablestatement->bindparam(':nameofuser',$i);
            $tablestatement->execute();
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
                $feegrandtotal = $feegrandtotal + $fee;
            endwhile;
        }
    //Gets the data for items for charity
    $item_charity_query = "SELECT COUNT(*) FROM iteminformation WHERE `Charity` = True;";
    $item_charity_query = $dbh->prepare($item_charity_query);
    $item_charity_query->execute();
    $charity_item_count = $item_charity_query->fetch();
    //Gets the data for items for charity
    $money_charity_query = "SELECT SUM(`SellingPrice`) FROM iteminformation WHERE `Charity` = True;";
    $money_charity_query = $dbh->prepare($money_charity_query);
    $money_charity_query->execute();
    $charity_money = $money_charity_query->fetch();
    

?>
<!DOCTYPE html>
<html>
<title>Reports</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
  </head>
  <body class="pagecolor">
    <div class="menu-wrap">
        <nav class="menu">
            <ul class="clearfix">
                <li><a href="index.html">Home</a></li>
            </ul>
        </nav>
    </div>
		<div class = "textboxes">
            <h1>Reports</h1>
        </div>
        <div class = "reportstext">
            <p>Number of buyers: <?php echo $user_count[0];?></p>
            <p>Number of items: <?php echo $item_count[0];?></p>
            <p>Average sale price: $<?php echo $average_price_total;?></p>
            <p>Money made: $<?php echo $feegrandtotal;?></p>
            <p>Items for charity: <?php echo $charity_item_count[0];?> </p>
            <p>Money for charity: $<?php echo $charity_money[0];?> </p>
        </div>
 </body>
</html>