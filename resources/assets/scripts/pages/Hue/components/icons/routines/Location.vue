<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <!-- Generator: Sketch 51.3 (57544) - http://www.bohemiancoding.com/sketch -->
        <title>routinesLocation</title>
        <desc>Created with Sketch.</desc>
        <defs></defs>
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path d="M5.48830308,14.4753994 L23.8123031,6.07939943 C24.5163031,5.75539943 25.2443031,6.48239943 24.9213031,7.18639943 L16.5343031,25.5113994 C16.1933031,26.2553994 15.0963031,26.1183994 14.9513031,25.3123994 L13.6403031,18.0543994 C13.5793031,17.7113994 13.3103031,17.4433994 12.9673031,17.3803994 L5.68630308,16.0583994 C4.88230308,15.9123994 4.74430308,14.8163994 5.48830308,14.4753994"/>
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
