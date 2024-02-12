<div class="w3-sidebar w3-light-grey w3-card-4 w3-animate-left" style="width:200px" id="mySidebar">
  <div class="w3-bar w3-dark-grey">
  <span class="w3-bar-item w3-padding-16">Menu</span>
  <button onclick="w3_close()"
  class="w3-bar-item w3-button w3-right w3-padding-16" title="close Sidebar">&times;</button>
  </div>
  
  <div class="w3-bar-block">
  <a class="w3-bar-item w3-button w3-green" href="home.php">Home</a>
  <button class="w3-button w3-block w3-left-align" onclick="myDropFunc('myAccFuncManageTruck')">Manage Truck <span class="caret"></span></button>
  <div id="myAccFuncManageTruck" class="w3-bar-block w3-hide w3-white w3-card-4">
    <a class="w3-bar-item w3-button" href="LoadTruck.php">Load Truck</a>
      <a class="w3-bar-item w3-button" href="AddDriver.php">Add Truck</a>
  </div>
  <button class="w3-button w3-block w3-left-align" onclick="myDropFunc('myAccFuncCustomner')">Manage Customer <span class="caret"></span></button>
  <div id="myAccFuncCustomner" class="w3-bar-block w3-hide w3-white w3-card-4">
		<a class="w3-bar-item w3-button" href="AddCustomer.php">Add Customer</a>
		<a class="w3-bar-item w3-button" href="changeAddress.php">Change Address</a>
  </div>
  <button class="w3-button w3-block w3-left-align" onclick="myDropFunc('myAccFuncEmployee')">Manage Employee <span class="caret"></span></button>
  <div id="myAccFuncEmployee" class="w3-bar-block w3-hide w3-white w3-card-4">
		<a class="w3-bar-item w3-button" href="AddEmployee.php">Add Employee</a>
      <a class="w3-bar-item w3-button" href="Attendance.php">Attendance</a>
      <a class="w3-bar-item w3-button" href="employeeAdvance.php">Employee Upad</a>
  </div>
<button class="w3-button w3-block w3-left-align" onclick="myDropFunc('myAccManageTruckReport')">Truck Report <span class="caret"></span></button>
  <div id="myAccManageTruckReport" class="w3-bar-block w3-hide w3-white w3-card-4">
		 <a class="w3-bar-item w3-button" href="LoadTruckReport.php">Load Truck Report</a>
      <a class="w3-bar-item w3-button" href="truckReport.php">Daily Truck Report</a>
      <a class="w3-bar-item w3-button" href="dailyTelly.php">Truck Report</a>
  </div>
  <button class="w3-button w3-block w3-left-align" onclick="myDropFunc('myAccCustomerReport')">Customer Report <span class="caret"></span></button>
  <div id="myAccCustomerReport" class="w3-bar-block w3-hide w3-white w3-card-4">
		 <a class="w3-bar-item w3-button" href="customerreport.php">Customer Invoice</a>
     
  </div>
  
   <button class="w3-button w3-block w3-left-align" onclick="myDropFunc('myAccEmployeeReport')">Employee Report <span class="caret"></span></button>
  <div id="myAccEmployeeReport" class="w3-bar-block w3-hide w3-white w3-card-4">
		<a class="w3-bar-item w3-button" href="employeeStatement.php">Employee Statement</a>
  </div>
  
  <button class="w3-button w3-block w3-left-align" onclick="myDropFunc('myAccOrder')">Order <span class="caret"></span></button>
  <div id="myAccOrder" class="w3-bar-block w3-hide w3-white w3-card-4">
		<a class="w3-bar-item w3-button" href="order_info.php">Order Info</a>
		<a class="w3-bar-item w3-button" href="orderReminder.php">Order Reminder</a>
      
  </div>
  
   <button class="w3-button w3-block w3-left-align" onclick="myDropFunc('myAccExpense')">Expense <span class="caret"></span></button>
  <div id="myAccExpense" class="w3-bar-block w3-hide w3-white w3-card-4">
		<a class="w3-bar-item w3-button" href="add_ExpenseStatement.php">Add Expense</a>
		<a class="w3-bar-item w3-button" href="addExpense.php">Add Expense Type</a>   
		<a class="w3-bar-item w3-button" href="expense_statement.php">Expense Statement</a> 
  </div>
    <a class="w3-bar-item w3-button" href="editWaterSupplied.php">Wrong Entry</a>
  <a class="w3-bar-item w3-button" href="AddPlan.php">Add Plan</a>
  <a class="w3-bar-item w3-button" href="changePassword.php">Change Password</a>
  <a class="w3-bar-item w3-button" href="logout.php">Logout</a>
  </div>
</div>

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "180px";
  document.getElementById("mySidebar").style.width = "180px";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-green";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-green", "");
    }
}

function myDropFunc(newval) {
	var idvalue=document.getElementById(newval);
    var x = idvalue;
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-green";
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-green", "");
    }
}
</script>