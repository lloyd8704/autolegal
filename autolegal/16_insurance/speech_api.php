<!DOCTYPE html>
<html>

<head>
    <title>Google Text to Speech API</title>
</head>

<body>
    <h1>Google Text to Speech API</h1>
    <p>Enter your text below and click the "Submit" button to synthesize it to speech.</p>
    <form action="/" method="post">
        <input type="text" name="text" />
        <input type="submit" value="Submit" />
    </form>

    <?php

    require __DIR__ . '../../vendor/google/auth/autoload.php';


    use Google\Cloud\TextToSpeech\V1\AudioConfig;
    use Google\Cloud\TextToSpeech\V1\SynthesisInput;
    use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

    use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;

    $client = new TextToSpeechClient();

    // Set the voice parameters.
    $voice = new VoiceSelectionParams();
    $voice->setLanguageCode('en-US');
    $voice->setSsmlGender(VoiceSelectionParams\SsmlGender::NEUTRAL);

    // Set the audio configuration.
    $audioConfig = new AudioConfig();
    $audioConfig->setAudioEncoding(AudioConfig\AudioEncoding::MP3);

    // Set the input text.
    $text = $_POST['text'];

    // Create a new synthesis input object.
    $synthesisInput = new SynthesisInput();
    $synthesisInput->setText($text);

    // Create a new synthesis request.
    $response = $client->synthesizeSpeech([
        'input' => $synthesisInput,
        'voice' => $voice,
        'audioConfig' => $audioConfig,
    ]);

    // Get the audio content from the response.
    $audioContent = $response->getAudioContent();

    // Play the audio.
    header('Content-Type: audio/mpeg');
    echo $audioContent;
    ?>

</body>

</html>