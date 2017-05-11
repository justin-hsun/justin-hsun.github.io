<html>
<head>
<title><?php print(encode_output($bio['name'])); ?></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<?php
if (isset($_GET['contained']) && $_GET['contained'] == 1) {
?>
<style type="text/css" media="screen">
<?php
	print($css_screen);
?>
</style>
<style type="text/css" media="print">
<?php
	print($css_print);
?>
</style>
<script type="text/javascript">
<?php
	print($js);
?>
</script>
<?php
}
else {
?>
<style type="text/css" media="screen">
	@import url(http://<?php print($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); ?>?output=css_screen);
</style>
<link rel="stylesheet" type="text/css" media="print" href="http://<?php print($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); ?>?output=css_print" />
<script type="text/javascript" src="http://<?php print($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']); ?>?output=js"></script>
<?php
}
?>
</head>

<body>

<h1><?php print(encode_output($bio['name'])); ?></h1>

<p id="bio_left">
<?php
if ($prefs['show_phone'] == 1) {
	print(encode_output($bio['phone']).'<br />');
}
if ($prefs['show_email'] == 1) {
?>
	<script type="text/javascript">email();</script>
<?php
}
?>
</p>
<p id="bio_right">
<?php
if ($prefs['show_address'] == 1) {
	print(encode_output($bio['address']).'<br />'
	     .encode_output($bio['city']).', '
	     .encode_output($bio['state']).' '
	     .encode_output($bio['zip'])
	     );
}
?>
</p>

<h2>OBJECTIVE</h2>
<p class="data"><?php print(encode_output($data['objective'])); ?></p>

<h2>EXPERIENCE</h2>
<?php
foreach ($data['jobs'] as $job) { 
	if ($job['show'] == 1) {
		if (!empty($job['employer_link'])) {
			$link = array(
				'<a href="'.$job['employer_link'].'">'
				,'</a>'
			);
		}
		else {
			$link = array('','');
		}
?>
<div class="job">
	<p class="date"><?php print(encode_output($job['period'])); ?></p>
	<div class="job_data">
		<h3><?php print($link[0].encode_output($job['employer']).$link[1]); ?></h3>
<?php
		if (!empty($job['location'])) {
?>
		<p class="location"><?php print(encode_output($job['location'])); ?></p>
<?php
		}
		else {
?>
		<p class="location">&nbsp;</p>
<?php
		}
		if (!empty($job['employer_info'])) {
?>
		<p class="company"><?php print(encode_output($job['employer_info'])); ?></p>
<?php
		}
		foreach ($job['positions'] as $title => $position) {
?>
		<p class="position"><?php print(encode_output($title)); ?></p>
		<ul>
<?php
			foreach ($position as $responsibility) {
				print("			<li>".encode_output($responsibility)."</li>\n");
			}
?>
		</ul>
		&nbsp;
<?php
		}
?>
	</div>
</div>

<?php
	}
}
?>
<h2>SKILLS, TECHNOLOGIES &amp; PROJECTS</h2>
<ul>
<?php
foreach ($data['skills_technologies_projects'] as $temp) {
	print("	<li>".encode_output($temp)."</li>\n");
}
?>
</ul>

<h2>EDUCATION &amp; INTERESTS</h2>
<ul>
<?php
foreach ($data['education_interests'] as $temp) {
	print("	<li>".encode_output($temp)."</li>\n");
}
?>
</ul>

<p id="references">References available upon request.</p>

<p id="meta">
<?php
if (empty($_GET['contained']) || $_GET['contained'] != 1) {
?>
	<span id="versions"><a href="<?php print($_SERVER['PHP_SELF']); ?>">HTML version</a> | <a href="<?php print($_SERVER['PHP_SELF'].'?output=html&amp;contained=1'); ?>">E-mailable HTML version</a> | <a href="<?php print($_SERVER['PHP_SELF'].'?output=text'); ?>">Plain Text (.txt) version</a>.</span>
<?php
}
?>
	<span id="valid">Valid <a href="http://validator.w3.org/check/referer">XHTML 1.1</a> / <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS 2.0</a></span>
</p>

</body>
</html>
