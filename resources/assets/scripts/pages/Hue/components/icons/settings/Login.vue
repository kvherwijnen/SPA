<template>
    <svg height="32px" version="1.1" viewBox="0 0 32 32" width="32px" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
            <g :fill="checked ? color : '#FFFFFF'">
                <path d="M15.9999734,15 C13.2379734,15 10.9999734,11.709 10.9999734,8.61 C10.9999734,5.512 13.2379734,3 15.9999734,3 C18.7619734,3 20.9999734,5.512 20.9999734,8.61 C20.9999734,11.709 18.7619734,15 15.9999734,15 Z M15.9999734,17 C20.1439734,17 23.5559734,20.896 23.9959734,25.9 C24.0479734,26.489 23.5829734,27 22.9889734,27 L9.01097343,27 C8.41697343,27 7.95197343,26.489 8.00397343,25.9 C8.44397343,20.896 11.8559734,17 15.9999734,17 Z"/>
            </g>
        </g>
    </svg>
</template>

<script>
    export default {
        name: "Login",
        props: {
            checked: Boolean,
            color: String
        }
    };
</script>
