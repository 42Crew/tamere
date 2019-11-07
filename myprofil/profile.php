<?php
    session_start();
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<div class="content">
		<div class="profile">
			<p id="usernameandage"><?php echo $_SESSION['username']?></p>
            <form  id="settings" class="settings" method="post"action="./index.php">
                    <input type="submit" value="Faire un montage">
            </form>
            <button id="loadcam" onclick="loadcam()">Parametres</button>
		</div>
		<div class="gallerycontainer">
			<div id="gallery" class='gallery'>
                <?php
                    session_start();
                    $files = glob('../images/montages/' . $_SESSION['flag'] . '[0-9].{jpg,png}', GLOB_BRACE);
                    natsort($files);
                    foreach (array_reverse($files) as $image){
                        echo '<img src="'. $image .'" class="pics"/>';
                    }
                ?>
			</div>
		</div>
		</div>

    <script>
        function loadcam(image)
        {
            window.parent.loadcam(); // On appelle ici notre fonction de callback
        }
    </script>
	</body>
       
</html>