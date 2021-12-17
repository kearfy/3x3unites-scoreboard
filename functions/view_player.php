<?php
    use Helper\Header;
    use Library\Controller;
    use Library\Users;

    if (isset($params[0])) {
        $users = new Users;
        $user = $users->info($params[0]);
        if (!$user) {
            $title = "Onbekende speler";
        }
    } else {
        $controller = new Controller;
        $userModel = $controller->__model('user');
        $user = $userModel->info();
        if (!$user) {
            $title = "Onbekende speler";
        } else {
            Header::Location(SITE_LOCATION . 'player/' . $user->id);
            die();
        }
    }
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profiel - 3x3unites scoreboard</title>
        
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.css">
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/forms.css">
    </head>
    <body>
        <form class="unload" action="<?php echo SITE_LOCATION; ?>">
            <div class="page-back">
                <i data-feather="arrow-left"></i>
            </div>

            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <div class="page-back">
                <i data-feather="arrow-left"></i>
            </div>
            <section class="title">
                <h1>
                    <?php echo ($user ? $user->fullname : ($title ? $title : "Er is een fout opgetreden")); ?>
                </h1>
            </section>
            <?php
                if ($user) {
            ?>
                <div class="profile-details">
                    <div>
                        <h3>Leeftijd</h3>
                        <p>
                            <?php 
                                $age = $users->metaGet($user->id, 'age');
                                if (!$age) $age = 'Onbekend';
                                echo $age;
                            ?>
                        </p>
                    </div>
                    <div>
                        <h3>Lengte</h3>
                        <p>
                            <?php 
                                $height = $users->metaGet($user->id, 'height');
                                if (!$height) $height = 'Onbekend';
                                echo $height;
                            ?>
                        </p>
                    </div>
                    <div>
                        <h3>Geslacht</h3>
                        <p>
                            <?php 
                                switch($users->metaGet($user->id, 'gender')) {
                                    case 'male':
                                        echo 'Man';
                                        break;
                                    case 'female':
                                        echo 'Vrouw';
                                        break;
                                    case 'other':
                                        echo 'Anders';
                                        break;
                                    default:
                                        echo 'Onbekend';
                                        break;
                                }
                            ?>
                        </p>
                    </div>
                    <div>
                        <h3>Club</h3>
                        <p>
                            <?php 
                                $club = $users->metaGet($user->id, 'club');
                                if (!$club) $club = 'Onbekend';
                                echo $club;
                            ?>
                        </p>
                    </div>
                    <div>
                        <h3>Team</h3>
                        <p>
                            <?php 
                                $team = $users->metaGet($user->id, 'team');
                                if (!$team) $team = 'Onbekend';
                                echo $team;
                            ?>
                        </p>
                    </div>
                    <div>
                        <h3>Competitie</h3>
                        <p>
                            <?php 
                                $competition = $users->metaGet($user->id, 'competition');
                                if (!$competition) $competition = 'Onbekend';
                                echo $competition;
                            ?>
                        </p>
                    </div>
                    <div>
                        <h3>Tournament 1</h3>
                        <p>
                            <?php 
                                $tournament1 = $users->metaGet($user->id, 'tournament1');
                                if ($tournament1 == '0') $tournament1 = 'Niet ingeschreven';
                                if ($tournament1 == '1') $tournament1 = 'Ingeschreven';
                                if (!$tournament1) $tournament1 = 'Onbekend';
                                echo $tournament1;
                            ?>
                        </p>
                    </div>
                    <div>
                        <h3>Tournament 2</h3>
                        <p>
                            <?php 
                                $tournament2 = $users->metaGet($user->id, 'tournament2');
                                if ($tournament2 == '0') $tournament2 = 'Niet ingeschreven';
                                if ($tournament2 == '1') $tournament2 = 'Ingeschreven';
                                if (!$tournament2) $tournament2 = 'Onbekend';
                                echo $tournament2;
                            ?>
                        </p>
                    </div>
                </div>
            <?php
                }
            ?>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>