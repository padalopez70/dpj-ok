@props([
    'guardar' => 'ckGuardar',
    'imprimir' => 'ckImprimir',
    ])
<div>
{{--
<x-ckeditor imprimir="docImprimir" guardar="docGuardar">{!!$doc->html!!}</x-ckeditor>

//hace emit así que hay que poner en algun lado los listeners
--}}
<div class="document-editor">
    <div class="document-editor__toolbar"></div>
    <div class="document-editor__editable-container">
        <div class="document-editor__editable">
            {{ $slot }}
        </div>
    </div>
</div>
    <!----------------------------- SCRIPT ---------------------------------->

    <script>
        CKEDITOR.DecoupledEditor.create( document.querySelector( '.document-editor__editable' ), {
           language: 'es',
               list: {
                   properties: {
                       styles: true,
                       startIndex: true,
                       reversed: true
                   }
               },
           toolbar: {
               items: [
                   'undo', 'redo','|',
                   'findAndReplace', 'selectAll', '|',
                   'heading', '|',
                   'bold', 'italic', 'strikethrough', 'underline',   'removeFormat', '|',
                   'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                   'bulletedList', 'numberedList', 'todoList', '|',
                   'alignment','outdent', 'indent', '|',
                       'insertImage', 'insertTable','horizontalLine', 'pageBreak', '|',
                       'specialCharacters','blockQuote', 'subscript', 'superscript',
               ],
               //eliminados: 'sourceEditing','exportPDF','exportWord', 'textPartLanguage', 'mediaEmbed',
               //'codeBlock', 'htmlEmbed', '|', 'code', 'link',
               shouldNotGroupWhenFull: false
           },
           heading: {
                   options: [
                       { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                       { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                       { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                       { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                       { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                       { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                       { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                   ]
               },
               // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
               placeholder: 'Documento vacio',
               // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
               fontFamily: {
                   options: [
                       'default',
                       'Arial, Helvetica, sans-serif',
                       'Courier New, Courier, monospace',
                       'Georgia, serif',
                       'Lucida Sans Unicode, Lucida Grande, sans-serif',
                       'Tahoma, Geneva, sans-serif',
                       'Times New Roman, Times, serif',
                       'Trebuchet MS, Helvetica, sans-serif',
                       'Verdana, Geneva, sans-serif'
                   ],
                   supportAllValues: true
               },
               // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
               fontSize: {
                   options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                   supportAllValues: true
               },
               // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
               // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
               htmlSupport: {
                   allow: [
                       {
                           name: /.*/,
                           attributes: true,
                           classes: true,
                           styles: true
                       }
                   ]
               },
               // Be careful with enabling previews
               // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
               htmlEmbed: {
                   showPreviews: true
               },
               // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
               link: {
                   decorators: {
                       addTargetToExternalLinks: true,
                       defaultProtocol: 'https://',
                       toggleDownloadable: {
                           mode: 'manual',
                           label: 'Downloadable',
                           attributes: {
                               download: 'file'
                           }
                       }
                   }
               },

               // The "super-build" contains more premium features that require additional configuration, disable them below.
               // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
               removePlugins: [
                   // These two are commercial, but you can try them out without registering to a trial.
                   'ExportPdf',
                   'ExportWord',
                   'CKBox',
                   'CKFinder',
                   'EasyImage',
                   // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                   // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                   // Storing images as Base64 is usually a very bad idea.
                   // Replace it on production website with other solutions:
                   // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                   // 'Base64UploadAdapter',
                   'RealTimeCollaborativeComments',
                   'RealTimeCollaborativeTrackChanges',
                   'RealTimeCollaborativeRevisionHistory',
                   'PresenceList',
                   'Comments',
                   'TrackChanges',
                   'TrackChangesData',
                   'RevisionHistory',
                   'Pagination',
                   'WProofreader',
                   // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                   // from a local file system (file://) - load this site via HTTP server if you enable MathType
                   'MathType'
               ]
       })
       .then( editor => {

           const toolbarContainer = document.querySelector( '.document-editor__toolbar' );

           toolbarContainer.appendChild( editor.ui.view.toolbar.element );

           window.editor = editor;
       } )
       .catch( err => {
           console.error( err );
       } );

       document.querySelector( '#ckGuardar' ).addEventListener( 'click', () => {
           const editorData = editor.getData();

           Livewire.emit('{{$guardar}}', editorData);
       } );

/*        document.querySelector( '#ckImprimir' ).addEventListener( 'click', () => {
           const editorData = editor.getData();

           Livewire.emit('{{$imprimir}}', editorData);
       } ); */



   </script>

   <!----------------------------- ESTILOS ---------------------------------->
   <style>
       .document-editor {
           border: 1px solid var(--ck-color-base-border);
           border-radius: var(--ck-border-radius);

           /* Set vertical boundaries for the document editor. */
           max-height: 700px;

           /* This element is a flex container for easier rendering. */
           display: flex;
           flex-flow: column nowrap;
       }

       .document-editor__toolbar {
           /* Make sure the toolbar container is always above the editable. */
           z-index: 1;

           /* Create the illusion of the toolbar floating over the editable. */
           box-shadow: 0 0 5px hsla(0, 0%, 0%, .2);

           /* Use the CKEditor CSS variables to keep the UI consistent. */
           border-bottom: 1px solid var(--ck-color-toolbar-border);
       }

       /* Adjust the look of the toolbar inside of the container. */
       .document-editor__toolbar .ck-toolbar {
           border: 0;
           border-radius: 0;
       }

       /* Make the editable container look like the inside of a native word processor app. */
       .document-editor__editable-container {
           padding: calc(2 * var(--ck-spacing-large));
           background: var(--ck-color-base-foreground);

           /* Make it possible to scroll the "page" of the edited content. */
           overflow-y: scroll;
       }

       .document-editor__editable-container .document-editor__editable.ck-editor__editable {
           /* Set the dimensions of the "page". */
           width: 21.0cm;
           min-height: 29.7cm;

           /* Keep the "page" off the boundaries of the container. */
           padding: 1cm 2cm 2cm;

           border: 1px hsl(0, 0%, 82.7%) solid;
           border-radius: var(--ck-border-radius);
           background: white;

           /* The "page" should cast a slight shadow (3D illusion). */
           box-shadow: 0 0 5px hsla(0, 0%, 0%, .1);

           /* Center the "page". */
           margin: 0 auto;
       }

       /* Override the page's width in the "Examples" section which is wider. */
       .main__content-wide .document-editor__editable-container .document-editor__editable.ck-editor__editable {
           width: 18cm;
       }

       /* Set the default font for the "page" of the content. */
       .document-editor .ck-content,
       .document-editor .ck-heading-dropdown .ck-list .ck-button__label {
           font: 16px/1.6 "Helvetica Neue", Helvetica, Arial, sans-serif;
       }

       /* Adjust the headings dropdown to host some larger heading styles. */
       .document-editor .ck-heading-dropdown .ck-list .ck-button__label {
           line-height: calc(1.7 * var(--ck-line-height-base) * var(--ck-font-size-base));
           min-width: 6em;
       }

       /* Scale down all heading previews because they are way too big to be presented in the UI.
   Preserve the relative scale, though. */
       .document-editor .ck-heading-dropdown .ck-list .ck-heading_heading1 .ck-button__label,
       .document-editor .ck-heading-dropdown .ck-list .ck-heading_heading2 .ck-button__label {
           transform: scale(0.8);
           transform-origin: left;
       }

       /* Set the styles for "Heading 1". */
       .document-editor .ck-content h2,
       .document-editor .ck-heading-dropdown .ck-heading_heading1 .ck-button__label {
           font-size: 2.18em;
           font-weight: normal;
       }

       .document-editor .ck-content h2 {
           line-height: 1.37em;
           padding-top: .342em;
           margin-bottom: .142em;
       }

       /* Set the styles for "Heading 2". */
       .document-editor .ck-content h3,
       .document-editor .ck-heading-dropdown .ck-heading_heading2 .ck-button__label {
           font-size: 1.75em;
           font-weight: normal;
           color: hsl(203, 100%, 50%);
       }

       .document-editor .ck-heading-dropdown .ck-heading_heading2.ck-on .ck-button__label {
           color: var(--ck-color-list-button-on-text);
       }

       /* Set the styles for "Heading 2". */
       .document-editor .ck-content h3 {
           line-height: 1.86em;
           padding-top: .171em;
           margin-bottom: .357em;
       }

       /* Set the styles for "Heading 3". */
       .document-editor .ck-content h4,
       .document-editor .ck-heading-dropdown .ck-heading_heading3 .ck-button__label {
           font-size: 1.31em;
           font-weight: bold;
       }

       .document-editor .ck-content h4 {
           line-height: 1.24em;
           padding-top: .286em;
           margin-bottom: .952em;
       }

       /* Make the block quoted text serif with some additional spacing. */
       .document-editor .ck-content blockquote {
           font-family: Georgia, serif;
           margin-left: calc(2 * var(--ck-spacing-large));
           margin-right: calc(2 * var(--ck-spacing-large));
       }

       @media only screen and (max-width: 960px) {

           /* Because on mobile 2cm paddings are to big. */
           .document-editor__editable-container .document-editor__editable.ck-editor__editable {
               padding: 1.5em;
           }
       }

       @media only screen and (max-width: 1200px) {
           .main__content-wide .document-editor__editable-container .document-editor__editable.ck-editor__editable {
               width: 100%;
           }
       }

       /* Style document editor a'ka Google Docs.*/
       @media only screen and (min-width: 1360px) {
           .main .main__content.main__content-wide {
               padding-right: 0;
           }
       }

       @media only screen and (min-width: 1600px) {
           .main .main__content.main__content-wide {
               width: 24cm;
           }

           .main .main__content.main__content-wide .main__content-inner {
               width: auto;
               margin: 0 50px;
           }

           /* Keep "page" look based on viewport width. */
           .main__content-wide .document-editor__editable-container .document-editor__editable.ck-editor__editable {
               width: 60%;
           }
       }
   </style>
</div>
