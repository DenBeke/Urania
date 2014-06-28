<?php 
/*
Basic functions for Urania CMS

Author: Mathias Beke
Url: http://denbeke.be
Date: March 2013
*/


/**
Simplify a file name to store the file on the disk

@param file name
@return string
*/
function simplifyFileName($fileName) {
		$table = array(
			'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
			'ă' => 'a', 'ā' => 'a', 'ą' => 'a', 'æ' => 'a', 'ǽ' => 'a', 'þ' => 'b',
			'ç' => 'c', 'č' => 'c', 'ć' => 'c', 'ĉ' => 'c', 'ċ' => 'c', 'ż' => 'z',
			'đ' => 'd', 'ď' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
			'ĕ' => 'e', 'ē' => 'e', 'ę' => 'e', 'ė' => 'e', 'ĝ' => 'g', 'ğ' => 'g',
			'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h', 'ħ' => 'h', 'ì' => 'i', 'í' => 'i',
			'î' => 'i', 'ï' => 'i', 'į' => 'i', 'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i',
			'ı' => 'i', 'ĵ' => 'j', 'ķ' => 'k', 'ĸ' => 'k', 'ĺ' => 'l', 'ļ' => 'l',
			'ľ' => 'l', 'ŀ' => 'l', 'ł' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n',
			'ņ' => 'n', 'ŋ' => 'n', 'ŉ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o',
			'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ō' => 'o', 'ŏ' => 'o', 'ő' => 'o',
			'œ' => 'o', 'ð' => 'o', 'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's',
			'ŝ' => 's', 'ś' => 's', 'ş' => 's', 'ŧ' => 't', 'ţ' => 't', 'ť' => 't',
			'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ũ' => 'u', 'ū' => 'u',
			'ŭ' => 'u', 'ů' => 'u', 'ű' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ẁ' => 'w',
			'ẃ' => 'w', 'ẅ' => 'w', 'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y', 'ž' => 'z',
			'ź' => 'z',
		);
		// We don't deal with uppercase characters
		$fileName = strtolower($fileName);
		// Strip accents
		$fileName = strtr($fileName, $table);
		// Non-alphanumericals characters become spaces
		$fileName = preg_replace('/[^a-z0-9.]/', ' ', $fileName);
		// Remove trailing and ending spaces
		$fileName = trim($fileName);
		// Spaces become -
		$fileName = preg_replace('#\s+#', '-', $fileName);
		return $fileName;
}



?>