<div class="span12">
	<h3> Korisnici</h3>	
	<hr class="soft"/>
        <div class="well">
            <?php
            
            $id = $this->input->get('idIzmenaKorisnika');
            if(isset($id)){
                echo validation_errors();
                if(isset($korisniciIzmena)){
                    foreach ($korisniciIzmena as $kor) {
                echo form_open('Administracija/korisnici', array('class'=>'form-horizontal'));
                
                echo '<div class="control-group">'
                    . '<label class="control-label">Ime:</label>';
                echo '<div class="controls">';
                echo $kor->ime;
                echo '</div></div><div class="control-group">'
                    . '<label class="control-label">Prezime:</label>';
                echo '<div class="controls">';
                echo $kor->prezime;
                echo '</div></div><div class="control-group">'
                    . '<label class="control-label">Uloga:</label>';
                echo '<div class="controls">';
                echo '<select id="ddlUloga" name="ddlUloga">';
                    echo '<option value="">Izaber...</option>';
                    echo '<option value="1">Admin</option>';
                    echo '<option value="2">Korisnik</option>';
                    
                    echo '</select>';
                
                echo '</div></div><div class="control-group">';
                echo '<div class="controls">';

                echo form_submit(array("id"=>"btnIzmeni","name"=>"btnIzmeni",'class'=>"exclusive shopBtn", 'value'=>"Izmeni"));                    
                echo '</div></div>';
                echo form_close();
                    }
                }
            }
            else
            {
                if(isset($tabelaKorisnici))
                {
                    echo $tabelaKorisnici;
                }
            }
            ?>
        </div>
</div>