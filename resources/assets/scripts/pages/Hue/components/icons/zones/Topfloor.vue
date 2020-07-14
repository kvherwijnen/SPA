<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path d="M27.66,14.19,16.71,4.28a1,1,0,0,0-1.42,0L4.34,14.19A1,1,0,0,0,5.05,16H7V27a1,1,0,0,0,1,1H24a1,1,0,0,0,1-1V16H27A1,1,0,0,0,27.66,14.19ZM7.53,14,16,6.33,24.47,14Z"/>
            </g>
        </g>
    </svg>
</template>

<script>
    export default {
        name: "Topfloor",
        props: {
            checked: Boolean,
            color: String
        }
    };
</script>
