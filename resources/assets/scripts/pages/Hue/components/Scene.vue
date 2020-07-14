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
    <div class="d-flex flex-column justify-content-between" v-if="scene">
        <div class="d-flex justify-content-around">
            <label @click='scene.setSceneToGroup(roomId)' class="scene">
                <input type="checkbox">
                <div class="checkmark">
                    <dynamic-icon :name="scene.getIcon()" typeGroup="scenes" class="hue-top-icon"/>
                </div>
            </label>
        </div>

        <div class="text-center text-white font-italic font-weight-600" style="font-size: smaller">
            {{ scene.name }}
        </div>
    </div>
</template>

<script>
    import Scene from "Core/models/Scene";
    import { getHue } from "Core/helpers/async";

    export default {
        props: {
            id: {
                required: true
            },
            roomId: {
                required: false
            }
        },
        data() {
            return {
                scene: null
            }
        },
        async beforeMount() {
            await getHue('scenes', this.id).then(scene => this.scene = new Scene(scene.data));
        }
    };
</script>
