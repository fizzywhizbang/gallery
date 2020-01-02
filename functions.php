<?PHP
function thumbnailImage($imagePath) {
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->setbackgroundcolor('rgb(64, 64, 64)');
    $imagick->thumbnailImage(200, 200, true, true);
    $imageBlob = $imagick->getImageBlob();
    $imagick->clear();
    return base64_encode($imageBlob);
}
function iconImage($imagePath) {
    global $folderIconSize;
    //get first file from path and return as icon
    $imagePath = $imagePath . "/images/thumbnails/";
    $imagePath = getFirstFile($imagePath);
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->setbackgroundcolor('rgb(64, 64, 64)');
    $imagick->thumbnailImage($folderIconSize, $folderIconSize, true, true);
    $imageBlob = $imagick->getImageBlob();
    $imagick->clear();
    return base64_encode($imageBlob);
}

function getFirstFile($path){
    $files = scandir($path, 0);
    foreach($files as $file){
        if ($file != "." && $file != "..") {
            $pathAndFile = $path . "/" . $file;
            if(isImage($pathAndFile) == 1){
                return $pathAndFile;
            }
            
        }

    }
}

function isImage($filename){
    
    if(@is_array(getimagesize($filename))){
        return 1;
    } else {
        return 0;
    }
}
?>