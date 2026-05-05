<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor.js Example</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Editor.js core -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

    <!-- Tools -->
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/editorjs-html@4.0.0/.build/edjsHTML.browser.js"></script>
</head>

<body>
    <form id="editorForm" action="{{ route('test.submit') }}" method="post">
        @csrf

        <div class="container my-4">
            <h3>Editor.js Example</h3>
            <div id="editorjs" style="border:1px solid #ccc; padding:10px; min-height:300px;"></div>
        </div>
        <!-- Hidden field to store editor data -->
        <input type="hidden" name="editor_data" id="editor_data">
        <button type="submit">Submit</button>
    </form>
    <script>
        let editor; // declare editor globally

        window.addEventListener('load', function() {
            editor = new EditorJS({
                holder: 'editorjs',
                tools: {
                    header: {
                        class: Header,
                        inlineToolbar: true
                    },
                    quote: {
                        class: Quote,
                        inlineToolbar: true
                    },
                    code: {
                        class: CodeTool
                    },
                    link: {
                        class: LinkTool
                    },
                    image: {
                        class: ImageTool,
                        config: {
                            endpoints: {
                                byFile: '/upload_by_file',
                                byUrl: '/upload_by_url',
                            },
                            additionalRequestHeaders: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }
                    },
                    list: {
                        class: EditorjsList,
                        inlineToolbar: true,
                        config: {
                            defaultStyle: 'unordered'
                        },
                    },
                    embed: {
                        class: Embed,
                        config: {
                            services: {
                                youtube: true,
                                twitter: true,
                                instagram: true,
                                facebook: true,
                                vimeo: true,
                                pinterest: true,
                            }
                        }
                    }
                }
            });
            // Handle form submit
            const edjsParser = edjsHTML();

            document.getElementById('editorForm').addEventListener('submit', function(e) {
                e.preventDefault();

                editor.save().then((outputData) => {
                    // Convert the JSON output to HTML
                    console.log(outputData)
                    // const html = edjsParser.parse(outputData);
                    const edjsParser = edjsHTML();
                    let html = edjsParser.parse(outputData);
                    console.log(html);
                    // Set the HTML into hidden input
                    document.getElementById('editor_data').value = html;

                    // Submit the form
                    e.target.submit();
                }).catch((error) => {
                    console.error('Editor.js save error: ', error);
                });
            });
        });
    </script>


</body>

</html>
