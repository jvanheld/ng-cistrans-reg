<?php
session_start();
/*session is started if you don't write this line can't use $_Session  global variable*/
?>

<h2>Upload files </h2>
<!-- plugin jQuery -->
<script type="text/javascript" src="jQuery/uploadify/jquery.uploadify.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/uploadify.css" />

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
                    'target-project': '<?php echo $_SESSION["path_project"]?>',
                    'name-project' : '<?php echo $_SESSION["project"]?>'
                });
            }})
        ;


    });

</script>

