// import axios from "axios";
// const https = require("https");
export default function ({ $config, $axios, query }, inject) {
  // 1. Create instance for API using Axios
  const $graphql = $axios.create({
    baseURL: $config.craftApiUrl,
  });

  // $graphql.defaults.httpsAgent = new https.Agent({ rejectUnauthorized: false });

  // 2. Add GraphQL Authorisation token for our private api schema
  if ($config.craftAuthToken !== "") {
    $graphql.setToken($config.craftAuthToken, "Bearer");
  }

  inject(
    "graphql",
    $graphql.$post.bind($graphql, query.token ? `?token=${query.token}` : "")
  );
}
