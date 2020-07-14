<template>
    <overlay-page-template>
        <page-header title="About"/>

        <div class="bar">
            <bar>
                <template #name>
                    Data Policy
                </template>
            </bar>

            <bar>
                <template #name>
                    Terms of Use
                </template>
            </bar>

        </div>
    </overlay-page-template>
</template>

<script>
    export default {
        name: "About",
        components: {
            Bar: () => import( /* webpackChunkName: "bar-component" */ 'GlobalComponents/Bar'),
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader')
        }
    }
</script>
