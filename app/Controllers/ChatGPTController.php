<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ChatGPTController extends BaseController
{   
    
    public function index()
    {
        
        $data['response'] = '';
        if ($this->request->getMethod() === 'post') {
             
             $userMessage = $this->request->getPost('message');

              $apiKey = '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';
            // Data to be sent in the POST request
           $apiUrl = 'https://api.openai.com/v1/engines/davinci/completions';

            // Data to be sent in the POST request
            $data = array(
               // 'model' => 'davinci', // The model/engine to use (e.g., davinci for GPT-3)
                'prompt' => $userMessage,
                'max_tokens' => 150
            ); 
            // Convert data to JSON format
            $dataJson = json_encode($data);
            
            // Initialize cURL session
            $ch = curl_init();
            
            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json'
            ));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
            
            // Execute cURL request and get the response
            $response = curl_exec($ch);
            
            // Check for cURL errors
            if (curl_errno($ch)) {
                echo 'cURL error: ' . curl_error($ch);
            }
            
            // Close cURL session
            curl_close($ch);
            $responseData = json_decode($response, true);

                // Handle the response data as needed
                // For example, you can access the AI's response as follows:
                if (isset($responseData['choices'][0]['text'])) {
                    $aiResponse = $responseData['choices'][0]['text'];
                    echo 'ChatGPT AI response: ' . $aiResponse;
                } else {
                    echo 'Failed to get AI response.';
                }
             exit;     
            
        }
         
         
        return view('chatgpt_view', $data);
    }
    
     public function testpost()
    {
        // Test POST request logic goes here
        // You can process any data or make API requests for testing

        // For demonstration purposes, we will just output a message
        echo 'Custom link for testing POST request clicked!';
    }
}
?>
