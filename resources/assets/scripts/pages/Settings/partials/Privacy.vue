<template>
    <overlay-page-template>
        <page-header title="Privacy"/>

        <div class="bar">
            <bar>
                <template #name>
                    Account privacy
                </template>
            </bar>

            <bar>
                <template #name>
                    Restricted accounts
                </template>
            </bar>

            <bar>
                <template #name>
                    Muted accounts
                </template>
            </bar>

            <bar>
                <template #name>

                </template>
            </bar>

            <bar icon="none">
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
        name: "Privacy",
        components: {
            Bar: () => import( /* webpackChunkName: "bar-component" */ 'GlobalComponents/Bar'),
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader')
        }
    }
</script>
