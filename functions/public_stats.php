<?php
    $controller = new \Library\Controller;
    $userModel = $controller->__model('user');
    $signedin = $userModel->signedin();
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>3x3unites scoreboard</title>
        
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.css">
        <link rel="stylesheet" href="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/pages.css">
    </head>
    <body>
        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/navbar.php'); ?>
        
        <div class="content">
            <div class="sections-container">
                <section class="general-notice">
                    <?php echo file_get_contents(DYNAMIC_DIR . '/modules/scoreboard/static/basketball.svg'); ?>

                    <br>
                    <p>
                        <?=$signedin ? "Inschrijvingen zijn gesloten!" : "Registraties staan open!"?><br><br>
                        <?=$signedin ? "Hier komen de statestieken van het toernooi!" : "Spelers kunnen een account aanmaken"?>
                    </p>

                    <div class="button-container">
                        <a href="/<?=$signedin ? "enroll" : "signup"?>" class="button">
                            <?=$signedin ? "Inschrijven" : "Registreren"?>
                        </a>
                    </div>
                </section>
                <section class="dates-overview">
                    <h2>
                        Overzicht toernooien
                    </h2>

                    <table class="tournament-overview">
                        <tr>
                            <th>
                                Datum
                            </th>
                            <td>
                                10-04-2022
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Locatie
                            </th>
                            <td>
                                Sportfondsen Het Spectrum
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Plaats
                            </th>
                            <td>
                                Hoofddorp
                            </td>
                        </tr>
                    </table>

                    <br>
                    <table class="dates">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Starttijd</th>
                                <th>Eindtijd</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Toernooi #1
                                </td>
                                <td>
                                    10:15
                                </td>
                                <td>
                                    12:15
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Middenstuk
                                </td>
                                <td>
                                    12:15
                                </td>
                                <td>
                                    13:15
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Toernooi #2
                                </td>
                                <td>
                                    13:15
                                </td>
                                <td>
                                    15:00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Afsluiting
                                </td>
                                <td>
                                    15:00
                                </td>
                                <td>
                                    15:45
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <br>
                    <p class="notice">
                        * De indeling kan iets afwijken of nog worden aangepast.
                    </p>
                </section>
            </div>
        </div>
        
        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/footer.php'); ?>

        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/help-button.php'); ?>
        
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>