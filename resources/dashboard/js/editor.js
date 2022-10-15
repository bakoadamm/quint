import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';

(function() {
    const editor = new EditorJS({
        holder : 'editorjs',
        tools: {
            header: {
                class: Header,
                inlineToolbar : true,
                placeholder: 'Enter a header',
                levels: [2, 3, 4],
                defaultLevel: 3
            },
        },
        data: {}});
})()
