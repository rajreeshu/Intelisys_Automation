<?php
require __DIR__ . '/PhpSpreadsheet-master/vendor/autoload.php';

if(isset($_POST['submit'])):

    $type=$_POST['type'];


    
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
 
$sheetData = $spreadsheet->getActiveSheet()->toArray();

// echo "<pre>";
//     print_r($sheetData);
// echo "</pre>";


    $month="";
    switch(substr($sheetData[0][0], -7,2)){
        case 01:
            $month="JAN";
            $month_full="JANUARY";
            break;
        case 02:
            $month="FEB";
            $month_full="FEBURARY";
            break;
        case 03:
            $month="MAR";
            $month_full="MARCH";
            break;
        case 04:
            $month="APR";
            $month_full="APRIL";
            break;
        case 05:
            $month="MAY";
            $month_full="MAY";
            break;
        case 06:
            $month="JUN";
            $month_full="JUNE";
            break;
        case 07:
            $month="JUL";
            $month_full="JULY";
            break;
        case 8:
            $month="AUG";
            $month_full="AUGUST";
            break;
        case 9:
            $month="SEP";
            $month_full="SEPTEMBER";
            break;
        case 10:
            $month="OCT";
            $month_full="OCTOBER";
            break;
        case 11:
            $month="NOV";
            $month_full="NOVEMBER";
            break;
        case 12:
            $month-"DEC";
            $month_full="DECEMBER";
            break;
        default:
        $month="NaN";
        $month_full="NaN";
        break;
    }
    

    function get_buy_sell_color($val){
        $buy_sell_color="";
        switch(strtolower(trim($val))){
            case "buy":
                $buy_sell_color="#0E901F";
                break;
            case "sell":
                $buy_sell_color="#FF0000";
                break;
            case "wait":
                $buy_sell_color="#F68900";
                // $buy_sell_color="#FF0000";
                break;
                    $buy_sell_color="#630678";
                    break;
            case "hold long":
                $buy_sell_color="#630678";
                break;
            case "hold short":
                $buy_sell_color="#001AFF";
                break;
            case "range bound":
                $buy_sell_color="#56150C";
                break;
            default:
                $buy_sell_color="#FF0000";
                break;
        }
        return $buy_sell_color;
    }

    function dataorwait($d){
        return $d?$d:"-";
    }

    function trenddata($arr,$row){
        if($arr[$row][6]=="YES"){
            $r="UP TREND";
        }elseif($arr[$row][7]=="YES"){
            $r="DOWN TREND";
        }elseif($arr[$row][8]=="YES"){
            $r="SIDEWAYS";
        }
        return $r;
        // return $sheetData;
    }



endif;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intelisys</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        
        /* .watermark-h{
            background:url(image/watermark.png) no-repeat;
        } */

        .buy-t-s{
            font-size:16px;
        }

        @media (min-width: 1200px) {
        .container {
            max-width: 1350px;
        }
        }
    
    </style>
</head>
<body style="background:grey;">
    

<div class="container pt-3 mb-5">


    <?php include 'header.php';?>
<hr>
    <?php 
        if(isset($_POST['submit'])):
    ?>

    <div class="intelisys m-0 pl-3 pr-3" style="background:white ;" id="intelisys">
        <div class="row pt-2" style="background:#9C7800; width:calc(100% + 32px); position:relative; left:-1px;">
            <div class="col-3"><img src="image/white-logo.png" style="width:170px;" alt="intelisyslogo"></div>
            <h2 class="col-6 text-center text-white"><b><?=substr($sheetData[1][0],0,15);?> - Currency</b></h2>
            <!-- <div class="col-3 text-right text-white"style="font-size:20px;"><b><span class="p-0 m-0" id="edit_date"><?= substr($sheetData[0][0], 0,2);?></span>-<span id="edit_month"><?= substr($sheetData[0][0], 3,3);?></span><br><span style="font-size:16px;" id="edit_year"><?= substr($sheetData[0][0], -13,4);?></span></b></div> -->
            <div class="col-3 text-right text-white"style="font-size:20px;"><b><span class="p-0 m-0" id="edit_date"><?= date('d');?></span>-<span id="edit_month"><?=strtoupper(date('M'));?></span><br><span style="font-size:16px;" id="edit_year"><?= date('Y');?></span></b></div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center align-items-center m-2"><b><span style="color:#CC1710;">&#9888 Warning &#9888 &nbsp &nbsp</span> *Resharing this sheet is not legal* <span style="color:#CC1710;">&nbsp &nbsp &#9888 Warning &#9888</span></b></div>
        </div>

        <div class="row mr-1 ml-1">

<!-- card 1 -->    
            <div class="col-12 col-md-6 p-2">
                <div class="card" style=" border-radius:10px; box-shadow:-4px 4px 10px grey">
                    <div class="card-header p-0 pt-2"  style="background:#9C7800; border-radius:10px 10px 0px 0px; width:calc(100% + 1px);; position:relative; left:-1px;">
                    <b> <h5 class="card-title text-uppercase d-flex justify-content-center align-items-center text-white" id="card1_heading"><?=substr($sheetData[4][0],0,6)." ( ".$sheetData[0][0]." )";?></h5></b>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:1px solid black; border-right:0;border-left:0;">
 
                        <div class="row p-0 m-0">
                            <div class="col-9" style="border-right:1px solid black;">
                            <img src="image/watermark.png" class="img-watermark" alt="watermark" style="opacity:1; position:absolute; top:23px; left:90px; height:90px; z-index:5;">
        
                                <div class="row">
                                    <div class="col pt-2 pb-2">
                                        <div class="card font-weight-bold" style=" border-radius:10px; border:0px;">
                                            <div class="card-header text-white p-0"  style="z-index:6; background-image: linear-gradient(to right, #AD8726, #D0AE42); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center ">Support</p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;"> 
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card1_support1"><?= $sheetData[7][1];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card1_support2"><?= $sheetData[8][1];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card1_support3"><?= $sheetData[9][1];?></p>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>

                                    <div class="col pt-2 pb-2">
                                        <div class="card" style=" border-radius:10px;">
                                            <div class="card-header p-0"  style="z-index:6;background-image: linear-gradient(to right, #E0A942, #EDC96B); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center "><b>Resistance</b></p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2 font-weight-bold"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;" >
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card1_resistance1"><?= $sheetData[7][3];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card1_resistance2"><?= $sheetData[8][3];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card1_resistance3"><?= $sheetData[9][3];?></p>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col ">
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:<?=get_buy_sell_color($sheetData[10][0]);?>;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s" id="edit_card1_buysell_txt"><?= strtoupper($sheetData[10][0]);?></p>
                                                <!-- <p class="m-0 mb-3 pb-1 buy-t-s" style="color:<?=get_buy_sell_color(substr($sheetData[10][0],0,4));?>;"><?= dataorwait(substr($sheetData[10][0],5,12));?></p> -->
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[10][0]);?>;" id="card1_buysell"><?= dataorwait($sheetData[10][1]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col mx-2 p-0 ">
                                        <!-- <div class="font-weight-bold text-center " style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;"></div>
                                            <p class="m-1 p-0 buy-t-s">Stop Loss</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#C5BE00;"><?= dataorwait(substr($sheetData[10][0],19,7));?></p>
                                        </div> -->
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s">Stop Loss</p>
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#C5BE00;" id="card1_sl"><?= dataorwait($sheetData[10][3]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- <div class="font-weight-bold text-center" style=" border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;"></div>
                                            <p class="m-1 p-0 buy-t-s">Target</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#291CB4;"><?= $sheetData[15][7];?></p>
                                        </div> -->
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s">Target</p>
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#291CB4;" id="card1_target"><?=dataorwait($sheetData[10][5]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           
                            </div>


                            <div class="col-3 p-0 pt-4 text-center" style=" height:100px; color:#9C7800;">
                                
                                <h6>Trend:<br><b><span><?=trenddata($sheetData,7);?></span></b></h6>
                                <br>
                                <h6>Magical Figures</h6><h4 id="edit_card1_magic" style="font-weight:bold;"><?= $sheetData[9][6];?></h4>
                            </div>
                        
                        
                        </div>
                    </div>
                
                    <div class="card-footer p-0" style="height:auto; background:#fff; border-radius:0px 0px 10px 10px;">
                        <p class="m-1 d-flex justify-content-center align-items-center">
                        <!-- <b>Join us  -->
                            <!-- <img src="image/youtube-logo.png" style="height:30px;">  -->
                            <!-- <span style="width:1px;border:1px solid #d0d0d0; border-right:0; margin-right:10px;"></span></b> -->
                            <!-- <img src="image/telegram-logo.png" style="height:18px; margin-right:10px;"> Intelisys Investment and Trading -->
                            <b id="foot_card_1">Buy/Sell can be done as per levels for 10-15 paisa</b>
                        </p>
                    </div>
                </div>
            </div>
<!-- card 2 -->
            <div class="col-12 col-md-6 p-2">
                <div class="card" style=" border-radius:10px; box-shadow:-4px 4px 10px grey">
                    <div class="card-header p-0 pt-2"  style="background:#9C7800; border-radius:10px 10px 0px 0px; width:calc(100% + 1px);; position:relative; left:-1px;">
                        <b><h5 class="card-title text-uppercase d-flex justify-content-center align-items-center text-white" id="card2_heading"><?=substr($sheetData[12][0],0,6)." ( ".$sheetData[0][0]." )";?></h5></b>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:1px solid black; border-right:0;border-left:0;">
                        <div class="row p-0 m-0">
                            <div class="col-9" style="border-right:1px solid black;">
                            <img src="image/watermark.png" class="img-watermark" alt="watermark" style="opacity:1; position:absolute; top:23px; left:90px; height:90px; z-index:5;">
                                
                                <div class="row">
                                    <div class="col pt-2 pb-2">
                                        <div class="card font-weight-bold" style=" border-radius:10px; border:0px;">
                                            <div class="card-header text-white p-0"  style="z-index:6; background-image: linear-gradient(to right, #AD8726, #D0AE42); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center ">Support</p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;"> 
                                                <p class="m-0 d-flex justify-content-center align-items-center"  id="edit_card2_support1"><?= $sheetData[14][1];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card2_support2"><?= $sheetData[15][1];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card2_support3"><?= $sheetData[16][1];?></p>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>

                                    <div class="col pt-2 pb-2">
                                        <div class="card" style=" border-radius:10px;">
                                            <div class="card-header p-0"  style="z-index:6;background-image: linear-gradient(to right, #E0A942, #EDC96B); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center "><b>Resistance</b></p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2 font-weight-bold"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;" >
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card2_resistance1"><?= $sheetData[14][3];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card2_resistance2"><?= $sheetData[15][3];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card2_resistance3"><?= $sheetData[16][3];?></p>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col ">
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:<?=get_buy_sell_color($sheetData[17][0]);?>;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s" id="edit_card2_buysell_txt"><?=strtoupper($sheetData[17][0]);?></p>
                                                <!-- <p class="m-0 mb-3 pb-1 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[17][0]);?>;"><?= dataorwait($sheetData[17][0]);?></p> -->
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[17][0]);?>;" id="card2_buysell"><?= dataorwait($sheetData[17][1]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col mx-2 p-0 ">
                                        <!-- <div class="font-weight-bold text-center " style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;"></div>
                                            <p class="m-1 p-0 buy-t-s">Stop Loss</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#C5BE00;"><?= $sheetData[15][6];?></p>
                                        </div> -->
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s">Stop Loss</p>
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#C5BE00;" id="card2_sl"><?= dataorwait($sheetData[17][3]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <!-- <div class="font-weight-bold text-center" style=" border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;"></div>
                                            <p class="m-1 p-0 buy-t-s">Target</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#291CB4;"><?= $sheetData[15][7];?></p>
                                        </div> -->
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s">Target</p>
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#291CB4;" id="card2_target"><?= dataorwait($sheetData[17][5]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           
                            </div>


                            <div class="col-3 p-0 pt-4 text-center" style=" height:100px; color:#9C7800;">
                                
                                <h6>Trend:<br><b><?=trenddata($sheetData,14);?></b></h6>
                                <br>
                                <h6>Magical Figures</h6><h4 id="edit_card2_magic" style="font-weight:bold;"><?= $sheetData[16][6];?></h4>
                            </div>
                        
                        
                        </div>
                    </div>
                
                    <div class="card-footer p-0" style="height:auto; background:#fff; border-radius:0px 0px 10px 10px;">
                        <p class="m-1 d-flex justify-content-center align-items-center">
                        <!-- <b>Join us  -->
                            <!-- <img src="image/youtube-logo.png" style="height:30px;">  -->
                            <!-- <span style="width:1px;border:1px solid #d0d0d0; border-right:0; margin-right:10px;"></span></b> -->
                            <!-- <img src="image/telegram-logo.png" style="height:18px; margin-right:10px;"> Intelisys Investment and Trading -->
                            <b id="foot_card_2">Buy/Sell can be done as per levels for 10-15 paisa</b>
                        </p>
                    </div>
                </div>
            </div>
<!-- card 3 -->
            <div class="col-12 col-md-6 p-2">
                <div class="card" style=" border-radius:10px; box-shadow:-4px 4px 10px grey">
                    <div class="card-header p-0 pt-2"  style="background:#9C7800; border-radius:10px 10px 0px 0px; width:calc(100% + 1px);; position:relative; left:-1px;">
                        <b><h5 class="card-title text-uppercase d-flex justify-content-center align-items-center text-white" id="card3_heading"><?= substr($sheetData[19][0],0,6)." ( ".$sheetData[0][0]." )";?></h5></b>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:1px solid black; border-right:0;border-left:0;">
                        <div class="row p-0 m-0">
                            <div class="col-9" style="border-right:1px solid black;">
                            <img src="image/watermark.png" alt="watermark" class="img-watermark" style="opacity:1; position:absolute; top:23px; left:90px; height:90px; z-index:5;">
                                
                                <div class="row">
                                    <div class="col pt-2 pb-2">
                                        <div class="card font-weight-bold" style=" border-radius:10px; border:0px;">
                                            <div class="card-header text-white p-0"  style="z-index:6; background-image: linear-gradient(to right, #AD8726, #D0AE42); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center ">Support</p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;"> 
                                                <p class="m-0 d-flex justify-content-center align-items-center"  id="edit_card3_support1"><?= $sheetData[21][1];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card3_support2"><?= $sheetData[22][1];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card3_support3"><?= $sheetData[23][1];?></p>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>

                                    <div class="col pt-2 pb-2">
                                        <div class="card" style=" border-radius:10px;">
                                            <div class="card-header p-0"  style="z-index:6;background-image: linear-gradient(to right, #E0A942, #EDC96B); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center "><b>Resistance</b></p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2 font-weight-bold"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;" >
                                                <p class="m-0 d-flex justify-content-center align-items-center"  id="edit_card3_resistance1"><?= $sheetData[21][3];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card3_resistance2"><?= $sheetData[22][3];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card3_resistance3"><?= $sheetData[23][3];?></p>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col ">
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:<?=get_buy_sell_color($sheetData[24][0]);?>;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s" id="edit_card3_buysell_txt"><?=strtoupper($sheetData[24][0]);?></p>
                                                <!-- <p class="m-0 mb-3 pb-1 buy-t-s" style="color:<?=get_buy_sell_color(substr($sheetData[24][0],0,4));?>;"><?= dataorwait(substr($sheetData[24][0],5,12));?></p> -->
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[24][0]);?>;" id="card3_buysell"><?= dataorwait($sheetData[24][1]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col mx-2 p-0 ">
                                        <!-- <div class="font-weight-bold text-center " style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;"></div>
                                            <p class="m-1 p-0 buy-t-s">Stop Loss</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#C5BE00;"><?= $sheetData[15][6];?></p>
                                        </div> -->
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s">Stop Loss</p>
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#C5BE00;" id="card3_sl"><?= dataorwait($sheetData[24][3]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col ">
                                        <!-- <div class="font-weight-bold text-center" style=" border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;"></div>
                                            <p class="m-1 p-0 buy-t-s">Target</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#291CB4;"><?= $sheetData[15][7];?></p>
                                        </div> -->
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s">Target</p>
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#291CB4;"  id="card3_target"><?= dataorwait($sheetData[24][5]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           
                            </div>


                            <div class="col-3 p-0 pt-4 text-center" style=" height:100px; color:#9C7800;">
                                
                                <h6>Trend:<br><b><?=trenddata($sheetData,21);?></b></h6>
                                <br>
                                <h6>Magical Figures</h6><h4 id="edit_card3_magic" style="font-weight:bold;"><?= $sheetData[23][6];?></h4>
                            </div>
                        
                        
                        </div>
                    </div>
                
                    <div class="card-footer p-0" style="height:auto; background:#fff; border-radius:0px 0px 10px 10px;">
                        <p class="m-1 d-flex justify-content-center align-items-center">
                        <!-- <b>Join us  -->
                            <!-- <img src="image/youtube-logo.png" style="height:30px;">  -->
                            <!-- <span style="width:1px;border:1px solid #d0d0d0; border-right:0; margin-right:10px;"></span></b> -->
                            <!-- <img src="image/telegram-logo.png" style="height:18px; margin-right:10px;"> Intelisys Investment and Trading -->
                            <b id="foot_card_3">Buy/Sell can be done as per levels for 10-15 paisa</b>
                        </p>
                    </div>
                </div>
            </div>

<!-- card 4 -->
            <div class="col-12 col-md-6 p-2">
                <div class="card" style=" border-radius:10px; box-shadow:-4px 4px 10px grey">
                    <div class="card-header p-0 pt-2"  style="background:#9C7800; border-radius:10px 10px 0px 0px; width:calc(100% + 1px);; position:relative; left:-1px;">
                    <b><h5 class="card-title text-uppercase d-flex justify-content-center align-items-center text-white" id="card4_heading"><?= substr($sheetData[26][0],0,7)." ( ".$sheetData[0][0]." )";?></h5></b>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:1px solid black; border-right:0;border-left:0;">
                        <div class="row p-0 m-0">
                            <div class="col-9" style="border-right:1px solid black;">
                            <img src="image/watermark.png" class="img-watermark" alt="watermark" style="opacity:1; position:absolute; top:23px; left:90px; height:90px; z-index:5;">
                                
                                <div class="row">
                                    <div class="col pt-2 pb-2">
                                        <div class="card font-weight-bold" style=" border-radius:10px; border:0px;">
                                            <div class="card-header text-white p-0"  style="z-index:6; background-image: linear-gradient(to right, #AD8726, #D0AE42); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center ">Support</p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;"> 
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card4_support1"><?= $sheetData[28][1];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card4_support2"><?= $sheetData[29][1];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card4_support3"><?= $sheetData[30][1];?></p>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>

                                    <div class="col pt-2 pb-2">
                                        <div class="card" style=" border-radius:10px;">
                                            <div class="card-header p-0"  style="z-index:6;background-image: linear-gradient(to right, #E0A942, #EDC96B); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center "><b>Resistance</b></p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2 font-weight-bold"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;" >
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card4_resistance1"><?= $sheetData[28][3];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card4_resistance2"><?= $sheetData[29][3];?></p>
                                                <hr class="m-0 p-0" style="color:black; background:black;">
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_card4_resistance3"><?= $sheetData[30][3];?></p>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    
                                </div>

                                <div class="row">
                                    <div class="col ">
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:<?=get_buy_sell_color($sheetData[31][0]);?>;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s" id="edit_card4_buysell_txt"><?=strtoupper($sheetData[31][0]);?></p>
                                                <!-- <p class="m-0 mb-3 pb-1 buy-t-s" style="color:<?=get_buy_sell_color(substr($sheetData[31][0],0,4));?>;"><?= dataorwait(substr($sheetData[31][0],5,12));?></p> -->
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[31][0]);?>;"  id="card4_buysell"><?= dataorwait($sheetData[31][1]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col mx-2 p-0 ">
                                        <!-- <div class="font-weight-bold text-center " style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;"></div>
                                            <p class="m-1 p-0 buy-t-s">Stop Loss</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#C5BE00;"><?= $sheetData[15][6];?></p>
                                        </div> -->
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s">Stop Loss</p>
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#C5BE00;" id="card4_sl"><?= dataorwait($sheetData[31][3]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col ">
                                        <!-- <div class="font-weight-bold text-center" style=" border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;"></div>
                                            <p class="m-1 p-0 buy-t-s">Target</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#291CB4;"><?= $sheetData[15][7];?></p>
                                        </div> -->
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-0 mt-1 p-0 buy-t-s">Target</p>
                                                <!-- <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#291CB4;"><= substr($sheetData[31][0],27,6)?substr($sheetData[31][0],27,6):"-";?></p> -->
                                                <p class="m-0 mb-3 pb-1 buy-t-s" style="color:#291CB4;" id="card4_target"><?= dataorwait($sheetData[31][5]);?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                           
                            </div>


                            <div class="col-3 p-0 pt-4 text-center" style=" height:100px; color:#9C7800;">
                                
                                <h6>Trend:<br><b><?=trenddata($sheetData,28);?></b></h6>
                                <br>
                                <h6>Magical Figures</h6><h4 id="edit_card4_magic" style="font-weight:bold;"><?= $sheetData[30][6];?></h4>
                            </div>
                        
                        
                        </div>
                    </div>
                
                    <div class="card-footer p-0" style="height:auto; background:#fff; border-radius:0px 0px 10px 10px;">
                        <p class="m-1 d-flex justify-content-center align-items-center">
                        <!-- <b>Join us  -->
                            <!-- <img src="image/youtube-logo.png" style="height:30px;">  -->
                            <!-- <span style="width:1px;border:1px solid #d0d0d0; border-right:0; margin-right:10px;"></span></b> -->
                            <!-- <img src="image/telegram-logo.png" style="height:18px; margin-right:10px;"> Intelisys Investment and Trading -->
                            <b id="foot_card_4">Buy/Sell can be done as per levels for 10-15 paisa</b>
                        </p>
                    </div>
                </div>
            </div>

                

        </div>

        <br>

        <div class="row pb-5">
            <div class="col">
                <div class="px-4">
                <div class="row">
                    <div class="col">
                        <span style="font-size:25px;"><b>Index:</b></span><br><br>
                        <div class="" style="border-radius:50%; background:#0E901F; width:30px; height:30px; float:left;"></div>
                        <span class="ml-3" style="font-size:20px;"><b>BUY</b></span>
                        <br><br>

                        <div class="" style="border-radius:50%; background:#C5BE00; width:30px; height:30px; float:left;"></div>
                        <span class="ml-3" style="font-size:20px;"><b>STOP LOSSL</b></span>
                        <br><br>

                        <div class="" style="border-radius:50%; background:#FF0000; width:30px; height:30px; float:left;"></div>
                        <span class="ml-3" style="font-size:20px;"><b>SELL</b></span>
                        <br><br>

                        <div class="" style="border-radius:50%; background:#291CB4; width:30px; height:30px; float:left;"></div>
                        <span class="ml-3" style="font-size:20px;"><b>TARGET</b></span>
                    </div>
                    <div class="col pr-5" style="padding-top:100px;">
                    <img src="image/logo-s.png" style="width:250px;" alt="logo">
                    </div>
                </div>
                    
                </div>
            </div>
            <div class="col mt-3 pb-4 mr-0 pr-0">
                <p class="mr-5" style="font-size:12px; text-align:center"><b>Disclaimer:</b> Our Company Do NOT promise any fix returns to any person or company. The accuracy
                    mentioned above is only for reference purpose and not to be construed as a promise for returns on
                    investment. The actual return have no relation with the above scenerio provided above the sample
                    attached. The actual returns may even come negative. all Investments are subject to risk and any
                    consequences occured to anyone should be withheld with that particular person/company. We
                    nowhere take any responsibility for act and its result.</p>
                    <div class="text-center">
                    <img src="image/youtube-logo.png" style="height:45px;"><b> Youtube : Intellisys Investment and Trading</b>
                    </div>
                    <h6 class="text-center" style="font-size:20px;"><b>Building Trust Lowering Uncertainities</b></h6>
            </div>
            
                
            
        </div>


    </div>
    <?php
        endif;
    ?>

</div>


</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>

<?php include 'footer.php';?>


<script>

    $("#download").click(function(e){
    e.preventDefault();
    domtoimage.toJpeg(document.getElementById('intelisys'), { quality: 1 }).then(function (dataUrl) {
            var link = document.createElement('a');
            link.download = '<?=$_POST['type']."_".substr($sheetData[0][0],-10);?>.jpg';
            // link.download="a.jpg";
            link.href = dataUrl;
            link.click();
        });
});

var enable_editing=0;


$("#edit_button").click(function(e){
    e.preventDefault();
    enable_editing=enable_editing?0:1;

    if(enable_editing){
        $("#edit_button").html("Save Data");
        $(".img-watermark").hide();
    }else{
        $("#edit_button").html("Edit Data");
        $(".img-watermark").show();
    }
    edit_add_input("#edit_date","child_input","number",50);
    edit_add_input("#edit_year","child_input","number",80);

    edit_add_input("#card1_heading","child_input","text",80);
    edit_add_input("#card2_heading","child_input","text",80);
    edit_add_input("#card3_heading","child_input","text",80);
    edit_add_input("#card4_heading","child_input","text",80);

    edit_add_input("#edit_card4_support1","child_input","number",70);
    edit_add_input("#edit_card4_support2","child_input","number",70);
    edit_add_input("#edit_card4_support3","child_input","number",70);
    edit_add_input("#edit_card4_resistance1","child_input","number",70);
    edit_add_input("#edit_card4_resistance2","child_input","number",70);
    edit_add_input("#edit_card4_resistance3","child_input","number",70);
    
    edit_add_input("#edit_card3_support1","child_input","number",70);
    edit_add_input("#edit_card3_support2","child_input","number",70);
    edit_add_input("#edit_card3_support3","child_input","number",70);
    edit_add_input("#edit_card3_resistance1","child_input","number",70);
    edit_add_input("#edit_card3_resistance2","child_input","number",70);
    edit_add_input("#edit_card3_resistance3","child_input","number",70);

    edit_add_input("#edit_card2_support1","child_input","number",70);
    edit_add_input("#edit_card2_support2","child_input","number",70);
    edit_add_input("#edit_card2_support3","child_input","number",70);
    edit_add_input("#edit_card2_resistance1","child_input","number",70);
    edit_add_input("#edit_card2_resistance2","child_input","number",70);
    edit_add_input("#edit_card2_resistance3","child_input","number",70);
    
    edit_add_input("#edit_card1_support1","child_input","number",70);
    edit_add_input("#edit_card1_support2","child_input","number",70);
    edit_add_input("#edit_card1_support3","child_input","number",70);
    edit_add_input("#edit_card1_resistance1","child_input","number",70);
    edit_add_input("#edit_card1_resistance2","child_input","number",70);
    edit_add_input("#edit_card1_resistance3","child_input","number",70);
    
    
    edit_add_input("#edit_card1_magic","child_input","number",80);
    edit_add_input("#edit_card2_magic","child_input","number",80);
    edit_add_input("#edit_card3_magic","child_input","number",80);
    edit_add_input("#edit_card4_magic","child_input","number",80);
    
    
    
    edit_add_input("#card1_buysell","child_input","text",100);
    edit_add_input("#card1_sl","child_input","text",80);
    edit_add_input("#card1_target","child_input","text",80);

    edit_add_input("#card2_buysell","child_input","text",100);
    edit_add_input("#card2_sl","child_input","text",80);
    edit_add_input("#card2_target","child_input","text",80);

    edit_add_input("#card3_buysell","child_input","text",100);
    edit_add_input("#card3_sl","child_input","text",80);
    edit_add_input("#card3_target","child_input","text",80);

    edit_add_input("#card4_buysell","child_input","text",100);
    edit_add_input("#card4_sl","child_input","text",80);
    edit_add_input("#card4_target","child_input","text",80);

    edit_add_input("#foot_card_1","child_input","text",500);
    edit_add_input("#foot_card_2","child_input","text",500);
    edit_add_input("#foot_card_3","child_input","text",500);
    edit_add_input("#foot_card_4","child_input","text",500);



     //select option edit
     edit_add_select("#edit_month",".select_short_month",short_month_select);

     edit_add_select("#edit_card4_buysell_txt",'.select_buy_Sell',buy_sell_select);
     edit_add_select("#edit_card3_buysell_txt",'.select_buy_Sell',buy_sell_select);
     edit_add_select("#edit_card2_buysell_txt",'.select_buy_Sell',buy_sell_select);
     edit_add_select("#edit_card1_buysell_txt",'.select_buy_Sell',buy_sell_select);


});

function edit_add_input(parent_div,child_div,input_type,width){
    if(enable_editing){
        // console.log("enable_editing");
        this_val=$(parent_div).html();
        $(parent_div).html("<input type='"+input_type+"' class='"+child_div+"' value='"+this_val+"'style='width:"+width+"px;'> ");
    }else{
        // console.log("disable editing");
        value_data=$(parent_div).children('.'+child_div).val();
        $(parent_div).html(value_data);
    }
    
}

function edit_add_select(parent_div,child_div,select_var){
    if(enable_editing){

        this_val= $(parent_div).html().replaceAll(' ','').toUpperCase();
        $(parent_div).html(select_var);
        $(parent_div).children(child_div).val(this_val);
        
    }else{
        value_data=$(parent_div).children(child_div).val();
        $(parent_div).html(value_data);
    }

    
}

$(document).on("change",".select_buy_Sell",function(){
    new_val=$(this).val();
    color_code=get_buy_sell_color(new_val);
    $(this).parent().siblings('p').css("color",color_code);
    $(this).parent().parent().siblings().css("background",color_code);

});

function get_buy_sell_color(val_ue){
        buy_sell_color="";
        switch(val_ue.toLowerCase()){
            case "buy":
                buy_sell_color="#0E901F";
                break;
            case "sell":
                buy_sell_color="#FF0000";
                break;
            case "wait":
                buy_sell_color="#F68900";
                break;
            case "hold long":
                buy_sell_color="#630678";
                break;
            case "hold short":
                buy_sell_color="#001AFF";
                break;
            case "range bound":
                buy_sell_color="#56150C";
                break;
            default:
                buy_sell_color="#d0d0d0";
                break;
        }
        return buy_sell_color;
    }

var month_select="";
month_select+='<select class="select_month">';
month_select+='<option value="JANUARY">JANUARY</option>';
month_select+='<option value="FEBRUARY">FEBRUARY</option>';
month_select+='<option value="MARCH">MARCH</option>';
month_select+='<option value="APRIL">APRIL</option>';
month_select+='<option value="MAY">MAY</option>';
month_select+='<option value="JUNE">JUNE</option>';
month_select+='<option value="JULY">JULY</option>';
month_select+='<option value="AUGUST">AUGUST</option>';
month_select+='<option value="SEPTEMBER">SEPTEMBER</option>';
month_select+='<option value="OCTOBER">OCTOBER</option>';
month_select+='<option value="NOVEMBER">NOVEMBER</option>';
month_select+='<option value="DECEMBER">DECEMBER</option>';
month_select+='</select>';

var short_month_select="";
short_month_select+='<select class="select_short_month">';
short_month_select+='<option value="JAN">JAN</option>';
short_month_select+='<option value="FEB">FEB</option>';
short_month_select+='<option value="MAR">MAR</option>';
short_month_select+='<option value="APR">APR</option>';
short_month_select+='<option value="MAY">MAY</option>';
short_month_select+='<option value="JUN">JUN</option>';
short_month_select+='<option value="JUL">JUL</option>';
short_month_select+='<option value="AUG">AUG</option>';
short_month_select+='<option value="SEP">SEPT</option>';
short_month_select+='<option value="OCT">OCT</option>';
short_month_select+='<option value="NOV">NOV</option>';
short_month_select+='<option value="DEC">DEC</option>';
short_month_select+='</select>';


var buy_sell_select="";
buy_sell_select+='<select class="select_buy_Sell" style="width:100px;">';
buy_sell_select+='<option value="BUY">BUY</option>';
buy_sell_select+='<option value="SELL">SELL</option>';
buy_sell_select+='<option value="WAIT">WAIT</option>';
buy_sell_select+='<option value="HOLD LONG" id="hold long">HOLD LONG</option>';
buy_sell_select+='<option value="HOLD SHORT">HOLD SHORT</option>';
buy_sell_select+='<option value="RANGE BOUND">RANGE BOUND</option>';
buy_sell_select+='</select>';





</script>
</html>
