<?php

$GamesBadgesJson=file_get_contents("json.js");
$GamesBadgesJson = preg_replace('/\s+/S', " ", $GamesBadgesJson);
$GamesBadges=json_decode(file_get_contents("json.js"));

$gameBadgesArr = getGamesBadges($GamesBadges);

function getGamesBadges($GamesBadges){
    foreach($GamesBadges as $gamewithbadges){
        $gameBadgesArr[str_replace("'", '', $gamewithbadges->game)]=$gamewithbadges->badges;
    }
    return $gameBadgesArr;
}

function makeValidId($string){
    //ids can have no spaces or '
    $arr1 = explode(' ',trim($string));
    $arr2 = explode("'",trim($arr1[0] ));
    return $arr2[0];
}

function PhpHide($gameBadgesArr){
    foreach ($gameBadgesArr as $key=>$gameBadges) {
        ?>
        $('#<?php echo makeValidId($key);?>').hide();
        $('#<?php echo makeValidId($key)."header";?>').hide();
        <?php
    }
    return;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <title>Turner Test 2</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col">
            <?php
                foreach ($gameBadgesArr as $key=>$gameBadges) {
                    echo "<div id=\"click".makeValidId($key)."\">".$key."</div>";
                }
            ?>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <?php
                                foreach ($gameBadgesArr as $key=>$gameBadges) {
                                    echo "<h2 id=\"".makeValidId($key)."header\">".$key."</h2>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?php
                            foreach ($gameBadgesArr as $key=>$gameBadges) {
                                echo "<div id=\"".makeValidId($key)."\">";
                                foreach ($gameBadges as $badge){
                                    echo $badge . "<br />";
                                }
                                echo "</div>";
                            }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    <script>
    <?php
        foreach ($gameBadgesArr as $key=>$gameBadges) {
    ?>
        $('#<?php echo makeValidId($key);?>').hide();
        $('#<?php echo makeValidId($key)."header";?>').hide();
    <?php
    }
    ?>
    $('#Finnheader').show();
    $(document).ready(
        function(){
            <?php
            PhpHide($gameBadgesArr);
        ?>
        });
    $("#clickRoyal").click(function () {
        hideAll();
        $("#Royalheader").show("slow");
        $("#Royal").show("slow");
    });
    $("#clickCakes").click(function () {
        hideAll();
        $("#Cakesheader").show("slow");
        $("#Cakes").show("slow");
    });
    $("#clickLemon").click(function () {
        hideAll();
        $("#Lemonheader").show("slow");
        $("#Lemon").show("slow");
    });
    $("#clickFinn").click(function () {
        hideAll();
        $("#Finnheader").show("slow");
        $("#Finn").show("slow");
    });

    function hideAll(){
        $('#Royal').hide();
        $('#Royalheader').hide();
        $('#Cakes').hide();
        $('#Cakesheader').hide();
        $('#Lemon').hide();
        $('#Lemonheader').hide();
        $('#Finn').hide();
        $('#Finnheader').hide();
    };

    </script>
</body>
</html>

