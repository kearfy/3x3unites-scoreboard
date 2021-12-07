<?php

    use Helper\Request;

    if (Request::method() == 'POST') {
        echo 'no';
    }

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account aanmaken - 3x3unites scoreboard</title>
        
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.css">
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/signup.css">
    </head>
    <body>
        <form action="<?php echo SITE_LOCATION; ?>/pb-loader/module/scoreboard/signup" method="post">
            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <section class="title">
                <h1>
                    Account aanmaken
                </h1>
            </section>
            <section class="input-fields">
                <input type="text" placeholder="Voornaam" name="firstname">
                <input type="text" placeholder="Achternaam" name="lastname">
                <input type="email" placeholder="E-mailadres" name="email">
                <input type="password" placeholder="Wachtwoord" name="password">
            </section>
            <section class="finish-signup">
                <div class="button">
                    Doorgaan
                </div>
            </section>
        </form>
    </body>
</html>