var $table = $("#table");
function priceFormatter(value) {
  var num = parseInt(value);
  return num.toLocaleString();
}

function dateSorter(a, b) {
  if (toDate(a) < toDate(b)) return 1;
  if (toDate(a) > toDate(b)) return -1;
  return 0;
}

function toDate(stringDate) {
  if (stringDate) {
    var parts = stringDate.split('.');
    var myDate = new Date(parts[2], parts[1] - 1, parts[0]);
    if (!isNaN( myDate.getTime())){
      return myDate
    }
     stringDate = parseInt(stringDate)*1000;

      var date = new Date(stringDate);
    return date;
  }
  return new Date(0);
}
function roundButtonFormatter(value){
   if (value) {
    var split = value.split('^');
    if (split.length > 2) {
      var pipeline = split[0];
      var text = split[1];
      var color = split[2];
    //  return ' <span class="badge badge-pill " style="background-color:' + color + '">' + text +'</span>'
      return ' <button type="button" class="btn btn-rounded" style="background-color:' + color + '; overflow: hidden; white-space: nowrap;font-size: 0.6rem;color: #676767; cursor: default;">' + text +'</button>';
    }

  }
  return "";
};

function cheapFormatter(value) {
  if (value) {
    var split = value.split('^');
    if (split.length > 2) {
      var pipeline = split[0];
      var text = split[1];
      var color = split[2];
      return " <div class='chip' style=\"background-color:" + color + "\">" + text + "</div>";
    }

  }
  return "";
};

function filterTable(from, to) {
  // var grepFunc = function (item) {
  //     alert(item);
  //         return item.date_create >= from;
  //     };
  $("#table").bootstrapTable('load', $.grep(Data, function(row) {
    return dateCheck(from, to, toDate(row.createdAt));
  }));
  //  $table.bootstrapTable('load', $.grep(jsonData, grepFunc));
}

function dateCheck(from, to, check) {

  var fDate, lDate, cDate;
  fDate = Date.parse(from);
  lDate = Date.parse(to);
  cDate = Date.parse(check);

  if ((cDate < lDate && cDate >= fDate)) {
    return true;
  }
  return false;
}
function totalSum() {
  var data = $("#table").bootstrapTable('getData');
  var result = 0;
  for (var i = 0; i < data.length; i++) {
    var sum = parseInt(data[i].price);
    result += sum;
  }
  console.log("result: "+result);
  console.log("count: "+data.length);
  $("#textPeriod").text("Итого: "+result.toLocaleString() + " руб");
}
 function formatDate(from, to){
       from.setHours(0);
        from.setMinutes(0);
        from.setSeconds(0)

        to.setHours(23);
        to.setMinutes(59);
         to.setSeconds(59);
        console.log(from," ", to);
    };
    function getTimePHP(date){
      var result = date.getTime()/1000|0;
       console.log(result);
       return result;
    };

 function dateFormat(value, row, index, field){
        if (value.indexOf("Итого")>-1){
          return value;
        }
        value = parseInt(value)*1000;

      var date = new Date(value);
     return date.toLocaleDateString()
    };

    function setBeginYear(){
      var now = new Date();
      return new Date(now.getFullYear(),0,1);
    };
    function setBeginMonth(){
      var now = new Date();
      return new Date(now.getFullYear(),now.getMonth(),1);
    };
