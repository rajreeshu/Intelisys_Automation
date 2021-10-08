<?php
require __DIR__ . '/PhpSpreadsheet-master/vendor/autoload.php';

if(isset($_POST['submit'])):

    $type=$_POST['type'];


    
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
 
$sheetData = $spreadsheet->getActiveSheet()->toArray();

// echo "<pre>";
// print_r($sheetData);
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

    function get_trend_color($val_ue){
        $trend_color="";
        switch($val_ue){
            case "UP TREND":
                $trend_color="#0E901F";
                break;
            case "DOWN TREND":
                $trend_color="#FF0000";
                break;
            case "SIDEWAYS":
                $trend_colorr="#F68900";
                break;
            default:
            $trend_color="#d0d0d0";
                break;
        }
        return $trend_color;
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
    

<div class="container mb-5" style="padding-left:150px; padding-right:150px;">

<?php include 'header.php';?>
<hr>
    <?php 
        if(isset($_POST['submit'])):
    ?>

    <div class="intelisys m-0 pl-3 pr-3 pb-1" style="background:#DADADA;" id="intelisys">
        <div class="row p-1" style="background:#fff;">
            <div class="col-3"><img src="image/logo-s.png" style="width:170px;"></div>
            <h2 class="col-6 text-center font-weight-bold" id="page_heading"><?=explode('(',$sheetData[3][1])[0];?> Levels</h2>
            <div class="col-3 text-right">
                <b>
                    <span class="p-0 m-0" style="font-size:20px;">
                        <span id="edit_date"><?=substr(explode(',',$sheetData[3][6])[1],-2);?></span>
                        <span id="edit_month"><?=substr(explode(',',$sheetData[3][6])[1],1,3);?></span>
                    </span> 
                    <br>
                    <span style="font-size:16px;" id="edit_year"><?=substr(explode(',',$sheetData[3][6])[2],1,4);?></span>
                </b>
            </div>
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center align-items-center m-2"><b><span style="color:#CC1710;">&#9888 Warning &#9888 &nbsp &nbsp</span> *Resharing this sheet is not legal* <span style="color:#CC1710;">&nbsp &nbsp &#9888 Warning &#9888</span></b></div>
        </div>

        <div class="row mr-3 ml-3">

<!-- card 1 -->
            <div class="col-12 p-2">
                <div class="card" style=" border-radius:10px; box-shadow:-4px 4px 10px grey">
                    <div class="card-header p-0 pt-2"  style="background:#fff; border-radius:10px 10px 0px 0px;">
                        <h3 class="card-title text-uppercase d-flex justify-content-center align-items-center"><b><span id="card1_head"><?=explode('(',$sheetData[3][1])[0];?></span></b></h3>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:1px solid black; border-right:0;border-left:0;">
                        <div class="row p-0 m-0">
                            <div class="col-9 " style="border-right:1px solid black; overflow:hidden; ">
                            <img src="image/watermark.png" class="img-watermark" style="opacity:1; position:absolute; top:43px; left:100px; height:90px; z-index:5;">
                                
                                <div class="row">
                                    <div class="col pt-2 pb-2">
                                        <div class="card font-weight-bold" style=" border-radius:10px; border:0px;">
                                            <div class="card-header text-white p-0"  style="z-index:6; background-image: linear-gradient(to right, #AD8726, #D0AE42); border-radius:10px 10px 0px 0px; height:35px;">
                                                <h4 class="p-0 m-0 d-flex justify-content-center align-items-center ">Support</h4>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;"> 
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty_support1"><?= $sheetData[6][2];?></h4>
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty_support2"><?= $sheetData[7][2];?></h4>
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty_support3"><?= $sheetData[8][2];?></h4>
                                                <!-- <input type="text" class="child_input" value="15435" style="width:70px;"> -->
                                            </div>
                                            
                                        
                                        </div>
                                    </div>

                                    <div class="col pt-2 pb-2">
                                        <div class="card" style=" border-radius:10px;">
                                            <div class="card-header p-0"  style="z-index:6;background-image: linear-gradient(to right, #E0A942, #EDC96B); border-radius:10px 10px 0px 0px; height:35px;">
                                                <h4 class="p-0 m-0 d-flex justify-content-center align-items-center "><b>Resistance</b></h4>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2 font-weight-bold"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;" >
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty_resistance1"><?= $sheetData[6][4];?></h4>
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty_resistance2"><?= $sheetData[7][4];?></h4>
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty_resistance3"><?= $sheetData[8][4];?></h4>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    
                                </div>

                           
                            </div>


                            <div class="col-3 p-0 pt-2 text-center" style=" height:100px; color:#9C7800;">
                                <h5 style="padding:0px; margin:0px;">Trend:</h5 style="padding:0px; margin:0px;"><h5 id="card1_trend"  style="color:<?=get_trend_color(trenddata($sheetData,6));?>"><?=trenddata($sheetData,6);?></h5>
                                <h6 style=" font-weight:bold;">Break out Point/<br>Magical Figures</h6><b><span id="edit_nifty_magic" style="font-size:20px; font-weight:bold;"><?= $sheetData[8][6];?></b>
                            </div>
                        
                        
                        </div>
                    </div>
                
                    <div class="card-footer p-0" style="height:auto; background:#fff; border-radius:0px 0px 10px 10px; margin-left:auto; margin-right:auto;">
                    <h4 id="card1_footer"><?=$sheetData[9][1];?></h4>
                    </div>
                </div>
            </div>


<!-- card 2 -->
            <div class="col-12 p-2">
                <div class="card" style=" border-radius:10px; box-shadow:-4px 4px 10px grey">
                    <div class="card-header p-0 pt-2"  style="background:#fff; border-radius:10px 10px 0px 0px;">
                        <h3 class="card-title text-uppercase d-flex justify-content-center align-items-center"><b><span id="card2_head"><?=$sheetData[10][1];?></span></b></h3>
                    </div>
                
                    <div class="card-body  p-0 m-0" style="border:1px solid black; border-right:0;border-left:0;">
                        <div class="row p-0 m-0">
                            <div class="col-9 " style="border-right:1px solid black; overflow:hidden; ">
                            <img src="image/watermark.png" class="img-watermark" style="opacity:1; position:absolute; top:43px; left:100px; height:90px; z-index:5;">
                                
                                <div class="row">
                                    <div class="col pt-2 pb-2">
                                        <div class="card font-weight-bold" style=" border-radius:10px; border:0px;">
                                            <div class="card-header text-white p-0"  style="z-index:6; background-image: linear-gradient(to right, #AD8726, #D0AE42); border-radius:10px 10px 0px 0px; height:35px;">
                                                <h4 class="p-0 m-0 d-flex justify-content-center align-items-center ">Support</h4>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;"> 
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty2_support1"><?= $sheetData[13][2];?></h4>
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty2_support2"><?= $sheetData[14][2];?></h4>
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty2_support3"><?= $sheetData[15][2];?></h4>
                                                <!-- <input type="text" class="child_input" value="15435" style="width:70px;"> -->
                                            </div>
                                            
                                        
                                        </div>
                                    </div>

                                    <div class="col pt-2 pb-2">
                                        <div class="card" style=" border-radius:10px;">
                                            <div class="card-header p-0"  style="z-index:6;background-image: linear-gradient(to right, #E0A942, #EDC96B); border-radius:10px 10px 0px 0px; height:35px;">
                                                <h4 class="p-0 m-0 d-flex justify-content-center align-items-center "><b>Resistance</b></h4>
                                            </div>
                                        
                                            <div class="card-body p-0 pt-2 pb-2 font-weight-bold"  style="  border-radius: 0px 0px 10px 10px; border:1px solid black; border-top:0;" >
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty2_resistance1"><?= $sheetData[13][4];?></h4>
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty2_resistance2"><?= $sheetData[14][4];?></h4>
                                                <h4 class="m-0 d-flex justify-content-center align-items-center font-weight-bold" id="edit_nifty2_resistance3"><?= $sheetData[15][4];?></h4>
                                            </div>
                                        
                                        </div>
                                    </div>

                                    
                                </div>

                           
                            </div>


                            <div class="col-3 p-0 pt-2 text-center" style=" height:100px; color:#9C7800;">
                                <h5 style="padding:0px; margin:0px;">Trend:</h5 style="padding:0px; margin:0px;"><h5 id="card2_trend" style="color:<?=get_trend_color(trenddata($sheetData,13));?>"><?=trenddata($sheetData,13);?></h5>
                                <h6 style=" font-weight:bold;">Break out Point/<br>Magical Figures</h6><b><span id="edit_nifty2_magic" style="font-size:20px; font-weight:bold;"><?= $sheetData[15][6];?></b>
                            </div>
                        
                        
                        </div>
                    </div>
                
                    <div class="card-footer p-0" style="height:auto; background:#fff; border-radius:0px 0px 10px 10px; margin-left:auto; margin-right:auto;">
                    <h4 id="card2_footer"><?=$sheetData[16][1];?></h4>
                    </div>
                </div>
            </div>

                

        </div>

        

        <div class="row mb-2">
            <div class="col">
            <h4 class="m-1 d-flex justify-content-center align-items-center"><b>Join us 
                            <img src="image/youtube-logo.png" style="height:30px;"> 
                            <span style="width:1px;border:1px solid #d0d0d0; border-right:0; margin-right:10px;"></span></b>
                            <img src="image/telegram-logo.png" style="height:18px; margin-right:10px;"> Intelisys Investment and Trading
                        </h4>
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

    //header
    edit_add_input("#edit_date","child_input","number",50);
    edit_add_input("#page_heading","child_input","text",200);
    edit_add_input("#edit_year","child_input","number",80);
    edit_add_select("#edit_month",".select_short_month",short_month_select);
    //header ends

    //card 1 
    edit_add_input("#card1_head","child_input","text",170);
    edit_add_input("#edit_nifty_support1","child_input","number",90);
    edit_add_input("#edit_nifty_support2","child_input","number",90);
    edit_add_input("#edit_nifty_support3","child_input","number",90);
    edit_add_input("#edit_nifty_resistance1","child_input","number",90);
    edit_add_input("#edit_nifty_resistance2","child_input","number",90);
    edit_add_input("#edit_nifty_resistance3","child_input","number",90);
    edit_add_input("#card1_trend","child_input","text",120);
    edit_add_input("#edit_nifty_magic","child_input","number",100);
    edit_add_input("#card1_footer","child_input","text",500);
    //card 1 ends

    //card 2
    edit_add_input("#card2_head","child_input","text",170);
    edit_add_input("#edit_nifty2_support1","child_input","number",90);
    edit_add_input("#edit_nifty2_support2","child_input","number",90);
    edit_add_input("#edit_nifty2_support3","child_input","number",90);
    edit_add_input("#edit_nifty2_resistance1","child_input","number",90);
    edit_add_input("#edit_nifty2_resistance2","child_input","number",90);
    edit_add_input("#edit_nifty2_resistance3","child_input","number",90);
    edit_add_input("#card2_trend","child_input","text",120);
    edit_add_input("#edit_nifty2_magic","child_input","number",100);
    edit_add_input("#card2_footer","child_input","text",500);
    //card 2 ends


    
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

        this_val=$(parent_div).html().toUpperCase();
        // console.log(strtoupper(this_val));
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
