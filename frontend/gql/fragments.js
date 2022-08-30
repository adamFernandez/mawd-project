import gql from "fake-tag";

export const info = gql`
  fragment info on info_info_Entry {
    linkTo
    richText
  }
`;
export const drops = gql`
  fragment drops on drops_entries_Entry {
    title
    imageCaption
    image {
      url
      filename
      id
      size
    }
  }
`;

export const pages = gql`
  fragment pages on page_page_Entry {
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
        image {
          uri
          url
          id
          title
        }
        text
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
`;
