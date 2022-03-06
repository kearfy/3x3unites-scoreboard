<?php
    use Helper\Request;
    use Helper\Validate;
    use Helper\Header;
    use Helper\ApiResponse;
    use Library\ModuleConfig;
    use Library\Controller;
    use Library\Users;
    use Library\Objects;

    $controller = new Controller;
    $userModel = $controller->__model('user');
    $user = $userModel->info();
    if (!$user) {
        if (Request::method() == 'POST') {
            ApiResponse::error('not_authenticated', "You are not authenticated.");
        } else {
            Header::Location(SITE_LOCATION . 'signup');
        }

        die();
    }
    
    $postdata = Request::parsePost();
    $config = new ModuleConfig('scoreboard');
    $users = new Users;

    if ($config->get('enrollment-disabled') == '0') {
        $team = 'team-' . $user->id;
        $objectManager = new Objects;
        $res = [];

        if (Request::method() == 'POST') {
            $users->metaSet($user->id, 'tournament1', (isset($postdata->tournament1) && $postdata->tournament1 == 'on' ? 1 : 0));
            $users->metaSet($user->id, 'tournament2', (isset($postdata->tournament2) && $postdata->tournament2 == 'on' ? 1 : 0));
            $users->metaSet($user->id, 'teamadmin', (isset($postdata->teamadmin) && $postdata->teamadmin == 'on' ? 1 : 0));
            $objectManager->purge('scoreboard-team', $team);

            if ($users->metaGet($user->id, 'teamadmin') == '1') {
                $objectManager->create('scoreboard-team', $team);
                $objectManager->set('scoreboard-team', $team, 'player1-name', $user->fullname);
                $objectManager->set('scoreboard-team', $team, 'player1-height', $users->metaGet($user->id, 'height'));
                $objectManager->set('scoreboard-team', $team, 'player1-age', $users->metaGet($user->id, 'age'));

                foreach($postdata as $key => $value) {
                    array_push($res, $key, substr($key, 0, 6));
                    if (substr($key, 0, 6) == 'player') {
                        if (substr($key, 0, 7) != 'player1') $objectManager->set('scoreboard-team', $team, $key, $value);
                    }
                }
            }

            ApiResponse::success(array(
                "body" => $postdata,
                "res" => $res
            ));
            die();
        }

        $tournament1 = $users->metaGet($user->id, 'tournament1') == '1' ? 'true' : 'false';
        $tournament2 = $users->metaGet($user->id, 'tournament2') == '1' ? 'true' : 'false';
        $teamadmin = $users->metaGet($user->id, 'teamadmin') == '1' ? 'true' : 'false';
        $teamregistrationEnabled = $config->get('teamregistration-disabled') == '0' ? 'true' : 'false';

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
        <form class="unload" action="<?php echo SITE_LOCATION; ?>/enroll" method="post" @submit="submitForm(event)">
            <div class="page-back">
                <i data-feather="arrow-left"></i>
            </div>
            
            <section class="logo">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="">
            </section>
            <section class="tournament-details input-fields">
                <div>
                    <h1>
                        10 APR 2022
                    </h1>
                    <div class="times">
                        <p>10:30</p> 
                        <span class="line"></span> 
                        <p>15:30</p>
                    </div>
                </div>
                <div>
                    <h3>
                        Sportfondsen Het Spectrum
                    </h3>
                    <p>
                        Hoofddorp
                    </p>
                </div>
                <div class="two-blocks tournament-registrations" :class:no-seperator="!teamregistrationEnabled || !tournament2">
                    <div>
                        <h3>
                            Toernooi #1
                        </h3>
                        <div class="times">
                            <p>10:15</p> 
                            <span class="line"></span> 
                            <p>12:15</p>
                        </div>
                        <p>
                            Inschrijving als individu, mixed teams, leeftijd 12+
                        </p>
                        <div class="checkbox">
                            <input type="checkbox" id="tournament1" name="tournament1" <?php echo $tournament1; ?> :checked="tournament1">
                            <label for="tournament1" class="checkmark"></label>
                            <label for="tournament1"> Ik doe mee</label><br>
                        </div>
                    </div>
                    <div>
                        <h3>
                            Toernooi #2
                        </h3>
                        <div class="times">
                            <p>13:15</p> 
                            <span class="line"></span> 
                            <p>15:45</p>
                        </div>
                        <p>
                            Inschrijving als team 16+ <br>
                            Individuele inschrijving ook mogelijk
                        </p>
                        <div class="checkbox">
                            <input type="checkbox" id="tournament2" name="tournament2" <?php echo $tournament2; ?> :checked="tournament2">
                            <label for="tournament2" class="checkmark"></label>
                            <label for="tournament2"> Ik doe mee</label><br>
                        </div>
                    </div>
                </div>
                <div class="team-registration" :if="teamregistrationEnabled && tournament2">
                    <h3>
                        Team registratie
                    </h3>
                    <div class="checkbox">
                        <input type="checkbox" id="teamadmin" name="teamadmin" :checked="teamregistration">
                        <label for="teamadmin" class="checkmark"></label>
                        <label for="teamadmin"> Ik wil een team registreren</label><br>
                    </div>
                    <p class="error-message" :if="errorMessage !== ''">
                        {{errorMessage}}
                    </p>
                    <table class="players" :if="teamregistration">
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Lengte</th>
                                <th>Leeftijd</th>
                                <th>Acties</th>
                            </tr>
                            <tr>
                                <td>
                                    <?=$user->firstname?> <?=$user->lastname?>
                                </td>
                                <td>
                                    <?=$users->metaGet($user->id, 'height')?>
                                </td>
                                <td>
                                    <?=$users->metaGet($user->id, 'age')?>
                                </td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="player" :for="players as index => player">
                                <td>{{player.name}}</td>
                                <td>{{player.height}}</td>
                                <td>{{player.age}}</td>
                                <td><a @click="deletePlayer(index)">Verwijderen</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="add-player" :if="teamregistration">
                        <div class="expandable-input closed">
                            <input type="text" :value="newplayername" @input="prefillPlayer()" placeholder="Naam">
                            <div class="hidden-content hidden">
                                <table class="suggestions">
                                    <thead>
                                        <th>Naam</th>
                                        <th>Lengte</th>
                                        <th>Leeftijd</th>
                                        <th>Acties</th>
                                    </thead>
                                    <tbody>
                                        <tr class="player" :for="suggestedplayers as index => player">
                                            <td>{{player.name}}</td>
                                            <td>{{player.height}}</td>
                                            <td>{{player.age}}</td>
                                            <td><a @click="addPlayer(index)">Toevoegen</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="two-inputs">
                            <input type="number" :value="newplayerheight" min="100" max="300" placeholder="Lengte" @input="this.errorMessage = ''">
                            <input type="number" :value="newplayerage" min="12" max="99" placeholder="Leeftijd" @input="this.errorMessage = ''">
                        </div>
                        
                        <button class="button" type="button" @click="addPlayer()">
                            Speler toevoegen
                        </button>
                    </div>
                </div>
            </section>
            <section class="note" :if="!teamregistrationEnabled">
                <p>
                    Teamregistratie wordt binnenkort geopend.
                </p>
            </section>
            <section class="finish-signup">
                <button class="button" :class:smaller="teamregistration" type="button" @click="finish()">
                    Opslaan
                </button>
            </section>
        </form>

        <script>
            const payload = {
                tournament1: <?=$tournament1?>,
                tournament2: <?=$tournament2?>,
                teamregistration: <?=$teamadmin?>,
                teamregistrationEnabled: <?=$teamregistrationEnabled?>,
                team: '<?=$team?>'
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/enroll.js" type="module"></script>
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
        <title>Inschrijven - 3x3unites scoreboard</title>
        
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
                    Wordt later vandaag geopend
                </h1>
            </section> 

            <section class="note">
                <p>
                    Teamregistratie wordt later geopend.
                </p>
            </section>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>

<?php
    }
?>
