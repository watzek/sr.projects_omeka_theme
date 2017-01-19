<? 
session_start();
if ($_SESSION["patroninfo"]["loggedin"]==true){$_SESSION["Zend_Auth"]["storage"]=5;}

if ($_POST["logout"]=="yes"){
    unset($_SESSION["Zend_Auth"]["storage"]);
    session_destroy();
    $url=$_SERVER["REDIRECT_SCRIPT_URI"];


}
#LDAP auth hack  1/4/12
/*
 * 
 *  Sets user role to "contributor" 
 * 
 *  This required augmenting of the roles for contributor...by default, it can't view non-public items
 * 
 *  files that controls this: /application/core/acl.php
 * 
 * */
if ($_POST["login"]=="yes"){
    $username=$_POST["username"];
    $password=$_POST["pw"];
   // include ("ldap/patronauthenticate.php");
   $loggedIn=false;
   $ds=ldap_connect("ldap.lclark.edu");
   
   	if ($ds) {

		$ldapbind=@ldap_bind($ds, "uid=$username,ou=People,o=lclark.edu,dc=lclark,dc=edu", "$password");
	   if ($ldapbind) {
				  $result=ldap_read ($ds, "uid=$username,ou=People,o=lclark.edu,dc=lclark,dc=edu", "objectClass=*");
				  $ldapinfo=ldap_get_entries($ds,$result);
				  $_SESSION["patroninfo"]["username"]=$username;
				  $_SESSION["patroninfo"]["email"]=$ldapinfo[0]["mail"][0];
				  $_SESSION["patroninfo"]["lastname"]=$ldapinfo[0]["sn"][0];
				  $_SESSION["patroninfo"]["firstname"]=$ldapinfo[0]["givenname"][0];
				  $_SESSION["patroninfo"]["loggedin"]=true;
				  $ldap_status=$ldapinfo[0]["lclarkstatus"][0];
				  $_SESSION["patroninfo"]["status"]=$ldap_statuses[$ldap_status];
				  $loggedIn=true;
		}		
		
	}
   
   
   
    if ($loggedIn==true){
        $_SESSION["Zend_Auth"]["storage"]=5;

    }
    
    $url=$_SERVER["REDIRECT_SCRIPT_URI"];

    
 
}  

if ($_SESSION["Zend_Auth"]["storage"]==5){

            $fn=$_SESSION["patroninfo"]["firstname"];
        $ln=$_SESSION["patroninfo"]["lastname"];
        $name="$fn $ln";
    $entry=" <div style='float:right; text-align:right;'><form action='https://watzek.lclark.edu/seniorprojects/' method='post' style='width:300px;'><span style='font-size:12px;'>Logged in as $name&nbsp;&nbsp;&nbsp;|</span><input type='hidden' name='logout' value='yes'><input type='submit' id='lobutton' value='Sign out'></form></div>";
 
}
else{$entry="<a id='loginlink' style='margin-top:0px;' class='loginLink'>Sign in to view full documents.</a>";}

if (isset($_SESSION["Zend_Auth"]["storage"]) && $_SESSION["Zend_Auth"]["storage"]>0){$loggedin=true;}
else{$loggedin=false;}

# end LDAP auth hack

?>

<!DOCTYPE html>
<html lang="<?php
echo get_html_lang();
?>">
<head>
	<meta charset="utf-8">
  <?php
if ($description = option('description')):
?>
  <meta name="description" content="<?php
    echo $description;
?>" />
  <?php
endif;
?>
  <link rel="shortcut icon" href="<?php echo src('library_favicon.ico', 'images'); ?>">
  <title><?php
echo option('site_title');
echo isset($title) ? ' | ' . strip_formatting($title) : '';
?></title>

  <?php
echo auto_discovery_link_tags();
?>


  <!-- Plugin Stuff -->

  <?php
fire_plugin_hook('public_head', array(
    'view' => $this
));
?>

  <!-- Stylesheets -->

  <?php
queue_css_url('https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
queue_css_file('foundation');
queue_css_file('app');
queue_css_file('galleriffic-5');
queue_css_file('items');
queue_css_file('slick/slick');
queue_css_file('slick/slick-theme');
queue_css_file('slick_custom');
queue_css_file('index_page');
echo head_css();
?>

  <!-- JavaScripts -->

  <?php
queue_js_file('vendor/jquery');
?>
  <?php
queue_js_file('app');
?>
  <?php
queue_js_file('foundation/foundation');
?>
  <?php
queue_js_file('foundation/foundation.orbit');
?>
    <?php
queue_js_file('foundation/foundation.reveal');
?>
  

  <?php
queue_js_file('vendor/custom.modernizr');
?>

  <?php
queue_js_file('foundation/foundation.forms');
?>

    <?php queue_js_file('jquery.galleriffic'); ?>
    <?php queue_js_file('jquery.opacityrollover'); ?>
    <?php queue_js_file('jush'); ?>
    <?php queue_js_file('masonry.pkgd'); ?>
    <!-- We want masonry grid to be loaded only on browse items page -->
    <?php if(current_url() == "/items/browse"){queue_js_file('grid_load');} ?>
    <?php queue_js_file('scrollreveal'); ?>
    <!-- Jquery 2.2.0 is required for carousel on main page but is conflicting with Jquery used on browse items page therefore if statement -->
    <?php if(current_url() != "/items/browse"){queue_js_file('jquery-2.2.0.min');} ?>
    <?php queue_js_file('slick/slick.min'); ?>
    <?php queue_js_file('slick_load'); ?>
  	<?php echo head_js(); ?>

</head>

<?php
echo body_tag(array(
    'id' => @$bodyid,
    'class' => @$bodyclass
));
?>
<?php
fire_plugin_hook('public_body', array(
    'view' => $this
));
?>

<header>
		  <?php
fire_plugin_hook('public_header');
?>
		</header>

		        <div id="primary-nav" class="contain-to-grid sticky">
		<nav class="top-bar">
		
		
		

		
		
		
		 <ul class="title-area">
		    <!-- Title Area -->
		    <li class="name">
		       <h1 id="site-title"><a href="#"><?php echo link_to_home_page(theme_logo()); ?></a></h1>
		    </li>
		    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
		  </ul>

				<section class="top-bar-section">
					<!-- Left Nav Section -->
					<ul class="left">
					    <li <?php if(current_url() == "/items/browse"){echo 'class="active"';} ?>><a href="/seniorprojects/items/browse">Items</a></li>
					    <li <?php if(current_url() == "/collections/browse"){echo 'class="active"';} ?>><a href="/seniorprojects/collections/browse">Departments</a></li>
					    <li <?php if(current_url() == "/items/search"){echo 'class="active"';} ?>><?php echo link_to_item_search('More Search Options'); ?></li>
					    <li class="search-form"><?php echo search_form(array('show_advanced' => false));?></li>
					  <!-- <li class='active'><?php #echo $entry;?></li> -->
					    
					</ul>

					
 				</section>
 				
 				<section>
 									<ul class="left">
					<li>test</li>
					</ul>
 				
 				</section>
 				
		    </nav>
		    
		    

		    <nav>
		     <!--<div style="font-size:1em;"><?php # echo $entry;?></div> -->
		     	             <div style='display:none;padding:20px;width:height:100px;margin:auto;' id="login">
             

           <?
            $action=$_SERVER["REDIRECT_SCRIPT_URI"];

           ?>             
             
             
             
                <form action="<?echo $action;?>" method="post">
                <p style='width:800px;margin:auto;text-align:right;padding-bottom:10px;padding-right:20px;'>username: <input type="text" name="username"></p>
                <p style='width:800px;margin:auto;text-align:right;padding-right:20px;'>password: <input type="password" name="pw"></p>
                <p  style='width:800px;margin:auto;text-align:right;padding-right:20px;padding-top:10px;'><input type="submit" name="submit" value="Submit" id="submit_login"></p>
                <input type="hidden" name="login" value="yes">
                </form>
             </div>	
              
		    </nav>
		    
	</div>
	
	
	

	
	
	
                    <script>



     
    <?php
     if ($loggedin==false){
     ?>
     jQuery( document ).ready(function() {
    		jQuery("ul.navigation li.nav-contribute").css("display", "none");
    		jQuery("ul.navigation li.nav-upload-instructions").css("display", "none");
      });
     
     <?php
    }
    ?> 
     jQuery( document ).ready(function() {
		 jQuery(".loginLink").click(function(){
		 
			 jQuery("#login").slideToggle("slow");
		 
		 });
     });
    
    </script>



		<?php
  // var_dump($_SESSION);        
        ?>

		<div class="row">
			<div class="large-12 columns">
