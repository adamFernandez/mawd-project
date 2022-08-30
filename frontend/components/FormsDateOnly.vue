<template>
  <div class="form-group relative">
    <label
      :class="`uk-form-label ${formType}__form__label`"
      for="form-stacked-text"
      >{{ label }}</label
    >
    <div class="uk-form-controls">
      <i class="uk-icon-calendar"></i>
      <input
        class="uk-input"
        v-model="item"
        :placeholder="label"
        :disabled="disabled"
        type="date"
        :class="className"
      />
      <slot></slot>
    </div>
    <pre v-if="debug">
      {{ item }}
    </pre>
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
