<?php
    $controller = new Library\Controller;
    $user = $controller->__model('user');
    if ($user->signedin()) {
        Helper\Header::Location(SITE_LOCATION . 'profile');
        die();
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inloggen - 3x3unites scoreboard</title>
        
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.css">
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/forms.css">
    </head>
    <body>
        <form class="unload portal" action="<?php echo SITE_LOCATION; ?>/pb-loader/module/scoreboard/signin" method="post">
            <div class="page-back">
                <i data-feather="arrow-left"></i>
            </div>

            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <section class="title">
                <h1>
                    Inloggen
                </h1>
            </section>

            <p class="error"></p>

            <section class="input-fields">
                <input type="email" placeholder="E-mailadres" name="identifier" required>
                <input type="password" placeholder="Wachtwoord" name="password" required>
            </section>
            <section class="finish-signup">
                <button class="button">
                    Doorgaan
                </button>
            </section>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

        <script>
            const SITE_LOCATION = '<?php echo SITE_LOCATION; ?>';
            const PB_API = axios.create({
                baseURL: SITE_LOCATION + 'pb-api/'
            });
        </script>  

        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-pubfiles/js/pb-pages-auth-signin.js"></script>
    </body>
</html>