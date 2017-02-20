<!DOCTYPE html>
<html>
<head>
    <title>Generate ss qrcode image</title>
    <meta charset="utf-8">
    <style>
        :root{
            --qrSquare: 300px;
        }
        section{
            padding: 15px;
        }
        #qrcodeImg{
            width: var(--qrSquare);
            height: var(--qrSquare);
            margin: 0 auto;
            transition: transform .3s;
        }
        .rotate{
            transform: rotateZ(360deg);
        }
    </style>
</head>
<body>
<?php
    $url = "https://dream.ren/ss.html";
    copy($url, "./ss.html");
?>
    <div id="hdn" style="display: none;"></div>
    <section>
        <div id="qrcodeImg"></div>
    </section>

    <script src="qrcode.min.js"></script>
    <script>
        var xhr = new XMLHttpRequest();
        (function sendAJAX() {
            xhr.onload = function() {
                if (xhr.status === 200) {
                    hdn.innerHTML = xhr.responseText;
                    var content = hdn.querySelector("#sstextarea").innerHTML;
                    hdn.innerHTML = "";
                    var a = content.split("\n");
                    genQrcode(a[0]);
                } else {
                    genQrcode("Hello there!");
                }
                release();
            };
            xhr.open("GET", "./ss.html", true);
            xhr.send(null);
        })();

        var qrcodeImg = document.querySelector('#qrcodeImg');
        var qrcode = new QRCode(qrcodeImg, {
            width: 300,
            height: 300
        });
        function genQrcode(text){
            qrcode.makeCode(text);
            qrcodeImg.classList.toggle('rotate');
        }
        // 释放资源
        function release() {
            xhr.onload = null; // 防止重复执行回调函数
            xhr.open("GET", "res.php", true);
            xhr.send(null);
        }
    </script>
</body>
</html>
