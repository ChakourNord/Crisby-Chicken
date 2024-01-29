<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Patrick Mwathi, Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>xCRUD & CodeIgniter 3</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/cover/"> -->

    <!-- Bootstrap core CSS -->
<!-- <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <?php echo get_xcrud_css(); ?>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/masthead.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/cover.css'); ?>" rel="stylesheet">
  </head>
  <body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">xCRUD & CodeIgniter 3</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="<?php echo site_url('xcrud_ci'); ?>">Home</a>
        <a class="nav-link" href="<?php echo site_url('xcrud_ci/demos'); ?>">Demos</a>
      </nav>
    </div>
  </header>

  <main role="main" class="inner cover">
    <h1 style="padding-top: 2em;" class="cover-heading">xCRUD & CodeIgniter 3.</h1>
    
    <p class="lead">
    	xCRUD integrates easily with CodeIgniter 3. <br>Just follow the instructions below.
    </p>
   <!--  <p class="lead">
      <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
    </p> -->
    
    <div class="text-left">
	    <h2 style="padding-top: 2.5em;">CodeIgniter Helper</h2>
	    <p class="text-justify">
	    	Create the file <strong>Xcrud_helper.php</strong> in your CI helpers directory with the code below. 
	    </p>

<pre class="pre-scrollable">
  &lt;?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
  
  /**
  * Include xcrud libraries
  */
  if ( ! function_exists('get_xcrud'))
  {
    function get_xcrud($name = false){
      require_once FCPATH . 'assets/vendor/xcrud/xcrud.php';
      return Xcrud::get_instance($name);
    }
  }
  
  /**
  * Get html &lt;header&gt; css &lt;link&gt; tags for xcrud & its plugins.
  * This function can only get called after calling get_xcrud()
  */
  if ( ! function_exists('get_xcrud_css'))
  {
    function get_xcrud_css(){
      return Xcrud::load_css();
    }
  }
  
  /**
  * Get html &lt;script&gt; tags for xcrud & its plugins.
  * This function can only get called after calling get_xcrud()
  */
  if ( ! function_exists('get_xcrud_js'))
  {
    function get_xcrud_js(){
      return Xcrud::load_js();
    }
  }
  
  
  /* End of file Xcrud_helper.php */
</pre>

	    <p class="text-justify">
	    	Function <code>get_xcrud()</code> assumes the xCRUD directory is copied to the codeigniter's base directory (the directory with index.php) under the directory <strong>assets/vendor</strong>.
	    </p>

	    <p class="text-justify">
	    	Helper functions <code>get_xcrud_css()</code> and <code>get_xcrud_js()</code> give you manual control over where to place xCRUD's css and js output respectively. This will be made clear when calling CodeIgniter's view further below.
	    </p>

	    <h2 class="text-left" style="padding-top: 1.5em;">xCRUD Configuration</h2>
	    <p class="text-justify">
	    	The following <strong>xcrud_config.php</strong> settings are important to ensuring proper function.
	    </p>

	    <ul>
	    	<li>Database settings: Remember to set the correct values for the items below.</li>
	    	<ul>
	    		<li><code>$dbname</code></li>
			    <li><code>$dbuser</code></li>
			    <li><code>$dbpass</code></li>
			    <li><code>$dbhost</code></li>
	    	</ul>

	    	<li>Theme settings: This demo uses bootstrap 4.5 so the settings below are set as shown.</li>
	    	<ul>
	    		<li><code>$theme = 'bootstrap'</code></li>
			    <li><code>$load_bootstrap = false</code></li>
			    <li><code>$load_bootstrap4 = true</code></li>
	    	</ul>

	    	<li>Set <code>$manual_load = true</code> to disable xCRUD's automatic css and js output.</li>
	    </ul>

	    <h2 class="text-left" style="padding-top: 1.5em;">CodeIgniter Controller</h2>
	    <p class="text-justify">
	    	Create the file <strong>Demo.php</strong> in your CI controllers directory with the code below. 
	    </p>

<pre class="pre-scrollable">
  &lt;?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Demo extends CI_Controller {
  
    public function __construct(){
      parent::__construct();
      $this-&gt;load-&gt;helper(array('xcrud', 'url'));
    }
    
    public function index()
    {
      $xcrud = get_xcrud();
      $xcrud-&gt;table('orders');
      
      $data['content'] = $xcrud-&gt;render('create');
      
      $this-&gt;load-&gt;view('some_content', $data);
    }
  }
</pre>
		<p class="text-justify">
	    	In the <code>__construct()</code>, <code>$this->load->helper(array('xcrud', 'url'));</code> loads the Xcrud_helper.php we just created alongside CodeIgniter's url helper since we will be requiring these.
	    </p>

	    <div class="alert alert-info" role="alert">
	    	<h5 class="alert-heading">Remember</h5> 
	    	<p>
	    		You can now load the xCRUD helper globally throughout your CodeIgniter application, by autoloading it under <strong>application/config/autoload.php</strong> file and adding it to the helper autoload array.
	    	</p>
	    </div>

	    <p class="text-justify">
	    	Function <code>index()</code> uses the Xcrud_helper's function <code>get_xcrud()</code> which calls <code>Xcrud::get_instance()</code> and returns the xCRUD instance. You can optionally assign an identifier to the xCRUD instance by passing a string to <code>get_xcrud()</code>. You can check <a target="_blank" href="https://xcrud.net/documentation"><strong>docs</strong></a> for further information.
	    </p>

<pre class="pre-scrollable">
    $xcrud = get_xcrud();
    $xcrud-&gt;table('orders');      
    $data['content'] = $xcrud-&gt;render('create');      
    $this-&gt;load-&gt;view('some_content', $data);
</pre>	  

	    <p class="text-justify">
	    	Now we can call our xCRUD methods from the <var>$xcrud</var> instance. We are loading the table orders <code>$xcrud-&gt;table('orders')</code> in this case. When done, render the table, <code>$xcrud-&gt;render()</code> and assign its value to our <var>$data</var> array. We pass this array to our view, below, for display to the user.
	    </p>



	    <h2 class="text-left" style="padding-top: 1.5em;">CodeIgniter View</h2>
	    <p class="text-justify">
	    	Create the file <strong>some_content.php</strong> in your CI views directory with the code below. This is the view being loaded in the <code>index()</code> function of our controller above by <code>$this-&gt;load-&gt;view('some_content', $data)</code>
	    </p>

<pre class="pre-scrollable">
&lt;?php
defined('BASEPATH') OR exit('No direct script access allowed');
?&gt;&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
  &lt;meta charset="utf-8"&gt;
  &lt;title&gt;xCRUD & CodeIgniter 3&lt;/title&gt;

  &lt;?php echo get_xcrud_css(); ?&gt;
&lt;/head&gt;
&lt;body&gt;
  &lt;?php echo $content; ?&gt;
  &lt;?php echo get_xcrud_js(); ?&gt;
&lt;/body&gt;
&lt;/html&gt;

</pre>
		<p class="text-justify">
	    	Remember we set xCRUD <code>$manual_load = true</code>? We are now able to call our helper functions <code>&lt;?php echo get_xcrud_css(); ?&gt;</code> and <code>&lt;?php echo get_xcrud_js(); ?&gt;</code> to load our css and js respectively, where we please.
	    </p>

	    <p class="text-justify">
	    	We rendered the table, <code>$xcrud-&gt;render()</code> to <var>$data['content']</var> array. CodeIgniter extracts it as <var>$content</var> which we echo in our &lt;body&gt; tag here <code>&lt;?php echo $content; ?&gt;</code>.
	    </p>

	    <p class="text-justify">
	    	We rendered the table, <code>$xcrud-&gt;render()</code> to <var>$data['content']</var> array. CodeIgniter extracts it as <var>$content</var> which we echo in our &lt;body&gt; tag (<code>&lt;?php echo $content; ?&gt;</code>)
	    </p>

	    <p class="lead" style="padding-top: 2em;">
	    	<strong>Run your app:</strong> http(s)://path_to_your_ci_xcrud_app/index.php/demo
	    </p>

	    <h1 class="display-4" style="padding: 1em 0;">That's all. Happy coding.</h1>
	</div>
  </main>

  <footer class="mastfoot mt-auto" style="padding-top: 1.5em;">
    <div class="inner">
      <p>&copy; Copyright xCRUD. All Rights Reserved.</p>
    </div>
  </footer>
</div>

<?php echo get_xcrud_js(); ?>
</body>
</html>
