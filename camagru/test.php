<?php
session_start();

$user = array(
	'username' => 'Lewis',
	'age' => '22',
	'bio' => "J\'aime la photo et le css!",
	'city' => 'Paris',
	'pp' => 'img/pp.jpg',
	'photos' => array('img/pic6.jpg', 
	'img/pic3.jpg', 
	'img/pic4.jpg', 
	'img/pic2.jpg',
	'img/pic5.jpg',
	'img/pic1.jpg'),
);
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile</title>
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" type="text/css" href="fonts/fonts.min.css" />
	</head>

	<body>
		<div class="content">
		<div class="profile">

            <?php if (file_exists('./images/profil/' . $_SESSION['username'] . '.png')): ?>
            <button>
            <label for="files">
            <img id="pp" class="pp" src='<?php echo './images/profil/' . $_SESSION['username'] . '.png' ?>' />
			</label></button>
            <?php else: ?>
                <img id="pp" class="pp" src='' />
            <?php endif; ?>
            <input id="files" style="visibility:hidden;" type="file" accept=".png" onchange="loadFile(event)">



            <form  id="settings" class="settings" method="post"action="index.php">
                    <input type="submit" value="Faire un montage">
            </form>
			<p id="usernameandage"><?php echo $_SESSION['username']?></p>
			<p id="city">none</p>
			<p class="bio" id="bio">none</p>
		</div>
		<div class="gallerycontainer">
			<div id="gallery" class='gallery'>
                <?php
                    session_start();
                    $files = glob('./images/montages/' . $_SESSION['username'] . '*.{jpg,png}', GLOB_BRACE);
                    natsort($files);
                    foreach (array_reverse($files) as $image){
                        echo '<img src="'. $image .'" class="pics"/>';
                    }
                ?>
			</div>
		</div>
		</div>
	</body>
       
</html>