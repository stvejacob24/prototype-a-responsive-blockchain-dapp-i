<?php

// isr5_prototype_a_res.php

// Blockchain API connection setup
$blockchain_api_url = 'https://api.example.com/blockchain';
$blockchain_api_key = 'your_api_key_here';

// dApp integrator class
class dAppIntegrator {
  private $blockchain_api_url;
  private $blockchain_api_key;

  public function __construct($blockchain_api_url, $blockchain_api_key) {
    $this->blockchain_api_url = $blockchain_api_url;
    $this->blockchain_api_key = $blockchain_api_key;
  }

  // Function to connect to blockchain API
  public function connectToBlockchain() {
    $headers = array(
      'Content-Type: application/json',
      'Authorization: Bearer ' . $this->blockchain_api_key
    );
    $ch = curl_init($this->blockchain_api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode($result, true);
  }

  // Function to get user's blockchain data
  public function getUserData($user_id) {
    $response = $this->connectToBlockchain();
    if ($response['status'] == 'success') {
      $user_data = $response['data'][$user_id];
      return $user_data;
    } else {
      return 'Error: ' . $response['error'];
    }
  }
}

// Test case: Get user data using dApp integrator
$dapp_integrator = new dAppIntegrator($blockchain_api_url, $blockchain_api_key);
$user_id = 'user123';
$user_data = $dapp_integrator->getUserData($user_id);

echo '<h1>User Data:</h1>';
echo '<pre>';
print_r($user_data);
echo '</pre>';

?>