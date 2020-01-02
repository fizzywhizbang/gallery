<?PHP
error_reporting(E_ALL);
ini_set("display_errors", 1);
include("functions.php");
$concat=$_GET["dir"];
$dir="uploaded-content/" . $concat;

$dh = opendir($dir);

function readIndex($fd){
    $file = $fd . "/index.html";
 
    $fh = fopen($file, "r");
    $txt = fread($fh, filesize($file));
    fclose($fh);

    //get json image list
    $location = strpos($txt, "LR.images");
    $diff = strlen($txt) - $location;
    $json = substr($txt, $location, $diff);
    $json = str_replace("LR.images = ", "", $json);
    $location = strpos($json, "]");
    $json = substr($json, 0, $location);
    $len = strlen(trim($json));
    $json = substr($json, 0, $len - 1);
    $json = $json . "]";
    //print($json);
    $jsonArray = json_decode($json, true);
    //print_r($jsonArray);
    return $jsonArray;
}
/*
id=>1441254
largeWidth=>803
largeHeight=>1200
exportFilename=>DSC_2588
title=>2nd Annual SAPR 5k
caption=>2nd Annual USCG Sexual Assualt Prevention and Response 5k
id=>1441255
largeWidth=>1200
largeHeight=>803
exportFilename=>DSC_2589
title=>2nd Annual SAPR 5k
caption=>2nd Annual USCG Sexual Assualt Prevention and Response 5k
*/
?>


<div class="row">
 
<?PHP
$jsonArray = readIndex($dir);
$jsonArraySize = count($jsonArray);
for($i=0; $i<$jsonArraySize; $i++){
        ?>
        <div class="col-sm-1-12">
                <div class="card">
                
                    <?PHP 
                    
                        $location = "https://www.m-levine.com/index.php?lib=" . $concat;
                        
                        $value=$jsonArray[$i]["exportFilename"];
                            $file = $dir . "/" . $value . ".jpg";
                            $pathAndFile = $dir . "/" . "images/large/" .  $value . ".jpg";
                            $thumbpathAndFile = $dir . "/" . "images/thumbnails/" .  $value . ".jpg";
                            $thumb = thumbnailImage($thumbpathAndFile);
                            
                            ?>
                            <a data-fancybox="gallery" href="<?PHP echo $pathAndFile;?>" data-caption="<?PHP echo $jsonArray[$i]["caption"];?>">
                            <img src="data:image/jpeg;base64,<?PHP echo $thumb;?>">
                            </a>
                                        <!--Footer-->
                           
                            <div class="card-footer small">
                                    <?PHP echo $value . " " . $jsonArray[$i]["largeHeight"] . "x" . $jsonArray[$i]["largeWidth"];?>
                            </div>
                            <?PHP
                        
                        ?>
                
                </div>
            </div>
        <?PHP
}
?>

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

        <video style="width: auto; height: auto;" controls id="video"><source type="video/mp4"></video>

     
    </div>
  </div>
</div>

<div class="modal fade wrapper" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="imagemodal" aria-hidden="true" >
    <div class="modal-dialog modal-xl" style="width:auto; height:auto;">
                    <!--header-->
        <div class="modal-footer justify-content-center bg-white">
            
            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

        </div>
        <div class="modal-content" >
            
            <img id="img">
        
        
        </div>

    </div>
</div>
