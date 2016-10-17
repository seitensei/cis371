<?php
include('config.php');
include('db.php');

//header("Content-Type: text/plain");
$xslDoc = new DOMDocument();
$xslDoc->load('./style.xsl');
$xslProc = new XSLTProcessor();
$xslProc->importStylesheet($xslDoc);

$xmlDoc = new DOMDocument();
$xmlRoot = $xmlDoc->appendChild($xmlDoc->createElement("results"));



$dba = new DBAccess($host, $db, $user, $pass);
$state = $_GET['state'];

$package = $dba->query_state($state);

// SOURCE HEADER: id,nameFirst,nameLast,address,city,st,zip,creditCard,balance
// DB HEADER: CustomerID, FirstName, LastName, Address, City, State, Zip, CreditCard, Balance
foreach($package as $row) {
    $rowtag = $xmlRoot->appendChild($xmlDoc->createElement("customer"));
    $rowtag->appendChild($xmlDoc->createAttribute("id"))->appendChild(
        $xmlDoc->createTextNode($row['CustomerID'])
    );
    $rowtag->appendChild($xmlDoc->createAttribute("nameFirst"))->appendChild(
        $xmlDoc->createTextNode($row['FirstName'])
    );
    $rowtag->appendChild($xmlDoc->createAttribute("nameLast"))->appendChild(
        $xmlDoc->createTextNode($row['LastName'])
    );
    $rowtag->appendChild($xmlDoc->createAttribute("address"))->appendChild(
        $xmlDoc->createTextNode($row['Address'])
    );
    $rowtag->appendChild($xmlDoc->createAttribute("city"))->appendChild(
        $xmlDoc->createTextNode($row['City'])
    );
    $rowtag->appendChild($xmlDoc->createAttribute("st"))->appendChild(
        $xmlDoc->createTextNode($row['State'])
    );
    $rowtag->appendChild($xmlDoc->createAttribute("zip"))->appendChild(
        $xmlDoc->createTextNode($row['Zip'])
    );
    $rowtag->appendChild($xmlDoc->createAttribute("creditCard"))->appendChild(
        $xmlDoc->createTextNode($row['CreditCard'])
    );
    $rowtag->appendChild($xmlDoc->createAttribute("balance"))->appendChild(
        $xmlDoc->createTextNode($row['Balance'])
    );
}

$xmlDoc->formatOutput = true;
$outDoc = $xslProc->transformToDoc($xmlDoc);
echo $outDoc->saveXML();

?>