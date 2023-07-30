<!DOCTYPE html>
<html>
<head>
    <title>ChatGPT API Integration</title>
    <style>
       body {
        font-family: Arial, sans-serif;
        background-color: #cfffef;
        color: #333;
        margin: 0;
        padding: 0;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #4caf50;
            color: white;
        }

        #container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-size: 18px;
            margin-bottom: 10px;
            color: #4caf50;
        }

        input[type="text"] {
            width: 96%;
            padding: 11px;
            font-size: 16px;
            border: 1px solid #319931;
            border-radius: 16px;
            margin-bottom: 22px;
            /* float: right; */
        }

        button {
            background-color: white;
            color: #4caf50;
            padding: 3px 16px;
            font-size: 15px;
            border: 2px solid #4caf50;
            border-radius: 17px;
            cursor: pointer;
            transition: background-color 0.3s;
            /* float: right; */
            /* margin-bottom: 80px; */
        }

        button:hover {
            background: linear-gradient(345deg, #4caf50, transparent);
            color: ghostwhite;
        }

        #responseContainer {
            margin-top: 20px;
            /* padding: 10px; */
            background-color: black;
            border: 3px solid #4caf50;
            border-radius: 9px;
            height: auto;
            padding: 10px;
        }

        textarea {
            width: 100%;
            height: 100%;
            border: none;
            resize: vertical;
            background: black;
            font-size: 17px;
            color: white;
            line-height: 29px;
            font-style: italic;
            text-transform: capitalize;
            padding: 10px 0px;
        }
        
        #loadingmsg {
        float: right;
        font-size: 11px;
        color: darkgreen;
        font-style: italic;
        }

    </style>
</head>
<body>
    <h1>ChatGPT API Integration</h1>
    <div id="container">
        <label for="message">Your Message:</label>
        <input type="text" name="message" id="message" required>
        <button type="button" id="sendButton">Send</button>
         <div id="loadingmsg" style="display: none;"> Wait while we get your response</div>
            
            <div id="responseContainer">
               <h2>ChatGPT Response:</h2>
                <textarea rows="8" cols="50"><?= $response; ?></textarea>
            </div>
        </div>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Add custom JavaScript for AJAX request -->
    <script>
        $(document).ready(function() {
            // Handle button click event
            $('#sendButton').click(function() {
                // Get user message
                var userMessage = $('#message').val();
            
                // Make AJAX POST request
                $.ajax({
                    url: '<?php base_url('public/chatgpt'); ?>',
                    type: 'POST',
                    data: { message: userMessage },
                    dataType: 'html',
                     beforeSend: function() {
                        // This function is executed before the AJAX request is sent.
                        // You can perform tasks here, such as showing a loading spinner.
                        $('#loadingmsg').show();
                    },
                    success: function(response) {
                        $('#message').val(''); // Clear the input field
                        $('#responseContainer').html('<textarea rows="8" cols="50">' + response + '</textarea>');
                        $('#loadingmsg').hide();
                        console.log('test');
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX request error:', error);
                    }
                });
            });
        });
    </script>
</body>
</html>
