<?php
$varImg = base64_decode($_GET["q"]);

header("Content-type:  image/jpeg");
print $varImg;