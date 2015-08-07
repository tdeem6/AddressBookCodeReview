<?php
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/AddressBook.php';

    session_start();
    if (empty($_SESSION['allcontacts'])) {
        $_SESSION['allcontacts'] = array();

       $first_contact = new Contact("Jimi Hendrix", "503-826-9371", "208 SW 5th st. Portland, OR 97204");
       $second_contact = new Contact("Elvis Presley", "617-356-3571", "Graceland");
       $third_contact = new Contact("Albert Einstein", "415-738-4935", "3718 MLK blvd. Oakland, CA 94609");
       $fourth_contact = new Contact("Janis Joplin", "415-124-2445", "Haight Ashbury, San Francisco, CA 94117");
       $contacts = array ($first_contact, $second_contact, $third_contact, $fourth_contact);
       array_push($_SESSION['allcontacts'], $first_contact);
       array_push($_SESSION['allcontacts'], $second_contact);
       array_push($_SESSION['allcontacts'], $thrid_contact);
       array_push($_SESSION['allcontacts'], $fourth_contact);

    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {

          return $app['twig']->render('contactssearch.html.twig');
    });


    $app->get("/contact_results", function() use ($app) {
        $contacts_matching_search = array();
        foreach ($_SESSION['allcontacts'] as $contact) {
             if ($contact->worthCalling($_GET["name"], $_GET["phone"], $_GET["address"])) {
                 array_push($contacts_matching_search, $contact);
             }
        }

        return $app['twig']->render('results.html.twig', array('contacts' => $contatcs_matching_search));

    });


    $app->post("/create_contact", function() use ($app) {
        $newcontact = new Contact($_POST['name'], $_POST['phone'], $_POST['address']);
        $newcontact->save();

        return $app['twig']->render('create_contacts.html.twig', array('newcontact' => $newcontact));
    });

    $app->post("/deleted_contact", function() use ($app) {
        Contact::deleteAll();

        return $app['twig']->render('delete_contact.html.twig');
    });

    return $app;
 ?>
