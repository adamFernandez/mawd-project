<template>
  <footer>
    <ul>
      <li>
        <a>Mawdmeta</a>
      </li>
      <li>
        <a id="to-top" href="#">Back to top</a>
      </li>
    </ul>
  </footer>
</template>
<script>
export default {
  name: "Footer",
};
</script>
<style>
footer {
  color: #ffffff;
  padding: 0 1em;
}
footer ul {
  display: flex;
  justify-content: space-between;
  border-top: 1px solid #ffffff;
  padding: 0;
  margin: 0;
}
footer ul li {
  display: flex;
  justify-self: flex-start;
  font-size: 0.9em;
  padding: 1em 0;
  margin: 0;
}

/* .stick-bottom :nth-child(1) {
  margin-right: auto;
} */
</style>
