<div class="span9">
    <div id="galerija">
	<?php
            if(isset($galerija))
            {
                foreach($galerija as $g)
                {
                    echo '<div class="slika">'.anchor('assets/img/'.$g->slika,img('assets/img/'.$g->slika), array('class'=>'prikaz', 'rel'=>'lightbox[plants]' )).'</div>';
                }
            }    
		?>		
	</div>
</div>
<div class="pagination-centered pagination">
    <ul>
        <?php echo $this->pagination->create_links(); ?>
    </ul>
</div>