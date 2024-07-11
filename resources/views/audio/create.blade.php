<form action="{{ route('audio.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <button id="startRecording">Start Recording</button>
    <button id="stopRecording" style="display: none;">Stop Recording</button>
    <input type="hidden" name="audio" id="audioBlob">
    <button type="submit" id="uploadButton" style="display: none;">Upload Audio</button>
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
            });
    };

    const stopRecording = () => {
        mediaRecorder.stop();
        mediaRecorder.onstop = () => {
            const audioBlob = new Blob(recordedChunks, { type: 'audio/webm' });
            const formData = new FormData();
            formData.append('audio', audioBlob);
            document.getElementById('audioBlob').value = audioBlob;
            document.getElementById('uploadButton').style.display = 'block';
        };
    };

    document.getElementById('startRecording').addEventListener('click', startRecording);
    document.getElementById('stopRecording').addEventListener('click', stopRecording);
</script>
