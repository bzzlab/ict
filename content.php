<?php
require_once(__DIR__ . '/lib/Navigation.php');
$nav = new Navigation();
require_once(__DIR__ . '/lib/Teacher.php');
require_once(__DIR__ . '/lib/Semester.php');
require_once(__DIR__ . '/lib/Content.php');
$content = new Content();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include_once("inc/head.inc"); ?>
    <link href="inc/dashboard.css" rel="stylesheet">
</head>
<body>
<!-- Fixed navbar -->
<?php if (!isset($_GET["top"])) { ?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php $nav->setLinksOfTopNavigation(); ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                           role="button" aria-haspopup="true"
                           aria-expanded="false">Varia<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php $nav->setDropDownMenuNavigation(); ?>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
</nav>
<?php } elseif (isset($_GET["top"])) {
            if ($_GET["top"] == 1) {
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav" style="float:right;">
                <li><button type="button" class="btn btn-link" onclick="history.back(-1)">Zurück</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php } } ?>
<div class="container theme-showcase" role="main">
    <?php
    if (isset($_GET["file"])){
        $teacher = new Teacher();
//        if (isset($_GET["lp"]) && isset($_GET["sem"])) {
//            $teacher->setSessionValue($_GET["lp"]);
//            (new Semester())->setSessionValue($_GET["sem"]);
//        }
        if (isset($_GET["lp"])) {
            $teacher->setSessionValue($_GET["lp"]);
        }

        $nav->setHiddenSessions();
        //V2.0 feature - add new teacher (lp)
        //expression means if not found then
        $file = $teacher->getNewPath($_GET["file"],
            $teacher->getSessionValue());

        if (isset($_GET["inc"]) && ($_GET["inc"]==1) ) {
            $content->showWithIncludes($file);
        } else {
            $content->show($file);
        }
    }
    ?>

<script>
//filter specific images whose path shouldn't be changed
function filterImages(src){
    //filter the following images
    var filterList = ["zoom-in", "video", "red.ico", "yellow.ico", "draft.png"];
    for (var i in filterList) {
        if (src.includes(filterList[i])){
            return true;
        }
    }
    return false;
}

$(document).ready(function() {
    var images = $("img");
    $.each(images, function() {
        var src = $(this).attr("src");
        //Filter: check if specific images' paths shouldn't be changed
        if (filterImages(src) === false) {
            //if src does not contain the path-part data, then ...
            if (!src.includes("data")) {
                //src path should be changed with the lp (Lehrperson) key
                var lp = $("#lp_key").val();
                if (lp == "") {
                    console.log("lp is empty!");
                } else {
                    $(this).attr("src", "data/" + lp + "/" + src);
                    console.log("data/" + lp + "/" + src);
                }
            }
        }
    });

    //select all anchor <a> in <figcaption> and change href accordingly
    images = $("figcaption a");
    $.each(images, function() {
        var href = $(this).attr("href");
        if (!href.includes("data")) {
            var lp = $("#lp_key").val();
            if (lp == "") {
                console.log("lp is empty!");
            } else {
                $(this).attr("href", "data/" + lp + "/" + href);
                console.log("data/" + lp + "/" + href);
            }
        }
    });
    //console.clear();
});
</script>
</div> <!-- /container -->
<?php include_once(__DIR__ ."/inc/footer.inc"); ?>

</body>
</html>