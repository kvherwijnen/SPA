<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path d="M15.999,12.999 C14.667,12.999 14,12.333 14,10.999 C14,9.664 14.667,8.999 15.999,8.999 C17.332,8.999 18,9.664 18,10.999 C18,12.333 17.332,12.999 15.999,12.999 Z M18,21.8 C18,22.46 17.46,23 16.8,23 L16.2,23 C15.54,23 15,22.46 15,21.8 L15,17 C14.34,17 14,16.46 14,15.8 L14,15.2 C14,14.54 14.54,14 15.2,14 L16.8,14 C17.46,14 18,14.54 18,15.2 L18,21.8 Z M16,4 C9.373,4 4,9.373 4,16 C4,22.627 9.373,28 16,28 C22.627,28 28,22.627 28,16 C28,9.373 22.627,4 16,4 Z"/>
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
