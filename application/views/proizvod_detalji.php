<div class="span9">	
    <?php foreach ($proizvod as $pr) { ?>
	<div class="well well-small">
	<div class="row-fluid">
			<div class="span5">
			<div id="myCarousel" class="carousel slide cntr">
                <div class="carousel-inner">
                  <div class="item active">
                      <a href="#"> <img src="<?php echo base_url('assets/img/').$pr->slika;?>" alt="" style="width:100%"></a>
                  </div>
                </div>
            </div>
			</div>
			<div class="span7">
				<h3><?php echo $pr->naslov;?></h3>
				<hr class="soft"/>
				
				<form class="form-horizontal qtyFrm">
				  <div class="control-group">
    <label class="control-label"><span><?php echo $pr->cena;?>€</span></label>
					<div class="controls">
					
					</div>
				  </div>
				
				  
				  <h4>100 items in stock</h4>
				  <p>Nowadays the lingerie industry is one of the most successful business spheres.
				  Nowadays the lingerie industry is one of ...
				  <p></form>
                                      <?php
                                      $btn = array(
                                        'class' => 'shopBtn',
                                        'value' => 'Dodaj u korpu',
                                        'name' => 'action'
                                        );
                                            echo form_open("home/korpa");
                                            echo form_hidden('id', $pr->id_proizvod);
                                            echo form_hidden('name', $pr->naslov);
                                            echo form_hidden('price', $pr->cena);
                                            echo form_hidden('slika', $pr->slika);
                                            echo form_submit($btn);
                                            echo form_close();
                                            }?>
                                                                           
				
			</div>
			</div>
				<hr class="softn clr"/>

</div>
</div>