<!-- <!DOCTYPE html>
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
</html> -->



<!-- <!DOCTYPE html>
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
<body> -->
    <!-- <form action="{{ route('audio.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <button id="startRecording" type="button">Start Recording</button> -->
        
        <!-- <button id="stopRecording" style="display: none;">Stop Recording</button> -->
        <!-- <button id="stopRecording" style="display: none;" type="button">Stop Recording</button>

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
</html> -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Recording and Upload</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #startRecording {
            background-color: #28a745;
            color: white;
        }

        #stopRecording {
            background-color: #dc3545;
            color: white;
            display: none;
        }

        #uploadButton {
            background-color: #007bff;
            color: white;
            display: none;
        }

        #startRecording:hover {
            background-color: #218838;
        }

        #stopRecording:hover {
            background-color: #c82333;
        }

        #uploadButton:hover {
            background-color: #0069d9;
        }

        #timestamp {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Audio Recording Form</h1>
        <form action="{{ route('audio.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <button id="startRecording" type="button">Start Recording</button>
            <button id="stopRecording" type="button">Stop Recording</button>
            <input type="hidden" name="audio" id="audioBlob">
            <button type="submit" id="uploadButton">Upload Audio</button>
        </form>
        <div id="timestamp">00:00</div>
    </div>

    <script>
        let mediaRecorder;
        let recordedChunks = [];
        let startTime;
        let timerInterval;

        const startRecording = () => {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then(stream => {
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.ondataavailable = event => {
                        recordedChunks.push(event.data);
                    };
                    mediaRecorder.start();
                    startTime = new Date();
                    timerInterval = setInterval(updateTimestamp, 1000);
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
            clearInterval(timerInterval);
            document.getElementById('timestamp').textContent = "00:00";
            mediaRecorder.onstop = () => {
                const audioBlob = new Blob(recordedChunks, { type: 'audio/webm' });
                // const audioBlobURL = URL.createObjectURL(audioBlob);
                const formData = new FormData();
                formData.append('audio', audioBlob, 'recorded_audio.webm');

                fetch('{{ route('audio.upload') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Audio uploaded successfully.');
                    } else {
                        alert('Audio upload failed.');
                    }
                })
                // .catch(error => {
                //     console.error('Error:', error);
                //     alert('Audio upload failed.');
                // });

                // document.getElementById('audioBlob').value = audioBlob;
                document.getElementById('uploadButton').style.display = 'inline-block';
                document.getElementById('stopRecording').style.display = 'none';

                // console.log(audioBlobURL);
            };
        };

        const updateTimestamp = () => {
            const now = new Date();
            const elapsedTime = new Date(now - startTime);
            const minutes = String(elapsedTime.getUTCMinutes()).padStart(2, '0');
            const seconds = String(elapsedTime.getUTCSeconds()).padStart(2, '0');
            document.getElementById('timestamp').textContent = `${minutes}:${seconds}`;
        };

        document.getElementById('startRecording').addEventListener('click', startRecording);
        document.getElementById('stopRecording').addEventListener('click', stopRecording);
    </script>
</body>
</html>
