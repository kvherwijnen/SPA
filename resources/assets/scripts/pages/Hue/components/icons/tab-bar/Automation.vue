<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path d="M21.1749694,4 L13.5139694,4 C13.0779694,4 12.6869694,4.256 12.5299694,4.643 L8.07096938,15.678 C7.80596938,16.335 8.31596938,17.041 9.05496938,17.041 L13.8439694,17.041 L9.05296938,27.284 C8.80196938,27.801 9.50496938,28.252 9.91496938,27.838 L22.7119694,14.719 C23.3449694,14.079 22.8669694,13.028 21.9449694,13.028 L15.9519694,13.028 L22.0059694,5.619 C22.5449694,4.96 22.0519694,4 21.1749694,4"/>
            </g>
        </g>
    </svg>
</template>

<script>
    export default {
        name: "Atomation",
        props: {
            checked: Boolean,
            color: String
        }
    };
</script>
