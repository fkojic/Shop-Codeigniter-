<div class="span12">
	<h3> Unos proizvoda</h3>	
	<hr class="soft"/>
        <div class="well">
        <?php 
                    if(isset($greske) && count($greske)>0)
                    {
                        foreach($greske as $greska)
                        {
                            echo "<div class='alert alert-danger'>".$greska."</div>";
                        }
                    }
                    
                ?>
                <?php
                    echo form_open_multipart('administracija/unesi', array('class'=>'form-horizontal'));
                    
                    echo '<div class="control-group">'
                    . '<label class="control-label">Ime proizvoda:</label>';
                    echo '<div class="controls">';
                    
                    echo form_input($tbIme);
                    
                    echo '</div></div><div class="control-group">'
                    . '<label class="control-label">Opis:</label>';
                    echo '<div class="controls">';
                    
                    echo form_textarea($tbOpis);
                    
                    echo '</div></div><div class="control-group">'
                    . '<label class="control-label">Kategorija:</label>';
                    echo '<div class="controls">';
                    
                    echo '<select id="ddlKategorija" name="ddlKategorija">';
                    echo '<option value="">Izaber...</option>';
                    if(isset($kategorija_naslov)){
                        foreach ($kategorija_naslov as $k) {
                            echo '<option value="'.$k->id_naslov.'">'.$k->naslov.'</option>';
                        }
                    }
                    echo '</select>';
                    echo '</div></div><div class="control-group">'
                    . '<label class="control-label">Cena:</label>';
                    echo '<div class="controls">';
                    
                    echo form_upload(array('id' => 'slika', 'name' => 'tbSlike', 'class' => 'form-control'));
                    
                    echo '</div></div><div class="control-group">'
                    . '<label class="control-label">Cena:</label>';
                    echo '<div class="controls">';
                    $datum = date("Y-m-d"); 
                    echo form_hidden('tbDatum', $datum);
                    echo form_input($tbCena);
                    
                    echo '</div></div><div class="control-group">'
                    . '<label class="control-label">Proizvodjac:</label>';
                    echo '<div class="controls">';
                    echo '<select id="ddlKategorija" name="ddlProizvodjac">';
                    echo '<option value="">Izaber...</option>';
                    if(isset($proizvodjac)){
                        foreach ($proizvodjac as $pr) {
                            echo '<option value="'.$pr->id_proizvodjac.'">'.$pr->naziv.'</option>';
                        }
                    }
                    echo '</select>';
                    
                    echo '</div></div><div class="control-group">';
                    echo '<div class="controls">';
                    
                    echo form_submit(array("id"=>"btnUnesi","name"=>"btnUnesi",'class'=>"exclusive shopBtn", 'value'=>"Unesi"));                    
                    echo '</div></div>';
                    echo form_close();
                ?>
        <div id="prikaz">
            <?php
                if(isset($tabela))
                {
                    echo $tabela;
                }
            ?>
        </div>
</div>
</div>