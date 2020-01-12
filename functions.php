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

function ogimage($image){
    global $dir;
    if($image=="random"){
        if($_SERVER["HTTPS"]=="on"){
            $http="https://";
        } else {
            $http="http://";
        }
        return $http . $_SERVER["SERVER_NAME"] . "/" . randomImage($dir);
    } else {
        return $image;
    }
}

function randomImage($dir){
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

    $files = array(); 
    foreach ($rii as $file)
        if (!$file->isDir())
            if(isImage($file->getPathname()) == 1){
                $files[] = $file->getPathname();
            }
    
            
    $randomNumber = rand(0,count($files));
    return $files[$randomNumber];
    
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