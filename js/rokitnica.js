$(function() {
  $("map[name=wioska] area").click(function(){
  var buildingID = $(this).attr('id');
  $.ajax({
    method: "POST",
    url: "building.php",
    data: 'building='+buildingID,
    success: function(data) {
      $("#myModal").modal();
      $('#myModal .modal-content').html(data);
    }
  });
  });
});
function rescaleImageMap() {
    var scale = parseInt(document.getElementById('villageBackground').width)/800;
    $("map area").each(function(index, element) {
      console.log(element);
      var coordString = element.coords;
      var coordArray = new Array();
      coordArray = coordString.split(',');
      coordString = "";
      for (i = 0; i < coordArray.length; i++) {
        coordArray[i] = Math.floor(coordArray[i]* scale);
        coordString += coordArray[i];
        if(i<coordArray.length-1) {coordString += ","};
      }
      element.coords = coordString;
    });
}
function upgradeBuilding(id) {
  var buildingID = id;
  $.ajax({
    method: "POST",
    url: "command.php",
    data: 'buildingID='+buildingID,
    success: function(data) {
      $("#myModal").modal('hide');
    }
  });
}
function acceptMarketOrder(id) {
  var orderID = id;
  $.ajax({
    method: "POST",
    url: "command.php",
    data: 'orderID='+orderID,
    success: function(data) {
      $("#myModal").modal('hide');
    }
  });
}
function recruitNewSquad() {
  //uzupelnic
}
