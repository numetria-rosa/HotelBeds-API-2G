function reloadInfo() {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  if (window.search == true) {
    $(this).prop("disabled", true);
    $(".error").html("");
    $(".mainSearch__submit > i").attr("class", "");
    $(".mainSearch__submit > i").addClass(
      "fa fa-spinner fa-spin text-20 mr-10"
    );
    let checkin = urlParams.get("CheckIn");
    let checkout = urlParams.get("CheckOut");

    let selCountryHB = "";
    let selCityHB = urlParams.get("City");
    let cityName = urlParams.get("CityName");

    let rooms = urlParams.get("Rooms");

    var dataStringSearchPax = "";

    for (let i = 0; i < rooms; i++) {
      dataStringSearchPax =
        dataStringSearchPax +
        "adultsselect" +
        i +
        "=" +
        urlParams.get("Adults" + i) +
        "&";
      if (urlParams.get("Children" + i) > 0) {
        dataStringSearchPax =
          dataStringSearchPax +
          "childselect" +
          i +
          "=" +
          urlParams.get("Children" + i) +
          "&";
        for (let y = 1; y <= urlParams.get("Children" + i); y++) {
          dataStringSearchPax =
            dataStringSearchPax +
            "ageselect" +
            i +
            "-" +
            y +
            "=" +
            urlParams.get("Age" + i + "-" + y) +
            "&";
        }
      } else {
        dataStringSearchPax = dataStringSearchPax + "childselect" + i + "=0&";
      }
    }

    dataStringSearchPax = dataStringSearchPax + "ActiveRooms=" + rooms;

    if (window.hotelCode) {
      var dataStringSearchHB =
        "Cityname=" +
        cityName +
        "&hotel=" +
        window.hotel +
        "&hotelCode=" +
        window.hotelCode +
        "&CheckInDate=" +
        checkin +
        "&CheckOutDate=" +
        checkout +
        "&selCityHB=" +
        selCityHB +
        "&selCountryHB=&action=hotelSearch&" +
        dataStringSearchPax;
    } else {
      if (window.zoneCode) {
        var dataStringSearchHB =
          "Cityname=" +
          cityName +
          "&zoneCode=" +
          window.zoneCode +
          "&CheckInDate=" +
          checkin +
          "&CheckOutDate=" +
          checkout +
          "&selCityHB=" +
          selCityHB +
          "&selCountryHB=&action=hotelSearch&" +
          dataStringSearchPax;
      } else {
        var dataStringSearchHB =
          "Cityname=" +
          cityName +
          "&CheckInDate=" +
          checkin +
          "&CheckOutDate=" +
          checkout +
          "&selCityHB=" +
          selCityHB +
          "&selCountryHB=&action=hotelSearch&" +
          dataStringSearchPax;
      }
    }

    $.ajax({
      type: "POST",
      url: "actions.php",
      data: dataStringSearchHB,
      cache: false,
      success: function (json) {
        window.location.href = queryString;
      },
      error: function (request, status, error) {
        $(".error").html("");
        $(".mainSearch__submit > i").attr("class", "");
        $(".mainSearch__submit > i").addClass("icon-search text-20 mr-10");
      },
    });
  } else {
    $(".error").html("Please choose a destination");
  }
}

function reloadDefaultInfo() {
  var startdate = new Date();
  startdate.setDate(startdate.getDate() + 1);
  var enddate = new Date();
  enddate.setDate(enddate.getDate() + 2);
  const checkinDate = moment(startdate).format("YYYY-MM-DD");
  const checkoutDate = moment(enddate).format("YYYY-MM-DD");
  const queryString = WORKPATH + "hotel-list.php?source=search&Place=destination&CityNamet&City=HMM&CheckIn="+checkinDate+"&CheckOut="+checkoutDate+"&Rooms=1&Adults0=1&Children0=0";
  const urlParams = new URLSearchParams(queryString);
  if (window.search == true) {
    $(this).prop("disabled", true);
    $(".error").html("");
    $(".mainSearch__submit > i").attr("class", "");
    $(".mainSearch__submit > i").addClass(
      "fa fa-spinner fa-spin text-20 mr-10"
    );
    let checkin = urlParams.get("CheckIn");
    let checkout = urlParams.get("CheckOut");

    let selCountryHB = "";
    let selCityHB = urlParams.get("City");
    let cityName = urlParams.get("CityName");

    let rooms = urlParams.get("Rooms");

    var dataStringSearchPax = "";

    for (let i = 0; i < rooms; i++) {
      dataStringSearchPax =
        dataStringSearchPax +
        "adultsselect" +
        i +
        "=" +
        urlParams.get("Adults" + i) +
        "&";
      if (urlParams.get("Children" + i) > 0) {
        dataStringSearchPax =
          dataStringSearchPax +
          "childselect" +
          i +
          "=" +
          urlParams.get("Children" + i) +
          "&";
        for (let y = 1; y <= urlParams.get("Children" + i); y++) {
          dataStringSearchPax =
            dataStringSearchPax +
            "ageselect" +
            i +
            "-" +
            y +
            "=" +
            urlParams.get("Age" + i + "-" + y) +
            "&";
        }
      } else {
        dataStringSearchPax = dataStringSearchPax + "childselect" + i + "=0&";
      }
    }

    dataStringSearchPax = dataStringSearchPax + "ActiveRooms=" + rooms;

    if (window.hotelCode) {
      var dataStringSearchHB =
        "Cityname=" +
        cityName +
        "&hotel=" +
        window.hotel +
        "&hotelCode=" +
        window.hotelCode +
        "&CheckInDate=" +
        checkin +
        "&CheckOutDate=" +
        checkout +
        "&selCityHB=" +
        selCityHB +
        "&selCountryHB=&action=hotelSearch&" +
        dataStringSearchPax;
    } else {
      if (window.zoneCode) {
        var dataStringSearchHB =
          "Cityname=" +
          cityName +
          "&zoneCode=" +
          window.zoneCode +
          "&CheckInDate=" +
          checkin +
          "&CheckOutDate=" +
          checkout +
          "&selCityHB=" +
          selCityHB +
          "&selCountryHB=&action=hotelSearch&" +
          dataStringSearchPax;
      } else {
        var dataStringSearchHB =
          "Cityname=" +
          cityName +
          "&CheckInDate=" +
          checkin +
          "&CheckOutDate=" +
          checkout +
          "&selCityHB=" +
          selCityHB +
          "&selCountryHB=&action=hotelSearch&" +
          dataStringSearchPax;
      }
    }

    $.ajax({
      type: "POST",
      url: "actions.php",
      data: dataStringSearchHB,
      cache: false,
      success: function (json) {
        window.location.href = queryString;
      },
      error: function (request, status, error) {
        $(".error").html("");
        $(".mainSearch__submit > i").attr("class", "");
        $(".mainSearch__submit > i").addClass("icon-search text-20 mr-10");
      },
    });
  } else {
    $(".error").html("Please choose a destination");
  }
}
