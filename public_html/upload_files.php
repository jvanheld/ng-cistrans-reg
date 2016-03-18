<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
?>

<!DOCTYPE html>
<html>
<head>
    <!-- META -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>NG-cistrans-reg Project</title>

    <script type="text/javascript" src="jQuery/jquery-1.12.0.js"></script>
    <script type="text/javascript" src="js/NGcistrans_functions.js"></script>
    <!-- plugin jQuery -->
    <script type="text/javascript" src="jQuery/uploadify/jquery.uploadify.min.js"></script>
    <!-- CSS -->
<!--    <link rel="stylesheet" type="text/css" href="css/mise_en_page.css">-->
    <link rel="stylesheet" type="text/css" href="css/uploadify.css" />
</head>
<body>
    <h1>Upload files in the <?php echo $_SESSION["project"]?> project</h1>
    <div class="home-div">
        <button onclick="window.location = 'index.php';"><img src="jQuery/img/home.png" alt="Home" height="42" width="42"></button>
    </div>

    <input type="file" name="file_upload" id="file_upload" />
    <br>
    <a href="javascript:$('#file_upload').uploadify('upload','*')">Upload Files</a>

    <script type="text/javascript">
        $(function() {
            $('#file_upload').uploadify({
                'buttonText':'Select files to upload',
                'method': 'post',
                'auto'     : false,
                'swf'      : 'uploadify.swf',
                'uploader' : 'uploadify.php',
                'fileTypeExts':'*.bam',
                'simUploadLimit' :0,
                'onUploadStart' : function() {
                    $('#file_upload').uploadify('settings', 'formData', {
                        'target-project': '<?php echo $_SESSION["path_project"]?>'
                    });
                }})
            ;
        });

    </script>

</body>
</html>