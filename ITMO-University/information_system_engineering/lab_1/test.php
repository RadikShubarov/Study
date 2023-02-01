<?php

test1(0,0,3);
test1(0,-1,3);
test1(-1,1,3);
test1(-1,-1,3);
test1(-1,-1,3);
test1(3,-3,3);
test1(-3,3,3);
test1(-6,3,3);

function test1($x, $y, $r){
    $hit = True;
    if ($x >= 0) {
        if ($y >= 0) {
            $hit = False;
        } else {
            $dist = sqrt($x ** 2 + $y ** 2);
            $hit = $dist <= $r;
        }
    } else {
        if ($y >= 0) {
            $hit = $y <= $r / 2 and $x > -$r;
        } else {
            $hit = $y >= ($x - $r);
        }
    }

    $hit_str = 'Промах';
    if ($hit) {
        $hit_str = 'Попадание';
    }

    echo $hit_str; 
}
                    
?>



<?php
test2(0,0,3);
test2(3,3,1);
function test2($x, $y, $r){ 
    $hit = false;
    if ($x <= $r && -$x <= $r) {
        if ($y <= $r && -$y <= $r) {
            $hit = true;
        }
    }
    if ($hit) {
        $hit_str = 'Попадание';
    } else  $hit_str = 'Промах';
    echo  $hit_str;
}
?>


<?php
test3(0,0,3);
test3(3,1,3);
test3(-1,0,3);
test3(-1,1,3);
test3(-1,3,2);
test3(3,3,1);
function test3($x, $y, $r){ 
    $hit = false;
    if ($x <= $r && -$x <= $r) {
        if ($x >= 0 && $y <= $r && -$y <= $r) {
            $hit = true;
        }
        if ($x <= 0 && $y >= 0 && $y <= $r) {
            $hit = true;
        }
    }
    if ($hit) {
        $hit_str = 'Попадание';
    } else  $hit_str = 'Промах';
    echo  $hit_str;
}
?>


<?php
function test4($x, $y, $r){ 
    $hit = false;
    if ($x <= $r && -$x <= $r) {
        if ($y >= 0 && $y <= $r) {
            $hit = true;
        }
    }
    if ($hit) {
        $hit_str = 'Попадание';
    } else  $hit_str = 'Промах';
    echo  $hit_str;
}
?>

<?php
function test5($x, $y, $r){ 
    $hit = false;
    if ($x >= 0 && $x <= $r) {
        if ($y >= 0 && $y <= $r) {
            $hit = true;
        }
    }
    if ($hit) {
        $hit_str = 'Попадание';
    } else  $hit_str = 'Промах';
    echo  $hit_str;
}
?>