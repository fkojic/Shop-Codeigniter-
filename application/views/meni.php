<div class="navbar">
	  <div class="navbar-inner">
		<div class="container">
		  <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </a>
		  <div class="nav-collapse">
                    <?php
                        $sesija = $this->session->userdata('ulogovan');
                        $uloga = $this->session->userdata('uloga');
                        
                        echo '<ul class="nav">';
                        if(empty($sesija) || $uloga =="korisnik")
                        {
                            echo '<li>'.anchor('home/index', 'Početna', array('class' => 'icon-home')).'</li>';
                            echo '<div class="dropdown" style="float:left;">
                                
                                <button class="dropbtn"><span class="icon-list"> Proizvodi</button>
                                <div class="dropdown-content" style="left:0;">';
                            
                                if(isset($kategorija_naslov)){
                                    foreach ($kategorija_naslov as $kategorija) {
                                        echo anchor(base_url('home/proizvodi/').$kategorija->id_naslov, $kategorija->naslov, array('class' => 'icon-chevron-right'));
                                    }
                                }
                            echo '</div></div>';
                        }
                            if(isset($meni))
                            {
                                foreach($meni as $m) 
                                    {
                                        echo '<li>'.anchor($m->link, $m->naziv).'</li>';
                                    }
                            }
                            
                            echo '</ul>';
                        if(empty($sesija) || $uloga =="korisnik")
                        {
//                            echo form_open('home/pretraga', array('id'=>'fPretraga', 'name'=>'fPretraga', 'class'=>'navbar-search pull-left','method'=>'POST'));
//                            echo form_input(array('id'=>'tbPretraga', 'name'=>'tbPretraga', 'class'=>'search-query span2'));
//                            echo form_close();
                        }
                        
                    ?>
			<ul class="nav pull-right">
                            <?php
                            $ulogovan = $this->session->userdata('ulogovan');
                        if(empty($ulogovan))
                        {
                            ?>
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#"><span class="icon-lock"></span> Login <b class="caret"></b></a>
				<div class="dropdown-menu">
                                    <?php
				echo form_open(base_url().'Logovanje/login',array('id'=>'forma','name'=>'forma','class'=>'form-horizontal loginFrm','method'=>'POST'));
				  echo '<div class="control-group">';
                                  echo form_input(array('id'=>'tbKorIme','name'=>'tbKorIme', 'class'=>'span2'));
				  echo '</div>
				  <div class="control-group">';
                                  echo form_password(array('id'=>'tbLozinka','name'=>'tbLozinka','class'=>'span2'));
				  echo '</div>
				  <div class="control-group">';
                                          echo form_submit(array('id'=>'btnLogovanje','name'=>'btnLogovanje','class'=>'shopBtn btn-block', 'value'=>'Uloguj se'));
				
				  echo '</div>';
				echo form_close();
                                ?>
                                <?php
                                    echo $this->session->flashdata('error');
                                ?>
				</div>
			</li>
                        <?php
                        }
                          else
                        {
                            echo '<li>'.  anchor(base_url('logovanje/logout'),'Odjava', array('class'=>'dropbtn')).'</li>';
                        }
                    ?>      
			</ul>
		  </div>
		</div>
              
	  </div>
	</div>

<div class="row">