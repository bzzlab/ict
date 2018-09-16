<?php
require_once(__DIR__ . '/lib/Teacher.php');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include_once("inc/head_src.inc"); ?>
</head>
<body>
    <?php
    if (isset($_GET["file"])){
        $teacher = new Teacher();
        //V2.0 feature - add new teacher (lp)
        //expression means if not found then
        $lp = $teacher->getSessionValue();
        $file = $teacher->getNewPath($_GET["file"], $lp);
    }
    echo '<xmp>'.file_get_contents($file).'</xmp>';
    ?>
</body>
</html>