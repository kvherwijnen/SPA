<template>
    <overlay-page-template>
        <page-header title="Security"/>

        <div class="bar">
            <bar>
                <template #name>
                    Report a problem
                </template>
            </bar>

            <bar>
                <template #name>
                    Help Centre
                </template>
            </bar>

            <bar>
                <template #name>
                    Support Request
                </template>
            </bar>

            <bar>
                <template #name>
                    Privacy and security help
                </template>
            </bar>

            <bar>
                <template #name>
                    Data and history
                </template>
                <template #right>
                    <span/>
                </template>
            </bar>

            <bar>
                <template #name>
                    Access data
                </template>
            </bar>
            <bar>
                <template #name>
                    Download Data
                </template>
            </bar>
            <bar>
                <template #name>
                    Apps and websites
                </template>
            </bar>
            <bar>
                <template #name>
                    Clear search history
                </template>
            </bar>

        </div>
    </overlay-page-template>
</template>

<script>
    export default {
        name: "Request",
        components: {
            Bar: () => import( /* webpackChunkName: "bar-component" */ 'GlobalComponents/Bar'),
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader')
        }
    }
</script>
