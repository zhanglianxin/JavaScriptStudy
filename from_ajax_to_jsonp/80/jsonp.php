<?php
// echo 'console.log("--- Hello AJAX! ---")';
// echo json_encode(array("hello"=>"--- Hello AJAX! ---"));
echo 'cbk({"hello":"--- Hello JSONP! ' . ((int) time() + rand(0, 2)) . ' ---"})';
?>
