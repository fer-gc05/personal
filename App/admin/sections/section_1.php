<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M</title>
    <link rel="stylesheet" href="../styles/header_stely.css">
    <link rel="stylesheet" href="../styles/main_stely.css">
    <link rel="stylesheet" href="../../libreries/bootstrap/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>


    <script src="../../libreries/bootstrap/bootstrap.min.js"></script>
    <script src="../../libreries/jquery/jquery-3.7.1.min.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });
    </script>
</body>

</html>