<?php
function show($index){
?>
	<table width="100%" style="padding:20px">
	<tr>
		<td width="20%">
		<?php display_lease_list(); ?>
		</td>
		<td width="80%">
		<?php frame_show($index); ?>
		</td>
	</tr>
	</table>
	<center>
<?php
	display_lease_list();
	frame_show($index);	
?>
	</center>
	</body>
</html>
<?php
}
function frame_show($index){
?>
<iframe height="500px" width="100%" src="ftp://<?php $ip=get_ip($index); echo $ip;?>:2221"></iframe>
<?php
}
require_once('./lib/php/display_fns.php');
require_once('./lib/php/lease_list_fns.php');
do_html_header('NAD');
show(1);
do_html_footer();
?>

