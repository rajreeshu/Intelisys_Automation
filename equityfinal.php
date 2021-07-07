<?php
require __DIR__ . '/PhpSpreadsheet-master/vendor/autoload.php';

if(isset($_POST['submit'])):

    $type=$_POST['type'];


    
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
 
$sheetData = $spreadsheet->getActiveSheet()->toArray();


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
        switch(strtolower($val)){
            case "buy":
                $buy_sell_color="#0E901F";
                break;
            case "sell":
                $buy_sell_color="#FF0000";
                break;
            case "wait":
                $buy_sell_color="#F68900";
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
                $buy_sell_color="#d0d0d0";
                break;
        }
        return $buy_sell_color;
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
    
    </style>
</head>
<body style="background:grey;">
    

<div class="container pt-3 mb-5">

<?php include 'header.php';?>
<hr>
    <?php 
        if(isset($_POST['submit'])):
    ?>

    <div class="intelisys m-0 pl-3 pr-3" style="background:#DADADA;" id="intelisys">
        <div class="row p-1" style="background:#fff;">
            <div class="col-3"><img src="image/logo-s.png" style="width:170px;"></div>
            <h2 class="col-6 text-center"><b>NSE Levels</b></h2>
            <div class="col-3 text-right">
                <b>
                    <span class="p-0 m-0" style="font-size:20px;">
                        <span id="edit_date"><?= substr($sheetData[0][0], -10,2);?></span>
                        <span id="edit_month"><?=$month;?></span>
                    </span> 
                    <br>
                    <span style="font-size:16px;" id="edit_year"><?= substr($sheetData[0][0], -4,4);?></span>
                </b>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center align-items-center m-2"><b><span style="color:#CC1710;">&#9888 Warning &#9888 &nbsp &nbsp</span> *Resharing this sheet is not legal* <span style="color:#CC1710;">&nbsp &nbsp &#9888 Warning &#9888</span></b></div>
        </div>

        <div class="row mr-3 ml-3">


            <div class="col-12 col-md-6 p-2">
                <div class="card" style=" border-radius:10px; box-shadow:-4px 4px 10px grey">
                    <div class="card-header p-0 pt-2"  style="background:#fff; border-radius:10px 10px 0px 0px;">
                        <h5 class="card-title text-uppercase d-flex justify-content-center align-items-center"><b>NIFTY <span id="edit_nifty_month"><?=$month_full;?></span> CONTRACT</b></h5>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:1px solid black; border-right:0;border-left:0;">
                        <div class="row p-0 m-0">
                            <div class="col-9 " style="border-right:1px solid black; overflow:hidden; ">
                            <img src="image/watermark.png" class="img-watermark" style="opacity:1; position:absolute; top:23px; height:90px; z-index:5;">
                                
                                <div class="row">
                                    <div class="col pt-2 pb-2">
                                        <div class="card font-weight-bold" style=" border-radius:10px; border:0px;">
                                            <div class="card-header text-white p-0"  style="z-index:6; background-image: linear-gradient(to right, #AD8726, #D0AE42); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center ">Support</p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;"> 
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_nifty_support1"><?= $sheetData[5][0];?></p>
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_nifty_support2"><?= $sheetData[5][1];?></p>
                                                <!-- <input type="text" class="child_input" value="15435" style="width:70px;"> -->
                                            </div>
                                            
                                        
                                        </div>
                                    </div>

                                    <div class="col pt-2 pb-2">
                                        <div class="card" style=" border-radius:10px;">
                                            <div class="card-header p-0"  style="z-index:6;background-image: linear-gradient(to right, #E0A942, #EDC96B); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center "><b>Resistance</b></p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2 font-weight-bold"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;" >
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_nifty_resistance1"><?= $sheetData[5][2];?></p>
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_nifty_resistance2"><?= $sheetData[5][3];?></p>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    
                                </div>

                           
                            </div>


                            <div class="col-3 p-0 pt-3 text-center" style=" height:100px; color:#9C7800;">
                                
                                <h5>Magical Figures <br><b><span id="edit_nifty_magic"><?= $sheetData[5][4];?></b></h5>
                            </div>
                        
                        
                        </div>
                    </div>
                
                    <div class="card-footer p-0" style="height:auto; background:#fff; border-radius:0px 0px 10px 10px;">
                        <p class="m-1 d-flex justify-content-center align-items-center"><b>Join us 
                            <img src="image/youtube-logo.png" style="height:30px;"> 
                            <span style="width:1px;border:1px solid #d0d0d0; border-right:0; margin-right:10px;"></span></b>
                            <img src="image/telegram-logo.png" style="height:18px; margin-right:10px;"> Intelisys Investment and Trading
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 p-2">
                <div class="card" style=" border-radius:10px; box-shadow:-4px 4px 10px grey">
                    <div class="card-header  p-0 pt-2"  style="background:#fff; border-radius:10px 10px 0px 0px;">
                        <h5 class="card-title text-uppercase d-flex justify-content-center align-items-center"><b>BANK-NIFTY <span id="edit_banknifty_month"><?=$month_full;?></span> CONTRACT</b></h5>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:1px solid black; border-right:0;border-left:0;">
                    
                        <div class="row p-0 m-0">
                            <div class="col-9" style="border-right:1px solid black; overflow:hidden;">
                            <img src="image/watermark.png" class="img-watermark" style=" position:absolute; top:23px; height:90px; z-index:5;">
                                
                                <div class="row">
                                    <div class="col pt-2 pb-2">
                                        <div class="card font-weight-bold" style=" border-radius:10px; border:0px;">
                                            <div class="card-header text-white p-0"  style="background-image: linear-gradient(to right, #AD8726, #D0AE42); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center ">Support</p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2"  style=" background:#fff; border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;"> 
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_banknifty_support1"><?= $sheetData[10][0];?></p>
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_banknifty_support2"><?= $sheetData[10][1];?></p>
                                                
                                            </div>
                                        
                                        </div>
                                    </div>

                                    <div class="col pt-2 pb-2">
                                        <div class="card" style=" border-radius:10px;">
                                            <div class="card-header p-0"  style="background-image: linear-gradient(to right, #E0A942, #EDC96B); border-radius:10px 10px 0px 0px;">
                                                <p class="p-0 m-0 d-flex justify-content-center align-items-center "><b>Resistance</b></p>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2 font-weight-bold"  style=" background:#fff; border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;" >
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_banknifty_resistance1"><?= $sheetData[10][2];?></p>
                                                <p class="m-0 d-flex justify-content-center align-items-center" id="edit_banknifty_resistance2"><?= $sheetData[10][3];?></p>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    
                                </div>

                           
                            </div>


                            <div class="col-3 p-0 pt-3 text-center" style=" height:100px; color:#9C7800;">
                                
                                <h5>Magical Figures <br><b><span id="edit_banknifty_magic"><?= $sheetData[10][4];?></span></b></h5>
                            </div>
                        
                        
                        </div>
                    </div>
                
                    <div class="card-footer p-0" style="height:auto; background:#fff; border-radius:0px 0px 10px 10px;">
                        <!-- <p class="m-1 d-flex justify-content-center align-items-center"><b>Buy/Sell can be done as per levels for 10-15 Paisa</b></p> -->
                        <p class="m-1 d-flex justify-content-center align-items-center"><b>Join us 
                            <img src="image/youtube-logo.png" style="height:30px;"> 
                            <span style="width:1px;border:1px solid #d0d0d0; border-right:0; margin-right:10px;"></span></b>
                            <img src="image/telegram-logo.png" style="height:18px; margin-right:10px;"> Intelisys Investment and Trading
                        </p>
                    </div>
                </div>
            </div>

                

        </div>

        <div class="row m-3 p-3 text-center" style="background:#fff; border-radius: 10px 10px 10px 10px;">
            <div class="col-12">
                <h2>SCRIPT (NSE EQUITIES)</h2>

            </div>
<!-- card 1 -->
            <div class="col-12 col-md-6 mt-3">
            <div class="card" style=" border-radius:10px; overflow:hidden;">
                    <div class="card-header text-white p-1"  style="background:#9C7700; border-radius:10px 10px 0px 0px; border:2px solid black; border-bottom:0;">
                        <h3 class="card-title text-uppercase d-flex justify-content-center align-items-center m-0" id="edit_card1_title"><?= $sheetData[15][0];?></h3>
                        <p class="m-0" style="color:#dfc986;">Intelisys Investment & Trading</p>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:2px solid black; border-radius:0px 0px 10px 10px; overflow:hidden;">
                    
                        <div class="row p-0 m-0">
                        <img src="image/watermark.png" class="img-watermark"  style="position:absolute; top:80px; left:50px; height:90px; z-index:5;">
                            <div class="col-12 pt-3">
                            

                                <div class="row">
                                    <div class="col">
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:<?=get_buy_sell_color($sheetData[15][4]);?>;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-1 p-0 buy-t-s" id="edit_card1_buysell_txt"><?= $sheetData[15][4];?></p>
                                                <p class="m-2 mb-3 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[15][4]);?>;" id="edit_card1_buysell"><?= $sheetData[15][5];?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="font-weight-bold text-center " style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;"></div>
                                            <p class="m-1 p-0 buy-t-s">Stop Loss</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#C5BE00;" id="edit_card1_stoploss"><?= $sheetData[15][6];?></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-bold text-center" style=" border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;"></div>
                                            <p class="m-1 p-0 buy-t-s">Target</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#291CB4;" id="edit_card1_target"><?= $sheetData[15][7];?></p>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>                        
                        
                        </div>
                    </div>
                
                   
                </div>
            </div>
<!-- card 2 -->
            <div class="col-12 col-md-6 mt-3">
            <div class="card" style=" border-radius:10px; overflow:hidden;">
                    <div class="card-header text-white p-1"  style="background:#9C7700; border-radius:10px 10px 0px 0px; border:2px solid black; border-bottom:0;">
                        <h3 class="card-title text-uppercase d-flex justify-content-center align-items-center m-0" id="edit_card2_title"><?= $sheetData[16][0];?></h3>
                        <p class="m-0" style="color:#dfc986;">Intelisys Investment & Trading</p>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:2px solid black; border-radius:0px 0px 10px 10px;">
                        <div class="row p-0 m-0">
                        <img src="image/watermark.png" class="img-watermark"  style="position:absolute; top:80px; left:50px; height:90px; z-index:5;">
                            <div class="col-12 pt-3">

                                <div class="row">
                                    <div class="col">
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:<?=get_buy_sell_color($sheetData[16][4]);?>;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-1 p-0 buy-t-s" id="edit_card2_buysell_txt"><?= $sheetData[16][4];?></p>
                                                <p class="m-2 mb-3 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[16][4]);?>;"><span id="edit_card2_buysell"><?= $sheetData[16][5];?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="font-weight-bold text-center " style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;"></div>
                                            <p class="m-1 p-0 buy-t-s">Stop Loss</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#C5BE00;" id="edit_card2_stoploss"><?= $sheetData[16][6];?></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-bold text-center" style=" border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;"></div>
                                            <p class="m-1 p-0 buy-t-s">Target</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#291CB4;" id="edit_card2_target"><?= $sheetData[16][7];?></p>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>                        
                        
                        </div>
                    </div>
                
                   
                </div>
            </div>
<!-- card 3 -->
        <div class="col-12 col-md-6 mt-3">
            <div class="card" style=" border-radius:10px; overflow:hidden;">
                    <div class="card-header text-white p-1"  style="background:#9C7700; border-radius:10px 10px 0px 0px; border:2px solid black; border-bottom:0;">
                        <h3 class="card-title text-uppercase d-flex justify-content-center align-items-center m-0" id="edit_card3_title"><?= $sheetData[17][0];?></h3>
                        <p class="m-0" style="color:#dfc986;">Intelisys Investment & Trading</p>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:2px solid black; border-radius:0px 0px 10px 10px;">
                        <div class="row p-0 m-0">
                        <img src="image/watermark.png"  class="img-watermark" style="position:absolute; top:80px; left:50px; height:90px; z-index:5;">
                            <div class="col-12 pt-3">

                                <div class="row">
                                    <div class="col">
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:<?=get_buy_sell_color($sheetData[17][4]);?>;">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-1 p-0 buy-t-s" id="edit_card3_buysell_txt"><?= $sheetData[17][4];?></p>
                                                <p class="m-2 mb-3 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[15][4]);?>;"><span id="edit_card3_buysell"><?= $sheetData[17][5];?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="font-weight-bold text-center " style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;"></div>
                                            <p class="m-1 p-0 buy-t-s">Stop Loss</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#C5BE00;" id="edit_card3_stoploss"><?= $sheetData[17][6];?></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-bold text-center" style=" border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;"></div>
                                            <p class="m-1 p-0 buy-t-s">Target</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#291CB4;" id="edit_card3_target"><?= $sheetData[17][7];?></p>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>                        
                        
                        </div>
                    </div>
                
                   
                </div>
            </div>
<!-- card 4 -->
            <div class="col-12 col-md-6 mt-3">
            <div class="card" style=" border-radius:10px; overflow:hidden;">
                    <div class="card-header text-white p-1"  style="background:#9C7700; border-radius:10px 10px 0px 0px; border:2px solid black; border-bottom:0;">
                        <h3 class="card-title text-uppercase d-flex justify-content-center align-items-center m-0" id="edit_card4_title"><?= $sheetData[18][0];?></h3>
                        <p class="m-0" style="color:#dfc986;">Intelisys Investment & Trading</p>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:2px solid black; border-radius:0px 0px 10px 10px;">
                        <div class="row p-0 m-0">
                        <img src="image/watermark.png"  class="img-watermark" style="position:absolute; top:80px; left:50px; height:90px; z-index:5;">
                            <div class="col-12 pt-3" >

                                <div class="row">
                                    <div class="col">
                                        <div class="font-weight-bold text-center mb-2" style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:<?=get_buy_sell_color($sheetData[18][4]);?>;" id="edit_card4_buysell_txt_top">
                                            </div>
                                             <div class="" style="padding:0px;">
                                                <p class="m-1 p-0 buy-t-s" id="edit_card4_buysell_txt"><?= $sheetData[18][4];?></p>
                                                <p class="m-2 mb-3 buy-t-s" style="color:<?=get_buy_sell_color($sheetData[16][4]);?>;" id="edit_card4_buysell_txt_col"><span id="edit_card4_buysell"><?= $sheetData[18][5];?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <div class="font-weight-bold text-center " style="border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#C5BE00;"></div>
                                            <p class="m-1 p-0 buy-t-s">Stop Loss</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#C5BE00;" id="edit_card4_stoploss"><?= $sheetData[18][6];?></p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="font-weight-bold text-center" style=" border-radius:10px 10px 10px 10px; box-shadow:-2px 2px 3px #d0d0d0;">
                                            
                                            <div style="height:13px; border-radius:10px 10px 0px 0px; background:#291CB4;"></div>
                                            <p class="m-1 p-0 buy-t-s">Target</p>
                                            <p class="m-2 mb-3 buy-t-s" style="color:#291CB4;" id="edit_card4_target"><?= $sheetData[18][7];?></p>
                                        </div>
                                    </div>
                                </div>
                           
                            </div>                        
                        
                        </div>
                    </div>
                
                   
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col">
                <div  style="background:linear-gradient(to right, #AE8624, #EDC968); border-radius:10px;">
                <div class="row mb-0">
                    <div class="col text-center mt-3"><b>NOTE: Significance of Magical Figures</b></div>
                </div>
                <div class="row p-4 mt-0 pt-0" >
                    <div class="col-12 col-md-6 p-4  pt-0 mt-0" style=" border-radius:10px 10px 10px 10px;">
                        <div class="row mt-0 pt-0">
                            <div class="col-12 mt-0 pt-0" style="background:#FF0000; height:10px; border-radius: 10px 10px 0px 0px;"></div>
                            <div class="col p-2 text-center" style="background:#fff; border-radius: 0px 0px 10px 10px;box-shadow:2px 2px 2px grey; font-size:11px;"><b>If market trades Below Magical Figures</b> <h4 style="color:#ff0000;">BEARISH MARKET</h4></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 p-4" style=" border-radius:10px 10px 10px 10px;">
                        <div class="row ">
                            <div class="col-12" style="background:#0E901F; height:10px; border-radius: 10px 10px 0px 0px;"></div>
                            <div class="col p-2  text-center" style="background:#fff; border-radius: 0px 0px 10px 10px;box-shadow:2px 2px 2px grey; font-size:11px;"><b>If market trades Below Magical Figures</b> <h4 style="color:#0E901F">BULLISH MARKET</h4></div>
                        </div>
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

            <!-- <br><br>
        <div class="row">
            <div class="col">
                <select>
                    <option>hello</option>
                </select>
            </div>
            <div class="col"></div>
        </div> -->

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


//edit option enabling

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

    edit_add_input("#edit_nifty_support1","child_input","number",70);
    edit_add_input("#edit_nifty_support2","child_input","number",70);
    edit_add_input("#edit_nifty_resistance1","child_input","number",70);
    edit_add_input("#edit_nifty_resistance2","child_input","number",70);
    edit_add_input("#edit_nifty_magic","child_input","number",100);

    edit_add_input("#edit_banknifty_support1","child_input","number",70);
    edit_add_input("#edit_banknifty_support2","child_input","number",70);
    edit_add_input("#edit_banknifty_resistance1","child_input","number",70);
    edit_add_input("#edit_banknifty_resistance2","child_input","number",70);
    edit_add_input("#edit_banknifty_magic","child_input","number",100);


    edit_add_input("#edit_card1_title","child_input","text",180);
    edit_add_input("#edit_card1_buysell","child_input","text",100);
    edit_add_input("#edit_card1_stoploss","child_input","number",100);
    edit_add_input("#edit_card1_target","child_input","number",100);
    
    
    edit_add_input("#edit_card2_title","child_input","text",180);
    edit_add_input("#edit_card2_buysell","child_input","text",100);
    edit_add_input("#edit_card2_stoploss","child_input","number",100);
    edit_add_input("#edit_card2_target","child_input","number",100);
    
    
    edit_add_input("#edit_card3_title","child_input","text",180);
    edit_add_input("#edit_card3_buysell","child_input","text",100);
    edit_add_input("#edit_card3_stoploss","child_input","number",100);
    edit_add_input("#edit_card3_target","child_input","number",100);
    
    
    edit_add_input("#edit_card4_title","child_input","text",180);
    edit_add_input("#edit_card4_buysell","child_input","text",100);
    edit_add_input("#edit_card4_stoploss","child_input","number",100);
    edit_add_input("#edit_card4_target","child_input","number",100);

    //select option edit
    edit_add_select("#edit_month",".select_short_month",short_month_select);
    edit_add_select("#edit_nifty_month",".select_month",month_select);
    edit_add_select("#edit_banknifty_month",".select_month",month_select);

    edit_add_select("#edit_card1_buysell_txt",'.select_buy_Sell',buy_sell_select);
    edit_add_select("#edit_card2_buysell_txt",'.select_buy_Sell',buy_sell_select);
    edit_add_select("#edit_card3_buysell_txt",'.select_buy_Sell',buy_sell_select);
    edit_add_select("#edit_card4_buysell_txt",'.select_buy_Sell',buy_sell_select);
    
    
});

function edit_add_input(parent_div,child_div,input_type,width){
    if(enable_editing){
        this_val=$(parent_div).html();
        $(parent_div).html("<input type='"+input_type+"' class='"+child_div+"' value='"+this_val+"'style='width:"+width+"px;'> ");
    }else{
        value_data=$(parent_div).children('.'+child_div).val();
        $(parent_div).html(value_data);
    }
    
}

function edit_add_select(parent_div,child_div,select_var){
    if(enable_editing){

        this_val=$(parent_div).html();
        $(parent_div).html(select_var);
        $(parent_div).children(child_div).val(this_val);
        // console.log(this_val.length);

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
buy_sell_select+='<option value="HOLD LONG">HOLD LONG</option>';
buy_sell_select+='<option value="HOLD SHORT">HOLD SHORT</option>';
buy_sell_select+='<option value="RANGE BOUND">RANGE BOUND</option>';
buy_sell_select+='</select>';




</script>
</html>
