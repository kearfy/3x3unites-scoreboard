<?php

    use Helper\Request;

    function start_function($params) {
        if (Request::method() == 'POST') {
            echo 'no';
        }
    }

?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gegevens aanvullen - 3x3unites scoreboard</title>
        
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
                    Gegevens aanvullen
                </h1>
            </section>
            <section class="input-fields">
                <div class="radio-gender">
                    <input type="radio" name="gender" id="male" value="male" checked>
                    <label for="male">Male</label>
                </div>
                <div class="radio-gender">
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female">Female</label>
                </div>
                
                <input type="text" placeholder="Lengte (cm)" name="height">
                <input type="text" placeholder="Vereneging" name="club">
                <input type="text" placeholder="Team (u18-1)" name="team">
                <input type="text" placeholder="competitie" name="competition">
            </section>
            <section class="finish-signup">
                <div class="button">
                    Opslaan
                </div>
            </section>
        </form>
    </body>
</html>