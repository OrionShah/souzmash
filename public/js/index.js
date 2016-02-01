$('#elfinder').elfinder({
    // set your elFinder options here
    customData: {
        _token: '<?= csrf_token() ?>'
    },
    url: '<?= URL::action('Barryvdh\Elfinder\ElfinderController@showConnector') ?>',  // connector URL
    dialog: {width: 900, modal: true, title: 'Select a file'},
    resizable: false,
    commandsOptions: {
        getfile: {
            oncomplete: 'destroy',
            folders  : true
        }
    },
    getFileCallback: function (file) {
        window.parent.processSelectedFile(file.path, '<?= $input_id?>');
        parent.jQuery.colorbox.close();
    }
}).elfinder('instance');