<?php
    $users = new Library\Users;
    $controller = new Library\Controller;
    $userModel = $controller->__model('user');
    $signedin = $userModel->signedin();
    
    if ($signedin) {
        $user = $userModel->info();
        $enrolled = $users->metaGet($user->id, 'tournament1') || $users->metaGet($user->id, 'tournament2');
    } else {
        $enrolled = false;
    }

    function showSignedin($signedin, $content) {
        if ($signedin) {
            echo $content;
        }
    }

    function showSignedout($signedin, $content) {
        if (!$signedin) {
            echo $content;
        }
    }

?>

<nav>
    <section class="left">
        <?php showSignedout($signedin, '<a href="/signup">Registreren</a>'); ?>
        <?php showSignedin($signedin, '<a href="/enroll">' . ($enrolled ? "Inschrijving" : "Inschrijven") . '</a>'); ?>
    </section>
    <section class="middle">
        <a href="https://www.3x3unites.com">
            <div class="logo-container">
                <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="3x3unites logo">
            </div>
        </a>
    </section>
    <section class="right">
        <?php showSignedout($signedin, '<a href="/signin">Inloggen</a>'); ?>
        <?php showSignedin($signedin, '<a href="/profile">Profiel</a>'); ?>
    </section>
</nav>

