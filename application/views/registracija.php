<div class="span12">
	<h3><?php echo $title;?></h3>	
	<hr class="soft"/>
	<div class="well">
		<h3>Podaci o korisniku</h3>
                <?php 
                    print validation_errors("<div class='alert alert-danger'>","</div>");
                    if(isset($obavestenje))
                    {
                        echo "<div class='alert alert-success'>".$obavestenje."</div>";
                    }?>
                <?php
                    echo form_open('home/registracija', array('class'=>'form-horizontal'));
                    
                    echo '<div class="control-group">'
                    . '<label class="control-label">Ime:</label>';
                    echo '<div class="controls">';
                    
                    echo form_input($tbIme);
                    
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
                    echo form_submit(array("id"=>"btnUnesi","name"=>"btnUnesi",'class'=>"exclusive shopBtn", 'value'=>"Prijavi"));                    
                    echo '</div></div>';
                    echo form_close();
                ?>
</div>

</div>
