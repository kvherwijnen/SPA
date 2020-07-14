<template>
    <overlay-page-template>
        <page-header title="Security"/>

        <div class="bar">
            <bar>
                <template #name>
                    Password
                </template>
            </bar>
            <bar>
                <template #name>
                    Login Activity
                </template>
            </bar>
            <bar>
                <template #name>
                    Saved login information
                </template>
            </bar>
            <bar>
                <template #name>
                    Two-factor authentication
                </template>
            </bar>
            <bar>
                <template #name>
                    Emails from SheepCompany
                </template>
            </bar>

        </div>
    </overlay-page-template>
</template>

<script>
    export default {
        name: "Help",
        components: {
            Bar: () => import( /* webpackChunkName: "bar-component" */ 'GlobalComponents/Bar'),
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader')
        }
    }
</script>
