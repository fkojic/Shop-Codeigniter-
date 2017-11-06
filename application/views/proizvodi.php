<div id="sidebar" class="span3">
<div class="well well-small">
	<ul class="nav nav-list">
            <select name="pro" id="pro">
                <option value="">Izaberi proizvod:</option>
                
		<?php
                    if(isset($kategorija_naslov)){
                        foreach ($kategorija_naslov as $naslov) {
                            echo ' <option value="'.$naslov->id_naslov.'">'.$naslov->naslov.'</option>';
                        }
                    }
                ?>
            </select><hr>
            <li style="border:0">Cena:</li>
            <?php if(isset($proizvodMax)){foreach($proizvodMax as $p){?>
            0 - <span id="broj"><?php echo $p->cena;?></span>
            <li><input type="range" id="cena" min="0" max="<?php echo $p->cena;?>"></li>
            <input type="hidden" id="idC" value="<?php echo $id; ?>"/>
		<li style="border:0"> &nbsp;</li>
            <?php }}?>
	</ul>
</div>
</div>
<div class="span10">
    <div id="proizvodi">
        <?php
        if(isset($proizvodKategorija)){
?>
<div class="well well-small">
    <?php    foreach ($proizvodKategorija as $kat){ ?>
	<div class="row-fluid">	  
		<div class="span2">
                    <img src="<?php echo base_url('assets/img/').$kat->slika;?>" alt="">
<!--			<img src="assets/img/a.jpg" alt="">-->
		</div>
		<div class="span6">
			<h5><?php echo $kat->naslov;?></h5>
			<p>
			<?php echo $kat->opis;?>
			</p>
		</div>
		<div class="span4 alignR">
		<form class="form-horizontal qtyFrm">
		<h3><?php echo $kat->cena;?> €</h3>
		<br>
		</form>
                    <a href="<?php echo base_url('Home/proizvod_detalji?idProizvod=').$kat->id_proizvod;?>" class="btn btn-primary pull-left">Više</a>
                    <?php
                        $btn = array(
                          'class' => 'shopBtn',
                          'value' => 'Dodaj u korpu',
                          'name' => 'action'
                          );
                        echo form_open("home/korpa");
                        echo form_hidden('id', $kat->id_proizvod);
                        echo form_hidden('name', $kat->naslov);
                        echo form_hidden('price', $kat->cena);
                        echo form_hidden('slika', $kat->slika);
                        echo form_hidden('idC', $kat->id_kategorija, array('id'=>'idC'));
                        echo form_submit($btn);
                        echo form_close();
                    ?>
		   <div class="btn-group">

		 </div>
			
		</div>
	</div>
	<hr class="soften">
    <?php } ?>
</div>
    <?php } ?>
</div>    
</div>