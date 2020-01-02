<?PHP
function thumbnailImage($imagePath) {
    $imagick = new \Imagick(realpath($imagePath));
    $imagick->setbackgroundcolor('rgb(64, 64, 64)');
    $imagick->thumbnailImage(200, 200, true, true);
    $imageBlob = $imagick->getImageBlob();
    $imagick->clear();
    return base64_encode($imageBlob);
}
?>