function removeSpecialCharacters(string) {
  return string.split(' ').join('-').replace(/[&\/\\#, +()$~%.'":*?|ß;ˇ^˘°˛`()˙´˝¨¸Ä€Í÷×äđĐłŁ@¤<>{}]/g, '');
}

function removeAccent(string) {
  return string.normalize("NFD").replace(/\p{Diacritic}/gu, "");
}

// TinyMCE betöltése
if (document.querySelectorAll('textarea.wysiwyg').length > 0) {
  tinymce.init({
    selector: 'textarea.wysiwyg',
    plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern',
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
    language: 'hu_HU',

    relative_urls: true,
    file_browser_callback: function (field_name, url, type, win) {
      tinyMCE.activeEditor.windowManager.open({
        file: '/file-manager/tinymce',
        title: 'Fájlkezelő',
        width: window.innerWidth * 0.8,
        height: window.innerHeight * 0.8,
        resizable: 'yes',
        close_previous: 'no',
      }, {
        setUrl: function (url) {
          win.document.getElementById(field_name).value = url;
        },
      });
    },

  });
}

