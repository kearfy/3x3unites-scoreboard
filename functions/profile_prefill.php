<?php
    use Helper\Request;
    use Helper\Validate;
    use Helper\Header;
    use Library\Controller;
    use Library\Users;

    $controller = new Controller;
    $userModel = $controller->__model('user');
    $user = $userModel->info();
    if (!$user) {
        Header::Location(SITE_LOCATION . 'signup');
        die();
    }

    foreach($user->meta as $metaitem) {
        if ($metaitem['name'] == 'profile-filled' && $metaitem['value'] == '1') {
            Header::Location(SITE_LOCATION . 'profile');
            die();
        }
    }

    $postdata = Request::parsePost();
    $dataset = array('gender', 'age', 'height', 'club', 'team');
    $allowed = array('gender', 'age', 'height', 'club', 'team', 'competition', 'notes');

    if (Request::method() == 'POST') {
        $postdata = (object) Validate::removeUnlisted($allowed, $postdata);
        $missing = Validate::listMissing($dataset, $postdata);
        if (count($missing) == 0) {
            $users = new Users;
            $users->metaSet($user->id, 'gender', $postdata->gender);
            $users->metaSet($user->id, 'age', $postdata->age);
            $users->metaSet($user->id, 'height', $postdata->height);
            if (isset($postdata->club)) $users->metaSet($user->id, 'club', $postdata->club);
            if (isset($postdata->team)) $users->metaSet($user->id, 'team', $postdata->team);
            if (isset($postdata->competition)) $users->metaSet($user->id, 'competition', $postdata->competition);
            if (isset($postdata->notes)) $users->metaSet($user->id, 'notes', $postdata->notes);
            $users->metaSet($user->id, 'profile-filled', '1');
            Header::Location(SITE_LOCATION);
        } else {
            Header::Location(SITE_LOCATION . 'signup/profile-prefill?error=missing_information&missing=' . join('-', $missing));
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
        <title>Gegevens aanvullen - 3x3unites scoreboard</title>
        
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.css">
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/forms.css">
    </head>
    <body>
        <form class="unload" action="<?php echo SITE_LOCATION; ?>signup/profile-prefill" method="post">
            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <section class="title">
                <h1>
                    Gegevens aanvullen
                </h1>
            </section>
            <section class="note">
                <p>
                    Velden gemarkeerd met een <b>*</b> zijn verplicht.
                </p>
            </section>
            <section class="input-fields">
                <div class="gender-selection">
                    <h3>
                        Geslacht
                    </h3>
                    <div class="radio-gender">
                        <input type="radio" name="gender" id="male" value="male" checked>
                        <label for="male">Man</label>
                    </div>
                    <div class="radio-gender">
                        <input type="radio" name="gender" id="female" value="female">
                        <label for="female">Vrouw</label>
                    </div>
                    <div class="radio-gender">
                        <input type="radio" name="gender" id="other" value="other">
                        <label for="other">Anders</label>
                    </div>
                </div>
                
                <input type="number" placeholder="Leeftijd *" name="age" min="12" max="99" required>
                <input type="number" placeholder="Lengte (cm) *" name="height" min="100" max="300" required>
            </section>
            <section class="note">
                <p>
                    Onderstaande velden enkel invullen indien van toepassing.
                </p>
            </section>
            <section class="input-fields">
                <input type="text" placeholder="Vereniging" name="club">
                <input type="text" placeholder="Team (u18-1)" name="team">
                <input type="text" placeholder="Competitie" name="competition">
                <textarea name="notes" id="notes" cols="30" rows="6" placeholder="Wil je nog een opmerking kwijt?"></textarea>
            </section>
            <section class="finish-signup">
                <button class="button">
                    Opslaan
                </button>
            </section>
        </form>
        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/footer.php'); ?>

        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/help-button.php'); ?>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>