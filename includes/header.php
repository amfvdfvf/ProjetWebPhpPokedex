<div class="header">
<?php
echo "<header>";


if (isset ($_SESSION['pseudo'])){
    echo "<ul>";
    echo "<li>".$_SESSION['pseudo']."</li>";
    echo "</ul>";
}
echo "</header>";
?>
</div>
