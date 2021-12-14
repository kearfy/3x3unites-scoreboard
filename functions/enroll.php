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
        <title>Inschrijven - 3x3unites scoreboard</title>
        
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.css">
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/forms.css">
    </head>
    <body>
        <form class="unload" action="<?php echo SITE_LOCATION; ?>/pb-loader/module/scoreboard/signup" method="post">
            <div class="page-back">
                <i data-feather="arrow-left"></i>
            </div>
            
            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <section class="title">
                <h1>
                    Inschrijven
                </h1>
            </section>
            <section class="input-fields">
                <!-- The check boxes -->
                <div class="checkboxes">
                    <div class="checkbox">
                        <input type="checkbox" id="tournament1" name="tournament1">
                        <label for="tournament1" class="checkmark"></label>
                        <label for="tournament1"> Ik doe mee met tournament 1</label><br>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" id="tournament2" name="tournament2">
                        <label for="tournament2" class="checkmark"></label>
                        <label for="tournament2"> Ik doe mee met tournament 2</label><br>
                    </div>
                </div>

                    
            </section>
            <section class="finish-signup">
                <button class="button">
                    Inschrijven
                </button>
            </section>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>