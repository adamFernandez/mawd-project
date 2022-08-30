<template>
  <div>
    <MainHeader title="testIndex" />
    <ul>
      <li>
        <NuxtLink to="/"> Home </NuxtLink>
      </li>
      <li>
        <NuxtLink to="/test"> testIndex </NuxtLink>
      </li>
    </ul>
  </div>
</template>
<script>
// import { xpagesQuery as slugs } from "@gql/queries";

export default {
  name: "testIndex",
  async asyncData({ params }) {
    const slug = params.slug; // When calling /abc the slug will be "abc"

    return { slug };
  },

  data: () => ({
    pages: {},
  }),
};
</script>
