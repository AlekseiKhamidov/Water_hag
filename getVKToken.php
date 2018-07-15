<?php
	require_once 'config.php';

	echo "<a href='https://oauth.vk.com/authorize?client_id=".VK_APP_ID."&redirect_uri=".VK_BASE_DOMAIN."&display=page&scope=".VK_SCOPES."&response_type=token&v=5.74'>Получить токен</a>";

?>

