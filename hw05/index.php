<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
    </head>
    <body>
        <h1>Customer Data Upload</h1>
        <span>Please upload a suitable 'customers.txt' document.</span>
        <form enctype="multipart/form-data" id="uploadform" action="post.php" method="POST">

            <label>Customer Data File</label><br />
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
            <input type="file" id="fileupload" name="uploadfile" required>
            <button name="btnsubmit" type="submit">Submit</button>

        </form>
    </body>
</html>
