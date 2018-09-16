function resizeIframe(iframe) {
    var delta = 0;
    if (navigator.userAgent.match("Chrome")) {
        delta = 26; //Korrektur bei Chrome-Browser
    }
    iframe.height = (iframe.contentWindow.document.body.scrollHeight+delta) + "px";
    iframe.width= (iframe.contentWindow.document.body.scrollWidth+delta) + "px";
}

function resizeIframeWidth(iframe,width) {
    var delta = 0;
    if (navigator.userAgent.match("Chrome")) {
        delta = 26; //Korrektur bei Chrome-Browser
    }
    iframe.height = (iframe.contentWindow.document.body.scrollHeight+delta) + "px";

    if (width != null) {
    	iframe.width = width + "px";
    }
    console.log("iframe.height:" + iframe.height);
    //console.log("iframe.width:" + iframe.width);
}

