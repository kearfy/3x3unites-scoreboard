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
    use Registry\Route;

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

            Route::register('root', '__index', '/pb-loader/module/scoreboard/public_stats');
            Route::register('root', 'api', '/pb-loader/module/scoreboard/api');
            Route::register('root', 'signin', '/pb-loader/module/scoreboard/signin');
            Route::register('root', 'profile', '/pb-loader/module/scoreboard/profile');
            Route::register('root', 'enroll', '/pb-loader/module/scoreboard/enroll');
            Route::register('root', 'player', '/pb-loader/module/scoreboard/view_player');
            Route::register('root', 'team', '/pb-loader/module/scoreboard/team');

            Route::register('root', 'configuration', function($params) { Header::Location(SITE_LOCATION . 'pb-dashboard/module-config/scoreboard/' . join('/', $params)); });
            Route::register('root', 'signup', function($params) {
                if (isset($params[0]) && $params[0] == 'profile-prefill') {
                    Request::rewrite('/pb-loader/module/scoreboard/profile_prefill');
                } else {
                    Request::rewrite('/pb-loader/module/scoreboard/signup');
                }
            });

            Event::listen('request-processed', function($info) {
                if (!$info->locked_controller) {
                    $url = (substr($info->url, 0, 1) == '/' ? $info->url : '/' . $info->url);
                    $allowed = ['/api', '/configuration', '/signup/profile-prefill'];
                    $canRedirect = true;
                    foreach($allowed as $item) $canRedirect = ($canRedirect ? substr($url, 0, strlen($item)) !== $item : false);
                    if ($canRedirect) {
                        $controller = new Controller;
                        $userModel = $controller->__model('user');
                        $user = $userModel->info();
            
                        if ($user) {
                            $isPlayer = false;
                            $profileFilled = false;

                            foreach($user->meta as $metaitem) {
                                if ($metaitem['name'] == 'type' && $metaitem['value'] == 'player') $isPlayer = true;
                                if ($metaitem['name'] == 'profile-filled' && $metaitem['value'] == '1') $profileFilled = true;
                            }

                            if ($isPlayer && !$profileFilled) {
                                Header::Location(SITE_LOCATION . 'signup/profile-prefill');
                                die();  
                            }
                        }
                    } 
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