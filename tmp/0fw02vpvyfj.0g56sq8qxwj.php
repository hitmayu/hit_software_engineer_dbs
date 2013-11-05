<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="" />
		<title><?php echo $title; ?></title>
		<base href="" />
		<link rel="stylesheet" href="<?php echo $UI; ?>css/base.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $UI; ?>css/theme.css" type="text/css" />
	</head>
	<body>
		<div class="header center">
			<p>On this site will rise another Web masterpiece powered by</p>
			<p><img src="<?php echo $UI; ?>images/logo.png" /></p>
		</div>
		<div class="content">
			<h3>Version </h3>
			<p>The first thing you might want to do is visualize your directory structures. Fat-Free gives you total control over your Web site. Organize your folders in any way that pleases you (or your development team if you're part of a group). Decide where you want to store the following:</p>
			<ul>
				<li>Application and code libraries</li>
				<li>HTML templates</li>
				<li>Graphics and media files</li>
				<li>Javascript and CSS files</li>
				<li>Database (if you plan to use an embedded DB like SQLite)</li>
				<li>Configuration files</li>
				<li>Uploads/Downloads</li>
			</ul>
			<p>For security reasons, consider relocating the <code>lib/</code> folder to a path that's not Web-accessible. If you decide to move this folder, just change the line in <code>index.php</code> containing <code>require 'lib/base.php';</code> so it points to the new location. The <code>lib/</code> folder also contains framework plug-ins that extend F3's capabilities. You can change the default location of all plug-ins by moving the files to your desired subdirectory. Then, it's just a matter of pointing the <code>PLUGINS</code> global variable to the new location. You may delete the plug-ins that you don't need. You can always restore them later.</p>
			<p>F3 can autoload OOP classes for you. Just add the path to the <code>AUTOLOAD</code> variable.</p>
			<p>When you're ready to write your F3-enabled site, you can start editing the rest of the code contained in the <code>index.php</code> file that displayed this Web page. Developing PHP applications will never be the same!</p>
			<h3>PHP Dependencies</h3>
			<p>Some framework features in this version will not be available if PHP is not configured with the modules needed by your application.</p>
			<table>
				<tr>
					<th>Class/Plug-in</th>
					<th>PHP Module</th>
				</tr>
				
					<tr>
					<td><code></code></td>
					<td>
						
						<input type="checkbox"  onclick="return false" /> <code></code><br />
						
					</td>
				</tr>
				
			</table>
			<ul>
			<li>The <code>Base</code> class requires all listed PHP modules enabled to function properly.</li>
			<li>The <code>Cache</code> class will use any available module in the list. If none can be found, it will use the filesystem as fallback.</li>
			<li>The <code>DB\SQL</code> class requires the <code>pdo</code> module and a PDO driver relevant to your application.</li>
			<li>The <code>Bcrypt</code> class will use the <code>mcrypt</code> or <code>openssl</code> module for entropy generation. Otherwise, it employs a custom random function.</li>
			<li>The <code>Web</code> class will use the <code>curl</code> module for HTTP requests to another server. If this is not detected, it will use other transports available, such as the HTTP stream wrapper or native sockets.</li>
			<li>The <code>geoip</code> module listed in the <code>Web\Geo</code> class is optional; the class will use an alternative Web service for geo-location.</li>
			<li>Other framework classes in the list need all its listed modules enabled.</li>
			</ul>
			<h3>Need Help?</h3>
			<p>If you have any questions regarding the framework, technical support is available at <code><a href="https://groups.google.com/forum/?fromgroups#!forum/f3-framework">https://groups.google.com/forum/?fromgroups#!forum/f3-framework</a></code></p>
			<p>If you need live support, you can talk to the development team and the rest of the Fat-Free community via IRC. We're on the FreeNode <code>#fatfree</code> channel (<code>chat.freenode.net</code>).</p>
			<p>The <strong><a href="/userref">User Reference</a></strong> is designed to serve as a handbook and programming guide. However, the online documentation at <code><a href="https://github.com/bcosca/fatfree" onclick="window.open(this.href); return false;">https://github.com/bcosca/fatfree</a></code> provides the latest and most comprehensive information about the framework.</p>
			<p>The help file included in the distribution (<code>lib/f3.chm</code>) is at your disposal if you need to take a close look at the Fat-Free API.</p>
			<h3>Fair Licensing</h3>
			<p><b>Fat-Free Framework is free and released as open source software covered by the terms of the GNU Public License (GPL v3).</b> You may not use the software, documentation, and samples except in compliance with the license. If the terms and conditions of this license are too restrictive for your use, alternative licensing is available for a very reasonable fee.</p>
			<p>If you feel that this software is one great weapon to have in your programming arsenal, it saves you a lot of time and money, use it for commercial gain or in your business organization, please consider making a donation to the project. A significant amount of time, effort, and money has been spent on this project. Your donations help keep this project alive and the development team motivated. Donors and sponsors get priority support (24-hour response time on business days).</p>
			<h3>Support F3</h3>
			<p>F3 is community-driven open-source software. Support the development of the Fat-Free Framework. Your contributions help keep this project alive.</p>
			<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MJSQL8N5LPDAY" target="_blank"><img src="<?php echo $UI; ?>images/donate.png" title="Donate" /></a><a href="https://coinbase.com/checkouts/7986a0da214006256d470f2f8e1a15cf" target="_blank"><img src="<?php echo $UI; ?>images/bitcoin.png" /></a></p>
			<p/>
		</div>
		<div class="footer center">
			<p>Fat-Free Framework is licensed under the terms of the GPL v3<br />
			Copyright &copy; 2009-2013 F3::Factory/Bong Cosca &lt;bong&#46;cosca&#64;yahoo&#46;com&gt;</p>
			<p><code></code></p>
		</div>
	</body>
</html>
