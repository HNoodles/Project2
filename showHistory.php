<?php

$history = $_SESSION['history'];

echo '<nav aria-label="breadcrumb">
    <ol class="breadcrumb">';

for ($i = 0; $i < count($history); $i++) {
    // get php self
    $startSpace = strrpos($history[$i],"/") + 1;
    $endSpace = strrpos($history[$i],".php");
    $phpSelf = substr($history[$i],$startSpace,$endSpace - $startSpace);

    if ($i == count($history) - 1){// echo last link
        echo '<li class="breadcrumb-item active" aria-current="page">'.ucfirst($phpSelf).'</li>';
    } else {// echo a link
        echo '<li class="breadcrumb-item"><a href="'.$history[$i].'">'.ucfirst($phpSelf).'</a></li>';
    }
}

echo '</ol>
</nav>';


