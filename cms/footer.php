<?php
$footer_file = __DIR__ . '/content/footer.html';
if(file_exists($footer_file)) {
    readfile($footer_file);
}
?>
</body>
</html>
