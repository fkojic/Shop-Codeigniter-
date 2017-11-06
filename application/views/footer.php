	</div>
<footer class="footer">
<div class="row-fluid">

 </div>
</footer>
</div><!-- /container -->

<div class="copyright">
<div class="container">
	
	<span>Copyright &copy; 2013<br> bootstrap ecommerce shopping template</span>
</div>
</div>
<a href="#" class="gotop"><i class="icon-double-angle-up"></i></a>
    <script src="<?php echo base_url();?>assets/js/jquery.easing-1.3.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.scrollTo-1.4.3.1-min.js"></script>
    <script src="<?php echo base_url();?>assets/js/shop.js"></script>
    <script src="<?php echo base_url();?>assets/js/lightbox.js"></script>
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#btnAjax").click(function(e) {
                e.preventDefault();

                odgovor = $(this).parent().find('input[name="rbAnketa"]:checked').val();
                id=$(this).parent().find('input[name="idAnkete"]').val();

                $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/ajax/');?>"+odgovor+"/"+id,
                dataType: "html",
                success:function(data){

                $('#result1').html(data);
                }
                });
        });
        
            $("#pro").on("change",function(e) {
                e.preventDefault();
                id=$("#pro").val();
                if(id>0){
                $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/ajaxProizvod/');?>"+id,
                dataType: "html",
                success:function(data){
                $('#proizvodi').html(data);
                }
                });}
        });
        
            $("#cena").on("change",function(e) {
                e.preventDefault();
                cena=$("#cena").val();
                id = $("#idC").val();
                if(cena>0){
                $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/cena/');?>"+cena+"/"+id,
                dataType: "html",
                success:function(data){
                $('#proizvodi').html(data);
                }
                });}
        });
        $("#cena").on("change",function(e) {
                e.preventDefault();
                cena=$("#cena").val();
                if(cena>0){
                $.ajax({
                type: "POST",
                url: "<?php echo base_url('home/cenaPromena/');?>"+cena,
                dataType: "html",
                success:function(data){
                $('#broj').html(data);
                }
                });}
        });
        });
    </script>
  </body>
</html>