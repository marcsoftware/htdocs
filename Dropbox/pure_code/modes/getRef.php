<?php
//
$chapterID=$_GET["ch"];
$elementID=$_GET["el"];

//$content =  file_get_contents($chapterID);

$dochtml = new DOMDocument();
//libxml_use_internal_errors(true);
$dochtml->loadHTMLFile($chapterID);


//getparent()
//$div = $dochtml->getElementById($elementID)->parentNode->nodeValue;
//echo $div;


function getInnerHTML( $node ) { 
    $innerHTML= ''; 
    $children = $node->childNodes; 
    foreach ($children as $child) { 
        $innerHTML .= $child->ownerDocument->saveXML( $child ); 
    } 

    return $innerHTML;  

}

function getHTML($e) {
     $doc = new DOMDocument();
     $doc->appendChild($doc->importNode($e, true));
     return $doc->saveHTML();
}

$div = $dochtml->getElementById($elementID);
if(!$div){
	echo "ERROR: element with id=$elementID does not exsist ";

}
echo getHTML( $div);
