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
    <body class="public_stats">
        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/navbar.php'); ?>
        
        <div class="content">
            <div class="sections-container">
                <section class="general-notice">
                    <?php echo file_get_contents(DYNAMIC_DIR . '/modules/scoreboard/static/basketball.svg'); ?>

                    <br>
                    <p>
                        <?=$signedin ? "Inschrijvingen zijn gesloten!" : "Registreren kan nog"?><br><br>
                        <?=$signedin ? "Hier komen de statestieken van het toernooi!" : "Spelers kunnen een account aanmaken"?>
                    </p>
                    <?php if (!$signedin) { ?>
                        <div class="button-container">
                            <a href="/<?=$signedin ? "enroll" : "signup"?>" class="button">
                            <?=$signedin ? "Inschrijven" : "Registreren"?>
                            </a>
                        </div>
                    <?php } ?>
                    <br>
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
            <div class="sections-container">
                <section class="teams">
                    <h2>Toernooi 1 teams</h2>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th>Team 1</th>
                                <th>Team 2</th>
                                <th>Team 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Arman Sedaghati Ghamsari
                                </td>
                                <td>
                                    Chant Balci
                                </td>
                                <td>
                                    Michael Siman
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Erfan Sedaghati Ghamsari
                                </td>
                                <td>
                                    Dana
                                </td>
                                <td>
                                    Lucas
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Rishaan Sriram
                                </td>
                                <td>
                                    Julian Klaassen
                                </td>
                                <td>
                                    Boran Celik
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Rithvik Sriram
                                </td>
                                <td>
                                    Sven de Raadt
                                </td>
                                <td>
                                    Rohin Azizi
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th>Team 4</th>
                                <th>Team 5</th>
                                <th>Team 6</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Silvano Boersma
                                </td>
                                <td>
                                    Özgür Gündogdu
                                </td>
                                <td>
                                    Aman chamlingray
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Daniël Rietveld
                                </td>
                                <td>
                                    Yassin Elyaqouti
                                </td>
                                <td>
                                    Liam Ahern
                                </td>
                            </tr>
                            <br>
                            <tr>
                                <td>
                                    Joa Chen
                                </td>
                                <td>
                                    Amy
                                </td>
                                <td>
                                   Rosa Piet
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Ravi de Zeeuw
                                </td>
                                <td>
                                    Finn Westerwaal
                                </td>
                                <td>
                                    Kibo Noteborn
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <p>Op het toernooi schema zijn de uitslagen te volgen tijdens het toernament!</p>
                </section>
                <section class="schedual center-head">
                    <h2>Toernooi 1 schema</h2>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 1</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 2
                                </td>
                                <td>
                                    6-9
                                </td>
                                <td>
                                    Team 5
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 3
                                </td>
                                <td>
                                    10-6
                                </td>
                                <td>
                                    Team 6
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 4
                                </td>
                                <td>
                                    16-7
                                </td>
                                <td>
                                    Team 1
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 1
                                </td>
                                <td>
                                    2-11
                                </td>
                                <td>
                                    Team 3
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 5
                                </td>
                                <td>
                                    8-15
                                </td>
                                <td>
                                    Team 4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 6
                                </td>
                                <td>
                                    8-11
                                </td>
                                <td>
                                    Team 2
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 2
                                </td>
                                <td>
                                    6-9
                                </td>
                                <td>
                                    Team 1
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 3
                                </td>
                                <td>
                                    8-9
                                </td>
                                <td>
                                    Team 4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 6
                                </td>
                                <td>
                                    8-7
                                </td>
                                <td>
                                    Team 5
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 1
                                </td>
                                <td>
                                    6-8
                                </td>
                                <td>
                                    Team 6
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 3
                                </td>
                                <td>
                                    13-11
                                </td>
                                <td>
                                    Team 5
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 4
                                </td>
                                <td>
                                    12-13
                                </td>
                                <td>
                                    Team 2
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 2
                                </td>
                                <td>
                                    8-10
                                </td>
                                <td>
                                    Team 3
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 5
                                </td>
                                <td>
                                    6-7
                                </td>
                                <td>
                                    Team 1
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 6
                                </td>
                                <td>
                                    9-11
                                </td>
                                <td>
                                    Team 4
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>    
            <div class="sections-container">
                <section class="teams">
                    <h2>Toernooi 2 teams</h2>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th>Team</th>
                                <th>Captains</th>
                                <th>Poule</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 1
                                </td>
                                <td>
                                    Alper Aykut
                                </td>
                                <td>
                                    Poule A
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 2
                                </td>
                                <td>
                                    Risyu Blom
                                </td>
                                <td>
                                    Poule A
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 3
                                </td>
                                <td>
                                    Chant Balci
                                </td>
                                <td>
                                    Poule A
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 4
                                </td>
                                <td>
                                    Yannick Krap
                                </td>
                                <td>
                                    Poule A
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 5
                                </td>
                                <td>
                                    Yorian Schenkel
                                </td>
                                <td>
                                    Poule A
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 6
                                </td>
                                <td>
                                    Rosa Piet
                                </td>
                                <td>
                                    Poule B
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 7
                                </td>
                                <td>
                                    Özgür Gündogdu
                                </td>
                                <td>
                                    Poule B
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 8
                                </td>
                                <td>
                                    Lieneke Hoek
                                </td>
                                <td>
                                    Poule B
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 9
                                </td>
                                <td>
                                    Michael Siman
                                </td>
                                <td>
                                    Poule B
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 10
                                </td>
                                <td>
                                    Liam Ahern
                                </td>
                                <td>
                                    Poule B
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <p>Op het toernooi schema zijn de uitslagen te volgen tijdens het toernament!</p>
                </section>
                <section class="schedual">
                    <h2>Toernooi 2 schema (Poule A)</h2>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 1</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 1
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 4
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 2
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 3
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 3
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 1
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 4
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 5
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 5
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 3
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 1
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 2
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 2
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 5
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 3
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 4
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 4
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 2
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 5
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 1
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="sections-container">
                <section class="schedual">
                    <h2>Toernooi 2 schema (Poule B)</h2>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 1</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 6
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 9
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 7
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 8
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 8
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 6
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 9
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 10
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 10
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 8
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 6
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 7
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 7
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 10
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 8
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 9
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Team 9
                                </td>
                                <td>
                                    
                                </td>
                                <td>
                                    Team 7
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Team 10
                                </td>
                                <td>

                                </td>
                                <td>
                                    Team 6
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="schedual final">
                    <h2>Toernooi 2 schema (Finals)</h2>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 1</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Winnaar poule A
                                </td>
                                <td>
                                    F1.1
                                </td>
                                <td>
                                    Winnaar poule B
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    2de poule A
                                </td>
                                <td>
                                    F1.2
                                </td>
                                <td>
                                    2de poule B
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    3de poule A
                                </td>
                                <td>
                                    F3
                                </td>
                                <td>
                                    3de poule B
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Winnaar F1.1
                                </td>
                                <td>
                                    Finale voor 1ste plek
                                </td>
                                <td>
                                    Winnaar F1.2
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Lozer F1
                                </td>
                                <td>
                                    F2
                                </td>
                                <td>
                                    Lozer F1
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Lozer (Finale voor 1ste plek)
                                </td>
                                <td>
                                    Finale voor 2de plek
                                </td>
                                <td>
                                    Winnaar F2
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <table class="grouping">
                        <thead>
                            <tr>
                                <th colspan=3>Ronde 4</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Winnaar F3
                                </td>
                                <td>
                                    Finale voor 3de plek
                                </td>
                                <td>
                                    Lozer (Finale voor 2de plek)
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
        </div>
        
        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/footer.php'); ?>

        <?php require_once(DYNAMIC_DIR . '/modules/scoreboard/partials/help-button.php'); ?>
        
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/default.js"></script>
    </body>
</html>