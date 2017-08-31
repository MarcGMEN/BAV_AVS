<?php
function degrade($img,$direction,$color1,$color2)
{
        if($direction=='h')
        {
                $size = imagesx($img);
                $sizeinv = imagesy($img);
        }
        else
        {
                $size = imagesy($img);
                $sizeinv = imagesx($img);
        }
        $diffs = array(
                (($color2[0]-$color1[0])/$size),
                (($color2[1]-$color1[1])/$size),
                (($color2[2]-$color1[2])/$size)
        );
        for($i=0;$i<$size;$i++)
        {
                $r = $color1[0]+($diffs[0]*$i);
                $g = $color1[1]+($diffs[1]*$i);
                $b = $color1[2]+($diffs[2]*$i);
                if($direction=='h')
                {
                        imageline($img,$i,0,$i,$sizeinv,imagecolorallocate($img,$r,$g,$b));
                }
                else
                {
                        imageline($img,0,$i,$sizeinv,$i,imagecolorallocate($img,$r,$g,$b));
                }
        }
        return $img;
}

function html2rgb($color)
{
    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return array($r, $g, $b);
}

function creationImageFond($color, $fileImg) {
  $img = imagecreatetruecolor(10,950);
  $img = degrade($img,'v',html2rgb($color),array(255,255,255));
  imagepng($img,$fileImg, 9); 
}

function creationImageFondFromImage($image, $fileImg) {
  if (!copy("../userfiles/Images/Site/".$image,$fileImg)) {
    print_r(error_get_last());
  }
}


function creationImageEntete($color, $fileImg) {
  $img = imagecreatetruecolor(10,25);
  $img = degrade($img,'v',html2rgb($color),array(255,255,255));
  imagepng($img,$fileImg, 9); 
}

