<?php
require_once(dirname(__file__).'/../../lib/protview/xfm/Bootstrap.php');

$b = new Bootstrap();
?>

<html>
<head>
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="Stefan Meier">
<link rel="icon" href="https://wwwfbm.unil.ch/favicon.ico"
	type="image/x-icon" />
<link rel="shortcut icon" href="https://wwwfbm.unil.ch/favicon.ico"
	type="image/x-icon" />

<!-- Stylesheets -->
<link href="/protview/a/css/template.css" rel="stylesheet">
<link href="/protview/a/css/jquery.svg.css" rel="stylesheet">
<link href="/protview/a/css/protein.css" rel="stylesheet">

<!-- JavaScript -->
<script type="text/javascript"
	src="/protview/a/js/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript"
	src="/protview/a/js/jquery/jquery-ui-1.8.21.custom.min.js"></script>
<script type="text/javascript"
	src="/protview/a/js/jquery/jquery.svg.min.js"></script>
<script type="text/javascript"
	src="/protview/a/js/jquery/jquery.svgdom.min.js"></script>

<script type="text/javascript" src="/protview/a/js/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="/protview/a/js/jqwidgets/jqxexpander.js"></script>
<script type="text/javascript" src="/protview/a/js/jqwidgets/jqxnavigationbar.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
            var theme = getTheme();
            // Create jqxNavigationBar
            $("#jqxNavigationBar").jqxNavigationBar({ width: 400, height: 420, sizeMode: 'fitAvailableHeight', theme: theme });
        });
    </script>


</head>
<body>
	<!-- BEGIN PAGE -->
	<div id="page">
		<!-- BEBIN HEADER -->
		<div id="header"></div>
		<!-- END HEADER -->
		<!-- BEGIN CONTENT -->
		<div id="main">
			<!-- BEGIN MAIN -->
			<div id="content">
				<!-- BEGIN CONTENT -->

				<!-- END CONTENT -->
			</div>
			<!-- END MAIN -->
			<!-- BEGIN SIDEBAR -->
			<div id="sidebar">

				<div id='jqxWidget' style="float: left;">
					<div style='overflow: hidden;' id='jqxNavigationBar'>
						<!--Header-->
						<div>Early History of the Internet</div>
						<!--Content-->
						<div>
							<ul>
								<li>1961 First packet-switching papers</li>
								<li>1966 Merit Network founded</li>
								<li>1966 ARPANET planning starts</li>
								<li>1969 ARPANET carries its first packets</li>
								<li>1970 Mark I network at NPL (UK)</li>
								<li>1970 Network Information Center (NIC)</li>
								<li>1971 Merit Network's packet-switched network operational</li>
								<li>1971 Tymnet packet-switched network</li>
								<li>1972 Internet Assigned Numbers Authority (IANA) established</li>
								<li>1973 CYCLADES network demonstrated</li>
								<li>1974 Telenet packet-switched network</li>
								<li>1976 X.25 protocol approved</li>
								<li>1979 Internet Activities Board (IAB)</li>
								<li>1980 USENET news using UUCP</li>
								<li>1980 Ethernet standard introduced</li>
								<li>1981 BITNET established</li>
							</ul>
						</div>
						<!--Header-->
						<div>Merging the networks and creating the Internet</div>
						<!--Content-->
						<div>
							<ul>
								<li>1981 Computer Science Network (CSNET)</li>
								<li>1982 TCP/IP protocol suite formalized</li>
								<li>1982 Simple Mail Transfer Protocol (SMTP)</li>
								<li>1983 Domain Name System (DNS)</li>
								<li>1983 MILNET split off from ARPANET</li>
								<li>1986 NSFNET with 56 kbit/s links</li>
								<li>1986 Internet Engineering Task Force (IETF)</li>
								<li>1987 UUNET founded</li>
								<li>1988 NSFNET upgraded to 1.5 Mbit/s (T1)</li>
								<li>1988 OSI Reference Model released</li>
								<li>1988 Morris worm</li>
								<li>1989 Border Gateway Protocol (BGP)</li>
								<li>1989 PSINet founded, allows commercial traffic</li>
								<li>1989 Federal Internet Exchanges (FIXes)</li>
								<li>1990 GOSIP (without TCP/IP)</li>
								<li>1990 ARPANET decommissioned</li>
							</ul>
						</div>
						<!--Header-->
						<div>Popular Internet services</div>
						<!--Content-->
						<div>
							<ul>
								<li>1990 IMDb Internet movie database</li>
								<li>1995 Amazon.com online retailer</li>
								<li>1995 eBay online auction and shopping</li>
								<li>1995 Craigslist classified advertisements</li>
								<li>1996 Hotmail free web-based e-mail</li>
								<li>1997 Babel Fish automatic translation</li>
								<li>1998 Google Search</li>
								<li>1999 Napster peer-to-peer file sharing</li>
								<li>2001 Wikipedia, the free encyclopedia</li>
								<li>2003 LinkedIn business networking</li>
								<li>2003 Myspace social networking site</li>
								<li>2003 Skype Internet voice calls</li>
								<li>2003 iTunes Store</li>
								<li>2004 Facebook social networking site</li>
								<li>2004 Podcast media file series</li>
								<li>2004 Flickr image hosting</li>
								<li>2005 YouTube video sharing</li>
								<li>2005 Google Earth virtual globe</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
			<!-- END SIDEBAR -->
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN FOOTER -->
		<div id="footer">&copy; 2012 - Université de Lausanne - All right
			reserved</div>
		<!-- END FOOTER -->
	</div>
	<!-- END PAGE -->
</body>
</html>
