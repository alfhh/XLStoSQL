<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 5/2/15
 * Time: 12:19 PM
 */

?>
<html>
<head>
    <title>
       XLS to SQL
    </title>

    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
    <script>

        function myfunction(){

            var file_data = $('#xls').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $.ajax({
                url: 'fileHandler.php', // point to server-side PHP script
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(respuesta){

                    $("div").html( "<h3>" + respuesta + "</h3>");
                }
            });


        }

    </script>
</head>
<body>
<h1>XLS to SQL</h1>


<input id="xls" type="file" name="files" />
<button id="upload" onclick="myfunction()">Upload</button>


</form>

<div id="result1"></div>
</body>

</html>

