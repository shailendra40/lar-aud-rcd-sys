<!-- <!DOCTYPE html>
<html>
<head>
    <title>Laravel Audio Upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Laravel Audio Upload</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                    <audio controls>
                        <source src="{{ asset('storage/audio/' . Session::get('audio')) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @endif
                <form action="{{ route('audio.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="audio">Choose Audio File:</label>
                        <input type="file" name="audio" class="form-control">
                        @error('audio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html> -->



<!DOCTYPE html>
<html>
<head>
    <title>Laravel Audio Upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Laravel Audio Upload</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>{{ $message }}</strong>
                    </div>
                    <audio controls>
                        <source src="{{ asset('storage/audio/' . Session::get('audio')) }}" type="audio/{{ pathinfo(Session::get('audio'), PATHINFO_EXTENSION) }}">
                        Your browser does not support the audio element.
                    </audio>
                @endif
                <form action="{{ route('audio.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="audio">Choose Audio File:</label>
                        <input type="file" name="audio" class="form-control" required>
                        @error('audio')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>

                <h4>Uploaded Audios</h4>
                @foreach($audios as $audio)
                    <div class="audio-player">
                        <audio controls class="uploaded-audio">
                            <source src="{{ asset('storage/audio/' . $audio->file_name) }}" type="audio/{{ pathinfo($audio->file_name, PATHINFO_EXTENSION) }}">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endforeach
                @if($audios->isEmpty())
                    <p>No audios uploaded yet.</p>
                @endif

                <a href="{{ route('audio.create') }}" class="btn btn-success mt-3">Create New Audio Record</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const audioPlayers = document.querySelectorAll('.uploaded-audio');

            audioPlayers.forEach(function(player) {
                let isDragging = false;

                player.addEventListener('timeupdate', function() {
                    if (!isDragging) {
                        const progressBar = player.nextElementSibling;
                        const progress = (player.currentTime / player.duration) * 100;
                        progressBar.value = progress;
                    }
                });

                player.addEventListener('click', function(event) {
                    if (event.target.tagName.toLowerCase() === 'audio') {
                        const rect = player.getBoundingClientRect();
                        const clickX = event.clientX - rect.left;
                        const width = rect.width;
                        const duration = player.duration;
                        const clickTime = (clickX / width) * duration;

                        player.currentTime = clickTime;
                    }
                });

                player.nextElementSibling.addEventListener('mousedown', function() {
                    isDragging = true;
                });

                player.nextElementSibling.addEventListener('mouseup', function() {
                    isDragging = false;
                });
            });
        });
    </script>
</body>
</html>
