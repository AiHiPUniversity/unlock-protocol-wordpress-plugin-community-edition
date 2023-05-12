/**
 * Creating a sidebar enables you to:
 - create an ordered group of docs
 - render a sidebar for each doc of that group
 - provide next/previous navigation

 The sidebars can be generated from the filesystem, or explicitly defined here.

 Create as many sidebars as you want.
 */

// @ts-check

/** @type {import('@docusaurus/plugin-content-docs').SidebarsConfig} */
const sidebars = {
  // By default, Docusaurus generates a sidebar from the docs folder structure
  docs: [
    {
      label: "Getting Started",
      type: "category",
      collapsed: false,
      link: {
        type: "doc",
        id: "getting-started/README",
      },
      items: [
        {
          type: "autogenerated",
          dirName: "getting-started",
        },
      ],
    },
    {
      label: "Features",
      type: "category",
      link: {
        type: "doc",
        id: "features/README",
      },
      items: [
        {
          type: "autogenerated",
          dirName: "features",
        },
      ],
    },
    {
      label: "Tutorials",
      type: "category",
      link: {
        type: "doc",
        id: "tutorials/README",
      },
      items: [
        {
          type: "autogenerated",
          dirName: "tutorials",
        },
      ],
    },
    {
      label: "FAQ",
      type: "category",
      link: { //added link tag to display sidebar on faq page
        type: "doc",
        id: "faq/README",
      },
      items: [
        // {
        //   type: "category",
        //   label: "Sign in with ethereum",
        //   link: {
        //     type: "doc",
        //     id: "faq/sign-in-with-ethereum/README",
        //   },
        //   items: ["faq/sign-in-with-ethereum/unlock-accounts"],
        // },
      ],
    },
    {
      label: "Showcase",
      type: "category",
      link: {
        type: "doc",
        id: "showcase/README",
      },
      items: [
        {
          type: "autogenerated",
          dirName: "showcase",
        },
      ],
    },
  ],
};

module.exports = sidebars;
