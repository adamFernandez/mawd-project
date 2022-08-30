<template>
  <div>
    <MainHeader :title="child" :className="'center'" />
    <h3 v-if="page.text">{{ page.text }}</h3>
  </div>
</template>

<script>
import { pagesQuery as slugs } from "@gql/queries";

export default {
  name: "ChildLevel1",
  async asyncData({ params }) {
    const child = params.firstchild;
    const parent = params.first;
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
