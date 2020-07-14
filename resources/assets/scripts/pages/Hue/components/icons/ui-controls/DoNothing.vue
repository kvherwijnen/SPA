<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <!-- Generator: Sketch 51.3 (57544) - http://www.bohemiancoding.com/sketch -->
        <title>uicontrolsDoNothing</title>
        <desc>Created with Sketch.</desc>
        <defs></defs>
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path d="M12,14 L20,14 C21.1,14 22,14.9 22,16 C22,17.1 21.1,18 20,18 L12,18 C10.9,18 10,17.1 10,16 C10,14.9 10.9,14 12,14 M16,28 C22.627,28 28,22.627 28,16 C28,9.373 22.627,4 16,4 C9.373,4 4,9.373 4,16 C4,22.627 9.373,28 16,28"/>
            </g>
        </g>
    </svg>
</template>

<script>
    export default {
        name: "NAME_HERE",
        props: {
            checked: Boolean,
            color: String
        }
    };
</script>
