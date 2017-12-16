
#get args


$word = $args[0]
write-host $word

#make tts and save to wav
Add-Type -AssemblyName System.speech
$speak = New-Object System.Speech.Synthesis.SpeechSynthesizer
$speak.SelectVoice('Microsoft Hedda Desktop')
$speak | Get-Member

$speak.SetOutputToWaveFile("C:\xampp\htdocs\Dropbox\audio-de\$word.wav")
$speak.Speak($word)
$speak.Dispose()



