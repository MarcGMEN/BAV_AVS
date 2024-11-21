

<!-- <script async src="https://cse.google.com/cse.js?cx=b423b843faa5744b2">
</script>*/
<div class="gcse-search"></div> -->
<?
// Construction de la requête Google Custom Search
$libelles="bike scott spark 930";
$apiKey = 'AIzaSyABMdW__fbyBDjd0aBBCY_im7rejFftkDQ';
$cx = 'b423b843faa5744b2';
$url = 'https://www.googleapis.com/customsearch/v1?key=' . $apiKey . '&cx=' . $cx . '&q=' . urlencode($libelles);

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $response = curl_exec($ch);
// curl_close($ch);
// print_r($response);


$fp = fopen($url, 'r');
$res= file_get_contents($url);
$results = json_decode($res, true);
$cpt=0;
foreach ($results['items'] as $item) {
    if ($cpt > 10) {
        break;
    }
    if (isset($item['pagemap']['cse_thumbnail']) && isset($item['pagemap']['cse_thumbnail'][0]['src'])) {
        echo '<img src="' . $item['pagemap']['cse_thumbnail'][0]['src'] . '">'; 
        $cpt++;
    }
}
// // Envoi de la requête et récupération des résultats
// $client = new GuzzleHttp\Client();
// $response = $client->request('GET', $url);
// $results = json_decode($response->getBody(), true);

// Affichage des résultats (exemple simplifié)
