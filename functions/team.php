<?php
    use Helper\Header;
    use Library\Controller;
    use Library\Users;
    use Library\Objects;

    if (isset($params[0])) {
        $team = $params[0];
    } else {    
        $controller = new Controller;
        $userModel = $controller->__model('user');
        $user = $userModel->info();

        if ($user) {
            $team = 'team-' . $user->id;
        } else {
            Header::Location(SITE_LOCATION);
            die();
        }
    }

    $objectManager = new Objects;
    if (!$objectManager->exists('scoreboard-team', $team)) $registeredTeam = "!0!";
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Team bekijken - 3x3unites scoreboard</title>
        
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
                <h1 :if="players.length > 0">
                    Team bekijken
                </h1>
                <h1 :else>
                    Team niet gevonden
                </h1>
            </section>
            <div class="profile-details">
                <div class="full-width team-table" :if="players.length > 0">
                    <h3>
                        Spelerlijst
                    </h3>

                    <table>
                        <thead>
                            <th>Naam</th>
                            <th>Lengte</th>
                            <th>Leeftijd</th>
                        </thead>
                        <tbody>
                            <tr class="player" :for="players as index => player">
                                <td>{{player.name}}</td>
                                <td>{{player.height}}</td>
                                <td>{{player.age}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/help-button.php'); ?>

        <script>
            const payload = {
                team: '<?=$team?>'
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/team.js" type="module"></script>
    </body>
</html>