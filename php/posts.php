<?php
$dir = '../blog';

if (is_dir($dir)) {
    $posts = array_values(array_diff(scandir($dir), array('.', '..')));
    
    usort($posts, function($a, $b) {
        return filemtime('../blog/' . $a) < filemtime('../blog/' . $b);
    });

    echo "<ul class='list-group'>";
    
    foreach ($posts as $post) {
        $title = substr($post, 0, (strrpos($post, ".")));
        $content = file_get_contents('../blog/' . $post);
        $summary = substr($content, strpos($content, "<p>"), strpos($content, "</p>")+4);
        $date = date("d F Y", filemtime('../blog/' . $post));

        echo "<a href='#' class='list-group-item list-group-item-action' onclick='loadPost(this)'>
        <div class='d-flex w-100 justify-content-between'>
        <h5 class='mb-1'>" . $title . "</h5>
        <small>" . $date ."</small>
        </div>
        <p class='mb-1'>" . $summary . "...</p>
        </a>";
    }

    echo "</ul>";
}
?>