const saveButton = document.getElementById("saveButton");

var data = {
    blocks: [
        {
            type: "header",
            data: {
                text: "Editor.js",
                level: 2
            }
        },
        {
            type: "paragraph",
            data: {
                text:
                    "Hey. Meet the new Editor. On this page you can see it in action — try to edit this text. Source code of the page contains the example of connection and configuration."
            }
        },
        {
            type: "header",
            data: {
                text: "Key features",
                level: 3
            }
        },
        {
            type: "list",
            data: {
                items: [
                    "It is a block-styled editor",
                    "It returns clean data output in JSON",
                    "Designed to be extendable and pluggable with a simple API"
                ],
                style: "unordered"
            }
        },
        {
            type: "header",
            data: {
                text: "What does it mean «block-styled editor»",
                level: 3
            }
        }
    ]
};
var editorjs = new EditorJS({
    /**
     * Wrapper of Editor
     */
    holder: "editorjs",

    /**
     * Tools list
     */
    tools: {
        /**
         * Each Tool is a Plugin. Pass them via 'class' option with necessary settings {@link docs/tools.md}
         */
        header: {
            class: Header,
            inlineToolbar: ["link"],
            config: {
                placeholder: "Header"
            },
            shortcut: "CMD+SHIFT+H"
        },

        /**
         * Or pass class directly without any configuration
         */
        image: SimpleImage,

        list: {
            class: List,
            inlineToolbar: true,
            shortcut: "CMD+SHIFT+L"
        },

        checklist: {
            class: Checklist,
            inlineToolbar: true
        },

        quote: {
            class: Quote,
            inlineToolbar: true,
            config: {
                quotePlaceholder: "Enter a quote",
                captionPlaceholder: "Quote's author"
            },
            shortcut: "CMD+SHIFT+O"
        },

        warning: Warning,

        marker: {
            class: Marker,
            shortcut: "CMD+SHIFT+M"
        },

        code: {
            class: CodeTool,
            shortcut: "CMD+SHIFT+C"
        },

        delimiter: Delimiter,

        inlineCode: {
            class: InlineCode,
            shortcut: "CMD+SHIFT+C"
        },

        embed: Embed,

        table: {
            class: Table,
            inlineToolbar: true,
            shortcut: "CMD+ALT+T"
        }
    },
    /**
     * Initial Editor data
     */
    data,
    placeholder: "Crea tu contenido aqui....",
    onReady: function() {
        saveButton.click();
    },
    onChange: function() {
        console.log("something changed");
    }
});

/**
 * Saving example
 */
saveButton.addEventListener("click", function() {
    editorjs.save().then(savedData => {
        console.log(savedData);
    });
});
