<?php
    namespace Module;

    use Library\ModuleConfig;
    use Library\Controller;
    use Library\Assets;
    use Library\Users;
    use Helper\ApiResponse as Respond;
    use Helper\Request;
    use Helper\Header;
    use Registry\Dashboard;

    use Registry\Event;

    class Scoreboard {
        public function initialize() {
            $config = new ModuleConfig('scoreboard');
            $config->defaults(array(
                "signup-disabled" => 0,
                "enrollment-disabled" => 0,
                "teamregistration-disabled" => 0
            ));

            Dashboard::register("module-config-scoreboard", array(
                "icon" => "award",
                "title" => "Tournament",
                "url" => "module-config/scoreboard"
            ));

            Event::listen('request-processed', function($info) {
                $controller = new Controller;
                $userModel = $controller->__model('user');
                $user = $userModel->info();
    
                $isPlayer = false;
                $profileFilled = false;
                $canRedirect = false;
                if ($user) foreach($user->meta as $metaitem) {
                    if ($metaitem['name'] == 'type' && $metaitem['value'] == 'player') $isPlayer = true;
                    if ($metaitem['name'] == 'profile-filled' && $metaitem['value'] == '1') $profileFilled = true;
                }

                $url = explode('/', $info->url);
                if ($info->url == '/') {
                    Request::rewrite('/pb-loader/module/scoreboard/public_stats');
                    $canRedirect = true;
                } else if ($url[0] == 'configuration') {
                    array_shift($url);
                    Header::Location(SITE_LOCATION . 'pb-dashboard/module-config/scoreboard/' . join('/', $url));
                } else if ($url[0] == 'api') {
                    array_shift($url);
                    Request::rewrite('/pb-loader/module/scoreboard/api/' . join('/', $url));
                } else if ($url[0] == 'signup') {
                    if (isset($url[1])) {
                        if ($url[1] == 'profile-prefill') {
                            Request::rewrite('/pb-loader/module/scoreboard/profile_prefill');
                        } else {
                            Request::rewrite('/pb-loader/module/scoreboard/signup');
                            $canRedirect = true;
                        }
                    } else {
                        Request::rewrite('/pb-loader/module/scoreboard/signup');
                        $canRedirect = true;
                    }
                } else if ($url[0] == 'signin') {
                    array_shift($url);
                    Request::rewrite('/pb-loader/module/scoreboard/signin/' . join('/', $url));
                    $canRedirect = true;
                } else if ($url[0] == 'profile') {
                    array_shift($url);
                    Request::rewrite('/pb-loader/module/scoreboard/profile/' . join('/', $url));
                    $canRedirect = true;
                } else if ($url[0] == 'enroll') {
                    array_shift($url);
                    Request::rewrite('/pb-loader/module/scoreboard/enroll/' . join('/', $url));
                    $canRedirect = true;
                } else if ($url[0] == 'player') {
                    array_shift($url);
                    Request::rewrite('/pb-loader/module/scoreboard/view_player/' . join('/', $url));
                    $canRedirect = true;
                } else if ($url[0] == 'team') {
                    array_shift($url);
                    Request::rewrite('/pb-loader/module/scoreboard/team/' . join('/', $url));
                    $canRedirect = true;
                }

                if ($canRedirect && $isPlayer && !$profileFilled) {
                    Header::Location(SITE_LOCATION . 'signup/profile-prefill');
                }
            });
        }

        public function requestHandler($params) {
            if (!isset($params[0])) {
                http_response_code(400);
                Respond::error("missing_function", "No function parameter was provided.");
            } else {
                $func = $params[0];
                array_shift($params);
                if (file_exists(__DIR__ . '/functions/' . $func . '.php')) {
                    require __DIR__ . '/functions/' . $func . '.php';
                } else {
                    http_response_code(404);
                    Respond::error("unknown_function", "An unknown function was provided.");
                }
            }
        }

        public function configurator($params) {
            $assets = new Assets;
            $assets->registerBody("script", "configurator.js", array(
                "permanent" => true,
                "origin" => "module:scoreboard",
                "properties" => 'type="module"'
            ));

            $controller = new Controller;
            $userModel = $controller->__model('user');
            if (!$userModel->check('site.tournament-admin')) {
                Header::Location(SITE_LOCATION);
                return;
            }

            require_once 'configurator.php';
        }
    }