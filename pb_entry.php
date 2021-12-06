<?php
    namespace Module;

    use Helper\ApiResponse as Respond;
    use Helper\Request;
    use Helper\Header;

    use Registry\Event;

    class Scoreboard {
        public function initialize() {
            Event::listen('request-processed', function($info) {
                $url = explode('/', $info->url);
                if ($info->url == '/') {
                    Request::rewrite('/pb-loader/module/scoreboard/public_stats');
                } else if ($url[0] == 'configuration') {
                    array_shift($url);
                    Header::Location('/pb-dashboard/module-config/scoreboard/' . join('/', $url));
                }
            });
        }

        public function requestHandler($params) {
            if (!isset($params[0])) {
                http_response_code(400);
                Respond::error("missing_function", "No function parameter was provided.");
            } else {
                if (file_exists(__DIR__ . '/functions/' . $params[0] . '.php')) {
                    require __DIR__ . '/functions/' . $params[0] . '.php';
                    array_shift($params);
                    start_function($params);
                } else {
                    http_response_code(404);
                    Respond::error("unknown_function", "An unknown function was provided.");
                }
            }
        }

        public function configurator($params) {
            echo 'configuration';
        }
    }