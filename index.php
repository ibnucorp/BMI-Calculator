<?php
    $warna = ['text-danger','text-warning','text-white','text-success'];
    $input_tinggi = $_POST['tinggi'];
    $input_berat = $_POST['berat'];
    
    $sangat_pendek = 0;
    $pendek = 0;
    $sedang = 0;
    $tinggi = 0;
    $sangat_tinggi = 0;

    if ($input_tinggi <115){
        $sangat_pendek = 1;
    }

    else if ($input_tinggi >= 115 && $input_tinggi <= 120){
        $sangat_pendek = (120 - $input_tinggi)/(120-115);
        $pendek = ($input_tinggi - 115)/(120-115);
    }

    else if ($input_tinggi >= 120 && $input_tinggi <= 140){
        $pendek = 1;

    }else if ( $input_tinggi > 140 && $input_tinggi < 145){
        $pendek = (145 - $input_tinggi)/(145-140);
        $sedang = ($input_tinggi - 140)/(145-140);

    }else if ( $input_tinggi >=145 && $input_tinggi <=160){
        $sedang = 1;

    }else if ( $input_tinggi > 160 && $input_tinggi < 165){
        $sedang = (165 - $input_tinggi)/(165-160);
        $tinggi = ($input_tinggi - 160)/(165-160);

    }else if ( $input_tinggi >= 165 && $input_tinggi <= 180){
        $tinggi = 1;

    }else if ( $input_tinggi >180 && $input_tinggi < 185){
        $tinggi = (185 - $input_tinggi)/(185-180);
        $sangat_tinggi = ($input_tinggi - 180)/(185-180);

    }else{
        $sangat_tinggi = 1;
    }

    $sangat_kurus = 0;
    $kurus = 0;
    $biasa = 0;
    $berat = 0;
    $sangat_berat = 0;

    if ($input_berat <= 40){
        $sangat_kurus = 1;
    }
    else if ($input_berat > 40 && $input_berat < 45){
        $sangat_kurus = (45 - $input_berat)/(45-40);
        $kurus = ($input_berat - 40)/(45-40);
    }
    else if ($input_berat >= 45 && $input_berat <= 50){
        $kurus = 1;
    }else if ( $input_berat > 50 && $input_berat < 55){
        $kurus = (55 - $input_berat)/(55-50);
        $biasa = ($input_berat - 50)/(55-50);
    }else if ( $input_berat >=55 && $input_berat <=60){
        $biasa = 1;
    }else if ( $input_berat > 60 && $input_berat < 65){
        $biasa = (65 - $input_berat)/(65-60);
        $berat = ($input_berat - 60)/(65-60);
    }else if ( $input_berat >= 65 && $input_berat <= 80){
        $berat = 1;
    }else if ( $input_berat >80 && $input_berat < 85){
        $berat = (85 - $input_berat)/(85-80);
        $sangat_berat = ($input_berat - 80)/(85-80);
    }else{
        $sangat_berat = 1;
    }

    $list_tinggi = [$sangat_pendek,$pendek,$sedang,$tinggi,$sangat_tinggi];
    $list_berat = [$sangat_kurus,$kurus,$biasa,$berat,$sangat_berat];
    
    $label_tinggi =['Sangat Pendek','Pendek','Sedang','Tinggi','Sangat tinggi'];
    $label_berat = ['Sangat Kurus','Kurus','Biasa','Berat','Sangat berat'];



    // $matrix = [5][5];
    // for ($y=0;$y<5;$y++){
    //     for ($x=0;$x<5;$x++){
    //         if($list_tinggi[$y] >0  && $list_berat[$x] >0){
    //             $matrix[$y][$x] = 1;
    //         }else{
    //             $matrix[$y][$x] = 0;
    //         }
    //         echo '['.$matrix[$y][$x].']';
    //     }
    //     echo '<br>';
    // }

     $max_tinggi = array_search(max($list_tinggi),$list_tinggi);
     $max_berat  = array_search(max($list_berat),$list_berat);


    $rule = [
        [4,3,2,1,1],    // 4 = SS
        [3,4,3,2,1],    // 3 = S
        [2,4,4,2,1],    // 2 = AS
        [1,3,4,3,1],    // 1 = TS
        [1,2,4,3,2]
    ];

    $score = 0;
    for($i = 0;$i<5;$i++){
        if($list_tinggi[$i] == 1){
            $pos_y = $i;
        }
        else{
            $pos_y = $max_tinggi;
        }
        if($list_berat[$i] == 1){
            $pos_x = $i;
        }
        else{
            $pos_x = $max_berat;           
        }
    }
    
    $score = $rule[$pos_y][$pos_x];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body style="background-color:#74c0e0;">
    <div class="container-fluid">
        <div class="container">
            <div class="row my-3">
                <div class="col">
                    <div class="card border-success p-0 border border-2 rounded-3 w-100" data-bs-theme="light">
                        <div class="card-header">Input</div>
                        <div class="card-body pb-0">
                            <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>?#hasil">
                                <div class="container">
                                    <div class="row">
                                        <div class="col">
                                            <label for="tinggi" class="form-label">Tinggi Badan</label>
                                            <input type="number" id="tinggi" class="form-control" aria-describedby="help" name="tinggi" value="<?=$input_tinggi?>" required>
                                            <div id="help" class="form-text"></div>
                                        </div>
                                        <div class="col">
                                            <label for="berat" class="form-label">Berat Badan</label>
                                            <input type="number" id="berat" class="form-control" aria-describedby="help" name="berat" value="<?=$input_berat?>" required>
                                            <div id="help" class="form-text"></div>
                                        </div>                                        
                                    </div>
                                </div>
                                <button class="btn btn-success m-3" type="submit" >Hitung</button>
                            </form>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                    <div class="card border-success p-0 border border-2 rounded-3 w-100 my-3" data-bs-theme="light">
                        <div class="card-header">
                            Rule Evaluation
                        </div>
                        <div class="card-body">
                            <img class="d-block mx-auto" src="img.png">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-success p-0 border border-2 rounded-3 w-100 my-3" data-bs-theme="light">
                        <div class="card-header">
                            Parameter Tinggi dan Berat Badan
                        </div>
                        <div class="card-body">
                            <img class="d-block mx-auto" src="tinggi.png">
                        </div>
                        <div class="card-body">
                            <img class="d-block mx-auto" src="berat.png">                            
                        </div>
                    </div>
                </div>                
            </div>
            <div class="row my-3">
                <div class="col">
                    <div class="card border-success p-0 border border-2 rounded-3 w-100" data-bs-theme="light">
                        <div class="card-header">
                            Perhitungan
                        </div>
                        <div class="card-body ">
                            <h5 class="card-title">Fuzzy</h5>
                            <p class="card-text"><?php
                                $i=0;
                                foreach($list_tinggi as $t){

                                    echo $label_tinggi[$i].' = '.$t;
                                    echo '<br>';
                                    $i++;
                                }
                            
                            ?></p>
                            
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-success p-0 border border-2 rounded-3 w-100" data-bs-theme="light">
                        <div class="card-header">
                            Perhitungan
                        </div>
                        <div class="card-body ">
                            <h5 class="card-title">Fuzzy</h5>
                            <p class="card-text"><?php
                                $i=0;
                                foreach($list_berat as $b){

                                    echo $label_berat[$i].' = '.$b;
                                    echo '<br>';
                                    $i++;
                                }
                            
                            ?></p>
                            
                        </div>
                    </div>
                </div>                
            </div>            
            <div class="row my-3">
                <div class="col">
                    <div id="hasil" class="card border-success p-0 border border-2 rounded-3 w-100" data-bs-theme="light">
                        <div class="card-header">
                            Hasil
                        </div>
                        <div class="card-body ">
                            
                            <h2 class="card-title <?=$warna[$score-1]?>"><?php
                                if ($score ==1){
                                    echo 'Tidak Sehat';
                                }
                                else if ($score ==2){
                                    echo 'Agak Sehat';
                                }
                                else if ($score ==3){
                                    echo 'Sehat';
                                }
                                else{
                                    echo 'Sangat Sehat';
                                }                            
                            ?></h2>
                            <p class="card-text h2">
                            <?php
                                
                                $saran_tinggi = ['Perbanyak minum susu','Perbaiki postur tubuh','Alhamdulillah normal ygy','Daftar Tentara aja g sih','Ngapain masih disini?? Daftar jadi pemain basket buruan gih'];
                                $saran_berat  = ['Udah makan belom nak?','Makan jangan ayam geprek aja kaka','Pertahankan king/queen, jangan lupa makan sayur','Eat right not less *Gila keren bet gweh','Banyak gerak, anak muda jangan males!!'];
                                
                                echo 'Tinggi: '.$saran_tinggi[$max_tinggi].'<br>';
                                echo 'Berat : '.$saran_berat[$max_berat];

                            ?>
                            </p>
                            
                        </div>
                    </div>
                </div>             
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>