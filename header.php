<form id="header_form" method="post" enctype="multipart/form-data" class="form p-3" style="background:#fff;">

<div class="row justify-content-md-center">
    
    <div class="col col-md-3 col-7">
        <select id="type" name="type" class="form-control  m-1">
            <option value="">Select</option>
            <option value="currency">Currency Sheet</option>
            <option value="equity">Equity Sheet</option>
            <option value="index">Index Sheet</option>
            <option value="mcx">MCX Sheet</option>
        </select>
    </div>
    
    <div class="col col-md-4 col-7">
        <input type="file" name="file" class="form-control  m-1">
    </div>

    <div class="col">
        <input type="submit" id="form_submit" name="submit" value="submit" class="btn btn-success">
    </div>
</div>
<button id="download" class="btn btn-info">Download</button>
<button id="edit_button" class="btn btn-warning"style="float:right;">Edit Data</button>


</form>
