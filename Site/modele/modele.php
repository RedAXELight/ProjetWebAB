<?php
/**
 * Created by PhpStorm.
 * User: Alexandre.baseia
 * Date: 24.05.2018
 * Time: 08:27
 */


function getDB()
{
    //Set databse connexion
    $connexion = new PDO('mysql:host=localhost; dbname=cubesat', 'root', '');

    //Get more error details
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $connexion;
}