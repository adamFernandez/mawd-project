<template>
  <div>
    <MainHeader :title="slug === '/' ? 'Home' : slug" :className="'center'" />
    <!-- <p>Path: {{ $route.path }}</p> -->

    <pre v-if="debug">{{ page }}</pre>
  </div>
</template>

<script>
import { pagesQuery as slugs } from "@gql/queries";

export default {
  name: "DefaultLayoutPage",
  async asyncData({ params }) {
    const slug = params.slug; // When calling /abc the slug will be "abc"
    return { slug };
  },
  async fetch() {
    const { data } = await this.$graphql({
      query: slugs,
    });
    const pages = data.entries;
    this.pages = pages;

    const page = pages.filter((x) => {
      return x.slug === this.$route.params.slug;
    });
    this.page = page[0];
  },

  data: () => ({
    pages: {},
    page: {},
    debug: true,
  }),
};
</script>
