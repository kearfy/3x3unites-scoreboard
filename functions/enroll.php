<?php
    use Helper\Request;
    use Helper\Validate;
    use Helper\Header;
    use Library\ModuleConfig;
    use Library\Controller;
    use Library\Users;

    $controller = new Controller;
    $userModel = $controller->__model('user');
    $user = $userModel->info();
    if (!$user) {
        Header::Location(SITE_LOCATION . 'signup');
        die();
    }
    
    $postdata = Request::parsePost();
    $dataset = array('tournament1', 'tournament2');
    $config = new ModuleConfig('scoreboard');

    if ($config->get('enrollment-disabled') == '0') {
        if (Request::method() == 'POST') {
            $postdata = (object) Validate::removeUnlisted($dataset, $postdata);
            $users = new Users;

            if (isset($postdata->tournament1)) $users->metaSet($user->id, 'tournament1', ($postdata->tournament1 == 'on' ? 1 : 0));
            if (isset($postdata->tournament2)) $users->metaSet($user->id, 'tournament2', ($postdata->tournament2 == 'on' ? 1 : 0));
    
            Header::Location(SITE_LOCATION);
            die();
        }

                // ======== ENROLLMENT IS ENABLED ======== \\
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
        <form class="unload" action="<?php echo SITE_LOCATION; ?>/enroll" method="post">
            <div class="page-back">
                <i data-feather="arrow-left"></i>
            </div>
            
            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <section class="tournament-details input-fields">
                <div>
                    <h3>
                        2 JAN 2022
                    </h3>
                    <div class="times">
                        <p>11:00</p> 
                        <span class="line"></span> 
                        <p>16:00</p>
                    </div>
                </div>
                <div>
                    <h3>
                        Sportcomplex Koning Willem-Alexander
                    </h3>
                    <p>
                        Hoofddorp
                    </p>
                </div>
                <div class="two-blocks">
                    <div>
                        <h3>
                            Tournament #1
                        </h3>
                        <div class="times">
                            <p>11:00</p> 
                            <span class="line"></span> 
                            <p>13:00</p>
                        </div>
                        <p>
                            Inschrijving als individu, mixed teams 12+
                        </p>
                        <div class="checkbox">
                            <input type="hidden" name="tournament1" value="off">
                            <input type="checkbox" id="tournament1" name="tournament1">
                            <label for="tournament1" class="checkmark"></label>
                            <label for="tournament1"> Ik doe mee</label><br>
                        </div>
                    </div>
                    <div>
                        <h3>
                            Tournament #2
                        </h3>
                        <div class="times">
                            <p>13:30</p> 
                            <span class="line"></span> 
                            <p>16:00</p>
                        </div>
                        <p>
                            Inschrijving als team 16+ <br>
                            Individuele inschrijving ook mogelijk
                        </p>
                        <div class="checkbox">
                            <input type="hidden" name="tournament2" value="off">
                            <input type="checkbox" id="tournament2" name="tournament2">
                            <label for="tournament2" class="checkmark"></label>
                            <label for="tournament2"> Ik doe mee</label><br>
                        </div>
                    </div>
                </div>
            </section>
            <section class="note">
                <p>
                    Team registratie wordt binnenkort geopent.
                </p>
            </section>
            <section class="finish-signup">
                <button class="button">
                    Opslaan
                </button>
            </section>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>

<?php
    } else {        // ======== ENROLLMENT IS DISABLED ======== \\
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account aanmaken - 3x3unites scoreboard</title>
        
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.css">
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/forms.css">
    </head>
    <body>
        <form class="unload">
            <div class="page-back">
                <i data-feather="arrow-left"></i>
            </div>

            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <section class="title">
                <h1>
                    Wordt binnenkort geopend
                </h1>
            </section>

            <p>
                Inschrijven zal uiterlijk 20 december worden geopend.
            </p>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>

<?php
    }
?>