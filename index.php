<?php
/**
 * Created by PhpStorm.
 * User: anyapps
 * Date: 02.11.2018
 * Time: 09:37
 */

include('Creational/builder.php');
include('Creational/singleton.php');
include('Creational/factory_method.php');
include('Creational/abstract_factory.php');

include('Structural/decorator.php');
include('Structural/composite.php');
include('Structural/facade.php');

include('Behavioral/strategy.php');
include('Behavioral/observer.php');



echo "/************************************************* BUILDER *************************************************/<br><br>";
$director = new Director();
/** @var Car $smallCar */
$smallCar = $director->build(new MediumCar());
echo "This Car has: $smallCar->doors doors and $smallCar->seats seats"; //RETURNS -> This Car has: 5 doors and 5 seats



echo "<br><br>/**************************************** SINGLETON *************************************************/<br><br>";
$preferences = Preferences::getInstance();
$preferences->setProperty('host','anyapps.pl');
echo $preferences->getProperty('host');//RETURNS -> anyapps.pl



echo "<br><br>/**************************************** FACTORY METHOD *************************************************/<br><br>";
$pizza = new PizzaCreator();
$order = $pizza->create("Deluxe");
echo $order->getName(); //RETURNS -> Deluxe pizza


echo "<br><br>/**************************************** ABSTRACT FACTORY *************************************************/<br><br>";
$factory = new MicrosoftOfficeFactory();
$factory->getDOC()->render(); //RETURNS -> This is MS Office Doc
echo "<br>";
$factory->getPDF()->render();  //RETURNS -> This is MS Pdf



echo "<br><br>/**************************************** DECORATOR *************************************************/<br><br>";
$baseOffer = new Basic();
echo "Basic rent: ".$baseOffer->getPrice();//RETURNS -> Basic rent: 100
echo "<br>";
$rentWithGPS = new GPS($baseOffer);
echo "Rent with GPS: ".$rentWithGPS->getPrice();//RETURNS -> Rent with GPS: 150
echo "<br>";
$rentComplex = new Insurance($rentWithGPS);
echo "Rent with GPS and Insurance: ".$rentComplex->getPrice();//RETURNS -> Rent with GPS and Insurance: 230



echo "<br><br>/**************************************** COMPOSITE *************************************************/<br><br>";
$form = new Form();
$form->addElement(new InputElement());
$form->addElement(new InputElement());
$form->addElement(new InputElement());
echo $form->render();//RETURNS form with 3 inputs



echo "<br><br>/**************************************** STRATEGY *************************************************/<br><br>";
$tax = new Tax();
$tax->setCountry(new Poland());
echo "Vat form value of 1000PLN in Poland is ".$tax->getCountry()->countVat(1000)."PLN.";



echo "<br><br>/**************************************** STRATEGY *************************************************/<br><br>";
$news = new News();
$news->attach(new RSSObserver());
$news->attach(new NewsletterObserver());
$news->add(
    [
        'title' => 'Title of news',
        'content' => 'blablabla'
    ]);