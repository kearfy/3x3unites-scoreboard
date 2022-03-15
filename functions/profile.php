<?php
    use Helper\Header;
    use Library\Controller;
    use Library\Users;
    use Library\Objects;

    $controller = new Controller;
    $userModel = $controller->__model('user');
    $user = $userModel->info();
    $users = new Users;
    $self = true;

    if (!$user) {
        Header::Location(SITE_LOCATION . 'signin');
        die();
    } else {
        if (isset($params[0])) {
            if ($userModel->check('user.view.other')) {
                $users = new Users;
                $user = $users->info($params[0]);
                $self = false;
            } else {
                Header::Location(SITE_LOCATION . 'profile');
                die();
            }
        }
    }

    $registeredTeam = 'team-' . $user->id;
    $objectManager = new Objects;
    if (!$objectManager->exists('scoreboard-team', $registeredTeam)) $registeredTeam = "!0!";
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
                    Profiel bekijken
                </h1>
            </section>
            <div class="profile-details">
                <div>
                    <h3>Naam</h3>
                    <p>
                        <?php echo $user->fullname; ?>
                    </p>
                </div>
                <div>
                    <h3>E-mail</h3>
                    <p>
                        <?php echo $user->email; ?>
                    </p>
                </div>
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
                            if (!$tournament1) $tournament1 = ($self ? '<a href="' . SITE_LOCATION . 'enroll">Inschrijven</a>' : 'Onbekend');
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
                            if (!$tournament2) $tournament2 = ($self ? '<a href="' . SITE_LOCATION . 'enroll">Inschrijven</a>' : 'Onbekend');
                            echo $tournament2;
                        ?>
                    </p>
                </div>
                <div class="full-width">
                    <h3>Geplaatste opmerking</h3>
                    <p>
                        <?php 
                            $notes = $users->metaGet($user->id, 'notes');
                            if (!$notes || empty($notes)) $notes = 'Geen opmerking geplaatst';
                            echo $notes;
                        ?>
                    </p>
                </div>
                <div class="full-width team-table" :if="players.length > 0">
                    <h3>Geregistreerd team</h3>
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

                <section class="buttons">
                    <?php if ($self) { ?><a href="<?php echo SITE_LOCATION; ?>enroll">Inschrijving aanpassen</a><?php } ?>
                </section>
            </div>
        </form>

        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/help-button.php'); ?>

        <script>
            const payload = {
                team: '<?=$registeredTeam?>'
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/profile.js" type="module"></script>
    </body>
</html>