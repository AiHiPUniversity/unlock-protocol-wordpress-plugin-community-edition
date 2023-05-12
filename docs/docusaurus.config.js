// @ts-check
// Note: type annotations allow type checking and IDEs autocompletion

const UnlockPrismTheme = require("./unlock-prism-theme");

/** @type {import('@docusaurus/core').Config} */
const config = {
  title: "Unlock Protocol Wordpress Plugin Community Edition",
  tagline:
    "Allows to lock content in wp with Unlock",
  url: "https://unlock-wpplugin-community-edition.aihipuniversity.com",
  baseUrl: "/",
  onBrokenLinks: "warn",
  onBrokenMarkdownLinks: "warn",
  onDuplicateRoutes: "throw",
  favicon: "img/favicon.ico",
  organizationName: "AiHiPUniversity", // Usually your GitHub org/user name.
  projectName: "Unlock Protocol Wordpress Plugin Community Edition Docs", // Usually your repo name.
  plugins: [
    'docusaurus-node-polyfills',
    [
      require.resolve("docusaurus-gtm-plugin"),
      {
        id: "GTM-PRCCFV9", // GTM Container ID
      },
    ],
    [
      "@docusaurus/plugin-client-redirects",
      {
        redirects: [
          // {
          //   from: "/unlock/developers/sign-in-with-ethereum", //redirect sign in with ethereum
          //   to: "/tools/sign-in-with-ethereum/",
          // },
          // {
          //   from: "/unlock",
          //   to: "/",
          // },
          // {
          //   from: "/basics",
          //   to: "/",
          // },
          // {
          //   from: "/unlock/tools/locksmith/webhooks",
          //   to: "/tools/locksmith/webhooks",
          // }
        ],
      },
    ],
  ],
  presets: [
    [
      '@docusaurus/preset-classic',
      {
        docs: {
          sidebarPath: require.resolve('./sidebars.js'),
          routeBasePath: '/',
          // Please change this to your repo.
          // editUrl: 'https://github.com/unlock-protocol/docs/docs',
        },
        theme: {
          customCss: require.resolve('./src/css/custom.css'),
        },
      },
    ],
  ],


  themeConfig: {
    start_urls: [
      "https://github.com/AiHiPUniversity/unlock-protocol-wordpress-plugin-community-edition"
    ],
    sitemap_urls: [
      "https://unlock-wpplugin-community-edition.aihipuniversity.com/sitemap.xml"
    ],
    algolia: {
      appId: "J4FN2FD27Q",
      apiKey: "9bcefa2858ec26676689edd55f03fd26",
      indexName: "unlock-protocol",
      contextualSearch: false,
      searchPagePath: false,
    },
    metadata: [
      {
        name: "keywords",
        content:
          "unlock, blockchain, nft, token-gate, memberships, subscriptions",
      },
      {
        property: "og:locale",
        content: "og:en_US",
      },
      {
        poperty: "og:type",
        content: "website",
      },
      {
        property: "og:description",
        content:
          "Unlock Protocol technical documentation for developers with a complete protocol reference, tutorials and code examples.",
      },
      {
        property: "og:title",
        content: "Unlock Protocol Technical Docs",
      },
      {
        property: "og:url",
        content: "https://unlock-wpplugin-community-edition.aihipuniversity.com",
      },
      {
        property: "og:image",
        content: "/img/dev-docs-share-img.png",
      },
      {
        property: "og:image:width",
        content: "1200",
      },
      {
        property: "og:image:height",
        content: "627",
      },
      {
        property: "og:image:type",
        content: "image/png",
      },
      {
        name: "twitter:card",
        content: "summary_large_image",
      },
      {
        name: "twitter:title",
        content: "Unlock Protocol Technical Docs",
      },
      {
        name: "twitter:description",
        content:
          "Unlock Protocol technical documentation for developers with a complete protocol reference, tutorials and code examples.",
      },
      {
        name: "twitter:image",
        content: "/img/dev-docs-share-img.png",
      },
      {
        name: "twitter:image:alt",
        content: "Unlock logo with the word docs next to it",
      },
      { name: 'docsearch:docusaurus_tag', content: 'current' }
    ],
    navbar: {
      title: "Unlock",
      logo: {
        alt: "Unlock Protocol",
        src: "img/logo.svg",
        href: "https://unlock-protocol.com/",
      },
      items: [
        { to: "/", label: "Home", position: "right" },
        {
          to: "https://app.unlock-protocol.com/dashboard",
          label: "Dashboard",
          position: "right",
        },
        { to: "/features", label: "Features", position: "right" },
        { to: "/showcase", label: "Showcase", position: "right" },
        {
          href: "https://github.com/AiHiPUniversity/unlock-protocol-wordpress-plugin-community-edition",
          label: "GitHub",
          position: "right",
        },
        { to: "/faq", label: "FAQ", position: "right" },
      ],
    },
    footer: {
      style: "dark",
      links: [
        {
          title: "Docs",
          items: [
            {
              label: "Overview",
              to: "/",
            },
            {
              label: "FAQ",
              to: "/faq",
            },
            {
              label: "Tutorials",
              to: "/tutorials",
            },
            {
              label: "Showcase",
              to: "/showcase",
            },
            {
              label: "GitHub",
              href: "https://github.com/AiHiPUniversity/unlock-protocol-wordpress-plugin-community-edition",
            },
          ],
        },
        {
          title: "Community",
          items: [
            {
              label: "Discord",
              href: "https://discord.com/invite/Ah6ZEJyTDp",
            },
            {
              label: "Twitter",
              href: "https://twitter.com/UnlockProtocol",
            },
            {
              label: "Forum",
              href: "https://unlock.community/",
            },
          ],
        },
        {
          title: "About Unlock",
          items: [
            {
              label: "About Unlock",
              to: "https://unlock-protocol.com",
            },
            {
              label: "Blog",
              to: "https://app.unlock-protocol.com",
            },
            {
              label: "Guides",
              to: "https://unlock-protocol.com/guides",
            },
            {
              label: "Brand kit",
              to: "https://unlock-protocol.com/guides/#",
            },
          ],
        },
        {
          title: "Unlock apps",
          items: [
            {
              label: "Launch dashboard",
              to: "https://app.unlock-protocol.com",
            },
            {
              label: "Grants for developer",
              to: "https://unlock-protocol.com/grants",
            },
          ],
        },
      ],
      copyright: `Copyright © 2023-${new Date().getFullYear()} Unlock Wordpress Plugin Community Edition.`,
    },
    prism: {
      additionalLanguages: ["solidity"],
      theme: UnlockPrismTheme,
    }
  },

  i18n: {
    defaultLocale: "en",
    locales: ["en"],
  },
};

module.exports = config;
