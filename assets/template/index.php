<span style="font-size:20px">
<?php

$dir = (scandir(__DIR__));
    array_shift($dir);array_shift($dir);
foreach($dir as $d)
{
    print "<a href=\"" . urlencode($d) . "\">" . $d . "</a><br/>";
    if(is_dir(__DIR__ . "/" . $d))
    {
        $dir2 = scandir(__DIR__ . "/" . $d);
        foreach($dir2 as $d2)
        {
            if(is_file(__DIR__ . "/" . $d . "/" . $d2))
            {
                print "&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"" . $d . '/' . $d2 . "\">" . $d2 . "</a><br/>";
            }
        }


    }

}
?></span>