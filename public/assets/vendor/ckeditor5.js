import {
    ClassicEditor,
    AccessibilityHelp,
    Autosave,
    Bold,
    Essentials,
    Italic,
    Mention,
    Paragraph,
    SelectAll,
    Undo
} from 'ckeditor5';
import { SlashCommand } from 'ckeditor5-premium-features';

const editorConfig = {
    toolbar: {
        items: ['undo', 'redo', '|', 'selectAll', '|', 'bold', 'italic', '|', 'accessibilityHelp'],
        shouldNotGroupWhenFull: false
    },
    placeholder: 'Type or paste your content here!',
    plugins: [AccessibilityHelp, Autosave, Bold, Essentials, Italic, Mention, Paragraph, SelectAll, SlashCommand, Undo],
    licenseKey:'WEJmdjRrUDZNczBmWDREWWFaY3FTb0J0MlJxaFQ3eGFoVjlick50MnRJdTBJMWw4L2craC9Gdzk3S3JlN0E9PS1NakF5TkRBNU1qVT0=',
    mention: {
        feeds: [
            {
                marker: '@',
                feed: [
                    /* See: https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html */
                ]
            }
        ]
    },
    initialData: "<h2>Congratulations on setting up CKEditor 5! 🎉</h2>"
};

ClassicEditor
    .create( document.querySelector( '#editor' ), editorConfig )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
