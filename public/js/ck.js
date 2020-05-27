
ClassicEditor
    .create(document.querySelector('#editor'), {
        toolbar: {
            items: [
                'heading',
                '|',
                'fontFamily',
                'bold',
                'italic',
                'fontSize',
                'fontColor',
                'highlight',
                'bulletedList',
                'numberedList',
                '|',
                'alignment',
                'indent',
                'outdent',
                'horizontalLine',
                'subscript',
                'superscript',
                'underline',
                '|',
                'link',
                'CKFinder',
                'imageUpload',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                'undo',
                'redo'
            ]
        },
        language: 'es',
        color: 'red',
        ckfinder: {
            uploadUrl: '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
        },
        image: {
            // You need to configure the image toolbar, too, so it uses the new style buttons.
            toolbar: [
                'imageTextAlternative', "|", 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight'
            ],
            styles: [
                'full',// This option is equal to a situation where no style is applied.
                'alignLeft',// This represents an image aligned to the left.
                'alignRight',// This represents an image aligned to the right.
                'side'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties',
                'tableProperties'
            ]
        },
        licenseKey: '',
    }).then(editor => {
        window.editor = editor;
    })
    .catch(err => {
        console.error(err);
    });
