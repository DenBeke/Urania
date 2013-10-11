/*
Script for notifying site visitors with an older browsers.
This script includes all the other scripts/information from browser-update.org
*/

var $buoop = {vs:{i:8,f:15,o:0,s:4,n:9}}
$buoop.ol = window.onload; 
window.onload=function(){ 
 try {if ($buoop.ol) $buoop.ol();}catch (e) {} 
 var e = document.createElement("script"); 
 e.setAttribute("type", "text/javascript"); 
 e.setAttribute("src", "http://browser-update.org/update.js"); 
 document.body.appendChild(e); 
}