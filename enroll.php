<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = "https://ctengg.amu.ac.in/web/reg_record_even.php";
$url_pdf = "file:///home/anas16/Downloads/GL3172-3.pdf";

$html = file_get_contents( $url);
echo $html;
if($html)
		{

			libxml_use_internal_errors( true);
			$doc = new DOMDocument();
			$doc->loadHTML( $html);
							
            //echo $doc;
			//$titles = $doc->getElementById('qlook');	
            $titles = $doc->getElementsByTagName('form input');

			$node = $titles->item(0);
			$n = $titles->length;
			echo $n;
			//echo $node->lastChild;
			//echo "{$node->nodeName} - {$node->nodeValue}";
			
			//$weather = $titles->nodeValue;
			
								
			//$length = strlen($weather);
		
			
		}
?>