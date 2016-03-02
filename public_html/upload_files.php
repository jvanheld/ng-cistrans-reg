<?php

session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/

?>

<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test upload</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/function.js"></script>
    <!-- plugin jQuery -->
    <script type="text/javascript" src="jQuery/uploadify/jquery.uploadify.min.js"></script>
    <!-- CSS -->
<!--    <link rel="stylesheet" type="text/css" href="css/mise_en_page.css">-->
    <link rel="stylesheet" type="text/css" href="css/uploadify.css" />
</head>
<body>
    <h1>Test upload files with uploadify</h1>


    <input type="file" name="file_upload" id="file_upload" />
    <a href="javascript:$('#file_upload').uploadify('upload','*')">Upload Files</a>

    <script type="text/javascript">
        $(function() {
            $('#file_upload').uploadify({
                'method': 'post',
                'auto'     : false,
                'swf'      : 'uploadify.swf',
                'uploader' : 'uploadify.php',
                'multi'          : true,
                'onUploadStart' : function() {
                    $('#file_upload').uploadify('settings', 'formData', {
                        'target-project': '<?php echo $_SESSION["project"]?>'
                    });
                }})


            ;


        });

    </script>



</body>
</html>