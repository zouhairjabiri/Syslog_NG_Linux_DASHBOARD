<?php

class renderHTML {

    public $title = "Venyu Syslog Server";
    public $svs = array("Home" => "https://syslog.venyu.com"); 
    public $servicename = NULL;

    public function head ($title) {
        $this->title = $title;
        echo '<!DOCTYPE html>' . "\n";
        echo '<html>' . "\n";
        echo "<title>$this->title</title>" . "\n";
        echo '<meta charset="UTF-8">' . "\n";
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
        echo '<link rel="stylesheet" href="css/w3.css">' . "\n";
        echo '<link rel="stylesheet" href="css/w3-theme-black.css">' . "\n";
        echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">' . "\n";
        echo '<body>' . "\n";
        echo '<div style="height:100%">' . "\n";
        echo '<!-- Header -->' . "\n";
        echo '<header class="w3-top" id="myHeader">' . "\n";
        echo '<div class="w3-center w3-theme" style="height:80px">' . "\n";
        echo '<img src="images/venyu-blkbg.png">' . "\n";
        echo '</div>' . "\n";
        echo '<div class="w3-cell-row w3-card w3-white" style="height:40px">' . "\n";
        echo '<div class="w3-cell w3-panel w3-cell-middle w3-xlarge w3-left-align" style="width:33%"><i id="openNav" onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button"></i></div>' . "\n";
        echo '<div class="w3-cell w3-panel w3-cell-middle w3-xlarge w3-center" style="width:33%">Syslog</div>' . "\n";
        echo '<div class="w3-cell w3-panel w3-cell-middle w3-right-align w3-small" style="width:33%">Logged in as <b>' . $_SESSION['username'] . ' </b>(<a href="logout.php" class="w3-text-blue">Logout</a>)</div>' . "\n";
        echo '</div>' . "\n";
        echo '</header>' . "\n";
    }
  
    public function services ($svs) {
        $this->svs = $svs;
        echo '<!-- Side Navigation -->' . "\n";
        echo '<nav class="w3-sidebar w3-card w3-animate-left" style="display:none" id="mySidebar">' . "\n";
        echo '<div class="w3-bar-block">' . "\n";
        echo '<h1 class="w3-bar-block w3-center w3-xlarge w3-text-theme">Links</h1>' . "\n";
        echo '<hr>' . "\n";
        foreach ($this->svs as $name => $url) {
            echo "<a href=\"$url\" class=\"w3-bar-item w3-button w3-small\">$name</a>\n";
        }
        echo '</div>' . "\n";
    }

    public function navfooter() {
	echo '<div class="w3-bar-block">' . "\n";
        echo '<button class="w3-bar-item w3-button" onclick="w3_close()">Close <i class="fa fa-remove"></i></button>' . "\n";
        echo '</div>' . "\n";
	echo '</nav>' . "\n";
    }

    public function contentstart() {
	echo '<!-- Content -->' . "\n";
	echo '<div id="main" class="w3-main" style="margin-top:122px">' . "\n";
    }

    public function contentclose() {
	echo '</div>' . "\n";
        echo '<!-- Script for Sidebar -->' . "\n";
        echo '<script>' . "\n";
        echo '// Side navigation' . "\n";
        echo 'function w3_open() {' . "\n";
        echo 'document.getElementById("main").style.marginLeft = "20%";' . "\n";
        echo 'document.getElementById("mySidebar").style.width = "20%";' . "\n";
        echo 'document.getElementById("mySidebar").style.display = "block";' . "\n";
        echo 'document.getElementById("openNav").style.display = \'none\';' . "\n";
        echo '}' . "\n";
        echo 'function w3_close() {' . "\n";
        echo 'document.getElementById("main").style.marginLeft = "0%";' . "\n";
        echo 'document.getElementById("mySidebar").style.display = "none";' . "\n";
        echo 'document.getElementById("openNav").style.display = "inline-block";' . "\n";
        echo '}' . "\n";
        echo '</script>' . "\n";
        echo '</body>' . "\n";
        echo '</html>' . "\n";
    }
}
