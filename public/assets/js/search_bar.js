//Take the name of the file
var ubicacionCompleta = window.location.href;
var url = new URL(ubicacionCompleta);
var nombreDeArchivo = url.pathname.substring(url.pathname.lastIndexOf('/') + 1) + url.search;
//console.log(nombreDeArchivo);

// Courses
function busquedaCourses(searchValue) {
    return new Promise((resolve, reject) => {
      $.ajax({
        type: 'GET',
        url: searchCoursesRoute,
        data: { query: searchValue },
        success: function (response) {
          resolve(response);
        },
        error: function () {
          reject(new Error('Error in the request with AJAX'));
        }
      });
    });
}

if (nombreDeArchivo == 'adminHome') {
    $(document).ready(function () {
        $('#searchText').keyup(function () {
            var searchValue = $(this).val();
            busquedaCourses(searchValue)
            .then((response) => {
                $('#bodyList').html(response);
            })
            .catch((error) => {
                alert(error.message);
            });
        });
    });
}

// Insurers
function busquedaInsurers(searchValue) {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: 'GET',
      url: searchInsurersRoute,
      data: { query: searchValue },
      success: function (response) {
        resolve(response);
      },
      error: function () {
        reject(new Error('Error in the request with AJAX'));
      }
    });
  });
}

if (nombreDeArchivo == 'insurers') {
  $(document).ready(function () {
      $('#searchText').keyup(function () {
          var searchValue = $(this).val();
          busquedaInsurers(searchValue)
          .then((response) => {
              $('#bodyList').html(response);
          })
          .catch((error) => {
              alert(error.message);
          });
      });
  });
}

// Sponsors
function busquedaSponsors(searchValue) {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: 'GET',
      url: searchSponsorsRoute,
      data: { query: searchValue },
      success: function (response) {
        resolve(response);
      },
      error: function () {
        reject(new Error('Error in the request with AJAX'));
      }
    });
  });
}

if (nombreDeArchivo == 'sponsors') {
  $(document).ready(function () {
      $('#searchText').keyup(function () {
          var searchValue = $(this).val();
          busquedaSponsors(searchValue)
          .then((response) => {
              $('#bodyList').html(response);
          })
          .catch((error) => {
              alert(error.message);
          });
      });
  });
}

// Competitors
function busquedaCompetitors(searchValue) {
  return new Promise((resolve, reject) => {
    $.ajax({
      type: 'GET',
      url: searchCompetitorsRoute,
      data: { query: searchValue },
      success: function (response) {
        resolve(response);
      },
      error: function () {
        reject(new Error('Error in the request with AJAX'));
      }
    });
  });
}

if (nombreDeArchivo == 'adminCompetitors') {
  $(document).ready(function () {
      $('#searchText').keyup(function () {
          var searchValue = $(this).val();
          busquedaCompetitors(searchValue)
          .then((response) => {
              $('#bodyList').html(response);
          })
          .catch((error) => {
              alert(error.message);
          });
      });
  });
}