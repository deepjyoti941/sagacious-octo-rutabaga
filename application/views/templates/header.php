<head>
  <meta http-equiv="content-type" content="text/html, charset=utf-8">
  <title><?php echo $pageTitle; ?></title>

  <?php
    $link_bootstrap = array(
     'href' => "resources/stylesheet/bootstrap/cosmo.min.css",
     'rel' => "stylesheet",
     'type' => "text/css"
    );
    $link_style = array(
     'href' => "resources/stylesheet/custom/style.css",
     'rel' => "stylesheet",
     'type' => "text/css"
    );

    $link_font_awesome = array(
     'href' => "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css",
     'rel' => "stylesheet",
     'type' => "text/css"
    );

    echo link_tag($link_bootstrap);
    echo link_tag($link_font_awesome);
    echo link_tag($link_style);
  ?>
</head>
