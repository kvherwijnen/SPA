<!--
  - :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
  -
  - Copyright (c) 2020
  - All Rights Reserved
  - Licensed use only
  -
  - This product is part of the SheepCompany Incorporated
  -
  -
  - LICENSE BY:
  - Artificial Intelligence :: Sheep-AI.com
  - More information: LICENSE.txt
  -
  - :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
  -->

<template>
    <transition :enter-active-class="transitionEnterActiveClass"
                :mode="transitionMode"
                :name="transitionName"
                @afterEnter="afterEnter"
                @beforeLeave="beforeLeave"
                @enter="enter">
        <slot/>
    </transition>
</template>

<script>
    const DEFAULT_TRANSITION = 'fade';
    const DEFAULT_TRANSITION_MODE = 'out-in';

    export default {
        name: 'PageTransition',
        data() {
            return {
                prevHeight: 0,
                transitionName: DEFAULT_TRANSITION,
                transitionMode: DEFAULT_TRANSITION_MODE,
                transitionEnterActiveClass: '',
            };
        },
        created() {
            this.$router.beforeEach((to, from, next) => {
                let transitionName = to.meta.transitionName || from.meta.transitionName || DEFAULT_TRANSITION;

                if (transitionName === 'slide') {
                    const toDepth = to.path.split('/').length;
                    const fromDepth = from.path.split('/').length;
                    transitionName = toDepth < fromDepth ? 'slide-right' : 'slide-left';
                }

                this.transitionMode = DEFAULT_TRANSITION_MODE;
                this.transitionEnterActiveClass = `${transitionName}-enter-active`;

                if (to.meta.transitionName === 'zoom') {
                    this.transitionMode = 'in-out';
                    this.transitionEnterActiveClass = 'zoom-enter-active';
                    document.body.style.overflow = 'hidden';
                }

                if (from.meta.transitionName === 'zoom') {
                    this.transitionMode = null;
                    this.transitionEnterActiveClass = null;
                    document.body.style.overflow = null;
                }

                this.transitionName = transitionName;

                next();
            });
        },
        methods: {
            beforeLeave(element) {
                this.prevHeight = getComputedStyle(element).height;
            },

            enter(element) {
                const {height} = getComputedStyle(element);

                element.style.height = this.prevHeight;

                setTimeout(() => {
                    element.style.height = height;
                });
            },

            afterEnter(element) {
                element.style.height = 'auto';
            }
        }
    }
</script>
