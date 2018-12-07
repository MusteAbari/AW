<?php
    require 'functions/functions.php';
    if (isset($_GET['page'])) {
        require 'pages/' .$_GET['page'].	'.php';
    }
    else {
        require 'pages/about.php';
    }

    $templateVars = [
        'title' => $title,
        'content' => $content
    ];
    $layoutHTML = loadTemplate('templates/layout.php', $templateVars);
    echo $layoutHTML;
?>