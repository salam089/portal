<html>
<head>
    <title>HMVC architect with php 5.6 </title>
 <script>
        var ajax = {'url':"<?php echo site_url(). AJAX_SLUG; ?>"};
    </script>
</head>
<body>

<h1>HMVC architect with php 5.6</h1>
<div>Click the button below to get response.</div>

<!-- our form -->
<input type='button' value='Post JSON' id='postJson' />

<!-- where the response will be displayed -->
<div id='response'></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js "></script>
<script src="<?php echo site_url().'templates/assets/js/main.js'?>"></script>
<script>

</script>

</body>
</html>