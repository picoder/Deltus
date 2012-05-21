## About
Matchbook is a Codeigniter library that manages script, stylesheet and image assets. It provides an API to the &lt;head&gt; content and includes helpers to work with script, stylesheet and image assets in your views. Matchbook uses the basic markup of [html5-boilerplate](http://html5boilerplate.com/) but leaves it up to you if you'd like to implement all the extra goodies.

## Installation
* Copy libraries/matchbook.php into your Codeigniter application's "libraries" folder
* Copy helpers/matchbook_helper.php into your Codeigniter application's "helpers" folder (optional)
* Copy config/matchbook.php to matchbook.php into your Codeigniter application's "config" folder (optional)

## Configuration
Basic configuration
<pre name="code" class="php">
$config['doctype'] = 'HTML5';
$config['title'] = 'Matchbook - Asset Management Library for Codeigniter';
$config['icon_path'] = 'images/icons/';
$config['stylesheet_path'] = 'css/';
$config['javascript_path'] = 'js/';
$config['stylesheets'] = array('main');
$config['head_scripts'] = array('headscript');
$config['body_scripts'] = array('bodycript');
$config['author'] = 'Dayton Nolan';
$config['description'] = 'Yet another asset management library for Codeigniter';
</pre>

<table border="0" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th>Setting</th>
			<th>Default</th>
			<th>Options</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>doctype</td>
			<td>HTML5</td>
			<td>HTML5, Strict, Transitional, Frameset</td>
			<td>Sets the doctype for the rendered head markup.</td>
		</tr>
		<tr>
			<td>title</td>
			<td>Untitled Document</td>
			<td>string</td>
			<td>Sets the default title for the rendered head markkup.</td>
		</tr>
		<tr>
			<td>stylesheet_path</td>
			<td>css/</td>
			<td>string</td>
			<td>Sets the default path to css files.</td>
		</tr>
		<tr>
			<td>script_path</td>
			<td>js/</td>
			<td>string</td>
			<td>Sets the default path to script files.</td>
		</tr>
		<tr>
			<td>image_path</td>
			<td>images/</td>
			<td>string</td>
			<td>Sets the default path to image files.</td>
		</tr>
		<tr>
			<td>icon_path</td>
			<td>images/icons/</td>
			<td>string</td>
			<td>Sets the default path to icon files for devices.</td>
		</tr>
		<tr>
			<td>use_cachebuster</td>
			<td>TRUE</td>
			<td>boolean</td>
			<td>Determines whether or not a cache buster will be appended to resource requests.</td>
		</tr>
		<tr>
			<td>cachebuster</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Sets the query string param to be used in cache buster for (ie. cache=0).</td>
		</tr>
		<tr>
			<td>head_scripts</td>
			<td>(empty array)</td>
			<td>array</td>
			<td>Scripts to be loaded inside the head tag.</td>
		</tr>
		<tr>
			<td>body_scripts</td>
			<td>(empty array)</td>
			<td>array</td>
			<td>Scripts to be loaded at the end of the body tag.</td>
		</tr>
		<tr>
			<td>author</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Author meta tag content</td>
		</tr>
		<tr>
			<td>description</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Description meta tag content</td>
		</tr>
		<tr>
			<td>body_id</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Sets default body id for rendered head markup</td>
		</tr>
		<tr>
			<td>body_class</td>
			<td>(empty string)</td>
			<td>string</td>
			<td>Sets default body class for rendered head markup</td>
		</tr>
	</tbody>
</table>

## Usage



You can now control head content via the matchbook API

<pre name="code" class="php">
// controllers/controller.php
$this->matchbook->page_info(array('title' = 'My Page Title', 'id' => 'home'));

$data['head'] = $this->matchbook->head(); // Get the head markup
$data['footer'] = $this->matchbook->footer(); // Get the closing footer markup

$this->load->view('myview', $data); // Pass markup to view

// Then in views/myview.php
&lt;?php echo $head; ?&gt;
	&lt;!-- Content goes here --&gt;
&lt;?php echo $footer ?&gt;

//-- OR --//

// You can use the matchbook helper to print the markup directly in a view
// In views/myview.php
&lt;?php echo head(); ?&gt;
	&lt;!-- Content goes here --&gt;
&lt;?php echo footer(); ?&gt;
</pre>

Which will render something like this:

<pre name="code" class="php">
&lt;!DOCTYPE html&gt;
&lt;!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ --&gt; 
&lt;!--[if lt IE 7 ]&gt; &lt;html lang="en" class="no-js ie6"&gt; &lt;![endif]--&gt;
&lt;!--[if IE 7 ]&gt;    &lt;html lang="en" class="no-js ie7"&gt; &lt;![endif]--&gt;
&lt;!--[if IE 8 ]&gt;    &lt;html lang="en" class="no-js ie8"&gt; &lt;![endif]--&gt;
&lt;!--[if IE 9 ]&gt;    &lt;html lang="en" class="no-js ie9"&gt; &lt;![endif]--&gt;
&lt;!--[if (gt IE 9)|!(IE)]&gt;&lt;!--&gt; &lt;html lang="en" class="no-js"&gt; &lt;!--&lt;![endif]--&gt;
&lt;head&gt;
	&lt;script&gt;document.documentElement.className = 'js';&lt;/script&gt;
	&lt;meta charset="utf-8"&gt;

	&lt;!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
		 Remove this if you use the .htaccess --&gt;

	&lt;meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"&gt;

	&lt;title&gt;Matchbook - Asset Management Library for Codeigniter&lt;/title&gt;
  	&lt;meta name="description" content="Yet another asset manager for Codeigniter"&gt;
  	&lt;meta name="author" content="Dayton Nolan"&gt;

  	&lt;!--  Mobile viewport optimized: j.mp/bplateviewport --&gt;
  	&lt;meta name="viewport" content="width=device-width; initial-scale=1.0"&gt;

  	&lt;!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references --&gt;

  	&lt;link rel="shortcut icon" href="http://example.com/favicon.ico"&gt;
  	&lt;link rel="apple-touch-icon" href="http://example.com/images/icons/ios-icon.png"&gt;

	&lt;link rel="stylesheet" href="http://example.com/css/main.css?1286342222" type="text/css" charset="utf-8" /&gt;

	&lt;script src="http://example.com//js/headscript.js?1286342222"&gt;&lt;/script&gt;

&lt;/head&gt;
&lt;body id="home"&gt;
	&lt;!-- Content goes here --&gt;
&lt;script src="http://example.com/js/application/bodyscript.js?1286342222"&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>