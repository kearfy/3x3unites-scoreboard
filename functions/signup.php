<?php

    use Helper\Validate;
    use Helper\Request;
    use Helper\Header;
    use Library\Users;

    $postdata = Request::parsePost();
    $dataset = array('firstname', 'lastname', 'email', 'password');

    if (Request::method() == 'POST') {
        $postdata = (object) Validate::removeUnlisted($dataset, $postdata);
        $missing = Validate::listMissing($dataset, $postdata);
        if (count($missing) == 0) {
            $users = new Users;
            $res = $users->create($postdata);
            if ($res->success) {
                $users->metaSet($res->id, 'type', 'player');
                Header::Location(SITE_LOCATION . '/signup?success');
            } else {
                Header::Location(SITE_LOCATION . '/signup?error=' . $res->error . '&message=' . $res->message);
            }
        } else {
            Header::Location(SITE_LOCATION . '/signup?error=missing_information&missing=' . join('-', $missing));
        }

        die();
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

            <?php
                if (isset($_GET['error']) || isset($_GET['message'])) {
                    if (!isset($_GET['error'])) $_GET['error'] = 'error';
                    if (!isset($_GET['message'])) $_GET['message'] = 'An error occured';
                    echo '<p class="error-message">' . $_GET['message'] . ' (' . $_GET['error'] . ')</p>';
                }
            ?>

            <section class="input-fields">
                <input type="text" placeholder="Voornaam" name="firstname" required>
                <input type="text" placeholder="Achternaam" name="lastname" required>
                <input type="email" placeholder="E-mailadres" name="email" required>
                <input type="password" placeholder="Wachtwoord" name="password" required>
            </section>
            <section class="finish-signup">
                <button class="button">
                    Doorgaan
                </button>
            </section>
        </form>
    </body>
</html>