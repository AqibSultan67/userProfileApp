<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
        .container {
            max-width: 700px;
            margin-top: 50px;
        }
        .details-container {
            padding: 30px;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .profile-image-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-image-container img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .btn-container a,
        .btn-container button {
            flex: 1;
            margin: 0 5px;
            font-size: 16px;
            border-radius: 5px;
        }
        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #007bff;
        }
        p {
            margin: 0 0 10px;
        }
        .no-data-message {
            text-align: center;
            font-size: 24px;
            color: #999;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="details-container">
            @if (isset($noData) && $noData)
                <p class="no-data-message">No Data Available</p>
            @else
                <h1 class="text-center">Submission Details</h1>
                <div class="profile-image-container">
                    @if ($submission->profile_image)
                        <img src="{{ asset('storage/' . $submission->profile_image) }}" alt="Profile Image" class="img-fluid">
                    @endif
                    <div>
                        <p><strong>Name:</strong> {{ $submission->name }}</p>
                        <p><strong>Contact:</strong> {{ $submission->contact }}</p>
                    </div>
                </div>
                @if ($submission->file)
                    <div class="btn-container">

                        <a href="{{ asset('storage/' . $submission->file) }}" class="btn btn-primary" target="_blank">View Uploaded File</a>
                        @endif
                        <a href="{{ route('submission.edit', $submission->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('submission.destroy', $submission->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>

            @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
