<?php

function perform_query($db_conection, $db_query)
{
	if ($db_conection->connect_error)
	{
		die("Connection error");
	}
	else
	{
		
	}

	$result = $db_conection->query($db_query);

	return $result;	
}

function extractKeyWords($string, $stopwords) {
  mb_internal_encoding('UTF-8');
  $string = preg_replace('/[\pP]/u', '', trim(preg_replace('/\s\s+/iu', '', mb_strtolower($string))));
  $matchWords = array_filter(explode(' ',$string) , function ($item) use ($stopwords) { return !($item == '' || in_array($item, $stopwords) || mb_strlen($item) <= 2 || is_numeric($item));});
  $wordCountArr = array_count_values($matchWords);
  arsort($wordCountArr);
  return array_keys(array_slice($wordCountArr, 0, 10));
}

?>