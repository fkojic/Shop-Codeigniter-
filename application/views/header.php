<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <?php 
        foreach ($css_data as $css)
        {
            echo $css;
        }
        foreach ($meta_data as $meta)
        {
            echo $meta;
        }
    ?>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/ico/favicon.ico">
    <script src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js" type="text/javascript"></script>
    <script type="text/javascript">
function clear_cart() {
var result = confirm('Da li ste sigurni?');

if (result) {
window.location = "<?php echo base_url(); ?>home/remove/all";
} else {
return false; // cancel button
}
}
</script>
  </head>
<body>
    
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="topNav">
		<div class="container">
			<div class="alignR">
				<div class="pull-left socialNw">
					<a href="#"><span class="icon-twitter"></span></a>
					<a href="#"><span class="icon-facebook"></span></a>
					<a href="#"><span class="icon-youtube"></span></a>
					<a href="#"><span class="icon-tumblr"></span></a>
				</div>
				<?php $uloga = $this->session->userdata('uloga');
                                $ime = $this->session->userdata('ime');
                               
                                if($uloga == 'korisnik'): ?>
                                <a href="<?php echo base_url('home/profil');?>"><span class="icon-user"> <?php echo $ime;?></span></a>
                                <?php endif;?>
                                <?php $cart_check = $this->cart->contents();
                                if(empty($cart_check)) {
                                echo '<a href="'.base_url('home/korpa').'"><span class="icon-shopping-cart"></span> Korpa <span class="badge badge-warning"> </span></a>';
                                }
                                else
                                {
                                echo '<a href="'.base_url('home/korpa').'"><span class="icon-shopping-cart"></span> Korpa <span class="badge badge-info"> </span></a>';
                                }
                                ?>
			</div>
		</div>
	</div>
</div>
<div class="container">
<div id="gototop"> </div>
<header id="header">
<div class="row">
	<div class="span4">
	<h1>
        <?php $sesija = $this->session->userdata('ulogovan');
                        if(empty($sesija))
                        {?>
	<a class="logo" href="<?php echo base_url();?>Home/"><span>Twitter Bootstrap ecommerce template</span> 
		<img src="<?php echo base_url();?>assets/img/logo-bootstrap-shoping-cart.png" alt="">
	</a>
                        <?php } else { ?>
            <a class="logo" href="<?php echo base_url();?>administracija/"><span>Twitter Bootstrap ecommerce template</span> 
		<img src="<?php echo base_url();?>assets/img/logo-bootstrap-shoping-cart.png" alt="">
	</a>
                        <?php }?>
	</h1>
	</div>
	<div class="span4">
	</div>
	<div class="span4 alignR">
            <?php echo anchor('assets/dokumentacija.pdf', 'Dokumentacija', array('class'=>'btn btn-warning'));?>
	</div>
</div>
</header>