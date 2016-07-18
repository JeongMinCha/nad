<?php
	require_once('display_fns.php');
	require_once('server_list_fns.php');
	session_start();

	do_html_header('Add FTP Server Success!');

	$success = add_server ($_POST['servername'], $_POST['username'], $_POST['passwd'], $_POST['ip'], $_POST['port']);
	if ($success === true){
		display_add_success ();
	} else {
		display_add_fail ();
	}
	do_html_URL('member.php', 'Home');
	do_html_footer();
?>
