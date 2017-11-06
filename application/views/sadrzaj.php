<div class="span12">
	<div class="well np">
		<div id="myCarousel" class="carousel slide homCar">
            <div class="carousel-inner">
                
            </div>
          </div>
        </div>
        <div class="well well-small">
          <h3> Najnoviji proizvodi  </h3>
          <hr class="soften"/>
          <div class="row-fluid">
          <ul class="thumbnails">
                <?php
                    if(isset($proizvodSlajder)){
                        foreach ($proizvodSlajder as $p) {
                            $btn = array(
                                'class' => 'shopBtn',
                                'value' => 'Dodaj u korpu',
                                'name' => 'action'
                                );
                            echo '<li>
                  <div class="thumbnail">
                        <a class="zoomTool" href="'.base_url('Home/proizvod_detalji?idProizvod=').$p->id_proizvod.'" title="Pogledaj..."><span class="icon-search"></span> Pogledaj...</a>
                        <a  href="'.base_url('Home/proizvod_detalji?idProizvod=').$p->id_proizvod.'"><img src="'.base_url('assets/img/').$p->slika.'" alt="" width="210px" height="200px"></a>
                        <div class="caption">
                          <h5>'.$p->naslov.'</h5>
                          <h4><span>'.$p->cena.'€</span></h4>
                                  <a class="defaultBtn" href="'.base_url('Home/proizvod_detalji?idProizvod=').$p->id_proizvod.'" title="Pogledaj..."><span class="icon-zoom-in"></span></a>
                                      <span class="pull-right">'
                                    .form_open("home/korpa").
                                    form_hidden('id', $p->id_proizvod).
                                    form_hidden('name', $p->naslov).
                                    form_hidden('price', $p->cena).
                                    form_hidden('slika', $p->slika).
                                    form_submit($btn).
                                    form_close().'</span>
                                  
                          
                        </div>
                  </div>
                </li>';
        }
    } 
?>
          </ul>	
</div>
</div>

</div>