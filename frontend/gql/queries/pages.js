import gql from "fake-tag";
import { pages, drops, info } from "../fragments";

export const pagesQuery = gql`
  query pagesQuery($slug: [String]) {
    entries(slug: $slug) {
      slug
      id
      ... on page_page_Entry {
        localNavigation {
          ... on localNavigation_link_BlockType {
            linkTitle
            background
            linkUrl
            id
          }
        }
        sectionGroup {
          ... on sectionGroup_sectionBlock_BlockType {
            sectionTitle
            linkToButton
            text
            image {
              uri
              url
              id
              title
            }
          }
        }
        level
        children {
          id
          slug
          title
          children {
            id
            slug
            title
            children {
              id
              slug
              title
            }
            parent {
              id
              slug
              title
            }
          }
          parent {
            id
            slug
            title
          }
        }
        parent {
          id
          slug
          title
        }
      }
    }
  }
`;

export const pageQuery = gql`
  query pagesQuery($slug: [String]) {
    entry(slug: $slug) {
      title
      slug
      id
      ...pages
    }
  }
  ${pages}
`;

export const infoQuery = gql`
  query infoQuery {
    entries(section: "info") {
      title
      slug
      id
      ...info
    }
  }
  ${info}
`;
export const dropsQuery = gql`
  query dropsQuery {
    entries(section: "drops") {
      title
      slug
      id
      ...drops
    }
  }
  ${drops}
`;
