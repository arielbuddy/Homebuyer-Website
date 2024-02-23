<?php
/* vertex_search: search term using Vertex AI */

// Include WordPress
include_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
include_once __DIR__ . '/vendor/autoload.php';

$GOOGLE_CLIENT_ID = "401503345865-dmr7pi5jbe3sd1f3bdpu84tkmu55osk3.apps.googleusercontent.com";
$GOOGLE_CLIENT_SECRET = "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";
$GOOGLE_REFRESH_TOKEN =  "1//04WUzd4x8VTmMCgYIARAAGAQSNwF-L9IrxZm9yz_vKPMOmTDB4EpiTleaimSh8d4X3UMm48EbwXbsu0nKxa4w7EDuMzEenj1UF-U";
$GOOGLE_ACCESS_TOKEN =  "ya29.a0AfB_byAEB0mztVX0PEyE3jb1FusUDmb9NahApehG76BsxLVqHsedtPp6dneNtIHP6P-h5ZtJvH0Gss6bpnYU52KZc1qsFYPK4ZTjMP2ih9gJcS6ImyMROaDEvbBYUHqsl5NcBG7izULgtN7zgXb3xQ04dbvBdlIytKSCaCgYKAe8SARASFQHGX2MijwOuGJZYJgF_6x59Y7WMPw0171";
$GOOGLE_PROJECT_ID = "programmable-sea-1704140431235";
$GOOGLE_MODEL_URL = 'https://discoveryengine.googleapis.com/v1alpha/projects/401503345865/locations/global/collections/default_collection/dataStores/homebuyer-public-urls_1704149914502/servingConfigs/default_search:search';

function refresh_token($client_id, $client_secret, $refresh_token)
{
    $token_url = 'https://oauth2.googleapis.com/token';
    $data = [
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'refresh_token' => $refresh_token,
        'grant_type' => 'refresh_token',
    ];

    $headers = array('');
    
    $response = make_curl_request($token_url, 'POST', http_build_query($data), $headers);

    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        update_access_token($token_data['access_token']);
    } else {
        handle_error('Error refreshing access token', $token_data);
    }
}

function make_curl_request($url, $method, $data, $headers)
{
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => ($method == 'POST'),
        CURLOPT_POSTFIELDS => ($method == 'POST') ? $data : null,
        CURLOPT_HTTPHEADER => $headers,
    ]);
    
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        handle_error('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);

    return $response;
}

function get_google_vertex_search_model_result($searchText, $accessToken, $modelUrl)
{
    if ($accessToken === null) {
        handle_error('Unauthorized');
    }

    $data = '{
        "query": "' . $searchText . '",
        "pageSize": 10,
        "queryExpansionSpec": {
            "condition": "AUTO"
        },
        "spellCorrectionSpec": {
            "mode": "AUTO"
        },
        "contentSearchSpec": {
            "snippetSpec": {
                "returnSnippet": true
            }
        }
    }';

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken,
    );

    return make_curl_request($modelUrl, 'POST', $data, $headers);
}


function get_google_vertex_search_model_nextResult($searchText, $accessToken, $modelUrl, $nextPageToken)
{
    if ($accessToken === null) {
        handle_error('Unauthorized');
    }

    $data = '{
        "query": "' . $searchText . '",
        "pageSize": 10,
        "queryExpansionSpec": {
            "condition": "AUTO"
        },
        "spellCorrectionSpec": {
            "mode": "AUTO"
        },
        "contentSearchSpec": {
            "snippetSpec": {
                "returnSnippet": true
            }
        },
        "pageToken": "'.$nextPageToken.'",
    }';

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken,
    );

    return make_curl_request($modelUrl, 'POST', $data, $headers);
}

function handle_error($message, $data = null)
{
    echo $message . PHP_EOL;
    if ($data) {
        print_r($data);
    }
    exit;
}

function make_vertex_ai_api_request($searchText, $accessToken, $modelUrl)
{
    try {
        $allResponses = [];
        $nextPageToken = null;

        // Make the API request for the current page
        $currentResponse = get_google_vertex_search_model_result($searchText, $accessToken, $modelUrl);

        $allResponses[] = $currentResponse;

        // Check if the current response indicates an expired access token
        $responseArray = json_decode($currentResponse, true);
        if (isset($responseArray['error']['status']) && $responseArray['error']['status'] === 'UNAUTHENTICATED') {
            // Access token may be expired, try refreshing it
            $allResponses = [];
            global $GOOGLE_CLIENT_ID, $GOOGLE_CLIENT_SECRET, $GOOGLE_REFRESH_TOKEN, $GOOGLE_ACCESS_TOKEN;
            refresh_token($GOOGLE_CLIENT_ID, $GOOGLE_CLIENT_SECRET, $GOOGLE_REFRESH_TOKEN);

            // Retry the API request with the new access token
            $accessToken = $GOOGLE_ACCESS_TOKEN;
            $currentResponse = get_google_vertex_search_model_result($searchText, $accessToken, $modelUrl);
            $allResponses[] = $currentResponse;
        }

//        do {
            // Get the next page token from the current response
            $nextPageToken = isset($responseArray['nextPageToken']) ? $responseArray['nextPageToken'] : null;
            echo $nextPageToken;
            // If there is a next page token, make the request for the next page
            if ($nextPageToken) {
                $currentResponse = get_google_vertex_search_model_nextresult($searchText, $accessToken, $modelUrl, $nextPageToken);
            }
            $allResponses[] = $currentResponse;
//       } while ($nextPageToken);

        return $allResponses;
    } catch (Exception $e) {
        handle_error('Error in API request: ' . $e->getMessage());
    }
}

function update_access_token(&$accessToken)
{
    // Update the global variable or perform any other action needed
    global $GOOGLE_ACCESS_TOKEN;
    $GOOGLE_ACCESS_TOKEN = $accessToken;
}

function make_hb_card_from_URL ($url) {
    // Check if the URL is valid and belongs to a post in the site
    $post_id = url_to_postid($url);

    if (!$post_id) {
        return 'Invalid URL or post not found.';
    }

    // Get the post object
    $post = get_post($post_id);

    // Get the post thumbnail URL
    $thumbnail = get_the_post_thumbnail_url($post_id);

    // Get the post category
    $categories = get_the_category($post_id);
    $category = $categories[0]->name;

    // Get the reading time using the custom function
    $ttr = hb_get_reading_time(get_post_field('post_content', $post_id));

    // Get the post title
    $title = get_the_title($post_id);

    // Get the post excerpt
    $excerpt = get_the_excerpt($post_id);

    return [
        'url' => $url,
        'thumbnail' => $thumbnail,
        'category' => $category,
        'ttr' => $ttr,
        'title' => $title,
        'excerpt' => $excerpt,
    ];
} 


$client = new Google\Client();
$client->setAuthConfig('client_credentials.json');

$client->addScope('https://www.googleapis.com/auth/cloud-platform');

$client->setRedirectUri('https://homebuyer.com');

// In your redirect callback
$code = $_GET['code'];

// Exchange authorization code for access token
$accessToken = $client->fetchAccessTokenWithAuthCode($code);

echo $accessToken;
// Now you can use $accessToken to make API requests


// $client->setSubject("luke2hallguy@gmail.com");

// if (isset($_GET['code'])) {
//        $token = $client->fetchAccessTokenWithAuthCode($_GET['code'], $_SESSION['code_verifier']);
//        echo 'token';
//         echo $token;
// }

// Example usage:
$responses = make_vertex_ai_api_request("loan to value", $GOOGLE_ACCESS_TOKEN, $GOOGLE_MODEL_URL);

// Print or process the responses as needed
//print_r($responses);

// Initialize an empty array to store links
$links = [];

// Iterate through the response array
foreach ($responses as $response) {
    
    $someArray = json_decode($response, true);
    //print_r($someArray['results']);
    foreach ($someArray['results'] as $subResponse) {

        // Check if the expected structure exists
        if (isset($subResponse['document']['derivedStructData']['link'])) {
            // Add the link to the links array
            $links[] = $subResponse['document']['derivedStructData']['link'];
        }
    }
}

//print_r($links);

foreach ($links as $link) {
    echo $link;
    $result = make_hb_card_from_URL($link);
    print_r($result);    
}


