<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>
<?php
if(isset($javascript)){
  foreach ($javascript as $file) {
    echo "<script src='js/$file.js'></script>";
  }
}
?>
</body>
</html>
