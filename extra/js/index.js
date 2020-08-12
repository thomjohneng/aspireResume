$('#formFileSelect').bind('change', function() {
  var fileName = '';
  fileName = $(this).val();
  $('#file-selected').html(fileName);

  filePath = document.getElementById("file-selected")
  filePath.innerText = filePath.innerText.split('\\').pop();
})
