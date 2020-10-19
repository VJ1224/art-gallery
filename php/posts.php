<?php
$dir = '../blog';

if (is_dir($dir)) {
    $posts = array_values(array_diff(scandir($dir), array('.', '..')));

    echo "<ul class='list-group'>";
    
    foreach ($posts as $post) {
        echo "<a href='#' class='list-group-item list-group-item-action'>" . 
        substr($post, 0, (strrpos($post, "."))) . "</a>";
    }

    echo "</ul>";
}
?>