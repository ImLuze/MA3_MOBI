<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'EventDAO.php';

class EventsController extends Controller {

  private $eventDAO;

  function __construct() {
    $this->eventDAO = new EventDAO();
  }

  public function index() {

  }

  public function events() {

    if( !empty($_REQUEST['getloc'])) {
      $this->getLocation();
      return;
    }

    $conditions = array();

    if( !empty($_REQUEST['showloc'])) {
      $locationArray = ['Brugge', 'Antwerpen', 'Kortrijk', 'Sint-Niklaas', 'Brussel', 'Watermaal-Bosvoorde', 'Laken', 'Sint-Joost-Ten-Noode', 'Elsene', 'Ieper'];

      foreach($locationArray as $location) {
        if(stristr($_REQUEST['loc'], $location)) {

          $conditions[] = array(
            'field' => 'city',
            'comparator' => '=',
            'value' => $_REQUEST['loc']
          );

        }
      }
    }

    if( !empty($_REQUEST['showtag'])) {
      $tags = explode('_', $_REQUEST['tags']);

      foreach($tags as $tag) {

        $conditions[] = array(
          'field' => 'tag',
          'comparator' => '=',
          'value' => $tag
        );

        // print_r($conditions);
        // print_r($this->eventDAO->search($conditions));

      }
    }

    if( !empty($_REQUEST['filter'])) {
      if( !empty($_REQUEST['loc'])) {
        $locationArray = ['Brugge', 'Antwerpen', 'Kortrijk', 'Sint-Niklaas', 'Brussel', 'Watermaal-Bosvoorde', 'Laken', 'Sint-Joost-Ten-Noode', 'Elsene', 'Ieper'];

        foreach($locationArray as $location) {
          if(stristr($_REQUEST['loc'], $location)) {

            $conditions[] = array(
              'field' => 'city',
              'comparator' => '=',
              'value' => $_REQUEST['loc']
            );

          }
        }
      }

      if( !empty($_REQUEST['tags'])) {
        $tags = explode('_', $_REQUEST['tags']);

        foreach($tags as $tag) {

          $conditions[] = array(
            'field' => 'tag',
            'comparator' => '=',
            'value' => $tag
          );

        }
      }

      if( !empty($_REQUEST['date'])) {
        $date = explode('_', $_REQUEST['date']);

        foreach($date as $day) {

          $conditions[] = array(
            'field' => 'start',
            'comparator' => '<=',
            'value' => '2018-09-'.$day.' 23:59:59'
          );
          $conditions[] = array(
            'field' => 'end',
            'comparator' => '>=',
            'value' => '2018-09-'.$day.' 00:00:00'
          );

        }
      }
    }

    //example: search on title
    // $conditions[] = array(
    //   'field' => 'title',
    //   'comparator' => 'like',
    //   'value' => 'leie'
    // );

    //example: search on organiser_id
    // $conditions[] = array(
    //   'field' => 'organiser_id',
    //   'comparator' => '=',
    //   'value' => 8
    // );

    //example: search on organiser name
    // $conditions[] = array(
    //   'field' => 'organiser',
    //   'comparator' => 'like',
    //   'value' => 'brussel'
    // );

    //example: search on tag name
    // $conditions[] = array(
    //   'field' => 'tag',
    //   'comparator' => '=',
    //   'value' => 'e-bike'
    // );

    //example: 1-day events on september 17
    // $conditions[] = array(
    //   'field' => 'start',
    //   'comparator' => '>=',
    //   'value' => '2018-09-17 00:00:00'
    // );
    // $conditions[] = array(
    //   'field' => 'end',
    //   'comparator' => '<=',
    //   'value' => '2018-09-17 23:59:59'
    // );

    //example: events on september 17 (includes multi-day events)
    // $conditions[] = array(
    //   'field' => 'start',
    //   'comparator' => '<=',
    //   'value' => '2018-09-17 23:59:59'
    // );
    // $conditions[] = array(
    //   'field' => 'end',
    //   'comparator' => '>=',
    //   'value' => '2018-09-17 00:00:00'
    // );

    //example: search on organiser, with certain end date + time
    // $conditions[] = array(
    //   'field' => 'organiser',
    //   'comparator' => 'like',
    //   'value' => 'brussel'
    // );
    // $conditions[] = array(
    //   'field' => 'end',
    //   'comparator' => '=',
    //   'value' => '2018-09-16 18:00:00'
    // );

    $events = $this->eventDAO->search($conditions);
    $this->set('events', $events);

    $tags = $this->eventDAO->selectAllTags();
    $this->set('tags', $tags);

    $response = '';

    if(!empty($_REQUEST['loc']) || !empty($_REQUEST['tags']) || !empty($_REQUEST['date'])) {
      header('Content-Type: application/json');
      $response = json_encode($events);
      // print_r($events);
      echo $response;
      // print_r($conditions);
    }
  }

  private function getLocation() {

    $locationArray = ['Brugge', 'Antwerpen', 'Kortrijk', 'Sint-Niklaas', 'Brussel', 'Watermaal-Bosvoorde', 'Laken', 'Sint-Joost-Ten-Noode', 'Elsene', 'Ieper'];

    if(!empty($_REQUEST['loc'])) {
      $loc = $_REQUEST["loc"];
    } else {
      $loc = "";
    }

    $hint = "";

    if ($loc !== "") {
        $loc = strtolower($loc);
        $len=strlen($loc);
        foreach($locationArray as $location) {
            if (stristr($loc, substr($location, 0, $len))) {
                if ($hint === "") {
                    $hint = $location;
                } else {
                    $hint .= ", $location";
                }
            }
        }
    }

    echo $hint === "" ? "no suggestion" : $hint;
  }

  public function detail() {

    $event = $this->eventDAO->selectById($_GET['id']);
    $this->set('event', $event);
    print_r($_GET['id']);
  }

}
