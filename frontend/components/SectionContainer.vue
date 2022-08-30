<template>
  <div :class="className">
    {{ content }}
  </div>
</template>
<script>
export default {
  name: "FormsDateOnly",
  props: {
    label: String,
    value: {
      type: String,
      default: "2022-07-26",
    },
    className: String,
    disabled: {
      type: Boolean,
      default: false,
    },
    debug: {
      type: Boolean,
      default: false,
    },
    formType: {
      type: String,
      default: "join",
    },
    error: Boolean,
  },
  data() {
    return {
      item: "",
    };
  },
  watch: {
    item: {
      deep: true,
      handler(val) {
        this.$emit("input", val);
      },
    },
    value: {
      immediate: true,
      handler(val) {
        this.item = val;
      },
    },
  },
};
</script>
