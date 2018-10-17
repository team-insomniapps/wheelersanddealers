//-----------------STILL NEEDED TO COMPLETE ----------------
//  Description - max characters and characters alllowed
//  Mileage - removing suffix removes last nine characters regardless
// sourcing datalists from the database to remove all script code from html file/s


// Checks input value against datalist array elements for a match
// for make and model fields a prompt is displayed if a match is not found
// that will let users request an addition to the database (sent to site admin)
function checkAgainstList(datalist)
{
  var field = document.getElementById(datalist);
  var validEntry = false;
  var inputValue = String(field.value);

  var array = document.getElementById(field.name).options;
  console.log(field.name);
  console.log(field.value);
  if(inputValue == "")
  {
    field.style.background="";
    field.style.backgroundColor = 'rgb(245,160,76)';
    //return;
  }
  else
  {
  var inputUpper = inputValue.toUpperCase();
  for(var count = 0; count < array.length;count++)
  {
    var compare = array[count].value.toUpperCase();
    if(compare == inputUpper)
    {
      field.value = inputUpper;
      field.style.backgroundColor = 'lightgreen';
      validEntry = true;
      field.style.background='rgb(184,245,231) url("rsz_check-mark-1292787_960_720.png") no-repeat center right';
      break;
    }
  }

  if(validEntry == false)
  {
   field.style.background= 'rgb(245,160,76)';
  field.style.backgroundColor = 'red';

  }
}
  if((field.id == "inputModel") || (field.id == "inputMake"))// && (validEntry != true))
  {
    var fieldChanged = String(field.name.charAt(0).toUpperCase() + field.name.slice(1));
    var prompt = String("add" + fieldChanged);
    addRequestPrompt(datalist,prompt,validEntry);
  }
}

// Toggles whether the prompt and its button to request adding a new vehicle
//  to the database is visible
function addRequestPrompt(aList,aPrompt,validEntry)
{
  var inputField = document.getElementById(aList);
  var inputFieldPrompt = document.getElementById(aPrompt);

  if((validEntry == true) || (inputField.value == "") || (inputField.value.replace(" ","").length == 0))
  {
    //inputFieldPrompt.innerHTML = "";
    inputFieldPrompt.style.display = 'none';
    return;
  }
  inputField.style.backgroundColor = 'red'; //redundant??
  inputFieldPrompt.style.display = 'block';
  inputFieldPrompt.innerHTML =
  "<p>"
  +  inputField.value +  " is not in the system,"
  + "  would you like to request and addition to the Wheelers and Dealers database?"
  + "</p>"
  + " <input type='submit' value = 'Request addition' formaction='/new_vehicle_request.php' >";
}

//Price format checked six digits for dollars, two for cents or just
// six digits for dollars, does allow dollars and decimal point without cents,
// does not add decimal point or cents if only dollars input
function checkPrice()
{
  var validPrice = false;

  var pricePattern = /^[0-9]{1,6}?(.[0-9]{1,2})?$/;
  validPrice = pricePattern.test(price.value);

  if(validPrice == true)
  {
    //price.style.backgroundColor = 'lightgreen';
    price.style.background='rgb(184,245,231) url("rsz_check-mark-1292787_960_720.png") no-repeat center right';
  }
  else if(price.value == "")
  {
    //price.style.backgroundColor = 'lightblue';
    price.style.background = " ";
    price.style.background = 'rgb(245, 160, 76)';
  }

  else
  {
    price.style.background='rgb(255,0,0)';
    price.style.backgroundColor = 'red';
    //price.style.background='rgb(255,0,0)';
  }
}



//Adds suffix to input mileage if user wants rounded value eg. "1234"
// becomes "1234 000 km's"
function addMileageSuffix(event)
{
  var inputMileage = document.getElementById('mileage');
  if(inputMileage.value.length >= 1)
  {  //document.getElementById("clearMileagePrompt").style.display = 'inline';
  document.getElementById("clearMileagePrompt").innerHTML ="<p>"
  +  "Press space to add '000 kms ' at the end" +
  "</p>";
  document.getElementById("clearMileagePrompt").style.display = 'block';
}
if(event.key == " ")
{
  inputMileage.value = inputMileage.value + " 000 km's"
  inputMileage.value.trim();
  document.getElementById("clearMileagePrompt").style.display = 'block';
  document.getElementById("clearMileagePrompt").innerHTML ="<p>"
  +  "Press space twice to clear the '000's" +
  "</p>";
  mileage.removeEventListener("keyup",addMileageSuffix);
  mileage.addEventListener("keyup",formatMileage,false);
  //mileage.addEventListener("blur",function(){formatMileage(this,mileage.id);},false);
}
}

function checkMileage(event)
{
  console.log(event.value);
  var validMileage = false;
  var inputMileage = document.getElementById(mileage);
  var mileagePattern = /^([0-9]{1,6})(\s{0,})?(0{3}\skm's|[0-9]{0,4})?(\s{0,})?$/


  validMileage = mileagePattern.test(mileage.value);

  if(validMileage == true)
  {
    //mileage.style.backgroundColor = 'lightgreen';
    mileage.classList.remove('mandatory');
    mileage.style.background='rgb(184,245,231) url("rsz_check-mark-1292787_960_720.png") no-repeat center right';
  }
  else if(mileage.value == "")
  {
    mileage.classList.remove('mandatory');
    mileage.style.background= 'rgb(245,160,76)';
    //mileage.style.backgroundColor = 'lightblue';
  }

  else
  {
    mileage.classList.remove('mandatory');
    mileage.style.backgroundColor = 'red';
    mileage.style.background="";
  }
  document.getElementById("clearMileagePrompt").style.display = 'none';
}


// separate function as space bar needs to be entered twice in a row to remove mileage suffix
// alternative would mean much nesting
function formatMileage(event)
{
  var inputMileage = document.getElementById("mileage");
  if(event.key == " ")
  {
    inputMileage.addEventListener("keyup",clearMileageSuffix,false);
  }
}


//Clears the mileage suffix not great as if user begins to delete
// before hand will take last nine characters from string
function clearMileageSuffix(event)
{
  var inputMileage = document.getElementById('mileage');
  if (event.key== "\s");
  {
    document.getElementById("clearMileagePrompt").style.display = 'none';

    var kmsSuffixLength = (inputMileage.value.length-1) - 9;
    inputMileage.value = inputMileage.value.substring(0,kmsSuffixLength);
    inputMileage.value = inputMileage.value.replace(" ","");

    mileage.removeEventListener("keyup",formatMileage);
    mileage.addEventListener("keyup",addMileageSuffix,false);
  }

  mileage.removeEventListener("keyup",clearMileageSuffix);
}

// function to validate VIN, does not validate check sum allows
function checkVIN()
{
  var VINpattern;
  var validVIN = false;

  if((year.value > 2018) | (year.value < 1920) | (year.value == "") | (isNaN(year.value)))
  {
    vin.style.background= 'rgb(245,160,76)';
    return;
  }
  if(year.value > 1980)
  {
    VINpattern = /^[A-HJ-NPR-Z0-9]{17}$/;
  }
  else{
    VINpattern = /^[a-zA-Z0-9]{11,17}$/;
  }

  validVIN = VINpattern.test(vin.value);

  if(validVIN == true)
  {
    //vin.style.backgroundColor = 'lightgreen';
    vin.classList.remove('mandatory');
    vin.style.background='rgb(184,245,231) url("rsz_check-mark-1292787_960_720.png") no-repeat center right';
    return;
  }

  if(vin.value == "")
  {
    vin.classList.remove('mandatory');
    vin.style.background = "";
    vin.style.backgroundColor= 'rgb(245,160,76)';
    //vin.style.backgroundColor = 'lightblue';
  }

  else
  {
    vin.classList.remove('mandatory');
    vin.style.background="";
    vin.style.backgroundColor = 'red';

  }

}

function checkRego(event)
{
  var validRego = false;
  var inputRego = document.getElementById(inputRego);
  var regoPattern = /^(([a-zA-Z0-9]{1,6})|([a-zA-Z]{3}-[0-9]{3})|([a-zA-Z]{2}-[0-9]{2}-[a-zA-Z]{2})){1}$/;


  validRego = regoPattern.test(rego.value);

  if(validRego == true)
  {
    //rego.style.backgroundColor = 'lightgreen';
    rego.classList.remove('mandatory');
    rego.style.background='rgb(184,245,231) url("rsz_check-mark-1292787_960_720.png") no-repeat center right';
  }
  else if(rego.value == "")
  {
    rego.classList.remove('mandatory');
    rego.style.background= 'rgb(245,160,76)';
    //rego.style.backgroundColor = 'lightblue';
  }

  else
  {
    rego.classList.remove('mandatory');
    rego.style.backgroundColor = 'red';
    rego.style.background='rgb(255,0,0)';
  }
}


function formatDescription()
{
  if(description.value == "")
  {
    description.value = "No Description";
    description.removeEventListener("blur",formatDescription);
    description.addEventListener("focus",formatBlankDescription,false);
    description.style.background = 'rgb(245,220,148)';
  }
  else
  {
    description.style.background = 'rgb(184,245,231)';
  }
}

function formatBlankDescription()
{
  if(description.value == "No Description")
  {
    description.value = "";
    description.addEventListener("blur",formatDescription,false);
  }
}

// description max chars?, allow all characters??

vin = document.getElementById("inputVIN");
vin.addEventListener("blur",checkVIN,false);

var year = document.getElementById("inputYear");
year.addEventListener("blur",function(){checkAgainstList(year.id);},false);
year.addEventListener("blur",checkVIN,false);

var make = document.getElementById("inputMake");
make.addEventListener("blur",function(){checkAgainstList(make.id);},false);
var addMake = document.getElementById('addMake');

var model = document.getElementById('inputModel');
model.addEventListener("blur",function(){checkAgainstList(model.id);},false);
var addModel = document.getElementById('addModel');
//inputModel.addEventListener("blur",modelPrompt,false);

var exteriorColor = document.getElementById("inputExteriorColor");
exteriorColor.addEventListener("blur",function(){checkAgainstList(exteriorColor.id);},false);
exteriorColor.addEventListener("focus",function(){exteriorColor.style.backgroundColor = 'white';},false);

var condition = document.getElementById("inputCondition");
condition.addEventListener("blur",function(){checkAgainstList(condition.id);},false);

var bodyStyle = document.getElementById("inputBodyStyle");
bodyStyle.addEventListener("blur",function(){checkAgainstList(bodyStyle.id);},false);

var transmission = document.getElementById("inputTransmission");
transmission.addEventListener("blur",function(){checkAgainstList(transmission.id);},false);

var passengerCapacity = document.getElementById("inputPassengerCapacity");
passengerCapacity.addEventListener("blur",function(){checkAgainstList(passengerCapacity.id);},false);

var drivetrain = document.getElementById("inputDriveTrain");
drivetrain.addEventListener("blur",function(){checkAgainstList(drivetrain.id);},false);

var cylinders = document.getElementById("inputCylinders");
cylinders.addEventListener("blur",function(){checkAgainstList(cylinders.id);},false);

var mileage = document.getElementById("mileage");
mileage.addEventListener("keyup",addMileageSuffix,false);
//mileage.addEventListener("keyup",function(){formatMileage(this,mileage.id);},false);
mileage.addEventListener("blur",checkMileage,false);

var fuel = document.getElementById("inputFuel");
fuel.addEventListener("blur",function(){checkAgainstList(fuel.id);},false);

var doors = document.getElementById("inputDoors");
doors.addEventListener("blur",function(){checkAgainstList(doors.id);},false);

var interiorColor = document.getElementById("inputInteriorColor");
interiorColor.addEventListener("blur",function(){checkAgainstList(interiorColor.id);},false);

var rego = document.getElementById("rego");
//rego.addEventListener("blur",function(){checkAgainstList(rego.id);},false);
rego.addEventListener("blur",checkRego,false);

var description = document.getElementById("description");
description.addEventListener("blur",formatDescription,false);

var price = document.getElementById("price");
price.addEventListener("blur",checkPrice,false);
