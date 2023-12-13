<template>
    <editor api-key="lcgvc5jqkgl0vzltyaujytghyz0jd8a317fi3whbli5f60tp" :init="{
        height: 300,
        menubar: false,
        plugins: [
            '     anchor',
            '   fullscreen',
            '      wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | \
                      alignleft aligncenter alignright alignjustify | \
                      bullist numlist outdent indent | removeformat | help'
    }" v-model="content"></editor>
</template>

<script>
import Editor from '@tinymce/tinymce-vue';

export default {
    components: {
        Editor
    },
    data() {
        return {
            content: '<p>This is the initial content of the editor</p>'
        };
    }
}
</script>
