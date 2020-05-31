let editorck;

ClassicEditor.create(document.querySelector("#editor"), {
    autosave: {
        waitingTime: 4000, // in ms
        save(editor) {
            console.log("update");
            $update = $(".edit")["0"].id;
            $.ajax({
                type: "put",
                url: "../updateat/" + $update,
                data: {
                    contenido: editorck.getData()
                }
            })
                .done(function(data) {
                    $("#contenidosave")
                        .prop("style", "background-color:green")
                        .empty()
                        .append("Disponible");
                })
                .fail(function(data) {
                    var errors = data.responseJSON["errors"];
                    if (errors) {
                        $.each(errors, function(i) {
                            alert(errors[i]);
                        });
                    }

                    $("#contenidosave")
                        .prop("style", "background-color:red")
                        .empty()
                        .append("Error intenta mas tarde");
                });
        }
    },
    toolbar: {
        items: [
            "heading",
            "|",
            "fontFamily",
            "bold",
            "italic",
            "fontSize",
            "fontColor",
            "highlight",
            "bulletedList",
            "numberedList",
            "|",
            "alignment",
            "indent",
            "outdent",
            "horizontalLine",
            "subscript",
            "superscript",
            "underline",
            "|",
            "link",
            "CKFinder",
            "imageUpload",
            "blockQuote",
            "insertTable",
            "mediaEmbed",
            "undo",
            "redo"
        ]
    },
    language: "es",
    color: "red",
    ckfinder: {
        uploadUrl:
            "/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json"
    },
    image: {
        // You need to configure the image toolbar, too, so it uses the new style buttons.
        toolbar: [
            "imageTextAlternative",
            "|",
            "imageStyle:alignLeft",
            "imageStyle:full",
            "imageStyle:alignRight"
        ],
        styles: [
            "full", // This option is equal to a situation where no style is applied.
            "alignLeft", // This represents an image aligned to the left.
            "alignRight", // This represents an image aligned to the right.
            "side"
        ]
    },
    table: {
        contentToolbar: [
            "tableColumn",
            "tableRow",
            "mergeTableCells",
            "tableCellProperties",
            "tableProperties"
        ]
    },
    licenseKey: ""
})
    .then(editor => {
        editor.model.document.on("change:data", (evt, data) => {
            //console.log(editor.getData());
            $("#contenidosave")
                .prop("style", "background-color:blue")
                .empty()
                .append("Guardando");
        });

        editorck = editor;
        //editor.isReadOnly = true;
    })
    .catch(err => {
        console.error(err);
    });

// $(document).on("click", "#contenidosave", function(event) {
//     console.log("save");

//     const editorData = editor.getData();

//     console.log(editorData);
// });
