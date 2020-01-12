<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css"/>
<?PHP 
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("settings.php");
include("functions.php");
?>
<!-- need to add tooltips and popper for jquery/bootstrap -->
<link rel="stylesheet" href="css/style.css">
<meta property="og:url" content="<?PHP echo $ogurl;?>" />
<meta property="og:type" content="<?PHP echo $ogtype;?>" />
<meta property="og:title" content="<?PHP echo $ogtitle;?>" />
<meta property="og:description" content="<?PHP echo $ogdescription;?>" />
<meta property="og:image" content="<?PHP echo ogimage($ogimage);?>">
<title><?PHP echo $title;?></title>
<style>
    .modal-dialog {
  position: relative;
  display: table;
  overflow: auto;
  width: auto;
  min-width: 300px;
}
.modal-body { /* Restrict Modal width to 90% */
  overflow-x: auto !important;
  max-width: auto !important;
}
</style>
</head>
<body>
    <?PHP
    function isEmptyDir($dir){ 
        return (($files = @scandir($dir)) && count($files) <= 2); 
    }
    ?>
<div class="card">
    <div class="card-header text-center" style="cursor:pointer" onclick="window.location='index.php'">
       <h1><?PHP echo $header;?></h1>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col small scrollable-menu">
                     <button type="button" class="list-group-item list-group-item-action" onclick="window.location='index.php'"><i class="fa fa-home text-green" style="font-size:30px"></i> Home</button>
                    <?PHP
                    //folder reader needs to be recursive
                    
                    //$dh = opendir($dir);
                    $files = scandir($dir, 0);
                    //rsort($files);
                    foreach($files as $file){
                        
                        if ($file != "." && $file != ".." && is_dir($dir . "/" . $file)) {
                            //check directory for empty
                            $newdir = $dir . "/" . $file;
                            $emptyval = isEmptyDir($newdir);
                            
                          
                                    $target=str_replace(" ", "-", $file);
                                    $iconImg = iconImage($newdir);
                                    echo "<button type=\"button\" class=\"list-group-item list-group-item-action\" value=\"$file\" data-toggle=\"collapse\" data-target=\"#f".$target."\" aria-expanded=\"false\" aria-controls=\"".$target."\">";
                                    if($folderIcon == 1){
                                        echo "<img src=\"data:image/jpeg;base64, $iconImg\"> ";       
                                    } else {
                                        echo "<i class=\"fa fa-folder text-gold\" ></i> ";
                                    }
                                    
                                    
                                    echo "$file</button>\n";
                                    echo "<div class='list-group small collapse margin-10' id=\"f".$target."\">";
                
                                    echo "</div>";
                        }
                
                    }
                    //closedir($dh);
                    ?>
 
                </div>
                <div id="viewer" class="col-9">
                       <?PHP include("welcome.php");?>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card-footer text-muted">
        Marc Levine Photograpy Credit to: <a href="https://github.com/fancyapps/fancybox">fancybox3</a> for the super simple lightbox
    </div>
</div>
<?PHP




?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(e) {
    e.preventDefault();
        $.get("folderreader.php",
        {
            dir: $(this).val()
        }
        ,
         function(data){
             //write the data to where some place
             document.getElementById("viewer").innerHTML=data;
            //alert("Data: " + data);
        });

    });
});

</script>

<script>
function loadContent(target, val){
    document.getElementById(target).src=val;
}



function fbshare(url,title){
    alert("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(url)+"&t="+title);
    //window.open("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(url)+"&t="+title, '', 'menubar=yes,toolbar=yes,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
}


</script>

</body>
</html>