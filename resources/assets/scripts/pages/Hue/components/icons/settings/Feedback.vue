<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <!-- Generator: Sketch 51.3 (57544) - http://www.bohemiancoding.com/sketch -->
        <title>settingsFeedback</title>
        <desc>Created with Sketch.</desc>
        <defs></defs>
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path d="M20.869,13.228 L18.917,15.25 L19.242,18.466 C19.304,18.844 18.903,19.127 18.569,18.942 L16,17.333 L13.431,18.942 C13.097,19.127 12.696,18.844 12.758,18.466 L13.083,15.25 L11.131,13.228 C10.87,12.96 11.02,12.51 11.389,12.454 L14.333,11.917 L15.586,9.264 C15.75,8.913 16.25,8.913 16.414,9.264 L17.667,11.917 L20.611,12.454 C20.979,12.51 21.13,12.96 20.869,13.228 M26,5 L6,5 C4.9,5 4,5.901 4,7 L4,21.002 C4,22.103 4.9,23.002 6,23.002 L16,23.002 L16,25.933 C16,26.8 16.979,27.304 17.684,26.8 L23,23.002 L26,23.002 C27.099,23.002 28,22.103 28,21.002 L28,7 C28,5.901 27.099,5 26,5"/>
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
