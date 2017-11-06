<div class="span9">
    <?php if(isset($autor))
    {
     foreach ($autor as $a) {
         ?>
     
	<h3><?php echo $a->ime.' '.$a->prezime; ?></h3>	
	<hr class="soft"/>
        <div class="well well-small">
	<div class="row-fluid">
            <div class="span5">
        <?php
        echo img('assets/img/'.$a->slika);?>
                </div><div class="control-group">
                <h3><?php echo $a->ime.' '.$a->prezime; ?></h3>	
            <?php
        echo '<div class="span7"><p>'.$a->opis.'</p></div>';
        }
    }
    ?>
            </div>
            <?php
            if(isset($anketa))
            {
                foreach ($anketa->result() as $a) {
                echo $a->pitanje;
                echo form_open('');   
                echo form_label('Da:').form_radio('rbAnketa',1);
                echo form_label('Ne:').form_radio('rbAnketa',0);
                echo form_hidden('idAnkete',$a->id_ankete);

                echo form_submit('radio','Glasaj','id="btnAjax"');
                echo form_close();
             }
            }
            ?>
            <span id="result1"></span>
</div>
        </div>
</div>