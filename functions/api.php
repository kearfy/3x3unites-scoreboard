<?php
    use Library\Controller;
    use Library\Objects;
    use Library\Users;
    use Helper\Respond;

    if (isset($params[0])) {
        if ($params[0] == 'players-suggestions') {
            $users = new Users;
            $players = array();
            foreach($users->list() as $current) {
                $player = $users->metaGet($current['id'], 'type') == 'player';
                $teamadmin = $users->metaGet($current['id'], 'teamadmin') == '1';
                if ($player && !$teamadmin) {
                    $item = (object) $current;
                    if ($users->metaGet($item->id, 'profile-filled') == '1') {
                        $height = $users->metaGet($item->id, 'height');
                        $age = $users->metaGet($item->id, 'age');
                        array_push($players, array(
                            "name" => $item->firstname . ' ' . $item->lastname,
                            "height" => $height,
                            "age" => $age
                        ));
                    }
                }
            }

            Respond::JSON($players);
        } else if ($params[0] == 'team') {
            if (isset($params[1])) {
                $objectManager = new Objects;
                if ($objectManager->exists('scoreboard-team', $params[1])) {
                    $result = [];
                    $raw = $objectManager->properties('scoreboard-team', $params[1], true);
                    foreach($raw as $key => $value) {
                        $id = substr($key, 6, 1) - 1;
                        $key = substr($key, 8);
                        if (!isset($result[$id])) $result[$id] = [];
                        $result[$id][$key] = $value;
                    }

                    Respond::JSON($result);
                } else {
                    die('unknown team');
                }
            } else {
                die('missing team');
            }
        } else if ($params[0] == 'teams') {
            $objectManager = new Objects;
            $teams = [];
            foreach($objectManager->list('scoreboard-team', 0) as $t) {
                $t = $t['name'];
                $teams[$t] = array();
                $raw = $objectManager->properties('scoreboard-team', $t, true);
                foreach($raw as $key => $value) {
                    $id = substr($key, 6, 1) - 1;
                    $key = substr($key, 8);
                    if (!isset($result[$id])) $result[$t][$id] = [];
                    $teams[$t][$id][$key] = $value;
                }
            }

            Respond::JSON($teams);
        } else if ($params[0] == 'players') {
            $users = new Users;
            $controller = new Controller;
            $userModel = $controller->__model('user');
            
            if ($userModel->check('site.tournament-admin')) {
                $players = array();
                foreach($users->list() as $current) {
                    $type = $users->metaGet($current['id'], 'type');
                    if ($type && $type == 'player') {
                        unset($current['password']);
                        array_push($players, $current);
                    }
                }

                Respond::JSON($players);
            } else {
                die('not authorized');
            }
        } else {
            die('unknown api');
        }
    } else {
        die('missing api');
    }