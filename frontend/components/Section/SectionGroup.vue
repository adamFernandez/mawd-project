<template>
  <div>
    <section
      v-for="(section, i) in sectionData"
      :key="i"
      :id="section.linkToButton"
    >
      <div v-if="section.sectionTitle && section.hasHeading">
        <h2>{{ section.sectionTitle }}</h2>
      </div>
      <a v-if="section.linkToButton" :id="`${section.linkToButton}`"></a>
      <div v-if="section.image[0]" class="section_image">
        <img :src="section.image[0].url" alt="" />
      </div>
      <div v-if="section.text" v-html="section.text"></div>
    </section>
  </div>
</template>
<script>
export default {
  props: {
    sectionData: {
      type: Array,
      default: () => [],
    },
  },
  methods: {
    callback: function (e) {
      this.$emit("click", e);
    },
  },
};
</script>
<style>
body {
  background: black;
}
section {
  display: flex;
  align-content: center;
  align-items: center;
  justify-content: center;
  justify-items: center;
  padding: 2em;
  height: 100vh;
  font-size: 1em;
}

.section_image {
  font-size: 4em;
  font-weight: bold;
}

.section_image img {
  width: 100%;
}

.link-to-info-panel {
  font-size: 0.7em;
  border: 1px solid white;
  border-radius: 5px;
  padding: 0.3em;
}
</style>
