<pre>
<?php

$filename="https://bourseaux1000velos.avs44.com/html/Bav.jpg";
print_r(getimagesize($filename));
print_r(fopen($filename,"rb"));
?>
</pre>
