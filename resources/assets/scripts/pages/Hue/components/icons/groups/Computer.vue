<template>
    <svg
            height="32px"
            version="1.1"
            viewBox="0 0 32 32"
            width="32px"
            xmlns="http://www.w3.org/2000/svg"
    >
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path
                        d="M29,5 C29.55,5 30,5.45 30,6 L30,17 L2,17 L2,6 C2,5.45 2.45,5 3,5 L29,5 Z M2,20 L2,19 L30,19 L30,20 C30,20.55 29.55,21 29,21 L17,21 L17,25 L19,25 C19.553,25 20,25.447 20,26 C20,26.553 19.553,27 19,27 L13,27 C12.447,27 12,26.553 12,26 C12,25.447 12.447,25 13,25 L15,25 L15,21 L3,21 C2.45,21 2,20.55 2,20 Z"
                />
            </g>
        </g>
    </svg>
</template>
<script>
    export default {
        name: "Computer",
        props: {
            checked: Boolean,
            color: String
        }
    };
</script>
