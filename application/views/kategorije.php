<div id="sidebar" class="span3">
<div class="well well-small">
	<ul class="nav nav-list">
		<?php
                    if(isset($kategorija_naslov)){
                        foreach ($kategorija_naslov as $naslov) {
                            echo '<li><a href="products.html"><span class="icon-chevron-right"></span>'.$naslov->naslov.'</a></li>';
                        }
                    }
                ?>
		<li><a href="products.html"><span class="icon-chevron-right"></span>Svi proizvodi</a></li>
		<li style="border:0"> &nbsp;</li>
	</ul>
</div>
</div>