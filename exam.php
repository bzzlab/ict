<!DOCTYPE html>
<html lang="de">
<head>
    <title>LB-Beilage</title>
    <meta charset="UTF-8">
    <?php
    include_once(__DIR__ . "/inc/exam.inc");
    ?>
    <style type="text/css">
        /* students */
        .gotop {
            float: right;
            font-size: 14px;
        }
        div.flex-container{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: stretch;
        }
        div.flex-container > iframe.example {
            margin: 0px;
            padding: 0px;
        }
        /* test */
        div.box1, div.box2{
            width: 410px;
            float: left;
        }
        figure {
            margin: 0px;
        }
        div.box3 {
            width: 300px;
            float: left;
        }
        div.besideBoxes {
            display: block;
            vertical-align: center;
            margin-left: 10px;
            margin-right: 10px;
        }

        div.clear {
            clear: both;
        }
        pre {
            text-align: left;
            background: rgb(211,211,211);
        }

        code {
            border: 0px;
        }

        iframe {
            display: inline;
            overflow: hidden;
            border:none;
            width: 400px;
            margin: 0px;
        }

        .red {
            background-color: red;
        }
    </style>
</head>

<body>
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

<script id="tpl-web1" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3>
    <figure>
        <iframe class="example"  scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{file}}&browser={{browser}}">
            <p>Your browser does not support iframes.</p></iframe>
    </figure>
</script>

<script id="tpl-img1" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3><figure><img class="{{size}}" src="{{path}}/{{file}}"/></figure>
</script>


<script id="tpl-web2" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3>
    <!-- Lösungen  -->
    <div class="flex-container">
        <!-- Teil-Lösungen  -->
        <figure>
            <iframe class="example" style="{{style_code}};" scrolling="no" onload="resizeIframe(this)"
                    src="view_code2.php?file={{path}}/{{code}}&browser=no">
                <p>Your browser does not support iframes.</p></iframe>
        </figure>
        <figure><img style="{{style_img}};" src="data/lp02/{{path}}/{{image}}"/></figure>
    </div>
</script>

<script id="tpl-web3" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Ausgangslage</h3>
    <!-- Lösungen  -->
    <div class="flex-container">
        <!-- Teil-Lösungen  -->
        <figure>
            <iframe class="example" style="{{style_code1}};" scrolling="no" onload="resizeIframe(this)"
                    src="view_code2.php?file={{path}}/{{code1}}&browser=no">
                <p>Your browser does not support iframes.</p></iframe>
        </figure>
        <figure>
            <iframe class="example" style="{{style_code2}};" scrolling="no" onload="resizeIframe(this)"
                    src="view_code2.php?file={{path}}/{{code2}}&browser=no">
                <p>Your browser does not support iframes.</p></iframe>
        </figure>
        <figure><img style="{{style_img}};" src="data/lp02/{{path}}/{{image}}"/></figure>
    </div>
</script>

<script id="tpl-sol1" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Mögliche Lösungen</h3>
    <!-- Lösungen  -->
    <div class="flex-container">
        <!-- Teil-Lösungen  -->
        <iframe class="example" style="width:{{w1}};"
                scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{a1}}&browser=no&style=exam">
            <p>Your browser does not support iframes.</p>
        </iframe>
        <iframe class="example" style="width:{{w1}};"
                scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{a2}}&browser=no&style=exam">
            <p>Your browser does not support iframes.</p>
        </iframe>
        <iframe class="example" style="width:{{w1}};"
                scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{a3}}&browser=no&style=exam">
            <p>Your browser does not support iframes.</p>
        </iframe>
        <iframe class="example" style="width:{{w1}};"
                scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{a4}}&browser=no&style=exam">
            <p>Your browser does not support iframes.</p>
        </iframe>
    </div>
</script>

<script id="tpl-sol2" type="text/x-handlebars-template">
    <a class="gotop" href="#top">top</a>
    <a id="{{id}}"></a>
    <h3>{{id}} - Mögliche Lösungen</h3>
    <figure>
        <iframe class="example"  scrolling="no" onload="resizeIframe(this)"
                src="view_code2.php?file={{path}}/{{file}}&browser=no">
            <p>Your browser does not support iframes.</p></iframe>
    </figure>
</script>

<script id="tpl-test1" type="text/x-handlebars-template">
  <div class="clear"></div>
  <div class="besideBoxes">
    <div class="box1">
      <h4>Aufgabe - {{aufg}} -
          <a style="font-size:80%;" id="{{aufg}}_link" target="_link"
             href="load.php?file={{path}}/{{file}}">Browser</a>
          <button style="font-size:80%;" id="{{aufg}}_enlarge">enlarge</button>
      </h4>
      <iframe id="{{aufg}}_content" scrolling="no"
      onload="resizeIframe(this)" 
      src="load.php?file={{path}}/{{file}}">
      <p>Your browser does not support iframes.</p></iframe>
    </div>
   <div id="{{aufg}}_box2" class="box2">
      <h4>Vorgabe</h4>
      <figure>
        <img width="medium" src="data/lp02/{{path}}/{{image}}"/>
      </figure>
   </div>
    <!-- possible solutions -->
    <div id="{{aufg}}_box3" class="box3">
       <h4 class="{{aufg}}_selected">Lösungswahl</h4>
        <button id="{{aufg}}_01">{{l1}}</button>&nbsp;
        <button id="{{aufg}}_02">{{l2}}</button>&nbsp;
        <button id="{{aufg}}_03">{{l3}}</button>&nbsp;
        <button id="{{aufg}}_04">{{l4}}</button>&nbsp;
        <pre><code class="{{aufg}}_text"></code></pre>
      </div>
  </div>
</script>

<div class="container theme-showcase" role="main">
    <a name="top"></a>
    <div class="jumbotron">
        <h2></h2>
    </div>
    <div id="index-container"></div>
    <div id="code-container"></div>

    <?php
    if (isset($_GET["js"])) {
        printf("<script type=\"text/javascript\" src='%s'></script>", $_GET["js"]);
    }
    ?>
</div> <!-- /container -->



<?php include_once(__DIR__ . "/inc/footer.inc"); ?>

</body>
