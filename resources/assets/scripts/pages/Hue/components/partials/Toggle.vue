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
    <div class="hue-content-toggle">
        <input :checked="$parent.isChecked" :disabled="disabled"
               class="hue-content-toggle-checkbox"
               type="checkbox" value="1"/>

        <label :disabled="disabled"
               :style="{ backgroundColor: $parent.isChecked ? ToggleColor : 'rgba(68,68,68,0.84)' }"
               @click="handleToggle" class="hue-content-toggle-label">
        </label>
    </div>
</template>

<script>
    import Color from "color";

    export default {
        name: 'Toggle',
        props: {
            id: {
                required: true
            },
            disabled: {
                default: true
            },
            hexColor: {
                type: String | Array
            }
        },
        computed: {
            ToggleColor() {
                if (Array.isArray(this.hexColor))
                    return Color(this.hexColor[this.hexColor.length - 1]).darken(0.2);

                return Color(this.hexColor).darken(0.2);
            }
        },
        methods: {
            async handleToggle() {
                if (this.$parent.hueObject.state.reachable) {
                    this.$parent.isChecked = !this.$parent.isChecked;
                    await this.toggle();
                    this.$emit("toggle", this.id, this.checked);
                } else return false;
            },

            async toggle() {
                return await this.$parent.hueObject.update({on: this.$parent.isChecked});
            }
        }
    }
</script>
