<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path d="M18.45,10.941 L17.216,17.019 C17.099,17.589 16.591,18 16,18 C15.409,18 14.9,17.589 14.784,17.019 L13.55,10.941 C13.24,9.42 14.423,8 16,8 C17.577,8 18.76,9.42 18.45,10.941 M16,23 C15.172,23 14.5,22.328 14.5,21.5 C14.5,20.671 15.172,20 16,20 C16.828,20 17.5,20.671 17.5,21.5 C17.5,22.328 16.828,23 16,23 M16,4 C9.373,4 4,9.373 4,16 C4,22.627 9.373,28 16,28 C22.627,28 28,22.627 28,16 C28,9.373 22.627,4 16,4"/>
            </g>
        </g>
    </svg>
</template>

<script>
    export default {
        name: "Error",
        props: {
            checked: Boolean,
            color: String
        }
    };
</script>
