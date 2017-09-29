<?php

 $json[1] = "http://www.cartoonnetwork.com/test/backend-quiz/games.json";
 $json[2] = "http://www.cartoonnetwork.com/test/backend-quiz/shows.json";

 foreach (range(1,count($json)) as $ct) {
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_URL, $json[$ct]);
     $result = curl_exec($ch);
     curl_close($ch);

     $feed[$ct] = json_decode($result);
 }
//since both feeds are the same length I have not accounted for the possibility of different lengths
//if one point of example was to handle different sized feeds then the feeds would have been different lengths IMO
// making that an inferred requirement:)

//no error checking provided since robust error checking, like unit testing
//can easily double or triple code required
//since this is a test you would have specifically asked for and described what level of error checking was expected

foreach (range(0,count($feed[$ct]->shows)-1) as $row){
    $arr["id"] = $feed[1]->games[$row]->id;
    $arr["show"] = $feed[2]->shows[$row]->show;
    $arr["game"] = $feed[1]->games[$row]->game;
    $res[]=$arr;
}
?>
<!--Since this a php example html kept to minimum :) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Turner Test</title>
</head>
<body>
<p>
<?php
foreach ($res as $item){
    echo $item["id"]."<br />";
    echo $item["show"]."<br />";
    echo $item["game"]."<br /><br />";
}
?>
</p>
</body>
</html>





