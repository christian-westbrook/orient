$('#search').select2({
  placeholder: 'Search by course name or number, department name, or instructor',
  theme: "bootstrap4",
  width: '100%',
  minimumInputLength: 1,
  ajax: {
    delay: 250,
    data: function (params) {
      var query = {
        s: params.term,
      }
      return query;
    },
    url: 'http://code.cis.uafs.edu/~iot3/search.php',
    dataType: 'json',

  }
});
