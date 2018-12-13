<?php
require_once(__DIR__ . '/lib/Teacher.php');
$teacher = new Teacher();
$content = "";
if (isset($_GET["file"])) {
	$lp = $teacher->getSessionValue();
    $file = $teacher->getNewPath($_GET["file"], $lp);
    $content = file_get_contents($file);
    if (isset($_GET["style"])) {
    	$file2 = $teacher->getNewPath($_GET["style"], $lp);
        $content = str_replace("style.css", $file2, $content);
    }
    if (isset($_GET["script"])) {
    	$file2 = $teacher->getNewPath($_GET["script"], $lp);
        $content = str_replace("script.js", $file2, $content);
    }
    if (isset($_GET["text"])) {
    	$file2 = $teacher->getNewPath($_GET["text"], $lp);
        $content = file_get_contents($file2);
    }
}
//dump content
printf("%s",$content);