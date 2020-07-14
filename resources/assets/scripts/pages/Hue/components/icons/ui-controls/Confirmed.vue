<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="color ? color : '#FFFFFF'">
                <path d="M22.072,12.953 L15.307,21.075 C14.966,21.485 14.357,21.529 13.961,21.173 L9.664,17.302 C9.204,16.887 9.163,16.173 9.572,15.707 C9.891,15.343 10.406,15.227 10.848,15.421 L14.457,17.003 L20.771,11.634 C21.134,11.326 21.666,11.344 22.007,11.676 C22.357,12.017 22.386,12.576 22.072,12.953 M16,4 C9.373,4 4,9.373 4,16 C4,22.627 9.373,28 16,28 C22.627,28 28,22.627 28,16 C28,9.373 22.627,4 16,4"/>
            </g>
        </g>
    </svg>
</template>

<script>
    export default {
        name: "Confirmed",
        props: {
            color: String
        }
    };
</script>
