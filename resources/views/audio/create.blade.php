<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Recording Form</title>
    <style>
        /* Basic CSS for button styling */
        button {
            padding: 10px 20px;
            font-size: 16px;
            margin-bottom: 10px;
        }
        /* Hide upload button initially */
        #uploadButton {
            display: none;
        }
    </style>
</head>
<body>
    <form action="{{ route('audio.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <button id="startRecording">Start Recording</button>
        <button id="stopRecording" style="display: none;">Stop Recording</button>
        <input type="hidden" name="audio" id="audioBlob">
        <button type="submit" id="uploadButton">Upload Audio</button>
    </form>

    <script>
        let mediaRecorder;
        let recordedChunks = [];

        const startRecording = () => {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then(stream => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.ondataavailable = event => {
                        recordedChunks.push(event.data);
                    };
                    mediaRecorder.start();
                    document.getElementById('startRecording').style.display = 'none';
                    document.getElementById('stopRecording').style.display = 'inline-block';
                })
                .catch(err => {
                    console.error('Error accessing microphone:', err);
                    alert('Please allow microphone access to use this feature.');
                });
        };

        const stopRecording = () => {
            mediaRecorder.stop();
            mediaRecorder.onstop = () => {
                const audioBlob = new Blob(recordedChunks, { type: 'audio/webm' });
                document.getElementById('audioBlob').value = audioBlob;
                document.getElementById('uploadButton').style.display = 'block';
            };
        };

        document.getElementById('startRecording').addEventListener('click', startRecording);
        document.getElementById('stopRecording').addEventListener('click', stopRecording);
    </script>
</body>
</html>
