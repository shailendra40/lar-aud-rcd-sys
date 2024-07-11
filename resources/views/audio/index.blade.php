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
</html>
