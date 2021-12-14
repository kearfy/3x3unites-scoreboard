<?php
    $controller = new Library\Controller;
    $user = $controller->__model('user');
    $signedin = $user->signedin();

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
        <?php showSignedin($signedin, '<a href="/enroll">Inschrijven</a>'); ?>
    </section>
    <section class="middle">
        <div class="logo-container">
            <img src="<?php echo SITE_LOCATION; ?>/pb-loader/module-static/scoreboard/logo_white.svg" alt="3x3unites logo">
        </div>
    </section>
    <section class="right">
        <?php showSignedout($signedin, '<a href="/signin">Inloggen</a>'); ?>
        <?php showSignedin($signedin, '<a href="/profile">Profiel</a>'); ?>
    </section>
</nav>

