<template>
  <div>
    <MainHeader :title="child" :className="'center'" />
    <h2>Parent: {{ parent }}</h2>
    <h3>Child: {{ child }}</h3>
    <p>Path: {{ $route.path }}</p>
    <h3>{{ page.text }}</h3>
  </div>
</template>

<script>
import { pagesQuery as slugs } from "@gql/queries";

export default {
  name: "ChildLevel3",
  async asyncData({ params }) {
    const child = params.thirdchild;
    const parent = params.third;
    return { parent, child };
  },
  async fetch() {
    const { data } = await this.$graphql({
      query: slugs,
    });
    const pages = data.entries;
    this.pages = pages;

    const page = pages.filter((x) => {
      return x.slug === this.child;
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
