<template>
    <div class="hue-slider-container">
        <div :aria-valuenow="(value / 100) * 254"
             :style="{ background: isVisible ? backgroundColor : 'rgba(35, 35, 35, 0.95)' }"
             @mousedown="handleDown" aria-valuemax="254" aria-valuemin="1" class="hue-slider" ref="slider"
             role="slider">
            <div class="hue-slider-overlay"/>
            <div :style="{width: value + '%'}" class="hue-slider-progress" ref="progress"/>
            <div :style="{left: 'calc('+ value +'% - ' + dotHalfWidth + 'px)'}" class="hue-slider-dot-container"
                 ref="dot">
                <div class="hue-slider-dot"/>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Slider",
        props: {
            backgroundColor: {
                type: String,
                required: true
            },
            isVisible: {
                type: Boolean,
                required: true
            },
            disabled: {
                type: Boolean,
                default: false
            },
            value: {
                type: Number,
                required: true,
                validator(value) {
                    return value >= 0 && value <= 100;
                }
            }
        },

        data() {
            return {
                dotHalfWidth: 17,
                dragging: false,
                progress: null,
                sliderLeftPosition: null,
                sliderWidth: null
            };
        },

        methods: {
            handleDown(event) {
                if (!this.disabled) {
                    this.dragging = true;
                    this.$emit('dragging', this.dragging);
                    this.sliderWidth = this.$refs.slider.offsetWidth;
                    this.sliderLeftPosition = this.$refs.slider.getBoundingClientRect().left;
                    document.addEventListener("mousemove", this.setNewCurrentPosition);
                    document.addEventListener("mouseup", this.mouseUp);
                    this.setNewCurrentPosition(event);
                }
                return false;
            },

            mouseUp() {
                this.dragging = false;
                this.$emit('dragging', this.dragging);
                document.removeEventListener("mousemove", this.setNewCurrentPosition);
                document.removeEventListener("mouseup", this.mouseUp);
            },

            setNewCurrentPosition(event) {
                if (
                    this.dragging &&
                    event.pageX >= this.sliderLeftPosition &&
                    event.pageX <= this.sliderLeftPosition + this.sliderWidth
                ) {
                    this.progress =
                        Math.round(((event.pageX - this.sliderLeftPosition) / this.sliderWidth) * 100);
                    this.$refs.dot.style.left = event.pageX - this.sliderLeftPosition - this.dotHalfWidth + "px";
                    this.$refs.progress.style.width = this.progress + "%";
                    this.$emit('change', this.progress)
                }
            }
        }
    }
</script>
