

<!-- <script async src="https://cse.google.com/cse.js?cx=b423b843faa5744b2">
</script>*/
<div class="gcse-search"></div> -->
<?
// Construction de la requête Google Custom Search
$libelles="scott spark 930";
$apiKey = 'AIzaSyABMdW__fbyBDjd0aBBCY_im7rejFftkDQ';
$cx = 'b423b843faa5744b2';
$url = 'https://www.googleapis.com/customsearch/v1?key=' . $apiKey . '&cx=' . $cx . '&q=' . urlencode($libelles);

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $response = curl_exec($ch);
// curl_close($ch);
// print_r($response);


$fp = fopen($url, 'r');

$meta_data = stream_get_meta_data($fp);
foreach ($meta_data['wrapper_data'] as $response) {

    /* Avons-nous été redirigés ? */
    if (strtolower(substr($response, 0, 10)) == 'location: ') {

        /* mise à jour de $url avec le chemin après redirection */
        $url = substr($response, 10);
    }

}
// // Envoi de la requête et récupération des résultats
// $client = new GuzzleHttp\Client();
// $response = $client->request('GET', $url);
// $results = json_decode($response->getBody(), true);

// Affichage des résultats (exemple simplifié)
// foreach ($results['items'] as $item) {
    // echo '<img src="' . $item['link'] . '">';
// }
