<template>
    <overlay-page-template>
        <page-header title="Appearance"/>

        <div class="col-4 col-md-3 col-xl-2 pl-0">
            <vs-button animation-type="vertical" class="btn-block border-dashed" danger gradient to="/store">
                <dynamic-icon class="my-2" nane="plus" typeGroup="settings"/>
                <template #animate>
                    <h5 class="mb-0">Store</h5>
                </template>
            </vs-button>
        </div>

    </overlay-page-template>
</template>
<script>
    export default {
        name: 'Appearance',
        components: {
            VsButton: () => import( /* webpackChunkName: "vs-Button-component" */ 'vuesax/dist/vsButton'),
            PageHeader: () => import( /* webpackChunkName: "page-header-mobile-component" */  'GlobalComponents/PageHeader'),
        },
    }
</script>
