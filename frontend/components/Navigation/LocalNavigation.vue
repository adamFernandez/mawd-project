<template>
  <div>
    <nav class="local">
      <ul>
        <li v-for="link in data" :key="link.id">
          <div
            v-if="link.background"
            class="gradient-btn"
            @click="callback($event)"
            :style="styleBtn"
          ></div>
          <a v-else :href="`#${link.linkTitle}`"> {{ link.linkTitle }}</a>
        </li>
      </ul>
      <pre v-if="debug">
      {{ styleBtn }}
      </pre>
    </nav>
  </div>
</template>

<script>
export default {
  name: "LocalNavigation",
  data: () => ({
    debug: false,
  }),
  props: {
    data: {
      type: Array,
      default: () => [],
    },
    styleBtn: {
      type: String,
      default: "",
    },
  },
  methods: {
    callback: function (e) {
      this.$emit("click", e);
    },
  },
};
</script>
<style lang="postcss">
nav.local {
  width: 100%;
  color: black;
  position: fixed;
  z-index: 1000;
  right: 0;
  top: 0;
}
nav.local ul li {
  background-color: hsla(60, 100%, 96%, 0.75);
  border-radius: 5px 5px;
  font-size: 0.8em;
  padding: 0.5em;
  display: grid;
  align-items: center;
}
nav.local :nth-child(1) {
  margin-right: auto;
}
.gradient-btn-container {
  display: flex;
  align-content: center;
  align-items: center;
  justify-content: center;
  justify-items: center;
}
.gradient-btn {
  width: 1.2em;
  height: 1.2em;
  background-image: radial-gradient(
      at 95% 77%,
      hsla(329, 100%, 82%, 0.93) 0px,
      transparent 50%
    ),
    radial-gradient(at 94% 10%, hsla(206, 100%, 52%, 1) 0px, transparent 50%),
    radial-gradient(at 3% 79%, hsla(329, 100%, 82%, 1) 0px, transparent 50%),
    radial-gradient(at 4% 5%, hsla(206, 100%, 84%, 0.76) 0px, transparent 50%),
    radial-gradient(at 53% 59%, hsla(329, 100%, 92%, 0.63) 0px, transparent 50%);
  border-radius: 50% 50%;
}
</style>
