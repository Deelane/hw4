<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-40 Ipsum Generator</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">

</head>
<body>

<!--Header-->
<header>
    <!--E-40 image div-->
    <div>
        <div>
            <div>E-40 Ipsum</div>
        </div>
    </div>
</header>

<!--Main Div-->
<div id="main">

    <div id="e40"></div>

    <div id="articleasideDiv">
        <article>
            <div>Settings</div>
            <form id="form" action="loremipsum.php" method="POST">
                <div id="checkboxDiv">
                    <div>
                        <input name="fortycheckbox" id="fortycheckbox" type="checkbox" >
                        <label for="fortycheckbox">Start with E-FAWTY</label>
                    </div>
                    <div>
                        <input name="realcheckbox" id="realcheckbox" type="checkbox">
                        <label for="realcheckbox">REAL <span style="color:grey; font-size: 16px;">(Include NSFW Lyrics)</span></label>
                    </div>
                </div>

                <div>
                    <label for="paragraphs"><span style="font-size: 30px; font-weight: bold;">Paragraphs:</span></label>
                    <input type="number" min="1" name="paragraphs" id="paragraphs" value="1">
                </div>

                <div>
                    <input type="submit" name="submit" value="GENERATE BARS">
                </div>
            </form>
        </article>

        <!--Aside-->
        <aside>
            <div id="BARS"><u>BARS</u></div>
            <div id="ipsumtext">

                <?php
                    $bars = array();

                    $barsfile = fopen("bars.txt", "r");
                    if ($barsfile) {
                        while (($line = fgets($barsfile)) !== false) {
                            array_push($bars, $line);
                        }
                        fclose($barsfile);
                    } else {
                        print("IO Exception");
                    }

                    $checked = false;
                    if(isset($_POST['realcheckbox']))
                    {
                        $checked = true;
                        $realbarsfile = fopen("realbars.txt", "r");
                        if ($realbarsfile)
                        {
                            while (($line = fgets($realbarsfile)) !== false)
                            {
                                array_push($bars, $line);
                            }
                            fclose($realbarsfile);
                        }
                        else
                        {
                            print("IO Exception");
                        }
                    }

                    shuffle($bars);
                    $paragraphs = 1;
                    if (isset($_POST['paragraphs']))
                    {
                        $paragraphs = $_POST['paragraphs'];
                    }
                    $numberofbars = rand(7, 10);
                    $result = "";

                    $fawty = false;
                    if (isset($_POST['fortycheckbox']))
                    {
                        $fawty = true;
                        $result = "E-FAWTY! ";
                    }

                    for ($h = 0; $h < $paragraphs; $h++) {
                        for ($i = 0; $i < $numberofbars; $i++) {
                            $barsrand = rand(0, count($bars) - 1);
                            $result = $result . $bars[$barsrand];
                        }
                        $result = $result . "\n" . "<br><br>";
                    }
                    echo $result;
                ?>
            </div>
        </aside>
    </div>
    <div id="test"></div>

</div>

<footer>
    Header e-40 image source: https://www.jambase.com/band/e-40<br>
    Aside e-40 image source: https://genius.com/albums/E-40/Practice-makes-paper<br>
    https://image-ticketfly.imgix.net/00/02/47/11/60-og.jpg?w=1362&h=2048
</footer>

<script>
    if ( window.history.replaceState )
    {
        window.history.replaceState( null, null, window.location.href );
    }
    document.getElementById("paragraphs").value = (<?php echo $paragraphs; ?>);
    if("<?php echo $checked; ?>")
    {
        document.getElementById("realcheckbox").checked = true;
    }
    if("<?php echo $fawty; ?>")
    {
        document.getElementById("fortycheckbox").checked = true;
    }
</script>
</body>
</html>

