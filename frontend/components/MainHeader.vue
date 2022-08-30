<template>
  <div :class="className">
    <h1>{{ title }}</h1>
  </div>
</template>
<script>
export default {
  name: "MainHeader",
  props: {
    title: String,
    label: String,
    className: String,
    debug: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      item: "",
    };
  },
};
</script>
