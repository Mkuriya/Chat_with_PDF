<!DOCTYPE html>
<html>
<head>
    <title>Upload PDF</title>
</head>
<body>
    <form action="/upload-pdf" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="pdf" accept="application/pdf">
        <button type="submit">Upload PDF</button>
    </form>
</body>
</html>
