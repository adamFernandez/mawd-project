<template>
  <div>
    <InfoPanel :content="infoData" />
    <SectionGroup :sectionData="pageContent.sectionGroup" />
    <!-- <pre v-if="debug">{{ pageContent }}</pre> -->
    <pre v-if="debug">{{ infoData }}</pre>
  </div>
</template>

<script>
import { pagesQuery as slugs } from "@gql/queries";
import { infoQuery as info } from "@gql/queries";
import InfoPanel from "@c/Blocks/InfoPanel";
export default {
  name: "IndexPage",
  components: {
    InfoPanel,
  },
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

    const pageContent = pages.filter((x) => {
      return x.slug === "landing-page";
    });
    this.pageContent = pageContent[0];

    const infoData = await this.$graphql({
      query: info,
    });

    this.infoData = infoData.data;
    // FILTER FOR DYNAMIC PAGES DEPENDING ON SLUG
    // const page = pages.filter((x) => {
    //   return x.slug === this.$route.params.slug;
    // });
    // this.page = page[0];
  },

  data: () => ({
    page: {},
    pageContent: {},
    pages: {},
    infoData: {},
    debug: true,
  }),
  methods: {
    showPanel() {
      console.log("Show Panel!");
    },
  },
};
</script>
