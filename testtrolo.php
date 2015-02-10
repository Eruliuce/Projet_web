<?
/*
* SiteMap Generator
* This script is designed to make it very easy to create a custom Sitemap for your site from a set of data objects
* Simply customize your object interactions
* Author: Ben Hall
* Url: http://www.benhallbenhall.com
* License: Free to use commercial or private with a link back to http://www.benhallbenhall.com
*/

/////////////////////////////////////////////////////////////
//// Setup
/////////////////////////////////////////////////////////////

// Replace the following code with whatever code you want to use to get a batch of objects from your data store.

// 1. The Object Class file :: Replace this wil your own Object Class
include("ObjectClass.php");

// 2. Change this code to represent whatever call you need to use to get a batch of objects
function getBatch($start, $end){
return Object::getBatch($start, $end);
}

// 3. Change this code to represent pulling data out of a single object and putting it into a single sitemap entry
// Note :: change frequency and priority are default to a standard value – feel free to customize as appropriate.
function writeRecord($object) {
$html .= '<url>';
$html .= '<loc>'.$object->url.'</loc>'; //The canicol URL to the item
$html .= '<lastmod>'.Util::formatDate($object->lastModified,"Y-m-d").'T'.Util::formatDate($object->lastModified,"H:i:s-04:00").'</lastmod>';
$html .= '<changefreq>weekly</changefreq>';
$html .= '<priority>0.5</priority>';
$html .= '</url>';
return $html;
}

// 4. If needed you can set the following variables to help tune the script.
$memory = '64M'; //Increase or lower the memory values as appropriate (useful if your sitemap is very large
$sitemapFile = "sitemap.xml"; //The location of the Sitemap to build
$batchSize = 1000; //Number of objects to retrieve at a single time
$sleepLength = 1; //Number of seconds to sleep in between batches (so as to not harm your server)
$showErrors = true; //Boolean, set to True or False to show or hide errors

/////////////////////////////////////////////////////////////
//// Code Body
/////////////////////////////////////////////////////////////

//Setup the variables
ini_set('memory_limit', $memory);
$start = $end = 0;
$moreToDo = true;

//Error reporting
if($showErrors){
error_reporting(E_ALL);
ini_set('display_errors','On');
}

//Open the file handler
$fh = fopen($myFile, 'w');

//Write the headers on the XML file
$html = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">';
fwrite($fh, $html);

//Loop through the objects. Get a batch an
while($moreToDo){

//Setup variables for the loop
$start = $end;
$end = $end + $batchSize;

//Get a batch of objects from your Data Store… Replace
$objects = getBatch($start, $end);
$objectCount = count($objects);

//Turn off looping if batch size is smaller then total possible
if($objectCount < $batchSize){
$moreToDo = false;
}

//Build the XML for each entry
foreach($objects as $object){
$entry = writeRecord($object);
fwrite($fh, $entry);
}

//Sleep briefly to not harm your server
sleep($sleepLength);
}

//Close up the end of the File
$html = '</urlset>';
fwrite($fh, $html);
fclose($fh);

echo '<p>All Done. <a href="'.$sitemapFile.'">Click here to view</a></p>';