<?php
require_once(__DIR__ . '/lib/Teacher.php');
$teacher = new Teacher();
$content = "";
if (isset($_GET["file"])) {
	$lp = $teacher->getSessionValue();
    $file = $teacher->getNewPath($_GET["file"], $lp);
    $content = file_get_contents($file);
    if (isset($_GET["style"])) {
    	$style = $teacher->getNewPath($_GET["style"], $lp);
        $content = str_replace("style.css", $style, $content);
    }
}
//dump content
printf("%s",$content);