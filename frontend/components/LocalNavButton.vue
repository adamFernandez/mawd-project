<template>
  <button :class="className" @click="callback($event)">
    {{ buttonText }}
  </button>
</template>

<script>
export default {
  props: {
    buttonText: String,
    className: String,
  },
  methods: {
    callback: function (e) {
      this.$emit("click", e);
    },
  },
};
</script>
