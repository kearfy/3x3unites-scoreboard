<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>3x3unites scoreboard</title>
        
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.css">
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/pages.css">
    </head>
    <body>
        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/navbar.php'); ?>
        
        <div class="notready">
            <?php echo file_get_contents(DYNAMIC_DIR . '/modules/scoreboard/static/basketball.svg'); ?>
            <p>
                &#9814; Helaas is de website nog niet afgerond, maar binnenkort wel &#9814;<br><br>
                Spelers kunnen zich alvast <a href="/signup">Registreren</a>.
            </p>
        </div>
        
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>