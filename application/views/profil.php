<div class="span9">
    <?php
    $prezime = $this->session->userdata('prezime');
    $ime = $this->session->userdata('ime');
    ?>
	<h3><?php echo $ime.' '.$prezime; ?></h3>	
	<hr class="soft"/>
        <?php
            print validation_errors("<div class='alert alert-danger'>","</div>");
            if(isset($obavestenje))
            {
                echo "<div class='alert alert-success'>".$obavestenje."</div>";
            }?>
        <?php
            echo form_open('home/profil', array('class'=>'form-horizontal'));

            echo '<div class="control-group">'
            . '<label class="control-label">Ime:</label>';
            echo '<div class="controls">';

            echo form_input($tbIme);
            
            $id = $this->session->userdata("id");
            echo form_hidden('idKorisnik', $id);
            echo '</div></div><div class="control-group">'
            . '<label class="control-label">Prezime:</label>';
            echo '<div class="controls">';

            echo form_input($tbPrezime);

            echo '</div></div><div class="control-group">'
            . '<label class="control-label">Username:</label>';
            echo '<div class="controls">';

            echo form_input($tbUsername);

            echo '</div></div><div class="control-group">'
            . '<label class="control-label">Lozinka:</label>';
            echo '<div class="controls">';

            echo form_password($tbLozinka);

            echo '</div></div><div class="control-group">'
            . '<label class="control-label">Lozinka ponovo:</label>';
            echo '<div class="controls">';

            echo form_password(array(
                        "name"=>"tbLozinkaPonovo", 
                        "id"=>"tbLozinkaPonovo", 
                        "value"=>  set_value('tbLozinkaPonovo'), 
                        "size"=>"30", 
                        'class'=>'form-control'
            ));

            echo '</div></div><div class="control-group">'
            . '<label class="control-label">Email:</label>';
            echo '<div class="controls">';
            
            echo form_input($tbEmail);

            echo '</div></div><div class="control-group">';
            echo '<div class="controls">';
            echo form_submit(array("id"=>"btnUnesi","name"=>"btnUnesi",'class'=>"exclusive shopBtn", 'value'=>"Izmeni"));                    
            echo '</div></div>';
            echo form_close();
        ?>
</div>
