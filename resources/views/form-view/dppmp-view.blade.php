<style>
  .dppmp-select{
    font-weight:normal!important;
  }
  .select2-results__option {
    font-weight:normal!important;
    font-size: 14px;
  }
  select{
    width:100%;
  }
  select *{
    font-size:9px!important;
  }
  .flex-container {
  display: flex;
  margin-right:20px;
  }
</style>

<body>

<div>
<form method="POST" action=""> 
   <strong>Division</strong>
   <select id="dppmp_division" name="dppmp_division" class="dppmp-select form-control col-6">
   <option value="" disabled selected>Select Division</option>
   </select><br/>

   <strong>Funding</strong>
   <select id="dppmp_funding" name="dppmp_funding" class="dppmp-select form-control col-6">
   <option value="" disabled selected>Select Funding</option>
   </select><br/>

   <strong>Charging</strong>
   <select id="dppmp_charging" name="dppmp_charging" class="dppmp-select form-control col-6">
   <option value="" disabled selected>Select Charging</option>
   </select><br/><br/>

   <strong>Months</strong>
                   <div class="flex-container">
                         <div>
                                <div class="font-weight-bold">
                                  From 
                                </div>
                                <div style="width:255px;">
                                <select id="months_from" placeholder="From" name="months_from" class="col-6 dppmp-select form-control">
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                                </select>
                                </div>
                        </div>
                        &nbsp&nbsp&nbsp
                        <div>
                                <div class="font-weight-bold">
                                  To
                                </div>
                                <div style="width:255px;">
                                <select id="months_to" placeholder="To" name="months_to" class="col-6 dppmp-select form-control">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                                </div>
                         </div>

                  </div>          

          <strong>Year</strong>
          <select id="dppmp_year"  name="dppmp_year" class="dppmp-select form-control col-5">
          <?php
            $yr = date('Y')+1;
            $yr2 = $yr - 5;
            for ($i=$yr; $i >= $yr2; $i--) { 
                echo "<option value='$i'>$i</option>";
            }
        ?>
          </select><br/>
</form>
</div> 
</body>

<script>
</script>    