<?php
	require_once 'config.php';

	echo "<a href='https://oauth.vk.com/authorize?"."
					client_id=".VK['application_id'].
          "&redirect_uri=".VK['base_domain'].
          "&display=page".
					"&scope=".VK['scopes'].
          "&response_type=token&v=".VK['version'].
					"'>Получить токен</a>";

?>
