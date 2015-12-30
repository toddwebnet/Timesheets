<?php

//print encryptPassword("password");


$mysql_bin = "/Applications/MAMP/Library/bin/mysql";
$username = "root";
$password = "root";
$database = "timesheets";
$server   = "mubuntu.lan";

$fileList = ConvertDirArrayToList( getcwd(), dirToArray(getcwd())  );

$count = count($fileList);
$c = 0;
print "\n" . $count . " Files to process\n";
foreach($fileList as $fileListItem) {
    $c++;
    $cmd = $mysql_bin . " -h " . $server . " -u" . $username . " -p" . $password . " " . $database . " <" . $fileListItem;
    print "\nExecuting " . $c . "/" . $count;
    print " - " . basename($fileListItem);
    exec($cmd);
}

print "\n\nCompleted.\n";


function ConvertDirArrayToList($root, $array)
{
    $return = array();
    foreach($array as $dir=>$o)
    {
        if(is_array($o))
        {
            $return = array_merge($return,
                ConvertDirArrayToList($root . "/" . $dir,  $o)
            );
        }
        else
        {
            if (pathinfo($o)["extension"] == "sql") {
                $return[] = $root . "/" . $o;
            }
        }

    }
    return $return;

}

function dirToArray($dir) {

    $result = array();

    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
        if (!in_array($value,array(".","..")))
        {
            if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
            {$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);}
            else
            {$result[] = $value;}
        }
    }

    return $result;
}


?>