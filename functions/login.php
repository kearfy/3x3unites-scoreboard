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
        <form class="unload" action="<?php echo SITE_LOCATION; ?>/pb-loader/module/scoreboard/signin" method="post">
            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <section class="title">
                <h1>
                    Inloggen
                </h1>
            </section>

            <?php
                if (isset($_GET['error']) || isset($_GET['message'])) {
                    if (!isset($_GET['error'])) $_GET['error'] = 'error';
                    if (!isset($_GET['message'])) $_GET['message'] = 'An error occured';
                    echo '<p class="error-message">' . $_GET['message'] . ' (' . $_GET['error'] . ')</p>';
                }
            ?>

            <section class="input-fields">
                <input type="email" placeholder="E-mailadres" name="email" required>
                <input type="password" placeholder="Wachtwoord" name="password" required>
            </section>
            <section class="finish-signup">
                <button class="button">
                    Log in
                </button>
            </section>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                setTimeout(() => {
                    document.querySelector("form.unload").classList.remove('unload');
                }, 800);
            });
        </script>
    </body>
</html>