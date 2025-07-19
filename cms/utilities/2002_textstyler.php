<?php
/* type_gpla1.php — renders the Game Player License Agreement banner */
header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>TYPE_GPLA1</title>
<style>
    /* —— container —— */
    #gpla-banner{
        width:305px;  height:72px; margin:0;
        background:#7B7F8D;            /* original grey-blue */
        font-family:Verdana,Arial,sans-serif;
        color:#FFFFFF;
        text-align:center;
        position:relative;
    }

    /* —— shared text styling —— */
    #gpla-banner span{
        display:block;
        margin:0; padding:0;
        line-height:1; letter-spacing:.25px;

        /* multi-layer feathered shadow: darker centre → lighter edge */
        text-shadow:
            1px 1px   0   rgba(0,0,0,.55),   /* crisp core */
            2px 2px   2px rgba(0,0,0,.40),   /* slight blur */
            3px 3px   4px rgba(0,0,0,.25),   /* softer */
            4px 4px   6px rgba(0,0,0,.15);   /* faint fringe */
    }

    /* top micro-heading */
    #gpla-banner .t1{
        font-size:11px; font-weight:bold;
        position:absolute; top:8px; left:0; width:100%;
    }

    /* middle “VALVE, L.L.C.” */
    #gpla-banner .t2{
        font-size:18px;
        position:absolute; top:26px; left:0; width:100%;
    }

    /* bottom “STEAM GAME PLAYER AGREEMENT” */
    #gpla-banner .t3{
        font-size:18px;
        position:absolute; top:48px; left:0; width:100%;
    }
</style>
</head>
<body style="margin:0;">
    <div id="gpla-banner">
        <span class="t1">Game Player License Agreement</span>
        <span class="t2">VALVE, L.L.C.</span>
        <span class="t3">STEAM GAME PLAYER AGREEMENT</span>
    </div>
</body>
</html>
