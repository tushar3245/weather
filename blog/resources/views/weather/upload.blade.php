

<form action="{{ route('upload.csv') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="csv_file">Upload CSV File:</label>
    <input type="file" name="csv_file" id="csv_file">
    <button type="submit">Upload</button>
</form>
